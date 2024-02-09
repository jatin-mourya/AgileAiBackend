<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tlquarterlyincentive;

class TlquarterlyincentiveController extends Controller
{

    //12-03-2023

    public function index()
    {  
        $newTLQ = Tlquarterlyincentive::all();
        $newTLQ = DB::table('tl_quarterly_incentive')
                        ->join('users', 'users.user_id', '=', 'tl_quarterly_incentive.teamleader_id')
                        ->join('teams', 'teams.team_id', '=', 'tl_quarterly_incentive.team_id')
                        ->select('users.firstname','users.middlename','users.lastname','teams.teamname', 'tl_quarterly_incentive.*')
                        ->get();
        return response()->json($newTLQ);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
     {
         $newTLQ = new Tlquarterlyincentive([
             'teamleader_id' => $request->get('teamleader_id'),
             'team_id' => $request->get('team_id'),
             'bussiness_value' => $request->get('bussiness_value'),
             'eligibility' => $request->get('eligibility'),
             'quarterly_inc' => $request->get('quarterly_inc'),
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
            //  'quarterly_inc' => 'required',
             'from_date' => 'required',
             'to_date' => 'required',
            //  'paid_amt' => '',
            // 'ince_type' => '',

         ]);
 
         $newTLQ = new Tlquarterlyincentive([
             'teamleader_id' => $request->get('teamleader_id'),
             'team_id' => $request->get('team_id'),
             'bussiness_value' => $request->get('bussiness_value'),
             'eligibility' => $request->get('eligibility'),
             'quarterly_inc' => $request->get('quarterly_inc'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),
             'paid_amt' => $request->get('paid_amt'),
             'ince_type' => $request->get('ince_type'),
         ]);
 
         $newTLQ->save();
 
         
         return response()->json($newTLQ);
         
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
        $newTLQ = Tlquarterlyincentive::findOrFail($ince_id);
		return response()->json($newTLQ);
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
        $newTLQ = Tlquarterlyincentive::findOrFail($team_id);

		$request->validate([
            'teamleader_id' => 'required',
            'team_id' => 'required',
           //  'bussiness_value' => 'required',
           //  'eligibility' => 'required',
           //  'quarterly_inc' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
		]);

        $newTLQ->teamleader_id = $request->get('teamleader_id');
		$newTLQ->team_id = $request->get('team_id');
        $newTLQ->bussiness_value = $request->get('bussiness_value');
        $newTLQ->eligibility = $request->get('eligibility');
        $newTLQ->quarterly_inc = $request->get('quarterly_inc');
        $newTLQ->from_date = $request->get('from_date');
		$newTLQ->to_date = $request->get('to_date');
       

		$newTLQ->save();

		return response()->json($newTLQ);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($team_id)
    {
        $newTLQ = Tlquarterlyincentive::findOrFail($team_id);
		$newTLQ->delete();

		return response()->json($newTLQ::all());
    }

    //22-03-2023
    public function getTLQLastUser(){
        $data=DB::table('tl_quarterly_incentive')
        ->select('*')
        ->orderBy('ince_id','desc')
        ->limit(1)
        ->get();
        return response()->json($data);
    }

    function getTLQData(Request $request){
        $team_leader_id = $request->get('team_leader_id');
        $data = DB::table('tl_quarterly_incentive')
        ->join('users', 'users.user_id', '=', 'tl_quarterly_incentive.teamleader_id')
        ->join('teams', 'teams.team_id', '=', 'tl_quarterly_incentive.team_id')
        ->select('users.firstname','users.middlename','users.lastname','teams.teamname', 'tl_quarterly_incentive.*')
        ->where('teamleader_id','=',$team_leader_id)
        ->get();
        return response()->json($data);
    }


    public function getTlTidUid($semp_id){
        $data=DB::table('teamdetails')
        ->select('team_leaders.user_id', 'team_leaders.team_id')
        ->join('team_leaders','teamdetails.team_leader_name','=','team_leaders.team_leader_name')
        ->where('teamdetails.user_id','=',$semp_id)
        ->get();
        return response()->json($data);
    }

    public function getTLMQTlData(Request $request){
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

    function updateQTLIncentive(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $eligibility = $request->get('eligibility');
        $quarterly_inc = $request->get('quarterly_inc');
        $bussiness_value = $request->get('bussiness_value');

        $data = DB::table('tl_quarterly_incentive')
                ->where('team_id',$team_id)
                ->where('teamleader_id',$teamleader_id)
                ->where('from_date',$from_date)
                ->where('to_date',$to_date)
                ->update(["eligibility" =>$eligibility,"quarterly_inc"=>$quarterly_inc,"bussiness_value"=>$bussiness_value ]);
        return response()->json($data);
    }


    //17-04-2023 for quaterly eligibility
    function getAllTLUsers(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');

        $data = DB::table('team_leaders')
        ->select('teamdetails.user_id')
        ->leftJoin('teams','team_leaders.team_id','=','teams.team_id')
        ->leftJoin('teamdetails',function($join) {
            $join->on('team_leaders.team_id','=','teamdetails.team_id')
            ->on('team_leaders.team_leader_name','=','teamdetails.team_leader_name');
        })
        ->where('team_leaders.user_id','=',$teamleader_id)
        ->where('teams.team_id','=',$team_id)
        ->get();
        return response()->json($data);
    }


    function getTLUsersInTBL(Request $request){
        $user_id = $request->get('user_id');
        $YearMonthS = $request->get('YearMonthS');
        $YearMonthE = $request->get('YearMonthE');

        $data = DB::table('tbl_monthly_incentive')
        ->select('*')
        ->whereBetween('YearMonth',["$YearMonthS","$YearMonthE"])
        ->whereIn('user_id',$user_id)
        ->get();
        return response()->json($data);
    }

    //18-04-2023
    function upTLQEligible(Request $request){
        $team_id = $request->get('team_id');
        $teamleader_id = $request->get('teamleader_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $tl_quarterly_eligible = $request->get('tl_quarterly_eligible');

        $data = DB::table('tl_quarterly_incentive')
        ->where('team_id',$team_id)
        ->where('teamleader_id',$teamleader_id)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["tl_quarterly_eligible" =>$tl_quarterly_eligible]);
        return response()->json($data);
    }


  
    

  
     

   
   
   




    



}
