<?php
namespace App\Library\Services;
use App\Models\service;
use DB;
   
class DemoOne
{
    public function doSomethingUseful()
    {
      $someModel = new service;
        $someModel->setConnection('mysql2');
        $daily_leadcount_projectwise = DB::connection('mysql2')->select('call daily_leadcount_projectwise()');
       
        foreach ($daily_leadcount_projectwise as $data) {
            if(1)
            {
                DB::table('daily_leadcount_projectwise')->insert([
                'cf_1359' =>$data->cf_1359,
                'Hot_Lead' =>$data->Hot_Lead,
                'warm_Lead' =>$data->warm_Lead,
                'Cold_Lead' =>$data->Cold_Lead
                ]);
            }    
        }
    }
}