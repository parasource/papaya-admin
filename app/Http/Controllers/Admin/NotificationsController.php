<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index');
    }

    public function broadcast()
    {
        return view('admin.notifications.broadcast');
    }

    public function broadcastPost(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
        ]);

        $client = new Client([
            'base_uri' => 'http://62.113.102.18:8201'
        ]);
        $res = $client->request("POST", "/apns/broadcast", [
            RequestOptions::JSON => [
                'title' => $request['title'],
                'body' => $request['text']
            ]
        ]);

        if ($res->getStatusCode() == 200) {
            return redirect()->route('admin.notifications.index')
                ->with('success', 'Рассылка успешно начата');
        }

        return redirect()->back()
            ->with('error', 'Возникла ошибка при отправлении рассылки. См логи сервиса jobs');
    }

    public function send()
    {
        return view('admin.notifications.send');
    }

    public function sendPost(Request $request)
    {

    }
}

function send_apns_push($pemfile, $passphrase, $title, $text, $deviceToken, $badge = null, $params = null)
{
    $response = array();

    ////////////////////////////////////////////////////////////////////////////////
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

    // Open a connection to the APNS server
    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

    if (!$fp) {
        exit("Failed to connect: $err $errstr" . PHP_EOL);
    }

    // Create the payload body
    $body['aps'] = array(
        'alert' => [
            'title' => $title,
            'body' => $text
        ],
        'sound' => 'default',
        'badge' => $badge
    );

    if ($params) {
        foreach ($params as $key => $value) {
            $body[$key] = $value;
        }
    }

    // Encode the payload as JSON
    $payload = json_encode($body);

    // Build the binary notification
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

    // Send it to the server
    $result = fwrite($fp, $msg, strlen($msg));

    if (!$result) {
        $response['log'] = 'Message not delivered' . PHP_EOL;

    } else {
        $response['log'] = 'Message successfully delivered' . PHP_EOL;
    }

    // Close the connection to the server
    fclose($fp);

    return $response;
}
