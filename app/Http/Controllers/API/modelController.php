<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\modelrole;
use Illuminate\Support\Facades\DB;

class modelController extends Controller
{
    public function index()
    {  
        $modelrole = modelrole::all();
        // $empdocuments = DB::table('users')
        // ->orderBy('users.updated_at','DESC')
        // ->get();
		return response()->json($modelrole);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$newusersData = $newusers->getNewusers($request->email);




        $modelrole = new modelrole([
            'role_id' => $request->get('role_id'),
            'model_type' => $request->get('model_type'),
            'model_id' => $request->get('model_id')
           
            
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
        // Add your validation rules here
    ]);

    $modelrole = ModelRole::updateOrCreate(
        [
            'model_id' => $request->get('model_id'), 
        ],
        [
            'role_id' => $request->get('role_id'),
            'model_type' => 'App\\Models\\User',
            'model_id' => $request->get('model_id')
        ]
    );

    return response()->json($modelrole);
}


}
