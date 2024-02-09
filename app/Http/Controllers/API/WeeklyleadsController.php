<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weeklyleads;
//use DB   
use Illuminate\Support\Facades\DB;;

class WeeklyleadsController extends Controller
{
    public function index()
    {
        $Weeklyleads = Weeklyleads::all();
		return response()->json($Weeklyleads);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$newWeeklyleadsData = $newWeeklyleads->getnewWeeklyleads($request->email);




        $newWeeklyleads = new Weeklyleads([
			'id' => $request->get('id'),
            'team_id' => $request->get('team_id'),
            'emp_id' => $request->get('emp_id'),
             'week_date' => $request->get('week_date'),
            //  'to_date' => $request->get('to_date'),
            'week_count'=> $request->get('week_count'),
            'yearly_week_count' => $request->get('yearly_week_count'),
            'weekly_lead_count' => $request->get('weekly_lead_count'),
            'weekly_lead_count_valid' => $request->get('weekly_lead_count_valid')
            
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
			'id' => '',
            'team_id' => '',
            'emp_id' => '',
             'week_date'=>'',
             'to_date'=>'',
            'week_count'=>'',
            'yearly_week_count' => '',
            'weekly_lead_count' => '',
            'weekly_lead_count_valid' => ''
		]);
        $year = date('Y',strtotime($request->get('week')));
        // $getDate = $this->getMonthDate($request->get('week'));
        $getweek = $this->getweekdate($request->get('yearly_week_count'),$year);

		$newWeeklyleads = new Weeklyleads([
			'id' => $request->get('id'),
            'team_id' => $request->get('team_id'),
            'emp_id' => $request->get('emp_id'),
            // 'week' => $request->get('week'),
             'week_date' => $getweek[0],
            //  'to_date' => $request->get('to_date'),
             'to_date' => $getweek[1],
            'week_count'=> $request->get('week_count'),
            'yearly_week_count' => $request->get('yearly_week_count'),
            'weekly_lead_count' => $request->get('weekly_lead_count'),
            'weekly_lead_count_valid' => $request->get('weekly_lead_count_valid')

		]);


		$newWeeklyleads->save();

		return response()->json($newWeeklyleads);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newWeeklyleads = Weeklyleads::findOrFail($id);
		return response()->json($newWeeklyleads);
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
    public function update(Request $request, $id)
    {
        $newWeeklyleads = Weeklyleads::findOrFail($id);
		
		$newWeeklyleads = Weeklyleads::find($id);
        $newWeeklyleads->update($request->all());
        return $newWeeklyleads;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newWeeklyleads = Weeklyleads::findOrFail($id);
		$newWeeklyleads->delete();

		return response()->json($newWeeklyleads::all());
    }


    public function getweekdate($week, $year){
        $time = strtotime("1 January $year", time());
        $day = date('w', $time);
        $time += ((7*$week)+1-$day)*24*3600;
        $dates[0] = date('Y-m-d', $time);
        $time += 6*24*3600;
        $dates[1] = date('Y-m-d', $time);
        
        return $dates;
    }

    public function weeklyleadsview(){

        $data = DB::table('weekly_leads')

        ->join('teams', 'teams.team_id', '=', 'weekly_leads.team_id')
        ->join('users', 'users.user_id', '=', 'weekly_leads.emp_id')
        ->select( 'teams.teamname','users.firstname', 'users.lastname','weekly_leads.*')

        ->get();

        return response()->json($data);
    }

    public function single_employee($user_id){

        $data = DB::table('users')

        ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
        ->join('weekly_leads', 'weekly_leads.emp_id', '=', 'teamdetails.user_id')
        ->select('weekly_leads.*', 'teamdetails.team_id','users.firstname', 'users.lastname')
        ->where('weekly_leads.emp_id',$user_id)

        ->get();

        return response()->json($data);
    }


    public function weeklyteams($team_id){

        $data = DB::table('weekly_leads')

        ->join('teams', 'teams.team_id', '=', 'weekly_leads.team_id')
        ->join('users', 'users.user_id', '=', 'weekly_leads.emp_id')
        ->select('teams.teamname','users.firstname', 'users.lastname','weekly_leads.*')
        ->where('weekly_leads.team_id',$team_id)

        ->get();

        return response()->json($data);
    }

    public function allleadsdata($team_id){

        $data =  DB::table('users')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','teamdetails.*','users.*')
        ->where('teamdetails.team_id',$team_id)
        ->where('users.status_id','1')

        ->get();

        return response()->json($data);
    }


    public function single_emp_weekly($user_id){

        $data = DB::table('users')

        ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
        ->join('weekly_leads', 'weekly_leads.emp_id', '=', 'teamdetails.user_id')
        ->select('weekly_leads.*', 'teamdetails.team_id','users.firstname', 'users.lastname')
        ->where('weekly_leads.emp_id',$user_id)   

        ->get();

        return response()->json($data);
    }

    public function weekwise(Request $request){
        
        $weekdate = $request->get('from_date');
        $to_date = $request->get('to_date');
        $emp_id = $request->get('emp_name');
        
        if(/*$emp_id == null  &&*/ $emp_id == ""){
            // return response()->json('No data');
            $data = DB::table('weekly_leads')
            ->join('users', 'weekly_leads.emp_id', '=', 'users.user_id') 
            ->select('weekly_leads.*','users.firstname','users.lastname')
            ->where('leads_given.emp_id', $emp_id)
            ->whereweek_date('weekly_leads.week_date', ">=", $weekdate)
            ->whereto_date('weekly_leads.week_date', "<=", $to_date)
            // ->toSql();
            ->get();
            
        }else{
        $data = DB::table('weekly_leads')
        ->join('users', 'weekly_leads.emp_id', '=', 'users.user_id')
        ->select('weekly_leads.*','users.firstname','users.lastname')
        ->where('weekly_leads.emp_id',$emp_id)
        ->where('weekly_leads.week_date', ">=", $weekdate)
        ->where('weekly_leads.to_date', "<=", $to_date)
        // ->toSql();
        ->get();

    }
    
    // dd($data);
        return response()->json($data);

    }

}
