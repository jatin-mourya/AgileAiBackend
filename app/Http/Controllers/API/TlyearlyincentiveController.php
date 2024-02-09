<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tlyearlyincentive;

class TlyearlyincentiveController extends Controller
{

    public function index()
    {  
        $newTLY = Tlyearlyincentive::all();
        $newTLY = DB::table('tl_yearly_incentive')
                        ->join('users', 'users.user_id', '=', 'tl_yearly_incentive.teamleader_id')
                        ->join('teams', 'teams.team_id', '=', 'tl_yearly_incentive.team_id')
                        ->select('users.firstname','users.middlename','users.lastname','teams.teamname', 'tl_yearly_incentive.*')
                        ->get();
        return response()->json($newTLY);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
     {
         $newTLY = new Tlyearlyincentive([
             'teamleader_id' => $request->get('teamleader_id'),
             'team_id' => $request->get('team_id'),
             'bussiness_value' => $request->get('bussiness_value'),
             'eligibility' => $request->get('eligibility'),
             'yearly_inc' => $request->get('yearly_inc'),
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
            //  'yearly_inc' => 'required',
             'from_date' => 'required',
             'to_date' => 'required',
            //  'paid_amt' => '',
            // 'ince_type' => '',

         ]);
 
         $newTLY = new Tlyearlyincentive([
             'teamleader_id' => $request->get('teamleader_id'),
             'team_id' => $request->get('team_id'),
             'bussiness_value' => $request->get('bussiness_value'),
             'eligibility' => $request->get('eligibility'),
             'yearly_inc' => $request->get('yearly_inc'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),
             'paid_amt' => $request->get('paid_amt'),
             'ince_type' => $request->get('ince_type'),
         ]);
 
         $newTLY->save();
 
         
         return response()->json($newTLY);
         
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
        $newTLY = Tlyearlyincentive::findOrFail($ince_id);
		return response()->json($newTLY);
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
        $newTLY = Tlyearlyincentive::findOrFail($team_id);

		$request->validate([
            'teamleader_id' => 'required',
            'team_id' => 'required',
           //  'bussiness_value' => 'required',
           //  'eligibility' => 'required',
           //  'yearly_inc' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
		]);

        $newTLY->teamleader_id = $request->get('teamleader_id');
		$newTLY->team_id = $request->get('team_id');
        $newTLY->bussiness_value = $request->get('bussiness_value');
        $newTLY->eligibility = $request->get('eligibility');
        $newTLY->yearly_inc = $request->get('yearly_inc');
        $newTLY->from_date = $request->get('from_date');
		$newTLY->to_date = $request->get('to_date');
       

		$newTLY->save();

		return response()->json($newTLY);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($team_id)
    {
        $newTLY = Tlyearlyincentive::findOrFail($team_id);
		$newTLY->delete();

		return response()->json($newTLY::all());
    }

    //24-03-2023
    public function getTLYLastUser(){
        $data=DB::table('tl_yearly_incentive')
        ->select('*')
        ->orderBy('ince_id','desc')
        ->limit(1)
        ->get();
        return response()->json($data);
    }


    function getTLYData(Request $request){
        $team_leader_id = $request->get('team_leader_id');
        $data = DB::table('tl_yearly_incentive')
        ->join('users', 'users.user_id', '=', 'tl_yearly_incentive.teamleader_id')
        ->join('teams', 'teams.team_id', '=', 'tl_yearly_incentive.team_id')
        ->select('users.firstname','users.middlename','users.lastname','teams.teamname', 'tl_yearly_incentive.*')
        ->where('teamleader_id','=',$team_leader_id)
        ->get();
        return response()->json($data);
    }

    public function getTLMYTlData(Request $request){
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

    function updateYTLIncentive(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $eligibility = $request->get('eligibility');
        $yearly_inc = $request->get('yearly_inc');
        $bussiness_value = $request->get('bussiness_value');

        $data = DB::table('tl_yearly_incentive')
                ->where('team_id',$team_id)
                ->where('teamleader_id',$teamleader_id)
                ->where('from_date',$from_date)
                ->where('to_date',$to_date)
                ->update(["eligibility" =>$eligibility,"yearly_inc"=>$yearly_inc,"bussiness_value"=>$bussiness_value ]);
        return response()->json($data);
    }


    //18-04-2023
    function upTLYEligible(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $tl_yearly_eligible = $request->get('tl_yearly_eligible');

        $data = DB::table('tl_yearly_incentive')
        ->where('team_id',$team_id)
        ->where('teamleader_id',$teamleader_id)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["tl_yearly_eligible" =>$tl_yearly_eligible]);
        return response()->json($data);
    }
    


}
