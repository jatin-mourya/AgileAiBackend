<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();
		return response()->json($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newRoles = new Roles([
			'slug' => $request->get('slug'),
			'name' => $request->get('name')
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
			'slug' => 'required',
			'name' => 'required'
		]);

		$newRoles = new Roles([
			'slug' => $request->get('slug'),
			'name' => $request->get('name')
		]);

		$newRoles->save();

		return response()->json($newRoles);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = Roles::findOrFail($id);
		return response()->json($roles);
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
        /* $roles = Roles::findOrFail($id);

		$request->validate([
			'slug' => 'slug',
			'name' => 'name'
		]);

		$roles->slug = $request->get('slug');
		$roles->name = $request->get('name');

		$roles->save();

		return response()->json($roles); */
		
		$roles = Roles::findOrFail($id);
		
		$roles = Roles::find($id);
        $roles->update($request->all());
        return $roles;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Roles::findOrFail($id);
		$roles->delete();

		return response()->json($roles::all());
    }
}
