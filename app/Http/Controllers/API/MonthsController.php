<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Months;
use DB;

class MonthsController extends Controller
{
    public function index()
    {
        $months = Months::all();
      return response()->json($months);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newmonths = new Months([
			'month_name' => $request->get('month_name'),
			'month_value' => $request->get('month_value')
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
        /** dependency dropdown code start**/
//dd($request->all());
     
        /** dependency dropdown code end**/


    //     if(isset($request->subregion_name)){
    //     $request->validate([
	// 		'region_id' => 'required',
	// 		'subregion_name' => 'required|unique:Months,subregion_name'
	// 	]);

	// 	$newMonths = new Months([
	// 		'region_id' => $request->get('region_id'),
	// 		'subregion_name' => $request->get('subregion_name')
	// 	]);

	// 	$newMonths->save();

	// 	return response()->json($newMonths);
    // }else{
      
        $salary_month = $request->salary_month;
        $months = new Months();
        $data = $months->getState1($salary_month);
        return response()->json($data);
      
    // }

     
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($month_id)
    // {
    //     $months = Months::findOrFail($month_id);
	// 	return response()->json($months);
    // }
    

    public function show(Request $request, $month_id){
        $months = DB::table('months')
        ->join('emp_attendance', 'emp_attendance.month', '=', 'months.month_id')
        ->select('months.*','emp_attendance.year')
        ->where('months.month_id', $month_id)
        ->first();
        return response()->json($months);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($month_id)
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
    public function update(Request $request, $month_id)
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
		
		$months = Months::findOrFail($month_id);
		
		$months = Months::find($month_id);
        $months->update($request->all());
        return $months;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($month_id)
    {
        $months = Months::findOrFail($month_id);
		$months->delete();

		return response()->json($months::all());
    }

    // public function Months(Request $request){

    // $month_id = $request->month_id;
    // $MonthsModel = new Months();
    // $data = $MonthsModel->getSubregion($month_id);
    // return response()->json($data);
    // }
}
