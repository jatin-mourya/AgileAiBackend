<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PayvouchertlDetails;

class PayvouchertlDetailsController extends Controller
{


    public function index()
    {  
        $newPTL = PayvouchertlDetails::all();
        // $empdocuments = DB::table('payvoucher')
        // ->orderBy('tl_id.updated_at','DESC')
        // ->get();
		return response()->json($newPTL);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
     {
         $newPTL = new PayvouchertlDetails([
             'pvtl_id' => $request->get('pvtl_id'),
             'tl_id' => $request->get('tl_id'),
             'inc_type' => $request->get('inc_type'),
             'incentive' => $request->get('incentive'),
             'paid' => $request->get('paid'),
             'pending' => $request->get('pending'),
             'status' => $request->get('status'),
             'remark' => $request->get('remark'),
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
             'pvtl_id' => 'required',
             'tl_id' => 'required',
            //  'inc_type' => 'required',
            //  'incentive' => 'required',
            //  'paid' => 'required',
            //  'pending' => 'required',
            //  'status' => 'required',
            //  'remark' => 'required',
            //  'from_date' => 'required',
            //  'to_date' => 'required', 
         ]);
 
         $newPTL = new PayvouchertlDetails([
             'pvtl_id' => $request->get('pvtl_id'),
             'tl_id' => $request->get('tl_id'),
             'inc_type' => $request->get('inc_type'),
             'incentive' => $request->get('incentive'),
             'paid' => $request->get('paid'),
             'pending' => $request->get('pending'),
             'status' => $request->get('status'),
             'remark' => $request->get('remark'),
             'from_date' => $request->get('from_date'),
             'to_date' => $request->get('to_date'),
         ]);
 
         $newPTL->save();
 
         
         return response()->json($newPTL);
         
         // return ('message','Success! You have added data successfully.');
 
     
     }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $newPTL = PayvouchertlDetails::findOrFail($id);
		return response()->json($newPTL);
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
    public function update(Request $request,$user_id)
    {
        $newPTL = PayvouchertlDetails::findOrFail($user_id);

		$request->validate([
            'pvtl_id' => 'required',
            'tl_id' => 'required',
           //  'inc_type' => 'required',
           //  'incentive' => 'required',
           //  'paid' => 'required',
           //  'pending' => 'required',
           //  'status' => 'required',
           //  'remark' => 'required',
           //  'from_date' => 'required',
           //  'to_date' => 'required', 
		]);

        $newPTL->pvtl_id = $request->get('pvtl_id');
		$newPTL->tl_id = $request->get('tl_id');
        $newPTL->inc_type = $request->get('inc_type');
        $newPTL->incentive = $request->get('incentive');
        $newPTL->paid = $request->get('paid');
        $newPTL->pending = $request->get('pending');
        $newPTL->status = $request->get('status');
		$newPTL->remark = $request->get('remark');
        $newPTL->from_date = $request->get('from_date');
        $newPTL->to_date = $request->get('to_date');
     

		$newPTL->save();

		return response()->json($newPTL);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($user_id)
    {
        $newPTL = PayvouchertlDetails::findOrFail($user_id);
		$newPTL->delete();

		return response()->json($newPTL::all());
    }


    public function getTLDDPOrN(Request $request){
        $pvtl_id = $request->get('pvtl_id');
        $tl_id = $request->get('tl_id');
        $inc_type = $request->get('inc_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $data=DB::table('payvouchertl_details')
        ->select('*')
        ->where('pvtl_id',$pvtl_id)
        ->where('tl_id',$tl_id)
        ->where('inc_type',$inc_type)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->get();
        return response()->json($data);
    }


    function uTLDPVoucher(Request $request){
        $pvtl_id = $request->get('pvtl_id');
        $tl_id = $request->get('tl_id');
        $inc_type = $request->get('inc_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $incentive = $request->get('incentive');
        $paid = $request->get('paid');
        $pending = $request->get('pending');
        $status = $request->get('status');
        

        $data = DB::table('payvouchertl_details')
        ->where('pvtl_id',$pvtl_id)
        ->where('tl_id',$tl_id)
        ->where('inc_type',$inc_type)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["incentive" =>$incentive,"paid" =>$paid,"pending"=>$pending,"status" =>$status]);
        return response()->json($data);
    }


    function updateTLPDM(Request $request){
        $teamleader_id = $request->get('teamleader_id');
        $team_id = $request->get('team_id');
        $ince_type = $request->get('ince_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $m_remark = $request->get('m_remark');

        $data = DB::table('tl_monthly_incentive')
        ->where('teamleader_id',$teamleader_id)
        ->where('team_id',$team_id)
        ->where('ince_type',$ince_type)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["paid_amt" =>$paid_amt,"pending_amt"=>$pending_amt,"m_remark" =>$m_remark]);
        return response()->json($data);
    }

    function updateTLPDQ(Request $request){
        $teamleader_id = $request->get('teamleader_id');
        $team_id = $request->get('team_id');
        $ince_type = $request->get('ince_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $m_remark = $request->get('m_remark');

        $data = DB::table('tl_quarterly_incentive')
        ->where('teamleader_id',$teamleader_id)
        ->where('team_id',$team_id)
        ->where('ince_type',$ince_type)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["paid_amt" =>$paid_amt,"pending_amt"=>$pending_amt,"m_remark" =>$m_remark]);
        return response()->json($data);
    }

    function updateTLPDHY(Request $request){
        $teamleader_id = $request->get('teamleader_id');
        $team_id = $request->get('team_id');
        $ince_type = $request->get('ince_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $m_remark = $request->get('m_remark');

        $data = DB::table('tl_halfyear_incentive')
        ->where('teamleader_id',$teamleader_id)
        ->where('team_id',$team_id)
        ->where('ince_type',$ince_type)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["paid_amt" =>$paid_amt,"pending_amt"=>$pending_amt,"m_remark" =>$m_remark]);
        return response()->json($data);
    }

    function updateTLPDY(Request $request){
        $teamleader_id = $request->get('teamleader_id');
        $team_id = $request->get('team_id');
        $ince_type = $request->get('ince_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $m_remark = $request->get('m_remark');

        $data = DB::table('tl_yearly_incentive')
        ->where('teamleader_id',$teamleader_id)
        ->where('team_id',$team_id)
        ->where('ince_type',$ince_type)
        ->where('from_date',$from_date)
        ->where('to_date',$to_date)
        ->update(["paid_amt" =>$paid_amt,"pending_amt"=>$pending_amt,"m_remark" =>$m_remark]);
        return response()->json($data);
    }


       




    
   
    



}
