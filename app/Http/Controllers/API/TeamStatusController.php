<?php

namespace App\Http\Controllers\API;
use App\Models\TeamStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamStatusController extends Controller
{
    public function index()
    {
        $teamstatus = Teamstatus::all();
		return response()->json($teamstatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newTeamstatus = new Teamstatus([
			
			'teamstatus' => $request->get('teamstatus')
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
		
			'teamstatus' => 'required'
		]);

		$newTeamstatus = new Teamstatus([
		
			'teamstatus' => $request->get('teamstatus')
		]);

		$newTeamstatus->save();

		return response()->json($newTeamstatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($team_status_id)
    {
        $teamstatus = Teamstatus::findOrFail($team_status_id);
		return response()->json($teamstatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($team_status_id)
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
    public function update(Request $request, $team_status_id)
    {
        // $teams = Teams::findOrFail($id);

		// $request->validate([
		// 	'slug' => 'slug',
		// 	'teamname' => 'teamname'
		// ]);

		// $teams->slug = $request->get('slug');
		// $teams->teamname = $request->get('teamname');

		// $teams->save();

		// return response()->json($teams);

        $teamstatus = Teamstatus::findOrFail($team_status_id);
		
		$teamstatus = Teamstatus::find($team_status_id);
        $teamstatus->update($request->all());
        return $teamstatus;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($team_status_id)
    {
        $teamstatus = Teamstatus::findOrFail($team_status_id);
		$teamstatus->delete();

		return response()->json($teamstatus::all());
    }
}
