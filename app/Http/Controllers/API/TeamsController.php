<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teams;
//use DB   
use Illuminate\Support\Facades\DB;;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = DB::table('teams')->where('boolean_value', '1')
        ->orderBy('teams.updated_at', 'DESC')
        ->get();
		return response()->json($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newTeams = new Teams([
			//'slug' => $request->get('slug'),
			'teamname' => $request->get('teamname')
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
			'teamname' => 'required|unique:teams,teamname'
		]);

		$newTeams = new Teams([
			'teamname' => $request->get('teamname')
		]);

		$newTeams->save();

		return response()->json($newTeams);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($team_id)
    {
        $teams = Teams::findOrFail($team_id);
		return response()->json($teams);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($team_id)
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
    public function update(Request $request, $team_id)
    {

        $teams = Teams::findOrFail($team_id);
		
		$teams = Teams::find($team_id);
        $teams->update($request->all());
        return $teams;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    // Delete Code Start //

    public function destroy(Request $request, $team_id)
    {
        $teams = Teams::findOrFail($team_id);
		
		$teams = Teams::find($team_id);
        if ($teams) {
            $teams->boolean_value = 0;
            $teams->save();
            return $teams;
        }
    }
}
