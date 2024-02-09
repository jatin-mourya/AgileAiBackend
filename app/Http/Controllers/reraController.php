<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rera;

class reraController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id'=>'',
            'subproject_id'=>'',
			'rera' => ''
		]);

		$newProjects = new Projects([
			'project_id' => $request->get('project_id'),
            'subproject_id' => $request->get('subproject_id'),
            'rera' => $request->get('rera')
		]);

		$newProjects->save();

		return response()->json($newProjects);
    }
}
