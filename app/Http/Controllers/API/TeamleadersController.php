<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teamleaders;

class TeamleadersController extends Controller
{

    public function index()
    {
        $teamleaders = Teamleaders::all();
        $teamleaders = DB::table('team_leaders')
                        ->join('users', 'users.user_id', '=', 'team_leaders.user_id')
                        ->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
                        ->join('team_status','team_status.team_status_id','=','team_leaders.status')
                        ->select('users.firstname','users.middlename','users.lastname', 'teams.teamname', 'team_status.teamstatus','team_leaders.team_leader_id','team_leaders.from_date','team_leaders.to_date','team_leaders.team_leader_name')
                        ->where('team_leaders.boolean_value', '1')
                        // ->orderBy('team_leaders.updated_at', 'DESC')
                        ->get();
		return response()->json($teamleaders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newTeamleaders = new Teamleaders([
			
			'team_id' => $request->get('team_id'),
            'user_id' => $request->get('user_id'),
            'status' => $request->get('status'),
            'team_leader_name' =>  $request->get('team_leader_name'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'region_head' => $request->get('region_head')
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
		
			'team_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'team_leader_name' => 'required',
            'from_date' => 'required',
            'to_date' => '',
            'region_head' => ''
		]);

		$newTeamleaders = new Teamleaders([
		
			'team_id' => $request->get('team_id'),
            'user_id' => $request->get('user_id'),
            'status' => $request->get('status'),
            'team_leader_name' => $request->get('team_leader_name'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'region_head' => $request->get('region_head')
		]);

		$newTeamleaders->save();

		return response()->json($newTeamleaders);
       
    }

//     public function getteam($team_id){
//     //$team_id = $request->team_id;
//     $teamleadersModel = new Teamleaders();
//     $data = $teamleadersModel->getteam($team_id);
//     return response()->json($data);
    
//   }
public function getteam($team_id){
    // $team_id = $request->get('team_id');
    // $teamleadersModel = new Teamleaders();
    // $data = $teamleadersModel->getteam($team_id);
    // return response()->json($data);
       $data=DB::table('team_leaders')
        ->select('*')
        ->where('team_id','=',$team_id)
        ->where('status','=' ,'1')
        ->get();
        return response()->json($data);
    
  }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // public function show($team_leader_id)
    // {
    //     $teamleaders = Teamleaders::findOrFail($team_leader_id);
	// 	return response()->json($teamleaders);


    // }
    public function show(Request $request,$team_leader_id)
    {
        $teamleaders = DB::table('team_leaders')
        ->select('team_leaders.*','teams.teamname','team_status.teamstatus','users.firstname','users.middlename','users.lastname',)
        ->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
        ->join('users', 'users.user_id', '=', 'team_leaders.user_id')
        ->join('team_status','team_status.team_status_id','=','team_leaders.status')
        ->where('team_leaders.team_leader_id', $team_leader_id)
        ->first();
        return response()->json($teamleaders);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($team_leader_id)
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
    public function update(Request $request, $team_leader_id)
    {

        $teamleaders = Teamleaders::findOrFail($team_leader_id);
		
		$teamleaders = Teamleaders::find($team_leader_id);
        $teamleaders->update($request->all());
        return $teamleaders;
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($team_leader_id)
    {
        $teamleaders = Teamleaders::findOrFail($team_leader_id);

        $teamleaders = Teamleaders::find($team_leader_id);
        if ($teamleaders) {
            $teamleaders->boolean_value = 0;
            $teamleaders->save();
            return $teamleaders;
        }

    }
    public function teamleaderslist(){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

        // $data=DB::table('users')
        // ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code','designations.*')
        // ->join('designations','designations.designation_id','=','users.designation')
        //  ->whereRaw("(`designations`.`designation_id` = 4 or `designations`.`designation_id`= 6 or `designations`.`designation_id`= 23 or `designations`.`designation_id`= 24)")
        // // ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
        // // ->where('designation','=' ,'6')
        // ->get();

    $users = DB::table('users')
    ->select('users.user_id', 'users.firstname','users.lastname', 'designations.designation')
    ->leftJoin('designations', 'designations.designation_id', '=', 'users.designation')
    ->whereIn('users.designation', [6, 8,30,49])
     ->where('status_id', 1)
    ->get();
        return response()->json($users);

    }

    public function regionheadslist(){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

        $data=DB::table('users')
        ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code','designations.*')
        ->join('designations','designations.designation_id','=','users.designation')
        ->where('designations.designation','Region Head')
        // ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
        // ->where('designation','=' ,'4')
        ->get();
        return response()->json($data);

    }
    
    public function teamleadersinform()
    {
        $teamleaders = DB::table('team_leaders')
                        ->join('users', 'users.user_id', '=', 'team_leaders.user_id')
                        ->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
                        ->join('team_status','team_status.team_status_id','=','team_leaders.status')
                        ->select('users.firstname','users.middlename','users.lastname', 'teams.teamname', 'team_status.teamstatus','team_leaders.team_leader_id','team_leaders.from_date','team_leaders.to_date','team_leaders.team_leader_name')
                        ->where('team_leaders.boolean_value', '1')
                        ->where('teams.teamname','like','R%')
                        // ->orderBy('team_leaders.updated_at', 'DESC')
                        ->get();
                        
		return response()->json($teamleaders);
    }

}
