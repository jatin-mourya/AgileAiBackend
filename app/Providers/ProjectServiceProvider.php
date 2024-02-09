<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoOne;
use Illuminate\Support\Facades\DB;
use App\Models\service;


class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
     public function register()
    {
      $this->app->bind('App\Library\Services\DemoOne', function ($app) {
          return new DemoOne();
        });
}
    // public function register()
    // {
    //       $someModel = new service;
    //      $someModel->setConnection('mysql2');
    
    //      $daily_leadcount_projectwise = DB::connection('mysql2')->select('call daily_leadcount_projectwise()');
    //      config(['your-namespace.message' => $daily_leadcount_projectwise ]);
    // }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
