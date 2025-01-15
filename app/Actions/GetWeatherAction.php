<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GetWeatherAction
{
    public function handle()
    {
        $client = new Client();

        $apiUrl = env('API_URL') . env('API_KEY');

        try {
            $response = $client->get($apiUrl);
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            return $e->getResponse();
        }
    }
}
