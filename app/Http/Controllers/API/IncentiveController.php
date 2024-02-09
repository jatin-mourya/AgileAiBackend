<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incentive;


class IncentiveController extends Controller
{
    public function index()
    {
        $Incentive = Incentive::all();
		return response()->json($Incentive);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newIncentive = new Incentive([
			'ince_type' => $request->get('ince_type'),
            'ince_freq' => $request->get('ince_freq'),
            'cat1_target' => $request->get('cat1_target'),
			'cat2_target' => $request->get('cat2_target'),
			'A' => $request->get('A'),
            'B' => $request->get('B'),
            'C' => $request->get('C'),
			'D' => $request->get('D'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'created_at' => $request->get('created_at'),
			'updated_at' => $request->get('updated_at')
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
        // $request->validate([
		// 	//'id' => 'required',
		// 	'region_name' => 'required'
		// ]);

		$newIncentive = new Incentive([
			'ince_type' => $request->get('ince_type'),
            'ince_freq' => $request->get('ince_freq'),
            'cat1_target' => $request->get('cat1_target'),
			'cat2_target' => $request->get('cat2_target'),
			'A' => $request->get('A'),
            'B' => $request->get('B'),
            'C' => $request->get('C'),
			'D' => $request->get('D'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'created_at' => $request->get('created_at'),
			'updated_at' => $request->get('updated_at')
		]);

		$newIncentive->save();

		return response()->json($newIncentive);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Incentive = Incentive::findOrFail($id);
		return response()->json($Incentive);
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
		
		$Incentive = Incentive::findOrFail($id);
		
		$Incentive = Incentive::find($id);
        $Incentive->update($request->all());
        return $Incentive;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Incentive = Incentive::findOrFail($id);
		$Incentive->delete();

		return response()->json($Incentive::all());
    }
}
