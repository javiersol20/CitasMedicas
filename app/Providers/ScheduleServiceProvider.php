<?php

namespace App\Providers;

use App\Interfaces\ScheduleServiceInterface;
use App\Services\ScheduleService;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ScheduleServiceInterface::class, ScheduleService::class);
    }

    public function boot()
    {
        //
    }
}
