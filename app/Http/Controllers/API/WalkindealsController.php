<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Walkindeals;
//use DB   
use Illuminate\Support\Facades\DB;;

class WalkindealsController extends Controller
{
    public function index()
    {
        $Walkindeals = Walkindeals::all();
		return response()->json($Walkindeals);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newWalkindeals = new Walkindeals([
			'id' => $request->get('id'),
            'date' => $request->get('date'),
            'client_name' => $request->get('client_name'),
            'project_id' => $request->get('project_id'),
            'sourcing_emp_id' => $request->get('sourcing_emp_id'),
            'closing_emp_id' => $request->get('closing_emp_id'),
            'team_id' => $request->get('team_id'),
            'team_leader_id' => $request->get('team_leader_id'),
            'revisit' => $request->get('revisit'),
            'videopresentation' => $request->get('videopresentation'),
            'leadsource_id' => $request->get('leadsource_id'),
            'remark' => $request->get('remark'),
            'presentwithclient' => $request->get('presentwithclient'),
            'closingtisite' => $request->get('closingtisite')
            
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
            'date' => '',
            'client_name' => '',
            'project_id' => '',
            'sourcing_emp_id' => '',
            'closing_emp_id' => '',
            'team_id' => '',
            'team_leader_id' => '',
            'revisit' => '',
            'videopresentation' => '',
            'leadsource_id' => '',
            'remark' => '',
            'presentwithclient' => '',
            'closingtisite' => ''
		]);

		$newWalkindeals = new Walkindeals([
			'id' => $request->get('id'),
            'date' => $request->get('date'),
            'client_name' => $request->get('client_name'),
            'project_id' => $request->get('project_id'),
            'sourcing_emp_id' => $request->get('sourcing_emp_id'),
            'closing_emp_id' => $request->get('closing_emp_id'),
            'team_id' => $request->get('team_id'),
            'team_leader_id' => $request->get('team_leader_id'),
            'revisit' => $request->get('revisit'),
            'videopresentation' => $request->get('videopresentation'),
            'leadsource_id' => $request->get('leadsource_id'),
            'remark' => $request->get('remark'),
            'presentwithclient' => $request->get('presentwithclient'),
            'closingtisite' => $request->get('closingtisite')
		]);

		$newWalkindeals->save();

		return response()->json($newWalkindeals);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Walkindeals = Walkindeals::findOrFail($id);
		return response()->json($Walkindeals);
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
        $Walkindeals = Walkindeals::findOrFail($id);
		
		$Walkindeals = Walkindeals::find($id);
        $Walkindeals->update($request->all());
        return $Walkindeals;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Walkindeals = Walkindeals::findOrFail($id);
		$Walkindeals->delete();

		return response()->json($Walkindeals::all());
    }


    public function getteamdetails1(Request $request){
        $team_leader_name = $request->get('team_leader_name');

        $data=DB::table('teamdetails') 
        ->join('users','users.user_id','=','teamdetails.user_id')
        ->join('salary_package','salary_package.user_id','=','teamdetails.user_id')
        ->select('teamdetails.*','users.firstname','users.lastname','salary_package.monthly_salary')
        ->where('team_leader_name',$team_leader_name)
        ->get();
        return response()->json($data);
    }

    // public function getuserdetails(){
    //     // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

    //     $data=DB::table('users')
    //     ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
    //     ->where('designation','=' ,'9')
    //     ->get();
    //     return response()->json($data);

    // }

