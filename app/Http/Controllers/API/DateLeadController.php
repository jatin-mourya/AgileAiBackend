<?php
namespace App\Http\Controllers\API;
use App\Providers\DateLeadServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Services\DemoThree;
use App\Models\Datebasislead;

use DB;

class DateLeadController extends Controller
{
    public function leadDatereport(DemoThree $customServiceInstance2){
          print_r($customServiceInstance2->doSomethingUseful2());
    }
    public function leadDatewise()
    {
    
        $data1 = DB::table('datewise_lead')
                        ->select('*')
                        ->get();

		return response()->json($data1);
      
    }
     public function weekleaderlist(Request $request){
        //  return response()->json($request[0][0]);
        $datelead = DB::table('datewise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('year', '=', $request[0][0])
                         ->where('Week', '=', $request[0][1])
                        // ->Where('Team_Leader', '=', $request[1])
                        ->get();
		return response()->json($datelead);
    }
     public function weekleaderlist1(Request $request){
        $datelead1 = DB::table('datewise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                       ->where('year', '=', $request[0][0])
                         ->where('Week', '=', $request[0][1])
                        ->Where('Team_Leader', '=', $request[1])
                        ->get();
		return response()->json($datelead1);
    }
     public function weekleaderlist2(Request $request){
        $datelead2 = DB::table('datewise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('year', '=', $request[0][0])
                         ->where('Week', '=', $request[0][1])
                        ->Where('Team_Leader', '=', $request[1])
                        ->Where('emp_code', '=', $request[2])
                        ->get();
		return response()->json($datelead2);
    }
    
}

