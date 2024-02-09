<?php

namespace App\Http\Controllers\API;
//use DB
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealdetails;


class DealdetailsController extends Controller
{
    public function index()
    {
        $dealdetails = Dealdetails::all();
		return response()->json($dealdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$DealdetailsData = $Dealdetails->getDealdetails($request->email);




        $newDealdetails = new Dealdetails([
			'user_id' => $request->get('user_id'),
            'salary_justify' => $request->get('salary_justify'),
            'business_target' => $request->get('business_target'),
            'leadsource' => $request->get('leadsource'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'deal_status' => $request->get('deal_status'),
            'attented_day' => $request->get('attented_day'),
            'actual_sales' => $request->get('actual_sales'),
            'walking_sourcing' => $request->get('walking_sourcing'),
            'walking_closing' => $request->get('walking_closing'),
            'leads_given' => $request->get('leads_given'),
            'deal_sourcing' => $request->get('deal_sourcing'),
            'deal_closing' => $request->get('deal_closing'),
            'business_value' => $request->get('business_value')
            
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
			'user_id' => '',
            'salary_justify' => '',
            'business_target' => '',
            'leadsource' => '',
            'from_date' => '',
            'to_date' => '',
            'deal_status' => '',
            'attented_day' => '',
            'actual_sales' => '',
            'walking_sourcing' => '',
            'walking_closing' => '',
            'leads_given' => '',
            'deal_sourcing' => '',
            'deal_closing' => '',
            'business_value' => ''
		]);

		$newDealdetails = new Dealdetails([
			'user_id' => $request->get('user_id'),
            'salary_justify' => $request->get('salary_justify'),
            'business_target' => $request->get('business_target'),
            'leadsource' => $request->get('leadsource'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'deal_status' => $request->get('deal_status'),
            'attented_day' => $request->get('attented_day'),
            'actual_sales' => $request->get('actual_sales'),
            'walking_sourcing' => $request->get('walking_sourcing'),
            'walking_closing' => $request->get('walking_closing'),
            'leads_given' => $request->get('leads_given'),
            'deal_sourcing' => $request->get('deal_sourcing'),
            'deal_closing' => $request->get('deal_closing'),
            'business_value' => $request->get('business_value')
		]);

		$newDealdetails->save();

		return response()->json($newDealdetails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealdetails = Dealdetails::findOrFail($id);
		return response()->json($dealdetails);
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
        $dealdetails = Dealdetails::findOrFail($id);
		
		$dealdetails = Dealdetails::find($id);
        $dealdetails->update($request->all());
        return $dealdetails;
    }


    public function teamsorting($team_id,$start_date,$end_date){
        $sp_get_performance_teamwise = DB::select(
        "CALL sp_get_performance_teamwise(?,?,?)", array($team_id,$start_date,$end_date));
        return response()->json($sp_get_performance_teamwise);
    }

    public function usersorting($user_id,$from_date,$end_date){
        $sp_get_performance_userwise= DB::select(
        "CALL sp_get_performance_userwise(?,?,?)", array($user_id,$from_date,$end_date));
        return response()->json($sp_get_performance_userwise);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealdetails = Dealdetails::findOrFail($id);
		$dealdetails->delete();

		return response()->json($dealdetails::all());
    }
    
    public function username(){
        // ->join('users','users.user_id','=','dealdetails.user_id')
        // ->select('users.*','users.firstname','users.lastname','dealdetails.')
        
       $data =  DB::table('users')
        ->join('deals_details','deals_details.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','deals_details.*')

        ->get();

        return response()->json($data);
    }

    public function getuserdetails(){
        $data=DB::table('users')
        ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
        ->get();
        return response()->json($data);

    }

    public function getteamsname(){
        $data=DB::table('teams')
        ->select('teams.team_id','teams.teamname')
        ->get();
        return response()->json($data);
    }

    public function getteamdetails(Request $request){
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $team_leader_name = $request->get('team_leader_name');

        $data=DB::table('teamdetails') 
        ->join('users','users.user_id','=','teamdetails.user_id')
        ->join('salary_package','salary_package.user_id','=','teamdetails.user_id')
        ->select('teamdetails.*','users.firstname','users.lastname','salary_package.monthly_salary')
        ->where('team_leader_name',$team_leader_name)
        ->get();
        return response()->json($data);
    }

    public function getuserdata(Request $request){
        //dd($request->all());
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $user_id = $request->get('user_id');

        $data=DB::table('salesdetails') 
        
        ->select(DB::raw('SUM(sourcing_emp_id) as sourcing_emp_id'),DB::raw('SUM(closing_emp_id) as closing_emp_id'), 
        DB::raw('SUM(business_value) as business_value'),DB::raw('SUM(leadsource_id) as leadsource_count'),
        DB::raw('SUM(net_shared_payout) as net_shared_payout'),DB::raw('SUM(payout_value) as payout_value'),
        DB::raw('SUM(net_payout) as net_payout'))
        ->where('salesdetails.sourcing_emp_id',$user_id)
        ->whereBetween('salesdetails.booking_date', [$from_date, $to_date])
        // ->where('salesdetails.booking_date','<=',$from_date)
        // ->where('salesdetails.booking_date','>=',$to_date)
        ->get();
        return response()->json($data);
    }
    public function getattendance(Request $request){
        // dd($request->all());
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $emp_name = $request->get('emp_name');

        $data=DB::table('emp_attendance') 
        ->select('emp_attendance.present_days','emp_attendance.absent_days')
        ->where('emp_attendance.emp_name',$emp_name)
        ->where('emp_attendance.year',$to_date)
        ->get();
        return response()->json($data);
    }

    public function userdetails($team_leader_name){

        $data = DB::table('users')
        ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
        ->join('deals_details', 'deals_details.user_id', '=', 'teamdetails.user_id')
        ->select('deals_details.*', 'teamdetails.team_leader_name','users.firstname', 'users.lastname')
        ->where('teamdetails.team_leader_name',$team_leader_name)
        ->get();

        return response()->json($data);
    }

    public function username1($team_leader_name){
        // ->join('users','users.user_id','=','dealdetails.user_id')
        // ->select('users.*','users.firstname','users.lastname','dealdetails.')
        
       $data =  DB::table('users')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','teamdetails.*')
        ->where('teamdetails.team_leader_name',$team_leader_name)
        ->get();

        return response()->json($data);
    }

    public function single_user($user_id){

        $data = DB::table('users')

        ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
        ->join('deals_details', 'deals_details.user_id', '=', 'teamdetails.user_id')
        ->select('deals_details.*', 'teamdetails.team_leader_name','users.firstname', 'users.lastname')
        ->where('teamdetails.user_id',$user_id)

        ->get();

        return response()->json($data);
    }


    public function datefilter(Request $request){

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $user_id = $request->get('user_id');
        
        if($user_id == null  && $user_id == ""){
            $data = DB::table('deals_details')
            ->join('users', 'deals_details.user_id', '=', 'users.user_id')
            ->select('deals_details.*','users.firstname','users.lastname')
            ->where('deals_details.from_date','>=',$from_date)
            ->where('deals_details.to_date','<=',$to_date)
            ->get();  
        }else{
        $data = DB::table('deals_details')
        ->join('users', 'deals_details.user_id', '=', 'users.user_id')
        ->select('deals_details.*','users.firstname','users.lastname')
        ->where('deals_details.user_id',$user_id)
       ->where('deals_details.from_date','>=',$from_date)
        ->where('deals_details.to_date','<=',$to_date)
        ->get();
        }
        return response()->json($data);

    }
    public function dateData(Request $request){

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');


        $data = DB::table('deals_details')
        ->join('users', 'deals_details.user_id', '=', 'users.user_id')
        ->select('deals_details.*','users.firstname','users.lastname')
        ->where('deals_details.from_date','>=',$from_date)
        ->where('deals_details.to_date','<=',$to_date)
        ->get();

        return response()->json($data);

    }

    public function userwisesorting($user_id){
        $sp_get_performance_user= DB::select(
        "CALL sp_get_performance_user(?)", array($user_id));
        return response()->json($sp_get_performance_user);
    }
}
