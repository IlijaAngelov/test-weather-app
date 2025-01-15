<?php

namespace App\Console\Commands;

use App\Actions\UpdateWeatherAction;
use App\Jobs\HourlyWeatherUpdateJob;
use App\Jobs\UpdateWeatherJobWithActions;
use Illuminate\Console\Command;

class RunScheduleWorkForWeatherUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        HourlyWeatherUpdateJob::dispatch();
        UpdateWeatherJobWithActions::dispatch();
    }
}
