<?php

namespace App\Jobs;

use App\Actions\GetWeatherAction;
use App\Actions\UpdateWeatherAction;
use App\Repositories\WeatherRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateWeatherJobWithActions implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
//        private readonly GetWeatherAction $getWeather,
//        private readonly UpdateWeatherAction $updateWeather
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(WeatherRepository $weather, GetWeatherAction $get, UpdateWeatherAction $updateWeather): void
    {

//        $data = $weather->get();
//        try {
//            logger('Updating weather...');
//            $weather->store($data);
//        } catch (Exception $exception) {
//            logger($exception->getMessage());
//            throw new \RuntimeException('Failed!');
//        }
//        $data = $this->getWeather->handle();
//
        $data = $get->handle();
        $updateWeather->handle($data);
    }
}
