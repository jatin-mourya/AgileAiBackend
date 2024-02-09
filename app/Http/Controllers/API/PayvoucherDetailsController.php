<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PayvoucherDetails;

class PayvoucherDetailsController extends Controller
{


    public function index()
    {
        $newP = PayvoucherDetails::all();
        // $empdocuments = DB::table('payvoucher')
        // ->orderBy('user_id.updated_at','DESC')
        // ->get();
        return response()->json($newP);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $newP = new PayvoucherDetails([
            'pv_id' => $request->get('pv_id'),
            'user_id' => $request->get('user_id'),
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
            'pv_id' => 'required',
            'user_id' => 'required',
            //  'inc_type' => 'required',
            //  'incentive' => 'required',
            //  'paid' => 'required',
            //  'pending' => 'required',
            //  'status' => 'required',
            //  'remark' => 'required',
            //  'from_date' => 'required',
            //  'to_date' => 'required', 
        ]);

        $newP = new PayvoucherDetails([
            'pv_id' => $request->get('pv_id'),
            'user_id' => $request->get('user_id'),
            'inc_type' => $request->get('inc_type'),
            'incentive' => $request->get('incentive'),
            'paid' => $request->get('paid'),
            'pending' => $request->get('pending'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
        ]);

        $newP->save();


        return response()->json($newP);

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
        $newP = PayvoucherDetails::findOrFail($id);
        return response()->json($newP);
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
    public function update(Request $request, $user_id)
    {
        $newP = PayvoucherDetails::findOrFail($user_id);

        $request->validate([
            'pv_id' => 'required',
            'user_id' => 'required',
            //  'inc_type' => 'required',
            //  'incentive' => 'required',
            //  'paid' => 'required',
            //  'pending' => 'required',
            //  'status' => 'required',
            //  'remark' => 'required',
            //  'from_date' => 'required',
            //  'to_date' => 'required', 
        ]);

        $newP->pv_id = $request->get('pv_id');
        $newP->user_id = $request->get('user_id');
        $newP->inc_type = $request->get('inc_type');
        $newP->incentive = $request->get('incentive');
        $newP->paid = $request->get('paid');
        $newP->pending = $request->get('pending');
        $newP->status = $request->get('status');
        $newP->remark = $request->get('remark');
        $newP->from_date = $request->get('from_date');
        $newP->to_date = $request->get('to_date');


        $newP->save();

        return response()->json($newP);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($user_id)
    {
        $newP = PayvoucherDetails::findOrFail($user_id);
        $newP->delete();

        return response()->json($newP::all());
    }


    public function userPorNPVD(Request $request)
    {
        $user_id = $request->get('user_id');
        $inc_type = $request->get('inc_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $data = DB::table('payvoucher_details')
            ->select('*')
            ->where('user_id', $user_id)
            ->where('inc_type', $inc_type)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->get();
        return response()->json($data);
    }


    function updatePVDU(Request $request)
    {
        $user_id = $request->get('user_id');
        $inc_type = $request->get('inc_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');


        $incentive = $request->get('incentive');
        $paid = $request->get('paid');
        $pending = $request->get('pending');
        $status = $request->get('status');

        $data = DB::table('payvoucher_details')
            ->where('user_id', $user_id)
            ->where('inc_type', $inc_type)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->update(["incentive" => $incentive, "paid" => $paid, "pending" => $pending, "status" => $status]);
        return response()->json($data);
    }
}
