<?php
namespace App\Http\Controllers\API;
use App\Providers\LeadServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Services\DemoTwo;
use App\Models\teamlead;

use DB;

class LeadController extends Controller
{
    public function leadreport(DemoTwo $customServiceInstance1){
          print_r($customServiceInstance1->doSomethingUseful1());
    }
    public function leadteamwise()
    {
    
        $data1 = DB::table('leadgiven_list')
                        ->select('*')
                        ->get();

		return response()->json($data1);
    }
    
//datewise data//
     public function dateleaderlist(Request $request){
        $datelead = DB::table('leadgiven_list')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->whereDate('created_at', '=', $request[0])
                        ->get();
		return response()->json($datelead);
    }
     public function dateleaderlist1(Request $request){
        $datelead1 = DB::table('leadgiven_list')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->whereDate('created_at', '=', $request[0])
                        ->Where('Team_Leader', '=', $request[1])
                        ->get();
		return response()->json($datelead1);
    }
     public function dateleaderlist2(Request $request){
        $datelead2 = DB::table('leadgiven_list')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->whereDate('created_at', '=', $request[0])
                        ->Where('Team_Leader', '=', $request[1])
                        ->Where('emp_code', '=', $request[2])
                        ->get();
		return response()->json($datelead2);
    }
//datewise data//
     
    
//      public function monthleadlist(Request $request){
//         $dateValue = explode('-',$request[0]);
//         $monthlead = DB::table('leadgiven_list')
//                         ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
//                         ->whereMonth('created_at', '=', $dateValue[1])
//                         ->whereYear('created_at', '=', $dateValue[0])
//                         ->get();
// 		return response()->json($monthlead);
//      }
//           public function monthleadlist1(Request $request){
//         $dateValue = explode('-',$request[0]);
//         $datelead1 = DB::table('leadgiven_list')
//                         ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
//                         ->whereMonth('created_at', '=', $dateValue[1])
//                         ->whereYear('created_at', '=', $dateValue[0])
//                         ->Where('Team_Leader', '=', $request[1])
//                         ->get();
// 		return response()->json($datelead1);
//     }
//      public function monthleadlist2(Request $request){
//           $dateValue = explode('-',$request[0]);
//         $datelead2 = DB::table('leadgiven_list')
//                         ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
//                         ->whereMonth('created_at', '=', $dateValue[1])
//                         ->whereYear('created_at', '=', $dateValue[0])
//                         ->Where('Team_Leader', '=', $request[1])
//                         ->Where('emp_code', '=', $request[2])
//                         ->get();
// 		return response()->json($datelead2);
     
     
//      }
    
}

