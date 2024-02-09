<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\rera;

class reraController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => '', // Make sure 'project_id' is required
            'subproject_id' => '', // Add appropriate validation rule here
            'rera' => '' // Add appropriate validation rule here
        ]);
    
        // Rest of the code remains the same
        $project_id = $request->input('project_id');
        dd($project_id);
    
        $newProject = new rera([
            'project_id' => $project_id,
            'subproject_id' => $request->input('subproject_id'),
            'rera' => $request->input('rera')
        ]);
    
        $newProject->save();
    
        // Return the saved data as JSON response
        // return response()->json($newProject);
    }
    
    
    
}
