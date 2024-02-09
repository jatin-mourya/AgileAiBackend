<?php
namespace App\Http\Controllers\API;
use App\Providers\ProjectServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Services\DemoOne;
use App\Models\service;

use App\Console\Commands\DemoCron;

use DB;

class ProjectController extends Controller
{
    public function projectreport(DemoOne $customServiceInstance){
          print_r($customServiceInstance->doSomethingUseful());
    }
    public function leadprojectwise()
    {
    
        $data1 = DB::table('daily_leadcount_projectwise')
                        ->select('*')
                        ->get();

		return response()->json($data1);
      
    }
}

