<?php

namespace App\Services;

use App\Models\Look;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Adviser
{
    private Client $client;

    public function __construct(string $baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri
        ]);
    }

    public function storeItem(Look $look, array $categories)
    {
        $res = $this->client->request("POST", "/api/item", [
            RequestOptions::JSON => [
                'Categories' => $categories,
                'IsHidden' => false,
                'ItemID' => "$look->id",
                'Timestamp' => Carbon::now()
            ]
        ]);
    }
}