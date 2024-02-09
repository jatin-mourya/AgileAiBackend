<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Payvoucher;

class PayvoucherController extends Controller
{


    public function index()
    {
        $newP = Payvoucher::all();
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
        $newP = new Payvoucher([
            'user_id' => $request->get('user_id'),
            'incentive' => $request->get('incentive'),
            'paid_amt' => $request->get('paid_amt'),
            'pending_amt' => $request->get('pending_amt'),
            'pay_status' => $request->get('pay_status'),
            'inc_type' => $request->get('inc_type'),
            'year' => $request->get('year'),
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
            'user_id' => 'required',
            //  'incentive' => 'required',
            //  'paid_amt' => 'required',
            //  'pending_amt' => 'required',
            //  'pay_status' => 'required',
            //  'inc_type' => 'required',
            //  'year' => 'required',

        ]);

        $newP = new Payvoucher([
            'user_id' => $request->get('user_id'),
            'incentive' => $request->get('incentive'),
            'paid_amt' => $request->get('paid_amt'),
            'pending_amt' => $request->get('pending_amt'),
            'pay_status' => $request->get('pay_status'),
            'inc_type' => $request->get('inc_type'),
            'year' => $request->get('year'),

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
        $newP = Payvoucher::findOrFail($id);
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
        $newP = Payvoucher::findOrFail($user_id);

        $request->validate([
            'user_id' => 'required',
            //  'incentive' => 'required',
            //  'paid_amt' => 'required',
            //  'pending_amt' => 'required',
            //  'pay_status' => 'required',
            //  'inc_type' => 'required',
            //  'year' => 'required',

        ]);

        $newP->user_id = $request->get('user_id');
        $newP->incentive = $request->get('incentive');
        $newP->paid_amt = $request->get('paid_amt');
        $newP->pending_amt = $request->get('pending_amt');
        $newP->pay_status = $request->get('pay_status');
        $newP->inc_type = $request->get('inc_type');
        $newP->year = $request->get('year');



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
        $newP = Payvoucher::findOrFail($user_id);
        $newP->delete();

        return response()->json($newP::all());
    }


    // row if exists in payvoucher table
    public function getDPOrN(Request $request)
    {
        $user_id = $request->get('user_id');
        $year = $request->get('year');
        $data = DB::table('payvoucher')
            ->select('*')
            ->where('user_id', $user_id)
            ->where('year', $year)
            ->get();
        return response()->json($data);
    }

    // updates row in payvoucher table if exists
    function uPayout(Request $request)
    {
        $user_id = $request->get('user_id');
        $incentive = $request->get('incentive');
        $year = $request->get('year');
        $paid_amt = $request->get('paid_amt');
        $pay_status = $request->get('pay_status');
        $pending_amt = $request->get('pending_amt');

        $data = DB::table('payvoucher')
            ->where('user_id', $user_id)
            ->where('year', $year)
            ->update(["paid_amt" => $paid_amt, "pay_status" => $pay_status, "incentive" => $incentive, "pending_amt" => $pending_amt]);
        return response()->json($data);
    }


    //24-04-2023 for monthly
    function updatePPM(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $pay_status = $request->get('pay_status');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->update(["paid_amt" => $paid_amt, "pending_amt" => $pending_amt, "m_remark" => $pay_status]);
        return response()->json($data);
    }

    //quaterly
    function updatePPQ(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $pay_status = $request->get('pay_status');

        $data = DB::table('quarterly_incentive')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->update(["paid_amt" => $paid_amt, "pending_amt" => $pending_amt, "m_remark" => $pay_status]);
        return response()->json($data);
    }


    function updatePPHY(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $pay_status = $request->get('pay_status');

        $data = DB::table('halfyear_incentive')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->update(["paid_amt" => $paid_amt, "pending_amt" => $pending_amt, "m_remark" => $pay_status]);
        return response()->json($data);
    }


    function updatePPY(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $pay_status = $request->get('pay_status');

        $data = DB::table('year_incentive')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->update(["paid_amt" => $paid_amt, "pending_amt" => $pending_amt, "m_remark" => $pay_status]);
        return response()->json($data);
    }


    //27-04-2023
    function getPVMdata(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $inc_type = $request->get('inc_type');

        $data = DB::table('tbl_monthly_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('inc_type', $inc_type)
            ->get();
        return response()->json($data);
    }


    function getPVQdata(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $inc_type = $request->get('inc_type');

        $data = DB::table('quarterly_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('inc_type', $inc_type)
            ->get();
        return response()->json($data);
    }

    function getPVHYdata(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $inc_type = $request->get('inc_type');

        $data = DB::table('halfyear_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('inc_type', $inc_type)
            ->get();
        return response()->json($data);
    }

    function getPVYdata(Request $request)
    {
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $inc_type = $request->get('inc_type');

        $data = DB::table('year_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('user_id', $user_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('inc_type', $inc_type)
            ->get();
        return response()->json($data);
    }
}
