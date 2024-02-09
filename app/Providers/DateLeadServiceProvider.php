<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoThree;
use Illuminate\Support\Facades\DB;
use App\Models\Datebasislead;


class DateLeadServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
    {
      $this->app->bind('App\Library\Services\DemoThree', function ($app) {
          return new DemoThree();
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
