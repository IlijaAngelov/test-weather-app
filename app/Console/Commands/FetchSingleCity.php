<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class FetchSingleCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:city {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $client = new Client();
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $this->argument('city') . "&appid=" . env('API_KEY');
        try {
            $response = $client->get($url);
            $weatherData = json_decode($response->getBody());
            print_r($weatherData);
        } catch (ClientException $e) {
            print_r($e->getMessage());
        }
    }
}
