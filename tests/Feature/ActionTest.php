<?php

it('tests the get action', function () {
    $action = new \App\Actions\GetWeatherAction();
    dd($action->__invoke());
});

it('updated the weather', function () {
    $action = new \App\Actions\UpdateWeatherAction();
//    $data = new \App\Actions\GetWeatherAction();
//    dd($data->__invoke());
//    dd($action->__invoke($data->__invoke()));


    $fakeResponse = [
        'location' => [
            'name' => 'Strumica',
            'coordinates' => [
                'latitude' => 41.4378,
                'longitude' => 22.6427,
            ],
            'country' => 'MK',
        ],
        'weather' => [
            'condition' => 'Clouds',
            'description' => 'few clouds',
            'temperature' => [
                'current' => 277.55,
                'feels_like' => 274.37,
                'min' => 277.55,
                'max' => 277.55,
            ],
            'pressure' => 1030,
            'humidity' => 67,
        ],
        'wind' => [
            'speed' => 3.84,
            'direction' => 310,
            'gust' => 5.07,
        ],
        'cloud_coverage' => 20,
        'visibility' => 10000,
        'timestamps' => [
            'sunrise' => 1735278885,
            'sunset' => 1735311975,
            'data_calculated_at' => 1735288925,
        ],
        'timezone_offset' => 3600,
    ];
    dd($action->__invoke($fakeResponse));
});
