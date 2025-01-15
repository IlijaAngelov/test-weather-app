<?php

namespace App\Repositories;

interface WeatherRepositoryInterface
{
    public function get();

    public function store($data);
}
