<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tlincentivestructure;

class TlincentivestructureController extends Controller
{

    //12-03-2023

    public function index()
    {  
        $newTLS = Tlincentivestructure::all();
        $newTLS = DB::table('tbl_tl_incentives_structure')
                        ->select('*')
                        ->get();
        return response()->json($newTLS);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
     {
         $newTLS = new Tlincentivestructure([
             'ince_type' => $request->get('ince_type'),
             'ince_freq' => $request->get('ince_freq'),
             'condition1' => $request->get('condition1'),
             'condition2' => $request->get('condition2'),
             'condition3' => $request->get('condition3'),
             'incentive' => $request->get('incentive'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),
            
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
            //  'ince_type' => 'required',
            //  'ince_freq' => 'required',
            //  'condition1' => 'required',
            //  'condition2' => 'required',
            //  'condition3' => 'required',
            //  'incentive' => 'required',
            //  'from_date' => 'required',
            //  'to_date' => 'required',

         ]);
 
         $newTLS = new Tlincentivestructure([
             'ince_type' => $request->get('ince_type'),
             'ince_freq' => $request->get('ince_freq'),
             'condition1' => $request->get('condition1'),
             'condition2' => $request->get('condition2'),
             'condition3' => $request->get('condition3'),
             'incentive' => $request->get('incentive'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),
         ]);
 
         $newTLS->save();
 
         
         return response()->json($newTLS);
         
         // return ('message','Success! You have added data successfully.');
 
     
     }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($ince_id)
    {
        $newTLS = Tlincentivestructure::findOrFail($ince_id);
		return response()->json($newTLS);
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
    public function update(Request $request,$team_id)
    {
        $newTLS = Tlincentivestructure::findOrFail($team_id);

		$request->validate([
            //  'ince_type' => 'required',
            //  'ince_freq' => 'required',
            //  'condition1' => 'required',
            //  'condition2' => 'required',
            //  'condition3' => 'required',
            //  'incentive' => 'required',
            //  'from_date' => 'required',
            //  'to_date' => 'required',
		]);

        $newTLS->ince_type = $request->get('ince_type');
		$newTLS->ince_freq = $request->get('ince_freq');
        $newTLS->condition1 = $request->get('condition1');
        $newTLS->condition2 = $request->get('condition2');
        $newTLS->condition3 = $request->get('condition3');
        $newTLS->incentive = $request->get('incentive');
        $newTLS->from_date = $request->get('from_date');
		$newTLS->to_date = $request->get('to_date');
       

		$newTLS->save();

		return response()->json($newTLS);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $newTLS = Tlincentivestructure::findOrFail($id);
		$newTLS->delete();

		return response()->json($newTLS::all());
    }


    public function getQTLIncentive($ts){
        $data=DB::table('tbl_tl_incentives_structure')
        ->select('incentive')
        ->where('ince_freq','=',"QI")
        ->where('condition2','<=',$ts)
        ->where('condition3','>=',$ts)
        ->get();
        return response()->json($data);
    }


    public function getHYITLIncentive($ts){
        $data=DB::table('tbl_tl_incentives_structure')
        ->select('incentive')
        ->where('ince_freq','=',"HYI")
        ->where('condition2','<=',$ts)
        ->where('condition3','>=',$ts)
        ->get();
        return response()->json($data);
    }

    public function getYITLIncentive($ts){
        $data=DB::table('tbl_tl_incentives_structure')
        ->select('incentive')
        ->where('ince_freq','=',"YI")
        ->where('condition2','<=',$ts)
        ->where('condition3','>=',$ts)
        ->get();
        return response()->json($data);
    }


}
