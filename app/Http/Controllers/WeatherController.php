<?php

namespace App\Http\Controllers;

use App\Jobs\HourlyWeatherUpdateJob;
use App\Models\Weather;
use App\Repositories\WeatherRepository;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

class WeatherController extends Controller
{

    public function __construct(protected WeatherRepository $weatherRepository){}

    public function index()
    {
//        $data = $this->getWeather();
        Schedule::job(new HourlyWeatherUpdateJob)->everyMinute();
//        HourlyWeatherUpdateJob::dispatch();
    }

    public function store()
    {
        // Storing data for single city. What about mass store??
        $data = $this->getWeather()['weatherData'];
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
            ]);
    }
    public function getWeather()
    {
        $client = new Client();
        $apiUrl = env('API_URL') . env('API_KEY');

        try {
            $response = $client->get($apiUrl);
            $weatherData = json_decode($response->getBody());
            return view('weather', ['weatherData' => $weatherData]);
        } catch (ClientException $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    public function getWeatherFromRepository()
    {
        return $this->weatherRepository->get();
    }

    public function updateWeatherFromRepository()
    {
        $data = $this->getWeatherFromRepository();
        $this->weatherRepository->store($data);
    }
}
