<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regions;

class RegionsController extends Controller
{
    public function index()
    {
        $regions = DB::table('regions')->where('boolean_value', '1') 
        ->orderBy('updated_at','DESC')
        ->get();
		return response()->json($regions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newRegions = new Regions([
			'region_name' => $request->get('region_name')
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
			'region_name' => 'required|unique:regions,region_name'
		]);

		$newRegions = new Regions([
			'region_name' => $request->get('region_name')
		]);

		$newRegions->save();

		return response()->json($newRegions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($region_id)
    {
        $regions = Regions::findOrFail($region_id);
		return response()->json($regions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($region_id)
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
    public function update(Request $request, $region_id)
    {
		$regions = Regions::findOrFail($region_id);
		
		$regions = Regions::find($region_id);
        $regions->update($request->all());
        return $regions;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($region_id)
    {
        $regions = Regions::findOrFail($region_id);

        $regions = Regions::find($region_id);
        if ($regions) {
            $regions->boolean_value = 0;
            $regions->save();
            return $regions;
        }
    }
}
