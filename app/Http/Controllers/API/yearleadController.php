<?php
namespace App\Http\Controllers\API;
use App\Providers\monthLeadServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Services\DemoFour;
use App\Models\monthbasislead;

use DB;

class yearleadController extends Controller
{
     public function leadmonthreport(DemoFour $customServiceInstance3){
          print_r($customServiceInstance3->doSomethingUseful3());
    }
    public function leadyearwise()
    {
    
        $data1 = DB::table('monthwise_lead')
                        ->select('*')
                        ->get();

		return response()->json($data1);
      
    }
    
  public function yearleaderlist(Request $request){
        $year = $request->Year;
        
		return response()->json($year);
        $monthlead = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('monthwise_lead.Year',$year)
                        ->get();
    }
     public function yearleaderlist1(Request $request){
        $team_id = $request->team_id;
        $year = $request->Year;
        $monthlead1 = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('monthwise_lead.Year',$year)
                        ->Where('monthwise_lead.Team_Leader',$team_id)
                        ->get();
		return response()->json($monthlead1);
    }
     public function yearleaderlist2(Request $request){
        $user_id6 = $request->user_id;
        $team_id = $request->team_id;
        $year = $request->Year;

        $monthlead2 = DB::table('monthwise_lead')
                        ->select('Team_Leader','username','emp_code','Hot_Lead', 'warm_Lead','Cold_Lead')
                        ->where('monthwise_lead.Year',$year)
                        ->Where('monthwise_lead.Team_Leader',$team_id)
                        ->Where('monthwise_lead.emp_code',$user_id6)
                        ->get();
		return response()->json($monthlead2);
    }
    
}

