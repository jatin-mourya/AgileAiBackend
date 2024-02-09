<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subprojects;
use App\Models\rera;

class SubprojectsController extends Controller
{
    public function index()
    {
        $subprojects = Subprojects::all();
        $subprojects = DB::table('subprojects')
                        ->join('projects', 'projects.project_id', '=', 'subprojects.project_id')
                        ->select('projects.project_name','subprojects.*')
                        ->where('subprojects.boolean_value', '1')
                        ->orderBy('subprojects.updated_at','DESC')
                        ->get();
      
		return response()->json($subprojects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newSubprojects = new Subprojects([
			'project_id' => $request->get('project_id'),
			'subproject_name' => $request->get('subproject_name'),
            'rera' => $request->get('rera')
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
		 	'project_id' => 'required',
		 	'subproject_name' => 'required|unique:subprojects,subproject_name',
            'rera' => ''
		]);

		$newSubprojects = new Subprojects([
			'project_id' => $request->get('project_id'),
			'subproject_name' => $request->get('subproject_name'),
            'rera' => $request->get('rera')
		]);

		$newSubprojects->save();

		return response()->json($newSubprojects);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subproject_id)
    {
        $subprojects = Subprojects::findOrFail($subproject_id);
		return response()->json($subprojects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subproject_id)
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
    public function update(Request $request, $subproject_id)
    {
		
		$subprojects = Subprojects::findOrFail($subproject_id);
		
		$subprojects = Subprojects::find($subproject_id);
        $subprojects->update($request->all());
        return $subprojects;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subproject_id)
    {
        $subprojects = Subprojects::findOrFail($subproject_id);

        $subprojects = Subprojects::find($subproject_id);
        if ($subprojects) {
            $subprojects->boolean_value = 0;
            $subprojects->save();
            return $subprojects;
        }

    }

    public function getSubproject($project_id){
        $subprojectsModel = new Subprojects();
        $data = $subprojectsModel->getState($project_id);
        return response()->json($data);
    }
     public function reradata1(Request $request)
    {
        $responseData = $request->json()->all();
    
        if (isset($responseData['rera']) && isset($responseData['rera']['rera'])) {
            $project_id = $responseData['projects'];
            $subproject_id = $responseData['subprojects'];
            $reraValues = $responseData['rera']['rera'];
    
            foreach ($reraValues as $reraValue) {
                // Create a new Rera record for each reraValue
                $reraRecord = new Rera();
                $reraRecord->project_id = $project_id;
                $reraRecord->subproject_id = $subproject_id;
                $reraRecord->rera = $reraValue;
                $reraRecord->save();
            }
        }
    
        // Optionally, you can return a response indicating success or any other relevant information.
        return response()->json(['message' => 'Data stored successfully', $responseData], 200);
    }
    
    public function showRera1($subproject_id)
    {
        $reraData = Rera::where('subproject_id', $subproject_id)->get();
        return response()->json($reraData, 200);
    }
    
    
    public function updateReraDataForsubProject(Request $request, $subproject_id)
{
    $project_id = $request->input('project_id', null);
    $reraData = $request->input('reraData', []);

    // Get existing RERA records for the given subproject_id
    $existingReraIds = Rera::where('subproject_id', $subproject_id)->pluck('id')->toArray();

    // Update existing RERA records and insert new ones
    foreach ($reraData as $reraItem) {
        // Assuming 'Rera' is the model for your RERA table
        // You can add more validation or processing as needed before updating the database
        $projectId = $reraItem['project_id'] ?? $project_id; // Use 'project_id' from the payload if present, otherwise use the default value

        if (isset($reraItem['id']) && in_array($reraItem['id'], $existingReraIds)) {
            // Update existing RERA records
            Rera::where('id', $reraItem['id'])->where('subproject_id', $subproject_id)->update(['rera' => $reraItem['rera'], 'project_id' => $projectId]);
            // Remove the processed RERA id from the existingReraIds array
            $existingReraIds = array_diff($existingReraIds, [$reraItem['id']]);
        } else {
            // Create a new RERA record
            $rera = new Rera();
            $rera->project_id = $projectId; // Set project_id from the payload or default value
            $rera->subproject_id = $subproject_id;
            $rera->rera = $reraItem['rera'];
            $rera->save();
        }
    }

    // Remove any remaining RERA records that were not in the payload
    if (!empty($existingReraIds)) {
        Rera::whereIn('id', $existingReraIds)->delete();
    }

    // Fetch the updated RERA records after the operations
    $updatedReraData = Rera::where('subproject_id', $subproject_id)->get();

    // Optionally, you can return a response indicating success or any other relevant information.
    return response()->json(['message' => 'RERA data updated successfully', 'data' => $updatedReraData], 200);
}


}
