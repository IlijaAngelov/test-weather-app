<?php

namespace App\Jobs;

use App\Http\Controllers\WeatherController;
use App\Repositories\WeatherRepository;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HourlyWeatherUpdateJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

//    public $tries = 3;

    public function __construct(){}

    public function handle(WeatherRepository $weather): void
    {
//        sleep(5);
        $data = $weather->get();
        try {
            logger('Updating weather...');
            $weather->store($data);
        } catch (Exception $exception) {
            logger($exception->getMessage());
            throw new \RuntimeException('Failed!');
        }
    }

    public function failed(\Throwable $e): void
    {
        info('This job has failed.' . $e->getMessage());
    }
}
