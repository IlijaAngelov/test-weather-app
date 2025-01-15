<?php


use App\Repositories\WeatherRepository;
use Illuminate\Support\Facades\Http;

test('the API returns successful response', function () {
    $response = Http::get(env('API_URL') . env('API_KEY'));
    expect($response->status())->toBe(200);
});

test('the get method', function () {
    $weather = new WeatherRepository;
    $data = $weather->get();
    expect($data)->toHaveKeys([
        "coord",
        "weather",
        "main",
        "wind",
        "sys",
        "name",
        "timezone"
    ]);
});

test('the store method', function () {
    $mock = Mockery::mock(WeatherRepository::class)->makePartial();

    $mock->shouldReceive('get')
        ->once()
        ->andReturn(collect([
            "coord" => [
                "lon" => 22.6427,
                "lat" => 41.4378,
            ],
            "weather" => [
                "id" => 800,
                "main" => false,
                "description" => false,
                "icon" => "01d"
            ],
            "base" => "stations",
            "main" => [
                "temp" => 800,
                "feels_like" => false,
                "temp_min" => false,
                "temp_max" => false,
                "pressure" => false,
                "humidity" => false,
                "sea_level" => false,
                "grnd_level" => "01d"
            ],
            "visibility" => 10000,
            "wind" => [
                "speed" => 1.27,
                "deg" => 171,
                "gust" => 1.23
            ],
            "clouds" => [
                "all" => 1
            ],
            "dt" => 1736347113,
            "sys" => [
                "country" => "MK",
            ],
            "timezone" => "Europe/Prague",
            "id" => 785380,
            "name" => "Strumica",
            "cod" => 200
        ]));
    $result = $mock->store();

    expect($result)->toBe('');

});

test('the store method1', function () {

    $fakeResponse1 = [
        "data" => [
            "coord" => [
                "lon" => 22.6427,
                "lat" => 41.4378,
            ],
            "description" => "Test weather",
            "main" => 32,
            "sys" => [
                "country" => "MK",
            ],
            "name" => "neznam",
            "timezone" => "Europe/Prague",
        ],
    ];
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

    $data = Http::fake([
        env('API_URL') . env('API_KEY') => Http::response([
            'coord' => ['lon' => 22.6427, 'lat' => 41.4378],
            'weather' => [
                ['id' => 801, 'main' => 'Clouds', 'description' => 'few clouds', 'icon' => '02d']
            ],
            'main' => ['temp' => 277.55, 'feels_like' => 274.37, 'temp_min' => 277.55, 'temp_max' => 277.55, 'pressure' => 1030, 'humidity' => 67],
            'wind' => ['speed' => 3.84, 'deg' => 310, 'gust' => 5.07],
            'clouds' => ['all' => 20],
            'sys' => ['country' => 'MK', 'sunrise' => 1735278885, 'sunset' => 1735311975],
            'dt' => 1735288925,
            'timezone' => 3600,
            'id' => 785380,
            'name' => 'Strumica',
            'cod' => 200,
        ], 200),
    ]);

    $weather = new WeatherRepository;
    $endData = $weather->store($data);

    expect($endData)->toBe($fakeResponse);
})->todo();