 public function getwalkinlist($team_leader_name){
        // dd($team_leader_name);

        $data=DB::table('walkin_deals')
       
        ->join('users', 'users.user_id','=','walkin_deals.sourcing_emp_id')
        ->leftjoin('projects', 'projects.project_id','=','walkin_deals.project_id')
        ->join('teams', 'teams.team_id','=','walkin_deals.team_id' )
        ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
        ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
        ->select('walkin_deals.*','projects.project_name', 'teams.teamname', 'team_leaders.team_leader_name' , 'leadsource.leadsource' , 'users.firstname', 'users.lastname',DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Sourcing"),DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Closing"))
        // ->select('walkin_deals.*','projects.project_name', 'teams.teamname', 'team_leaders.team_leader_name' , 'users.firstname', 'users.lastname')
        ->where('team_leaders.team_leader_name',$team_leader_name)
        ->get();
        return response()->json($data);
       
    }
    
     public function getusermapped($team_leader_name){
        $data=DB::table('users')
        ->join('designations','designations.designation_id','=','users.designation')
        ->join('emp_status','emp_status.emp_status_id','=','users.status_id')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        // ->join('team_leaders','team_leaders.user_id','=','users.user_id')
         ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code','teamdetails.team_id')
         ->whereRaw("(`designations`.`designation` = 'Sales Manager' or `designations`.`designation`='Assistant Sales Manager' or `designations`.`designation`='Senior Sales Manager'  or `designations`.`designation`='CP Source Manager' or  `designations`.`designation`='Tele Caller')")
         ->whereRaw("(`emp_status`.`empstatus` = 'Active' or `emp_status`.`empstatus` = 'Transfered' )")
         ->where('teamdetails.team_leader_name',$team_leader_name)
         ->get();
        //  ->toSql();
         return response()->json($data);

    }


    public function getdata($user_id){
        // dd($team_leader_name);

        $data=DB::table('walkin_deals')
       
        ->join('users', 'users.user_id','=','walkin_deals.sourcing_emp_id')
        // ->join('walkin_deals', 'walkin_deals.closing_emp_id','=','users.user_id')
        // ->join('clientdetails', 'clientdetails.client_id','=','walkin_deals.client_id')
        ->leftjoin('projects', 'projects.project_id','=','walkin_deals.project_id')
        ->join('teams', 'teams.team_id','=','walkin_deals.team_id' )
        ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
        ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
        ->select('walkin_deals.*', 'projects.project_name', 'teams.teamname', 'team_leaders.team_leader_name' , 'leadsource.leadsource' , 'users.firstname', 'users.lastname',DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Sourcing"),DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Closing"))
        // ->select('walkin_deals.*', 'projects.project_name', 'teams.teamname', 'team_leaders.team_leader_name' , 'users.firstname', 'users.lastname')
        ->where('users.user_id',$user_id)
        ->get();
        return response()->json($data);
       
    }

    public function getclemp($user_id){
        // dd($team_leader_name);

        $data=DB::table('walkin_deals')
       
        ->join('users', 'users.user_id','=','walkin_deals.closing_emp_id')
        // ->join('walkin_deals', 'walkin_deals.closing_emp_id','=','users.user_id')
        // ->join('clientdetails', 'clientdetails.client_id','=','walkin_deals.client_id')
        ->join('projects', 'projects.project_id','=','walkin_deals.project_id')
        ->join('teams', 'teams.team_id','=','walkin_deals.team_id' )
        ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
        ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
        ->select('walkin_deals.*', 'projects.project_name', 'teams.teamname', 'team_leaders.team_leader_name' , 'leadsource.leadsource' , 'users.firstname', 'users.lastname')
        ->where('users.user_id',$user_id)
        ->get();
        return response()->json($data);
       
    }

    public function getuserid(){


        $data=DB::table('users')

        ->select('users.firstname', 'users.lastname','salesdetails.*')
        ->join('salesdetails', 'salesdetails.sourcing_emp_id', '=', 'users.user_id' )

        ->get();
        return response()->json($data);
    }


    public function getdeals(){

        $data=DB::table('users')

        ->select('users.firstname', 'users.lastname','deals_details.*')
        ->join('deals_details', 'deals_details.user_id', '=', 'users.user_id' )

        ->get();
        return response()->json($data); 

    }


    // DB::table('users')
    // ->select('users.id','users.name','profiles.photo')
    // ->join('profiles','profiles.id','=','users.id')
    // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
    // ->get();


   
 public function filterdata(Request $request){

        // return response()->json($request->all());
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $user_id = $request->get('user_name');
        
            
            $data = DB::table('walkin_deals')
            ->join('users','walkin_deals.sourcing_emp_id','=','users.user_id')
            ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
            ->leftjoin('projects', 'projects.project_id','=','walkin_deals.project_id')
            ->join('teams', 'teams.team_id','=','walkin_deals.Team_id' )
            ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
            ->select('walkin_deals.*', 'users.firstname', 'users.lastname', 'projects.project_name', 'teams.teamname','team_leaders.team_leader_name','leadsource.leadsource')
            ->where('walkin_deals.sourcing_emp_id',$user_id)
            ->whereBetween('date',[$from_date, $to_date])
            ->get();
            // ->toSql();
        return response()->json($data);
    
    }
    
    
    
    //sumedh updated code//
    public function getuserdetails(){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

        $data=DB::table('users')
       ->join('designations','designations.designation_id','=','users.designation')
       ->join('emp_status','emp_status.emp_status_id','=','users.status_id')
        ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
        ->whereRaw("(`designations`.`designation_id` = 9 or `designations`.`designation_id`= 10 or `designations`.`designation_id`= 11 or `designations`.`designation_id`= 8 or `designations`.`designation_id`= 7 or `designations`.`designation_id`= 6)")
        ->whereRaw("(`emp_status`.`empstatus` = 'Active')")
        ->get();
        // ->toSql();
        return response()->json($data);

    }
    //code//
    
     public function teamleaderwise($team_leader_name){

        $data=DB::table('walkin_deals')
        ->join('users', 'users.user_id','=','walkin_deals.sourcing_emp_id')
        ->leftjoin('projects','projects.project_id','=','walkin_deals.project_id')
        ->join('teams','teams.team_id','=','walkin_deals.team_id')
        ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
        ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
        ->select('walkin_deals.*','projects.project_name','teams.teamname','team_leaders.team_leader_name','leadsource.leadsource' , 'users.firstname', 'users.lastname',DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Sourcing"),DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Closing"))
        ->where('team_leaders.team_leader_name',$team_leader_name)
        ->get();
        return response()->json($data);
   
    }
    
    public function alldata(Request $request){

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
            $data = DB::table('walkin_deals')
            ->join('users','walkin_deals.sourcing_emp_id','=','users.user_id')
            ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
            ->leftjoin('projects', 'projects.project_id','=','walkin_deals.project_id')
            ->join('teams', 'teams.team_id','=','walkin_deals.Team_id' )
            ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
            ->select('walkin_deals.*', 'users.firstname', 'users.lastname', 'projects.project_name', 'teams.teamname','team_leaders.team_leader_name','leadsource.leadsource')
            ->whereBetween('date',[$from_date, $to_date])
            ->get();
            // ->toSql();
        return response()->json($data);
    
    }

       public function walkindata(){

        $data=DB::table('walkin_deals')
        ->join('users', 'users.user_id','=','walkin_deals.sourcing_emp_id')
        ->leftjoin('projects','projects.project_id','=','walkin_deals.project_id')
        ->join('teams','teams.team_id','=','walkin_deals.team_id')
        ->join('team_leaders','team_leaders.team_leader_id','=','walkin_deals.team_leader_id')
        ->join('leadsource','leadsource.leadsource_id','=','walkin_deals.leadsource_id')
        ->select('walkin_deals.*','projects.project_name','teams.teamname','team_leaders.team_leader_name','leadsource.leadsource' , 'users.firstname', 'users.lastname',DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Sourcing"),DB::raw("CONCAT(users.firstname,' ',users.lastname) AS Closing"))
        // ->where('team_leaders.team_leader_name',$team_leader_name)
        ->get();
        return response()->json($data);
   
    }
    
     public function teamsdata(){
        $data=DB::table('teams')
        // ->join('team_leaders','team_leaders.team_id','=','teams.team_id')
        ->select('teams.team_id','teams.teamname')
        ->where('teams.teamname','like','R%')

        ->get();
        return response()->json($data);
    }



public function teamleader(){
        $data=DB::table('team_leaders')
        ->join('teams','teams.team_id','=','team_leaders.team_id')
        ->select('teams.*','team_leaders.team_leader_name','team_leaders.team_leader_id')

        ->get();
        return response()->json($data);
    
    }

 public function tlmappeduser($team_leader_name){
        $data=DB::table('users')
        ->join('designations','designations.designation_id','=','users.designation')
        ->join('emp_status','emp_status.emp_status_id','=','users.status_id')
        ->join('teamdetails','teamdetails.user_id','=','users.user_id')
        // ->join('team_leaders','team_leaders.user_id','=','users.user_id')
         ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code','teamdetails.team_id')
         ->whereRaw("(`designations`.`designation` = 'Sales Manager' or `designations`.`designation`='Assistant Sales Manager' or `designations`.`designation`='Senior Sales Manager'  or `designations`.`designation`='CP Source Manager' or  `designations`.`designation`='Tele Caller')")
         ->whereRaw("(`emp_status`.`empstatus` = 'Active' or `emp_status`.`empstatus` = 'Transfered' )")
         ->where('teamdetails.team_leader_name',$team_leader_name)
         ->get();
        //  ->toSql();
         return response()->json($data);

    }



    public function getallteamleaders($team_leader_id){

    $data=DB::table('users')
     ->select('users.firstname', 'users.lastname', 'users.user_id')
    ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
    ->join('team_leaders', 'team_leaders.team_id', '=', 'teamdetails.team_id')
    ->join('designations', 'users.designation', '=', 'designations.designation_id')
    ->whereIn('designations.designation', ["Sales Manager", "Senior Sales Manager", "Assistant Sales Manager", "Tele Caller", "CP Source Manager"])
    ->where('team_leaders.team_leader_id', '=', $team_leader_id)
    ->where('teamdetails.status', '=', 1)
    ->distinct()
    ->get();
    return response()->json($data);

    }


}
