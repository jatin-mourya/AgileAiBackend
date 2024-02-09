<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incentiverange;
//use DB   
use Illuminate\Support\Facades\DB;;

class IncentiverangeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Incentiverange = Incentiverange::all();
		return response()->json($Incentiverange);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newIncentiverange = new Incentiverange([
			'business_value' => $request->get('business_value'),
			'business_value1' => $request->get('business_value1'),
            'business_cat' => $request->get('business_cat')
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
			'business_value' => 'required',
			'business_value1' => 'required',
            'business_cat' => 'required'
		]);

		$newIncentiverange = new Incentiverange([
			'business_value' => $request->get('business_value'),
			'business_value1' => $request->get('business_value1'),
            'business_cat' => $request->get('business_cat')
		]);

		$newIncentiverange->save();

		return response()->json($newIncentiverange);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Incentiverange = Incentiverange::findOrFail($id);
		return response()->json($Incentiverange);
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
        /* $Incentiverange = Incentiverange::findOrFail($id);

		$request->validate([
			'slug' => 'slug',
			'name' => 'name'
		]);

		$Incentiverange->slug = $request->get('slug');
		$Incentiverange->name = $request->get('name');

		$Incentiverange->save();

		return response()->json($Incentiverange); */
		
		$Incentiverange = Incentiverange::findOrFail($id);
		
		$Incentiverange = Incentiverange::find($id);
        $Incentiverange->update($request->all());
        return $Incentiverange;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Incentiverange = Incentiverange::findOrFail($id);
		$Incentiverange->delete();

		return response()->json($Incentiverange::all());
    }

    public function inceBusiness(){
        dd(all());
        //$amount = $request->receivable_amt;
        $amount = 2000000;
        ///////////////////////// Monthly Incentive ///////////////////////

        if(($business_value  <= 2000000) && (2000000 <= $business_value1)){
            $business_cat = $business_cat;
        }
        $data=DB::table('tbl_incentive_range') 
        //->where('business_cat',$business_cat)
        ->where('business_value',$business_value)
        ->where('business_value1',$business_value1)
        ->select($business_cat)
        ->get();
        return response()->json($data);
    }
}
