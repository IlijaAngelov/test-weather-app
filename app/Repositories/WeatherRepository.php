<?php

namespace App\Repositories;

use App\Models\Weather;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;

class WeatherRepository implements WeatherRepositoryInterface
{
    public function get()
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

    public function store($data)
    {
        Weather::updateOrCreate(
            [
                'city' => $data->name
            ],
            [
                'latitude' => $data->coord->lat,
                'longitude' => $data->coord->lon,
                'description' => $data->weather[0]->description,
                'temperature' => $data->main->temp,
                'country' => $data->sys->country,
                'city' => $data->name,
                'timezone' => $data->timezone,
                'updated_at' => now(),
            ]
        );
    }
}
