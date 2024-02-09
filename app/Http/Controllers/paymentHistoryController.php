<?php
// this file and whole code is Created By Jatin

namespace App\Http\Controllers;

use App\Models\paymentHistory;

// SM Models
use App\Models\Halfyearincentive;
use App\Models\MonthlyIncentive;
use App\Models\QuarterlyIncentive;
use App\Models\YearIncentive;

// TL Models
use App\Models\Tlhalfyearincentive;
use App\Models\Tlmonthlyincentive;
use App\Models\Tlquarterlyincentive;
use App\Models\Tlyearlyincentive;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class paymentHistoryController extends Controller
{

    // get All Payment Histories
    function getPaymentHistory()
    {
        $tableData = DB::table('payment_history')->select('*')->get();
        return response()->json($tableData);
    }

    // get Payment History By user ID
    function getPaymentHistoryById($user_id)
    {
        $tableData = DB::table('payment_history')->select('*')
            ->where('user_id', $user_id)
            ->get();
        return response()->json($tableData);
    }

    // creates new row in payment_history table
    function createPaymentHistory(Request $request)
    {
        $user_id = $request->get('user_id');
        // total current payment
        $paid_amt = $request->get('paid_amt');
        $remark = $request->get('remark');
        $user_type = $request->get('user_type');
        $remarkArr = $request->get('remarkArr');

        $resArr = [];

        // checks if Data is present in their respective tables
        foreach ($remarkArr as $i => $remarkObj) {

            $table_name = '';
            $eligibility_name = '';
            $user_id_name = '';

            if ($remarkObj['ince_type']) {

                // SM
                if ($user_type == 'SM') {
                    $user_id_name = 'user_id';

                    if ($remarkObj['ince_type'] == "M") {
                        $table_name = 'tbl_monthly_incentive';
                        $eligibility_name = 'monthly_eligible';
                    } else if ($remarkObj['ince_type'] == "Q") {
                        $table_name = 'quarterly_incentive';
                        $eligibility_name = 'quarterly_eligible';
                    } else if ($remarkObj['ince_type'] == "HY") {
                        $table_name = 'halfyear_incentive';
                        $eligibility_name = 'halfyear_eligible';
                    } else if ($remarkObj['ince_type'] == "Y") {
                        $table_name = 'year_incentive';
                        $eligibility_name = 'yearly_eligible';
                    } else {
                        return response()->json(['message' => 'Incentive Type is not Valid', "object" => $remarkObj]);
                    }
                    // TL
                } else if ($user_type == 'TL') {
                    $user_id_name = 'teamleader_id';

                    if ($remarkObj['ince_type'] == "M") {
                        $table_name = 'tl_monthly_incentive';
                        $eligibility_name = 'tl_eligibility_ince';
                    } else if ($remarkObj['ince_type'] == "Q") {
                        $table_name = 'tl_quarterly_incentive';
                        $eligibility_name = 'tl_quarterly_eligible';
                    } else if ($remarkObj['ince_type'] == "HY") {
                        $table_name = 'tl_halfyear_incentive';
                        $eligibility_name = 'tl_halfyear_eligible';
                    } else if ($remarkObj['ince_type'] == "Y") {
                        $table_name = 'tl_yearly_incentive';
                        $eligibility_name = 'tl_yearly_eligible';
                    } else {
                        return response()->json(['message' => 'Incentive Type is not Valid', "object" => $remarkObj]);
                    }
                } else {
                    return response()->json(['message' => 'User Type is not Valid', "object" => $remarkObj]);
                }

                $tableExists = DB::table($table_name)
                    ->select('*')
                    ->where($user_id_name, '=', $remarkObj['user_id'])
                    ->where('paid_amt', '=', $remarkObj['paid_amt'])
                    ->where('pending_amt', '=', $remarkObj['pending_amt'])
                    ->where('from_date', '=', $remarkObj['from_date'])
                    ->where('to_date', '=', $remarkObj['to_date'])
                    ->where($eligibility_name, '=', 1)
                    ->get();

                if (!empty($tableExists[0])) {
                    // dd($tableExists);
                    array_push($resArr, $tableExists[0]);
                } else {
                    return response()->json(['message' => "Data Does Not Match in Table='" . $table_name . "' Or This Data is not Eligible for Incentive", "object" => $remarkObj]);
                }
            } else {
                return response()->json(['message' => 'Incentive Type is not present', "object" => $remarkObj]);
            }
        }
        // return response()->json($resArr);


        $updateArr = [];

        // updates data in their respective tables
        foreach ($remarkArr as $i => $remarkObj) {

            $tableUpdate = '';
            $table_name = '';
            $user_id_name = '';

            if ($user_type == "SM") {
                $user_id_name = 'user_id';

                if ($remarkObj['ince_type'] == "M") {
                    $tableUpdate = new MonthlyIncentive();
                } else if ($remarkObj['ince_type'] == "Q") {
                    $tableUpdate = new QuarterlyIncentive();
                } else if ($remarkObj['ince_type'] == "HY") {
                    $tableUpdate = new Halfyearincentive();
                } else if ($remarkObj['ince_type'] == "Y") {
                    $tableUpdate = new YearIncentive();
                }
            } else if ($user_type == "TL") {
                $user_id_name = 'teamleader_id';

                if ($remarkObj['ince_type'] == "M") {
                    $tableUpdate = new Tlmonthlyincentive();
                } else if ($remarkObj['ince_type'] == "Q") {
                    $tableUpdate = new Tlquarterlyincentive();
                } else if ($remarkObj['ince_type'] == "HY") {
                    $tableUpdate = new Tlhalfyearincentive();
                } else if ($remarkObj['ince_type'] == "Y") {
                    $tableUpdate = new Tlyearlyincentive();
                }
            }

            $tableUpdate
                ->where([
                    $user_id_name => $remarkObj['user_id'],
                    'paid_amt' => $remarkObj['paid_amt'],
                    'pending_amt' => $remarkObj['pending_amt'],
                    'from_date' => $remarkObj['from_date'],
                    'to_date' => $remarkObj['to_date'],
                ])->update([
                    'paid_amt' => $remarkObj['paid_amt'] + $remarkObj['curr_paid_amt'],
                    'pending_amt' => $remarkObj['pending_amt'] - $remarkObj['curr_paid_amt'],
                    'm_remark' => $remarkObj['m_remark'],
                ]);

            array_push($updateArr, $tableUpdate);
        }
        // return response()->json($updateArr);

        // create entry in payment_history table
        if (count($remarkArr) == count($resArr)) {
            $createPH = new paymentHistory();
            $createPH->user_id = $user_id;
            $createPH->user_type = $user_type;
            $createPH->paid_amt = $paid_amt;
            $createPH->remark = $remark;
            $createPH->save();

            return response()->json($createPH);
        }
    }
}
