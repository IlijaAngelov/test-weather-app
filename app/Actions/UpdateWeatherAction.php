<?php

namespace App\Actions;

use App\Models\Weather;

class UpdateWeatherAction
{
    public function handle($data): void
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
