<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoTwo;
use Illuminate\Support\Facades\DB;
use App\Models\service;


class LeadServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
    {
      $this->app->bind('App\Library\Services\DemoTwo', function ($app) {
          return new DemoTwo();
        });
}
 

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
