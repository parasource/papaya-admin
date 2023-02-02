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

    public function broadcast(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
        ]);

        $client = new Client([
            'base_uri' => 'http://jobs:8201'
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
}
