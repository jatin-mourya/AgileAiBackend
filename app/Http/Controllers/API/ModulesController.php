<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modules;

class ModulesController extends Controller
{
    public function index()
    {
        $modules = Modules::all();
		return response()->json($modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newModules = new Modules([
			'module_name' => $request->get('module_name'),
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
		 	'module_name' => 'required',
		]);

		$newModules = new Modules([
			'module_name' => $request->get('module_name')
		]);

		$newModules->save();

		return response()->json($newModules);
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($module_id)
    {
        $modules = Modules::findOrFail($module_id);
		return response()->json($modules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($module_id)
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
    public function update(Request $request, $module_id)
    {
		
		$modules = Modules::findOrFail($module_id);
		
		$modules = Modules::find($module_id);
        $modules->update($request->all());
        return $modules;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($module_id)
    {
        $modules = Modules::findOrFail($module_id);
		$modules->delete();

		return response()->json($modules::all());
    }

}
