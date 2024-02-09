<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Groups::all();
		return response()->json($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newGroups = new Groups([
			'slug' => $request->get('slug'),
			'gropuname' => $request->get('groupname')
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
			'groupname' => 'required'
		]);

		$newGroups = new Groups([
			'slug' => $request->get('slug'),
			'groupname' => $request->get('groupname')
		]);

		$newGroups->save();

		return response()->json($newGroups);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = Groups::findOrFail($id);
		return response()->json($groups);
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
        // $groups = Groups::findOrFail($id);

		// $request->validate([
		// 	'slug' => 'slug',
		// 	'groupname' => 'groupname'
		// ]);

		// $groups->slug = $request->get('slug');
		// $groups->groupname = $request->get('groupname');

		// $groups->save();

		// return response()->json($groups);

        $groups = Groups::findOrFail($id);
		
		$groups = Groups::find($id);
        $groups->update($request->all());
        return $groups;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groups = Groups::findOrFail($id);
		$groups->delete();

		return response()->json($groups::all());
    }
}
