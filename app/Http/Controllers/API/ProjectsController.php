<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\rera;
use App\Models\companyMulti;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::all();

                $projects = DB::table('projects')
                         ->select('project_id','debtor_company_det.cname','project_name','rera','location','regions.region_name','subregions.subregion_name','builders_group.name')
                        // ->select('project_id','debtor_company_det.cname','project_name','rera','location','regions.region_name','subregions.subregion_name')
                        ->leftJoin('debtor_company_det','debtor_company_det.debtor_company_det_id','=','projects.company_id')
                        ->leftJoin('regions', 'regions.region_id', '=', 'projects.region_id')
                        ->leftJoin('subregions', 'subregions.subregion_id', '=', 'projects.subregion_id')
                        ->leftJoin('builders_group','builders_group.builder_group_id','=','projects.builder_group_id')
                        ->where('projects.boolean_value','1')
                        ->orderBy('projects.updated_at','DESC')
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
        $newProjects = new Projects([
			'project_name' => $request->get('project_name'),
			'rera' => $request->get('rera'),
			'builder_group_id' => $request->get('builder_group_id'),
            'location' => $request->get('location'),
            'region_id' => $request->get('reagion_id'),
            'subregion_id' => $request->get('subregion_id'),
            'company_id' => $request->get('company_id'),
            'ads_status' => $request->get('ads_status'),
            'outdoor_presence' => $request->get('outdoor_presence'),
            'aop_taken' => $request->get('aop_taken'),
            'project_status' => $request->get('project_status'),
            'focused' => $request->get('focused'),
            'profile_score' => $request->get('profile_score')
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
			'project_name' => 'required|unique:projects,project_name',
			'rera' => '',
			'builder_group_id' => '',
            'location' => '',
            'region_id' => 'required',
            'subregion_id' => 'required',
            'company_id' => '',
            'profile_score',
            'focused' => ''
		]);

		$newProjects = new Projects([
			'project_name' => $request->get('project_name'),
            'rera' => $request->get('rera'),
            'builder_group_id' => $request->input('builder_group_id'),
            'location' => $request->get('location'),
            'region_id' => $request->get('region_id'),
            'subregion_id' => $request->get('subregion_id'),
			'company_id' => $request->get('company_id'),
			'ads_status' => $request->get('ads_status'),
            'outdoor_presence' => $request->get('outdoor_presence'),
            'aop_taken' => $request->get('aop_taken'),
            'project_status' => $request->get('project_status'),
            'profile_score' => $request->get('profile_score'),
            'focused' => $request->input('focused')
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
    // public function show($project_id)
    // {
    //     $projects = Projects::findOrFail($project_id) ;
	// 	return response()->json($projects);
    // }


    public function show(Request $request, $project_id)

    {
        $projects = DB::table('projects')
        ->select('projects.*','builders_group.name')
        ->leftJoin('builders_group','builders_group.builder_group_id','=','projects.builder_group_id')
        ->where('projects.project_id', $project_id)
        ->first();
        return response()->json($projects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id)
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
    public function update(Request $request, $project_id)
    {
		$projects = Projects::findOrFail($project_id);
		
		$projects = Projects::find($project_id);
        $projects->update($request->all());
        return $projects;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id)
    {
        $projects = Projects::findOrFail($project_id);

        $projects = Projects::find($project_id);
        if ($projects) {
            $projects->boolean_value = 0;
            $projects->save();
            return $projects;
        }

    }
    
        public function projectteamwise(Request $request)
    {
    
        $regiondata1 = DB::table('projects')
                      ->select('regions.*','debtor_company_det.cname','projects.*')
                      ->join('debtor_company_det','debtor_company_det.debtor_company_det_id','=','projects.company_id')
                      ->join('regions','regions.region_id', '=','projects.region_id')
                       ->where('projects.region_id','=', $request)
                    
                        ->get();
                    
		return response()->json($regiondata1);

    }


public function getRegionData(Request $request)
{
    $region_id = $request->region_id;
    $regiondata3 = DB::table('projects')
                    ->leftjoin('regions', 'regions.region_id', '=', 'projects.region_id')
                    ->leftjoin('subregions', 'subregions.subregion_id', '=', 'projects.subregion_id')
                    ->leftjoin('debtor_company_det','debtor_company_det.debtor_company_det_id','=','projects.company_id')
                    ->select('regions.region_name', 'projects.*','debtor_company_det.cname','subregions.subregion_name')
                    ->where('projects.region_id', $region_id)
                    ->get();
    return response()->json($regiondata3);

}

public function getSubRegionData(Request $request)
{
    $region_id = $request->region_id;
    $subregion_id = $request->subregion_id;
    $regiondata5 = DB::table('projects')
                    ->leftjoin('regions', 'regions.region_id', '=', 'projects.region_id')
                    ->leftjoin('subregions', 'subregions.subregion_id', '=', 'projects.subregion_id')
                    ->leftjoin('debtor_company_det','debtor_company_det.debtor_company_det_id','=','projects.company_id')
                    ->select('regions.region_name', 'projects.*','debtor_company_det.cname','subregions.subregion_name')
                    ->where('projects.region_id', $region_id)
                    ->where('projects.subregion_id', $subregion_id)
                    ->get();
    return response()->json($regiondata5);

}

public function getProjectStatusData(Request $request)
{
    $region_id = $request->region_id;
    $subregion_id = $request->subregion_id;
    $project_status = $request->project_status;
    $regiondata6 = DB::table('projects')
                    ->leftjoin('regions', 'regions.region_id', '=', 'projects.region_id')
                    ->leftjoin('subregions', 'subregions.subregion_id', '=', 'projects.subregion_id')
                    ->leftjoin('debtor_company_det','debtor_company_det.debtor_company_det_id','=','projects.company_id')
                    ->select('regions.region_name', 'projects.*','debtor_company_det.cname','subregions.subregion_name')
                    ->where('projects.region_id', $region_id)
                    ->where('projects.subregion_id', $subregion_id)
                    ->where('projects.project_status', $project_status)
                    ->get();
    return response()->json($regiondata6);

}

public function updateRegion(Request $request)
{
    $data = $request->all(); 
   
    foreach ($data as $item) {
        $record = Projects::find($item['project_id']); 
        if ($record) {
            $record->project_name = $item['project_name']; 
            $record->location = $item['location'];
            $record->rera = $item['rera'];
            $record->region_id = $item['region_id'];
            $record->subregion_id = $item['subregion_id'];
            $record->company_id = $item['company_id'];
            $record->ads_status = $item['ads_status'];
            $record->outdoor_presence = $item['outdoor_presence'];
            $record->aop_taken = $item['aop_taken'];
            $record->project_status = $item['project_status'];
            $record->save(); 
            $updatedRecords[]=$record;
        }
    }

    return response()->json(['message' => 'Bulk update successful','data' => $updatedRecords]);
}

   public function reradata(Request $request)
{
    $responseData = $request->json()->all();

    if (isset($responseData['rera']) && isset($responseData['rera']['rera'])) {
        $project_id = $responseData['projects'];
        $reraValues = $responseData['rera']['rera'];

        foreach ($reraValues as $reraValue) {
            // Create a new Rera record for each reraValue
            $reraRecord = new Rera();
            $reraRecord->project_id = $project_id;
            $reraRecord->rera = $reraValue;
            // If you have a subproject_id, you can set it as well
            // $reraRecord->subproject_id = $subproject_id;
            $reraRecord->save();
        }
    }

    // Optionally, you can return a response indicating success or any other relevant information.
    return response()->json(['message' => 'Data stored successfully',$responseData], 200);
}
    
public function showRera($project_id)
{
    $reraData = Rera::where('project_id', $project_id)->get();
    return response()->json($reraData, 200);
}

public function updateReraDataForProject(Request $request, $project_id)
{
    $reraData = $request->input('reraData');

    // First, delete existing RERA records for the given project_id
    Rera::where('project_id', $project_id)->delete();

    // Now, insert the updated RERA data
    foreach ($reraData as $reraItem) {
        // Assuming 'Rera' is the model for your RERA table
        // You can add more validation or processing as needed before inserting the data
        $rera = new Rera();
        $rera->project_id = $project_id;
        $rera->rera = $reraItem['rera'];
        $rera->save();
    }

    // Optionally, you can return a response indicating success or any other relevant information.
    return response()->json(['message' => 'RERA data updated successfully', 'data' => $reraData], 200);
}



public function companydata(Request $request)
{
    $responseData = $request->json()->all();

    if (isset($responseData['company']) && isset($responseData['company']['company'])) {
        $project_id = $responseData['projects'];
        $reraValues = $responseData['company']['company'];

        foreach ($reraValues as $reraValue) {
            // Create a new Rera record for each reraValue
            $reraRecord = new companyMulti();
            $reraRecord->project_id = $project_id;
            $reraRecord->debtor_company_det_id = $reraValue;
            // If you have a subproject_id, you can set it as well
            // $reraRecord->subproject_id = $subproject_id;
            $reraRecord->save();
        }
    }
    return response()->json(['message' => 'Data stored successfully',$responseData], 200);

    // Optionally, you can return a response indicating success or any other relevant information.
}

public function showcompany($project_id)
{
    $compData = companyMulti::where('project_id', $project_id)->get();
    return response()->json($compData, 200);
}

public function updateCompDataForProject(Request $request, $project_id)
{
    $reraData = $request->input('company');

    // First, delete existing RERA records for the given project_id
    companyMulti::where('project_id', $project_id)->delete();

    // Now, insert the updated RERA data
    foreach ($reraData as $reraItem) {
        // Assuming 'Rera' is the model for your RERA table
        // You can add more validation or processing as needed before inserting the data
        $rera = new companyMulti();
        $rera->project_id = $project_id;
        $rera->debtor_company_det_id = $reraItem['debtor_company_det_id'];
        $rera->save();
    }

    // Optionally, you can return a response indicating success or any other relevant information.
    return response()->json(['message' => 'RERA data updated successfully', 'data' => $reraData], 200);
}
	
}
