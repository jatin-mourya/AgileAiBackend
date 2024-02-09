<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Payvouchertl;

class PayvouchertlController extends Controller
{


    public function index()
    {
        $newPTL = Payvouchertl::all();
        // $empdocuments = DB::table('payvouchertl')
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
        $newPTL = new Payvouchertl([
            'tl_id' => $request->get('tl_id'),
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
            'tl_id' => 'required',
            //  'incentive' => 'required',
            //  'paid_amt' => 'required',
            //  'pending_amt' => 'required',
            //  'pay_status' => 'required',
            //  'inc_type' => 'required',
            //  'year' => 'required',

        ]);

        $newPTL = new Payvouchertl([
            'tl_id' => $request->get('tl_id'),
            'incentive' => $request->get('incentive'),
            'paid_amt' => $request->get('paid_amt'),
            'pending_amt' => $request->get('pending_amt'),
            'pay_status' => $request->get('pay_status'),
            'inc_type' => $request->get('inc_type'),
            'year' => $request->get('year'),

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
        $newPTL = Payvouchertl::findOrFail($id);
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
    public function update(Request $request, $user_id)
    {
        $newPTL = Payvouchertl::findOrFail($user_id);

        $request->validate([
            'tl_id' => 'required',
            //  'incentive' => 'required',
            //  'paid_amt' => 'required',
            //  'pending_amt' => 'required',
            //  'pay_status' => 'required',
            //  'inc_type' => 'required',
            //  'year' => 'required',

        ]);

        $newPTL->tl_id = $request->get('tl_id');
        $newPTL->incentive = $request->get('incentive');
        $newPTL->paid_amt = $request->get('paid_amt');
        $newPTL->pending_amt = $request->get('pending_amt');
        $newPTL->pay_status = $request->get('pay_status');
        $newPTL->inc_type = $request->get('inc_type');
        $newPTL->year = $request->get('year');



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
        $newPTL = Payvouchertl::findOrFail($user_id);
        $newPTL->delete();

        return response()->json($newPTL::all());
    }


    //04-05-2023
    function getPVMTLdata(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $ince_type = $request->get('ince_type');

        $data = DB::table('tl_monthly_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('team_id', $t_id)
            ->where('teamleader_id', $tl_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('ince_type', $ince_type)
            ->get();
        return response()->json($data);
    }

    function getPVQTLdata(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $ince_type = $request->get('ince_type');

        $data = DB::table('tl_quarterly_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('team_id', $t_id)
            ->where('teamleader_id', $tl_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('ince_type', $ince_type)
            ->get();
        return response()->json($data);
    }

    function getPVHYTLdata(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $ince_type = $request->get('ince_type');

        $data = DB::table('tl_halfyear_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('team_id', $t_id)
            ->where('teamleader_id', $tl_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('ince_type', $ince_type)
            ->get();
        return response()->json($data);
    }


    function getPVYTLdata(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $ince_type = $request->get('ince_type');

        $data = DB::table('tl_yearly_incentive')
            ->select('paid_amt', 'pending_amt')
            ->where('team_id', $t_id)
            ->where('teamleader_id', $tl_id)
            ->where('from_date', $from_date)
            ->where('to_date', $to_date)
            ->where('ince_type', $ince_type)
            ->get();
        return response()->json($data);
    }


    public function getTLDPOrN(Request $request)
    {
        $tl_id = $request->get('tl_id');
        $year = $request->get('year');
        $data = DB::table('payvouchertl')
            ->select('*')
            ->where('tl_id', $tl_id)
            // by jatin
            // ->where('year',$year)
            ->get();
        return response()->json($data);
    }


    function uTLPayout(Request $request)
    {
        $tl_id = $request->get('tl_id');
        $incentive = $request->get('incentive');
        $year = $request->get('year');
        $paid_amt = $request->get('paid_amt');
        $pending_amt = $request->get('pending_amt');
        $pay_status = $request->get('pay_status');


        $data = DB::table('payvouchertl')
            ->where('tl_id', $tl_id)
            ->where('year', $year)
            ->update(["incentive" => $incentive, "paid_amt" => $paid_amt, "pending_amt" => $pending_amt, "pay_status" => $pay_status]);
        return response()->json($data);
    }
}
