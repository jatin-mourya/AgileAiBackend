<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoFive;
use Illuminate\Support\Facades\DB;
use App\Models\yearbasislead;


class yearLeadServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
    {
      $this->app->bind('App\Library\Services\DemoFive', function ($app) {
          return new DemoFive();
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
