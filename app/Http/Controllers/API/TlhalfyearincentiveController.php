<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tlhalfyearincentive;

class TlhalfyearincentiveController extends Controller
{

    //12-03-2023

    public function index()
    {  
        $newTLHY = Tlhalfyearincentive::all();
        $newTLHY = DB::table('tl_halfyear_incentive')
                        ->join('users', 'users.user_id', '=', 'tl_halfyear_incentive.teamleader_id')
                        ->join('teams', 'teams.team_id', '=', 'tl_halfyear_incentive.team_id')
                        ->select('users.firstname','users.middlename','users.lastname','teams.teamname', 'tl_halfyear_incentive.*')
                        ->get();
        return response()->json($newTLHY);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
     {
         $newTLHY = new Tlhalfyearincentive([
             'teamleader_id' => $request->get('teamleader_id'),
             'team_id' => $request->get('team_id'),
             'bussiness_value' => $request->get('bussiness_value'),
             'eligibility' => $request->get('eligibility'),
             'halfyear_inc' => $request->get('halfyear_inc'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),

             'paid_amt' => $request->get('paid_amt'),
             'ince_type' => $request->get('ince_type'),
            
         ]);
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
 
 
     public function store(Request $request)
     {      
 
         $request->validate([
             'teamleader_id' => 'required',
             'team_id' => 'required',
            //  'bussiness_value' => 'required',
            //  'eligibility' => 'required',
            //  'halfyear_inc' => 'required',
             'from_date' => 'required',
             'to_date' => 'required',
            //  'paid_amt' => '',
            // 'ince_type' => '',

         ]);
 
         $newTLHY = new Tlhalfyearincentive([
             'teamleader_id' => $request->get('teamleader_id'),
             'team_id' => $request->get('team_id'),
             'bussiness_value' => $request->get('bussiness_value'),
             'eligibility' => $request->get('eligibility'),
             'halfyear_inc' => $request->get('halfyear_inc'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),
             'paid_amt' => $request->get('paid_amt'),
             'ince_type' => $request->get('ince_type'),
         ]);
 
         $newTLHY->save();
 
         
         return response()->json($newTLHY);
         
         // return ('message','Success! You have added data successfully.');
 
     
     }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($ince_id)
    {
        $newTLHY = Tlhalfyearincentive::findOrFail($ince_id);
		return response()->json($newTLHY);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$team_id)
    {
        $newTLHY = Tlhalfyearincentive::findOrFail($team_id);

		$request->validate([
            'teamleader_id' => 'required',
            'team_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
		]);

        $newTLHY->teamleader_id = $request->get('teamleader_id');
		$newTLHY->team_id = $request->get('team_id');
        $newTLHY->bussiness_value = $request->get('bussiness_value');
        $newTLHY->eligibility = $request->get('eligibility');
        $newTLHY->halfyear_inc = $request->get('halfyear_inc');
        $newTLHY->from_date = $request->get('from_date');
		$newTLHY->to_date = $request->get('to_date');
       

		$newTLHY->save();

		return response()->json($newTLHY);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($team_id)
    {
        $newTLHY = Tlhalfyearincentive::findOrFail($team_id);
		$newTLHY->delete();

		return response()->json($newTLHY::all());
    }

    //23-03-2023
    public function getTLHYLastUser(){
        $data=DB::table('tl_halfyear_incentive')
        ->select('*')
        ->orderBy('ince_id','desc')
        ->limit(1)
        ->get();
        return response()->json($data);
    }


    function getTLHYData(Request $request){
        $team_leader_id = $request->get('team_leader_id');
        $data = DB::table('tl_halfyear_incentive')
        ->join('users', 'users.user_id', '=', 'tl_halfyear_incentive.teamleader_id')
        ->join('teams', 'teams.team_id', '=', 'tl_halfyear_incentive.team_id')
        ->select('users.firstname','users.middlename','users.lastname','teams.teamname', 'tl_halfyear_incentive.*')
        ->where('teamleader_id','=',$team_leader_id)
        ->get();
        return response()->json($data);
    }


    public function getTLMHYTlData(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $syearmonth = $request->get('syearmonth');
        $eyearmonth = $request->get('eyearmonth');

        $data=DB::table('tl_monthly_incentive')
        ->select('*')
        ->whereBetween('YearMonth',["$syearmonth","$eyearmonth"])
        ->where('team_id','=',$team_id)
        ->where('teamleader_id',$teamleader_id)
        ->get();
        return response()->json($data);
    }


    function updateHYTLIncentive(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $eligibility = $request->get('eligibility');
        $halfyear_inc = $request->get('halfyear_inc');
        $bussiness_value = $request->get('bussiness_value');


        $data = DB::table('tl_halfyear_incentive')
                ->where('team_id',$team_id)
                ->where('teamleader_id',$teamleader_id)
                ->where('from_date',$from_date)
                ->where('to_date',$to_date)
                ->update(["eligibility" =>$eligibility,"halfyear_inc"=>$halfyear_inc,"bussiness_value"=>$bussiness_value]);
        return response()->json($data);
    }


    //18-04-2023
    function upTLHYEligible(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $tl_halfyear_eligible = $request->get('tl_halfyear_eligible');

        $data = DB::table('tl_halfyear_incentive')
        ->where('team_id',$team_id)
        ->where('teamleader_id',$teamleader_id)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["tl_halfyear_eligible" =>$tl_halfyear_eligible]);
        return response()->json($data);
    }


}
