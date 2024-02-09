<?php
namespace App\Http\Controllers\API;
use App\Providers\monthLeadServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Services\DemoFour;
use App\Models\monthbasislead;

use DB;

class monthleadController extends Controller
{
    public function leadmonthreport(DemoFour $customServiceInstance3){
          print_r($customServiceInstance3->doSomethingUseful3());
    }
    public function leadmonthwise()
    {
    
        $data1 = DB::table('monthwise_lead')
                        ->select('*')
                        ->get();

		return response()->json($data1);
      
    }
    
//      public function monthleaderlist(Request $request){
//         //  return response()->json($request[0][0]);
//         $monthlead = DB::table('monthwise_lead')
//                         ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
//                          ->whereDate('created_at', '=', $request[0])
//                         //  ->where('Week', '=', $request[0][1])
//                         // ->Where('Team_Leader', '=', $request[1])
//                         ->get();
// 		return response()->json($monthlead);
//     }
    
    public function monthleaderlist(Request $request){
        //  return response()->json($request[0][0]);
        $monthlead = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('Year', '=', $request[0][0])
                         ->where('month', '=', $request[0][1])
                        // ->Where('Team_Leader', '=', $request[1])
                        ->get();
		return response()->json($monthlead);
    }
     public function monthleaderlist1(Request $request){
        $monthlead1 = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('Year', '=', $request[0][0])
                         ->where('month', '=', $request[0][1])
                        ->Where('Team_Leader', '=', $request[1])
                        ->get();
		return response()->json($monthlead1);
    }
     public function monthleaderlist2(Request $request){
        $monthlead2 = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                         ->where('Year', '=', $request[0][0])
                         ->where('month', '=', $request[0][1])
                        ->Where('Team_Leader', '=', $request[1])
                        ->Where('emp_code', '=', $request[2])
                        ->get();
		return response()->json($monthlead2);
    }
//      public function monthleaderlist(Request $request){
//         $datelead = DB::table('monthwise_lead')
//                         ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
//                         ->whereDate('created_at', '=', $request[0])
//                         ->get();
// 		return response()->json($datelead);
//     }

 public function yearleaderlist(Request $request){
        $year = $request->Year;
        
        $yearlead = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('Year', '=',$year)
                        ->get();
		return response()->json($yearlead);
    }
     public function yearleaderlist1(Request $request){
        $team_id = $request->Team_Leader;
        $year = $request->Year;
        $yearlead1 = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('Year', '=',$year)
                        ->Where('Team_Leader', '=',$team_id)
                        ->get();
		return response()->json($yearlead1);
    }
     public function yearleaderlist2(Request $request){
        $user_id9 = $request->emp_code;
        $team_id = $request->Team_Leader;
        $year = $request->Year;

        $yearlead2 = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('Year', '=',$year)
                        ->Where('Team_Leader', '=',$team_id)
                        ->Where('emp_code', '=',$user_id9)
                        ->get();
		return response()->json($yearlead2);
    }
    
}

