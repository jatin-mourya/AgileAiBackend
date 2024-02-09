<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leadsgiven;
//use DB   
use Illuminate\Support\Facades\DB;;

class LeadsgivenController extends Controller
{
    public function index()
    {
        $Leadsgiven = Leadsgiven::all();
		return response()->json($Leadsgiven);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$newLeadsgivenData = $newLeadsgiven->getnewLeadsgiven($request->email);



        // dd($request);
        $newLeadsgiven = new Leadsgiven([
			'leads_given_id ' => $request->get('leads_given_id'),
            'team_id' => $request->get('team_id'),
            // 'emp_code' => $request->get('emp_code'),
            'emp_id' => $request->get('emp_id'),
            'month' => $request->get('month'),
            'to_date' => $request->get('to_date'),
            'leads_given_to' => $request->get('leads_given_to'),
            'valid_lead_count' => $request->get('valid_lead_count')
            
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
            'leads_given_id' => '',
            'team_id' => '',
            // 'emp_code' => '',
            'emp_id' => '',
            'month' => '',
            'to_date' => '',
            'leads_given_to' => '',
            'valid_lead_count' => ''
		]);
        
        $getDate = $this->getMonthDate($request->get('month'));



		$newLeadsgiven = new Leadsgiven([
			'leads_given_id' => $request->get('leads_given_id'),
            'team_id' => $request->get('team_id'),
            // 'emp_code' => $request->get('emp_code'),
            'emp_id' => $request->get('emp_id'),
            // 'month' => $request->get('month'),
            'month' => $getDate[0],
            // 'to_date' => $request->get('to_date'),
            'to_date' => $getDate[1],
            'leads_given_to' => $request->get('leads_given_to'),
            'valid_lead_count' => $request->get('valid_lead_count')
		]);
        
        // print_r($newLeadsgiven);
        // dd($newLeadsgiven);
        // return response()->json($newLeadsgiven);
		$newLeadsgiven->save();
        
		return response()->json($newLeadsgiven);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newLeadsgiven = Leadsgiven::findOrFail($id);
		return response()->json($newLeadsgiven);
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
        $newLeadsgiven = Leadsgiven::findOrFail($id);
		
		$newLeadsgiven = Leadsgiven::find($id);
        $newLeadsgiven->update($request->all());
        return $newLeadsgiven;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newLeadsgiven = Leadsgiven::findOrFail($id);
		$newLeadsgiven->delete();

		return response()->json($newLeadsgiven::all());
    }


    public function getMonthDate($dateVal){
        $dateData = explode('-', $dateVal);
        $startDate = date('Y-m-d', strtotime($dateData[0]."-".$dateData[1]."-01"));
        $endDate = date("Y-m-t", strtotime($startDate));
        return [$startDate, $endDate];
        // $startDate = date($dateData[0]."-".$dateData[1]."-31");
        // echo "<pre>";print_r($dateVal);echo "</pre>";exit;
    }

    public function getMonthYear($datedata){
        $dateValue = explode('-',$datedata);
        // $monthyear = date('Y-m',strtotime($dateValue[0]."-".$dateValue[1]."-01"));
        return $dateValue;
    }

    public function leadsgivenview(){

        $data = DB::table('leads_given')

        ->join('teams', 'teams.team_id', '=', 'leads_given.team_id')
        ->join('users', 'users.user_id', '=', 'leads_given.emp_id')
        ->select( 'teams.teamname','users.firstname', 'users.lastname','leads_given.*')

        ->get();

        return response()->json($data);
    }

    public function leadsteams($team_id){

        $data = DB::table('leads_given')

        ->join('teams', 'teams.team_id', '=', 'leads_given.team_id')
        ->join('users', 'users.user_id', '=', 'leads_given.emp_id')
        ->select('teams.teamname','users.firstname', 'users.lastname','leads_given.*')
        ->where('leads_given.team_id',$team_id)

        ->get();

        return response()->json($data);
    }

    public function allteamsdata($team_id){

        $data =  DB::table('users')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','teamdetails.*','users.*')
        ->where('teamdetails.team_id',$team_id)
        ->where('users.status_id','1')
        ->get();

        return response()->json($data);
    }


    public function single_emp_data($user_id){

        $data = DB::table('users')

        ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
        ->join('leads_given', 'leads_given.emp_id', '=', 'teamdetails.user_id')
        ->select('leads_given.*', 'teamdetails.team_id','users.firstname', 'users.lastname')
        ->where('leads_given.emp_id',$user_id)   

        ->get();

        return response()->json($data);
    }

    public function teamwise($team_id){
        
       $data =  DB::table('users')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        ->join('leads_given', 'leads_given.emp_id', '=', 'teamdetails.user_id')
        ->select('users.firstname','users.lastname','teamdetails.*','leads_given.*')
        ->where('leads_given.team_id',$team_id)
        ->get();

        return response()->json($data);
    }

    public function getempdetails($id){

        // dd($team_id);


        $data = DB::table('teamdetails')
        ->join('users', 'users.user_id', '=', 'teamdetails.user_id')
        ->join('teams', 'teams.team_id', '=', 'teamdetails.team_id')
        ->select('teams.*', 'teamdetails.team_id','users.firstname', 'users.lastname','users.user_id')
        ->where('teamdetails.team_id', $id)
        ->get();


        return response()->json($data);
    }

    public function singleemp($team_id){
        
       $data =  DB::table('users')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','teamdetails.*')
        ->where('teamdetails.team_id',$team_id)
        ->get();

        return response()->json($data);
    }

    public function single_emp($user_id){

        $data = DB::table('users')
        ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
        ->join('leads_given', 'leads_given.emp_id', '=', 'teamdetails.user_id')
        ->select('leads_given.*', 'teamdetails.team_id','users.firstname', 'users.lastname')
        ->where('leads_given.emp_id',$user_id)

        ->get();

        return response()->json($data);
    }

    public function datesorting(Request $request){
        $getMonth = $this->getMonthYear($request->get('month_year'));
       $emp_id = $request->get('emp_id');
        
        if($emp_id == null  && $emp_id == ""){
            $data = DB::table('leads_given')
            ->join('users', 'leads_given.emp_id', '=', 'users.user_id') 
            ->select('leads_given.*','users.firstname','users.lastname')
            // ->where('leads_given.emp_id', $emp_id)
            // ->where("month(leads_given.month)", "=", "$getMonth[0]")
            // ->where("year(leads_given.month)", "=", "$getMonth[1]")->toSql();
            ->whereYear('leads_given.month','=', $getMonth[0])
            ->whereMonth('leads_given.month','=',$getMonth[1])
            // ->toSql();
            ->get();

        }else{
        $data = DB::table('leads_given')
        ->join('users', 'leads_given.emp_id', '=', 'users.user_id')
        ->select('leads_given.*','users.firstname','users.lastname')
        ->where('leads_given.emp_id',$emp_id)
        // ->where(month(`leads_given`.`month`), $getMonth)
        // ->where(year(`leads_given`.`month`), $getMonth)
        ->whereYear('leads_given.month','=', $getMonth[0])
        ->whereMonth('leads_given.month','=',$getMonth[1])
        // ->where('leads_given.month','>=',$getMonth)
        // ->where('leads_given.month','<=',$getMonth)
        ->get();
        }

        // dd($data);

        return response()->json($data);

    }


}
