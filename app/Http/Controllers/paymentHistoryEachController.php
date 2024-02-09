<?php
// this file and whole code is Created By Jatin

namespace App\Http\Controllers;
// model file
use App\Models\paymentHistoryEach;
use Illuminate\Http\Request;

class paymentHistoryEachController extends Controller
{
    // creates new entry in payment_history_each table
    function createPaymentHistoryEach(Request $request)
    {
        $pay_id = $request->get('pay_id');
        $ince_type = $request->get('ince_type');
        $table_id = $request->get('table_id');
        $user_type = $request->get('user_type');
        $incentive = $request->get('incentive');
        $total_paid_amt = $request->get('total_paid_amt');
        $curr_paid_amt = $request->get('curr_paid_amt');
        $pending_amt = $request->get('pending_amt');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        // create Payment history overview
        $createPHE = new paymentHistoryEach();
        $createPHE->pay_id = $pay_id;
        $createPHE->ince_type = $ince_type;
        $createPHE->table_id = $table_id;
        $createPHE->user_type = $user_type;
        $createPHE->incentive = $incentive;
        $createPHE->total_paid_amt = $total_paid_amt;
        $createPHE->curr_paid_amt = $curr_paid_amt;
        $createPHE->pending_amt = $pending_amt;
        $createPHE->from_date = $from_date;
        $createPHE->to_date = $to_date;

        $createPHE->save();

        return response()->json($createPHE);
    }
}
