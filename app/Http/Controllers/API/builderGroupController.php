<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\builderGroup;

class builderGroupController extends Controller
{
    public function index()
    {
        $projects = builderGroup::all();

                $projects = DB::table('builders_group')
                        ->select('builders_group.*')
                        // ->where('boolean_value', '1')
                        ->orderBy('builders_group.updated_at','DESC')
                        ->get();
		return response()->json($projects);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newProjects = new builderGroup([
			'name' => $request->get('name'),
			'profile_score' => $request->get('profile_score'),
            'status' => $request->get('status')
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
			'name' => '',
			'profile_score' => '',
            'status' => ''
		]);

		$newProjects = new builderGroup([
			'name' => $request->get('name'),
            'profile_score' => $request->get('profile_score'),
            'status' => $request->get('status')
		]);

		$newProjects->save();

		return response()->json($newProjects);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = builderGroup::findOrFail($id) ;
		return response()->json($projects);
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
		$projects = builderGroup::findOrFail($id);
		
		$projects = builderGroup::find($id);
        $projects->update($request->all());
        return $projects;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
    
    public function getStatusEnumValues()
    {
        $tableName = 'builders_group'; // Replace with the actual table name
        $columnName = 'status';

        $enumValues = DB::select(DB::raw("SHOW COLUMNS FROM $tableName WHERE Field = '$columnName'"))[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $enumValues, $matches);
        $enumValuesArray = explode("','", $matches[1]);

        return response()->json($enumValuesArray);
    }

}
