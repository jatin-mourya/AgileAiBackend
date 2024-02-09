<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoFour;
use Illuminate\Support\Facades\DB;
use App\Models\monthbasislead;


class monthLeadServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
    {
      $this->app->bind('App\Library\Services\DemoFour', function ($app) {
          return new DemoFour();
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
