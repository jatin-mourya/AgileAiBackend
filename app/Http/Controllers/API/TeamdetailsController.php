<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teamdetails;

class TeamdetailsController extends Controller
{
    public function index()
    {
        $teamdetails = Teamdetails::all();
        $teamdetails = DB::table('teamdetails')
                        ->join('users', 'users.user_id', '=', 'teamdetails.user_id')
                        ->join('teams', 'teams.team_id', '=', 'teamdetails.team_id')
                        ->join('team_status','team_status.team_status_id','=','teamdetails.status')
                        ->join('designations','designations.designation_id','=','teamdetails.designation_id')
                        ->select('users.firstname','users.middlename','users.lastname', 'teams.teamname', 'team_status.teamstatus','designations.designation','teamdetails.*')
                        ->orderBy('teamdetails.updated_at', 'DESC')
                        ->get();
		return response()->json($teamdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newTeamdetails = new Teamdetails([
			
			'user_id' => $request->get('user_id'),
            'team_id' => $request->get('team_id'),
            'designation_id' => $request->get('designation_id'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'status' => $request->get('status'),
            'team_leader_name' => $request->get('team_leader_name')
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
		
			'user_id' => 'required',
            'team_id' => 'required',
            'designation_id' => 'required',
            'from_date' => 'required',
            'to_date' => '',
            'status' => 'required',
            'team_leader_name' => 'required',
		]);

		$newTeamdetails = new Teamdetails([
		
			'user_id' => $request->get('user_id'),
            'team_id' => $request->get('team_id'),
            'designation_id' => $request->get('designation_id'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'status' => $request->get('status'),
            'team_leader_name' => $request->get('team_leader_name')

		]);

		$newTeamdetails->save();

		return response()->json($newTeamdetails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // public function show($team_detail_id)
    // {
    //     $teamdetails = Teamdetails::findOrFail($team_detail_id);
    //     return response()->json($teamdetails);
    // }

    public function show(Request $request,$team_detail_id)
    {
        $teamdetails = DB::table('teamdetails')
        ->select('teamdetails.*','teams.teamname','team_status.teamstatus','users.firstname','users.middlename','users.lastname',)
        ->join('teams', 'teams.team_id', '=', 'teamdetails.team_id')
        ->join('users', 'users.user_id', '=', 'teamdetails.user_id')
        ->join('team_status','team_status.team_status_id','=','teamdetails.status')
        ->where('teamdetails.team_detail_id', $team_detail_id)
        ->first();
        return response()->json($teamdetails);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($team_detail_id)
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
    public function update(Request $request, $team_detail_id)
    {

        $teamdetails = Teamdetails::findOrFail($team_detail_id);
		
		$teamdetails = Teamdetails::find($team_detail_id);
        $teamdetails->update($request->all());
        return $teamdetails;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($team_detail_id)
    {
        $teamdetails = Teamdetails::findOrFail($team_detail_id);
		$teamdetails->delete();

		return response()->json($teamdetails::all());
    }

    public function getuserteam(Request $request)
    {
        $team_id = $request->team_id;
        // $user_id = $request->user_id;
    
        $teamdata3 = DB::table('teamdetails')
                        ->leftjoin('users', 'users.user_id', '=', 'teamdetails.user_id')
                        ->leftjoin('teams', 'teams.team_id', '=', 'teamdetails.team_id')
                        ->select('users.firstname','users.middlename','users.lastname', 'teams.teamname','teamdetails.*')
                        ->where('teamdetails.team_id', $team_id)
                        // ->where('teamdetails.user_id', $user_id)
                        ->get();
        return response()->json($teamdata3);
    
    }
    
    public function getUserFilterData(Request $request)
    {
        $team_id = $request->team_id;
        $teamLeaders = DB::table('team_leaders')
        ->join('users', 'team_leaders.user_id', '=', 'users.user_id')
        ->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
        ->select('teams.team_id', 'teams.teamname', 'users.firstname', 'users.lastname','users.user_id')
        ->where('team_leaders.status', 1)
        ->where('teams.team_id', $team_id);
    
    $teamDetails = DB::table('teamdetails')
        ->leftJoin('teams', 'teams.team_id', '=', 'teamdetails.team_id')
        ->leftJoin('users', 'users.user_id', '=', 'teamdetails.user_id')
        ->select('teams.team_id', 'teams.teamname', 'users.firstname', 'users.lastname','users.user_id')
        ->where('teamdetails.status', 1)
        ->where('teamdetails.team_id',$team_id);
    
    $unionQuery = $teamLeaders->union($teamDetails)->get();

        return response()->json($unionQuery);
    
    }
    public function updateTeamDetails(Request $request, $user_id)
{
    
    $teamDetail = TeamDetail::where('team_id', 14)
                            ->where('user_id', 329)
                             ->toSql();
    // if ($previousTeamDetail) {
    //     $previousTeamDetail->delete();
    // }

    // TeamDetails::create($request->all());

    return response()->json(['message' => 'Team details updated successfully',$teamDetail]);
}
}
