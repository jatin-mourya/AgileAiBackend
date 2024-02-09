<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gstr3b;
use App\Models\Gstjson;

//use DB   
use Illuminate\Support\Facades\DB;
use App\Models\Groups;


class Gstr_3b extends Controller
{
    public function index()
    {
        $gstr_3b = Gstr3b::all();
		return response()->json($gstr_3b);
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
		$gstr_3b = new Gstr3b([
			'month_year' => $request->get('month_year'),
			'sales_rate_InMaha' => $request->get('sales_rate_InMaha'),
            'sales_basic_InMaha' => $request->get('sales_basic_InMaha'),
			'sales_CGST_InMaha' => $request->get('sales_CGST_InMaha'),
            'sales_SGST_InMaha' => $request->get('sales_SGST_InMaha'),
			'sales_IGST_InMaha' => $request->get('sales_IGST_InMaha'),
            'sales_rate_OutMaha_18' => $request->get('sales_rate_OutMaha_18'),
            'sales_IGST_OutMaha_18' => $request->get('sales_IGST_OutMaha_18'),
            'sales_basic_OutMaha_18' => $request->get('sales_basic_OutMaha_18'),
            'sales_rate_OutMaha_12' => $request->get('sales_rate_OutMaha_12'),
            'sales_IGST_OutMaha_12' => $request->get('sales_IGST_OutMaha_12'),
            'sales_basic_OutMaha_12' => $request->get('sales_basic_OutMaha_12'),
            'sales_rate_OutMaha_5' => $request->get('sales_rate_OutMaha_5'),
            'sales_IGST_OutMaha_5' => $request->get('sales_IGST_OutMaha_5'),
			'sales_basic_OutMaha_5' => $request->get('sales_basic_OutMaha_5'),
			'sales_basic_RCM' => $request->get('sales_basic_RCM'),
            'sales_CGST_RCM' => $request->get('sales_CGST_RCM'),
			'sales_SGST_RCM' => $request->get('sales_SGST_RCM'),
            'sales_IGST_RCM' => $request->get('sales_IGST_RCM'),
			'sales_basic_Amendment' => $request->get('sales_basic_Amendment'),
            'sales_CGST_Amendment' => $request->get('sales_CGST_Amendment'),
			'sales_SGST_Amendment' => $request->get('sales_SGST_Amendment'),
            'sales_IGST_Amendment' => $request->get('sales_IGST_Amendment'),
			'sales_Basic_Total' => $request->get('sales_Basic_Total'),
            'sales_CGST_Total' => $request->get('sales_CGST_Total'),
            'sales_SGST_Total' => $request->get('sales_SGST_Total'),
			'sales_IGST_Total' => $request->get('sales_IGST_Total'),
            'pur_inMhRt_18' => $request->get('pur_inMhRt_18'),
			'pur_inMhBs_18' => $request->get('pur_inMhBs_18'),
            'pur_inMhC_18' => $request->get('pur_inMhC_18'),
			'pur_inMhS_18' => $request->get('pur_inMhS_18'),
            'pur_inMhRt_12' => $request->get('pur_inMhRt_12'),
			'pur_inMhBs_12' => $request->get('pur_inMhBs_12'),
            'pur_inMhC_12' => $request->get('pur_inMhC_12'),
			'pur_inMhS_12' => $request->get('pur_inMhS_12'),
            'pur_inMhRt_5' => $request->get('pur_inMhRt_5'),
			'pur_inMhBs_2' => $request->get('pur_inMhBs_2'),
            'pur_inMhC_5' => $request->get('pur_inMhC_5'),
			'pur_inMhS_5' => $request->get('pur_inMhS_5'),
            'purc_CGST_InMhPurc' => $request->get('purc_CGST_InMhPurc'),
			'purc_SGST_InMhPurc' => $request->get('purc_SGST_InMhPurc'),
            'purc_CGST_OutMhPurc' => $request->get('purc_CGST_OutMhPurc'),
			'purc_SGST_OutMhPurc' => $request->get('purc_SGST_OutMhPurc'),
            'pur_OutMhRt_18' => $request->get('pur_OutMhRt_18'),
			'pur_OutMhBs_18' => $request->get('pur_OutMhBs_18'),
            'pur_OutMhI_18' => $request->get('pur_OutMhI_18'),
			'pur_OutMhRt_12' => $request->get('pur_OutMhRt_12'),
            'pur_OutMhBs_12' => $request->get('pur_OutMhBs_12'),
			'pur_OutMhI_12' => $request->get('pur_OutMhI_12'),
            'pur_OutMhRt_5' => $request->get('pur_OutMhRt_5'),
			'pur_OutMhBs_5' => $request->get('pur_OutMhBs_5'),
            'pur_OutMhI_5' => $request->get('pur_OutMhI_5'),
			'purc_RCM_CGST' => $request->get('purc_RCM_CGST'),
            'purc_RCM_SGST' => $request->get('purc_RCM_SGST'),
            'purc_RCM_IGST	' => $request->get('purc_RCM_IGST'),
            'pur_basic_total' => $request->get('pur_basic_total'),
			'pur_CGST_total' => $request->get('pur_CGST_total'),
            'pur_SGST_total' => $request->get('pur_SGST_total'),
			'pur_IGST_total' => $request->get('pur_IGST_total'),
            'ITC_Basic' => $request->get('ITC_Basic'),
			'ITC_CGST' => $request->get('ITC_CGST'),
            'ITC_SGST' => $request->get('ITC_SGST'),
			'ITC_IGST' => $request->get('ITC_IGST'),
            'IGST_to_IGST' => $request->get('IGST_to_IGST'),
			'IGST_to_CGST' => $request->get('IGST_to_CGST'),
            'CGST_Balance_Liability' => $request->get('CGST_Balance_Liability'),
			'SGST_Balance_Liability' => $request->get('SGST_Balance_Liability'),
            'IGST_to_SGST' => $request->get('IGST_to_SGST'),
			'CGST_to_CGST' => $request->get('CGST_to_CGST'),
            'CGST_to_IGST' => $request->get('CGST_to_IGST'),
			'SGST_to_SGST' => $request->get('SGST_to_SGST'),
            'SGST_to_IGST' => $request->get('SGST_to_IGST'),
			'CGST_Late_Fees' => $request->get('CGST_Late_Fees'),
            'SGST_Late_Fees' => $request->get('SGST_Late_Fees'),
			'CGST_Final_Liability' => $request->get('CGST_Final_Liability'),
            'SGST_Final_Liability' => $request->get('SGST_Final_Liability'),
			'Carried_Forward_CGST' => $request->get('Carried_Forward_CGST'),
            'Carried_Forward_SGST' => $request->get('Carried_Forward_SGST'),
			'Carried_Forward_IGST' => $request->get('Carried_Forward_IGST')
		]);

		$gstr_3b->save();

		return response()->json($gstr_3b);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gstr_3b = Gstr3b::findOrFail($id);
		return response()->json($gstr_3b);
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

    public function getMonth($month1)
    {
        // dd($month1);
        $gstr_3b = DB::table('gstr_3b')
                   ->select('*')
                   ->where('month_year', '=' ,$month1)
                   ->get();
                  
         return response()->json($gstr_3b);
    }

    public function gstrAll()
    {
        $gstr_3b = Gstjson::all();
        $gstr_3b = DB::table('gstr_3b')
                ->select( DB::raw('SUM(cgst_amt) as invctotal'), DB::raw('COUNT(cgst_amt) as Invcount'), DB::raw('SUM(sgst_amt) as invstotal'), DB::raw('SUM(igst_amt) as invitotal'), DB::raw('SUM(total_gst_amt) as total'))
                ->groupby('new_date')
                ->get();
                
		    return response()->json($gstr_3b);
    }

    public function updateCreate3B(Request $request){
        $request->validate([
       
                 'month_year' => 'required'
            ]);
        $gstr_3b = Gstr3b::updateOrCreate(
   
         ['month_year' => $request->get('month_year')],
           [
			'sales_rate_InMaha' => $request->get('sales_rate_InMaha'),
            'sales_basic_InMaha' => $request->get('sales_basic_InMaha'),
			'sales_CGST_InMaha' => $request->get('sales_CGST_InMaha'),
            'sales_SGST_InMaha' => $request->get('sales_SGST_InMaha'),
			'sales_IGST_InMaha' => $request->get('sales_IGST_InMaha'),
            'sales_rate_OutMaha_18' => $request->get('sales_rate_OutMaha_18'),
            'sales_IGST_OutMaha_18' => $request->get('sales_IGST_OutMaha_18'),
            'sales_basic_OutMaha_18' => $request->get('sales_basic_OutMaha_18'),
            'sales_rate_OutMaha_12' => $request->get('sales_rate_OutMaha_12'),
            'sales_IGST_OutMaha_12' => $request->get('sales_IGST_OutMaha_12'),
            'sales_basic_OutMaha_12' => $request->get('sales_basic_OutMaha_12'),
            'sales_rate_OutMaha_5' => $request->get('sales_rate_OutMaha_5'),
            'sales_IGST_OutMaha_5' => $request->get('sales_IGST_OutMaha_5'),
			'sales_basic_OutMaha_5' => $request->get('sales_basic_OutMaha_5'),
			'sales_basic_RCM' => $request->get('sales_basic_RCM'),
            'sales_CGST_RCM' => $request->get('sales_CGST_RCM'),
			'sales_SGST_RCM' => $request->get('sales_SGST_RCM'),
            'sales_IGST_RCM' => $request->get('sales_IGST_RCM'),
			'sales_basic_Amendment' => $request->get('sales_basic_Amendment'),
            'sales_CGST_Amendment' => $request->get('sales_CGST_Amendment'),
			'sales_SGST_Amendment' => $request->get('sales_SGST_Amendment'),
            'sales_IGST_Amendment' => $request->get('sales_IGST_Amendment'),
			'sales_Basic_Total' => $request->get('sales_Basic_Total'),
            'sales_CGST_Total' => $request->get('sales_CGST_Total'),
            'sales_SGST_Total' => $request->get('sales_SGST_Total'),
			'sales_IGST_Total' => $request->get('sales_IGST_Total'),
            'pur_inMhRt_18' => $request->get('pur_inMhRt_18'),
			'pur_inMhBs_18' => $request->get('pur_inMhBs_18'),
            'pur_inMhC_18' => $request->get('pur_inMhC_18'),
			'pur_inMhS_18' => $request->get('pur_inMhS_18'),
            'pur_inMhRt_12' => $request->get('pur_inMhRt_12'),
			'pur_inMhBs_12' => $request->get('pur_inMhBs_12'),
            'pur_inMhC_12' => $request->get('pur_inMhC_12'),
			'pur_inMhS_12' => $request->get('pur_inMhS_12'),
            'pur_inMhRt_5' => $request->get('pur_inMhRt_5'),
			'pur_inMhBs_2' => $request->get('pur_inMhBs_2'),
            'pur_inMhC_5' => $request->get('pur_inMhC_5'),
			'pur_inMhS_5' => $request->get('pur_inMhS_5'),
            'purc_CGST_InMhPurc' => $request->get('purc_CGST_InMhPurc'),
			'purc_SGST_InMhPurc' => $request->get('purc_SGST_InMhPurc'),
            'purc_CGST_OutMhPurc' => $request->get('purc_CGST_OutMhPurc'),
			'purc_SGST_OutMhPurc' => $request->get('purc_SGST_OutMhPurc'),
            'pur_OutMhRt_18' => $request->get('pur_OutMhRt_18'),
			'pur_OutMhBs_18' => $request->get('pur_OutMhBs_18'),
            'pur_OutMhI_18' => $request->get('pur_OutMhI_18'),
			'pur_OutMhRt_12' => $request->get('pur_OutMhRt_12'),
            'pur_OutMhBs_12' => $request->get('pur_OutMhBs_12'),
			'pur_OutMhI_12' => $request->get('pur_OutMhI_12'),
            'pur_OutMhRt_5' => $request->get('pur_OutMhRt_5'),
			'pur_OutMhBs_5' => $request->get('pur_OutMhBs_5'),
            'pur_OutMhI_5' => $request->get('pur_OutMhI_5'),
			'purc_RCM_CGST' => $request->get('purc_RCM_CGST'),
            'purc_RCM_SGST' => $request->get('purc_RCM_SGST'),
            'purc_RCM_IGST	' => $request->get('purc_RCM_IGST'),
            'pur_basic_total' => $request->get('pur_basic_total'),
			'pur_CGST_total' => $request->get('pur_CGST_total'),
            'pur_SGST_total' => $request->get('pur_SGST_total'),
			'pur_IGST_total' => $request->get('pur_IGST_total'),
            'ITC_Basic' => $request->get('ITC_Basic'),
			'ITC_CGST' => $request->get('ITC_CGST'),
            'ITC_SGST' => $request->get('ITC_SGST'),
			'ITC_IGST' => $request->get('ITC_IGST'),
            'IGST_to_IGST' => $request->get('IGST_to_IGST'),
			'IGST_to_CGST' => $request->get('IGST_to_CGST'),
            'CGST_Balance_Liability' => $request->get('CGST_Balance_Liability'),
			'SGST_Balance_Liability' => $request->get('SGST_Balance_Liability'),
            'IGST_to_SGST' => $request->get('IGST_to_SGST'),
			'CGST_to_CGST' => $request->get('CGST_to_CGST'),
            'CGST_to_IGST' => $request->get('CGST_to_IGST'),
			'SGST_to_SGST' => $request->get('SGST_to_SGST'),
            'SGST_to_IGST' => $request->get('SGST_to_IGST'),
			'CGST_Late_Fees' => $request->get('CGST_Late_Fees'),
            'SGST_Late_Fees' => $request->get('SGST_Late_Fees'),
			'CGST_Final_Liability' => $request->get('CGST_Final_Liability'),
            'SGST_Final_Liability' => $request->get('SGST_Final_Liability'),
			'Carried_Forward_CGST' => $request->get('Carried_Forward_CGST'),
            'Carried_Forward_SGST' => $request->get('Carried_Forward_SGST'),
			'Carried_Forward_IGST' => $request->get('Carried_Forward_IGST')
           ]
       );
       return response()->json($gstr_3b);
     }

    
}
