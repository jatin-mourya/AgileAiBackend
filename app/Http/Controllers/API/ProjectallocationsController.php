<?php

namespace App\Http\Controllers\API;
// //use DB   use Illuminate\Support\Facades\DB;;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectAllocations;

class ProjectallocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectallocations = Projectallocations::all();
        $projectallocations = DB::table('projectallocations')
                            ->join('users', 'users.user_id', '=', 'projectallocations.user_id')
                            ->join('projects', 'projects.project_id', '=', 'projectallocations.project_id')
                            ->leftjoin('subprojects', 'subprojects.subproject_id', '=', 'projectallocations.subproject_id')
                            ->select('projectallocations.*','users.firstname','users.middlename','users.lastname','projects.project_name','subprojects.subproject_name')
                            ->where('projectallocations.boolean_value', '1')
                            ->orderBy('projectallocations.updated_at','DESC')
                            ->get();
		return response()->json($projectallocations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newProjectallocations = new Projectallocations([
			'user_id' => $request->get('user_id'),
			'project_id' => $request->get('project_id'),
            'subproject_id' => $request->get('subproject_id')
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
			'project_id' => 'required',
            'subproject_id' => ''
		]);

		$newProjectallocations = new Projectallocations([
			'user_id' => $request->get('user_id'),
            'project_id' => $request->get('project_id'),
			'subproject_id' => $request->get('subproject_id')
		]);

		$newProjectallocations->save();

		return response()->json($newProjectallocations);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectallocation_id)
    {
        $projectallocations = DB::table('projectallocations')
        ->leftjoin('subprojects', 'subprojects.subproject_id', '=', 'projectallocations.subproject_id')
        ->join('users', 'users.user_id', '=', 'projectallocations.user_id')
        ->join('projects', 'projects.project_id', '=', 'projectallocations.project_id')
        ->select('projectallocations.*','subprojects.subproject_name','projects.project_name','users.firstname','users.middlename','users.lastname',)
        ->where ('projectallocation_id',$projectallocation_id)
        ->get();
		return response()->json($projectallocations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectallocation_id)
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
    public function update(Request $request, $projectallocation_id)
    {
        
		$projectallocations = Projectallocations::findOrFail($projectallocation_id);
		
		$projectallocations = Projectallocations::find($projectallocation_id);
        $projectallocations->update($request->all());
        return $projectallocations;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectallocation_id)
    {
        $projectallocations = Projectallocations::findOrFail($projectallocation_id);

        $projectallocations = Projectallocations::find($projectallocation_id);
        if ($projectallocations) {
            $projectallocations->boolean_value = 0;
            $projectallocations->save();
            return $projectallocations;
        }

    }
}
