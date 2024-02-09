<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subregions;

class SubregionsController extends Controller
{
    public function index()
    {
        $subregions = Subregions::all();

        $subregions = DB::table('subregions')
                        ->join('regions', 'regions.region_id', '=', 'subregions.region_id')
                        ->select('regions.region_name','subregions.*')
                        ->where('subregions.boolean_value', '1')
                        ->orderBy('subregions.updated_at', 'DESC')
                        ->get();
		
		return response()->json($subregions);

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
        if($request->get('subregion_name') != 'null'){
            $request->validate([
                'region_id' => 'required',
                'subregion_name' => 'required|unique:subregions,subregion_name'
            ]);
    
            $newSubregions = new Subregions([
                'region_id' => $request->get('region_id'),
                'subregion_name' => $request->get('subregion_name')
            ]);
    
            $newSubregions->save();
    
            return response()->json($newSubregions);
        }else{
          
            $region_id = $request->region_id;
            $subregionsModel = new Subregions();
            $data = $subregionsModel->getSubregion($region_id);
            return response()->json($data);
          
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Request $request, $subregion_id)
    // {
    //     $subregions = Subregions::findOrFail($subregion_id);
	// 	return response()->json($subregions);

        
    // }

    public function show(Request $request,$subregion_id)
    {
		
        $regiondata1 = DB::table('subregions')
        //
                    ->join('regions', 'regions.region_id', '=', 'subregions.region_id')
                    ->select('regions.region_name','subregions.*')
                    ->where('subregions.subregion_id', $subregion_id)
                    ->first();
		return response()->json($regiondata1);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subregion_id)
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
    public function update(Request $request, $subregion_id)
    {

		$subregions = Subregions::findOrFail($subregion_id);
		
		$subregions = Subregions::find($subregion_id);
        $subregions->update($request->all());
        return $subregions;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subregion_id)
    {
        $subregions = Subregions::findOrFail($subregion_id);

        $subregions = Subregions::find($subregion_id);
        if ($subregions) {
            $subregions->boolean_value = 0;
            $subregions->save();
            return $subregions;
        }
    }


    public function getSubregionOfRegion($region_id)
    {
        $subregions = DB::table('regions')->WHERE('region_id', $region_id)->first();
        // $subregions = SubRegion::findOrFail($region_name);
        $allSubRegions = Subregions::SELECT('subregion_name', 'subregion_id' , 'boolean_value')
        ->WHERE('region_id', $subregions->region_id)->WHERE('boolean_value', '1')->get();
        return response()->json($allSubRegions);

    }

    
}
