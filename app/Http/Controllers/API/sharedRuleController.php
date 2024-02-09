<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\sharedRule;
use App\Models\CreditNote;
use App\Models\Salesdetails;
use App\Models\InvoiceMulti;
use App\Models\Debtorcompanydet;
class sharedRuleController extends Controller
{
    public function sharedRules(Request $request){
        $userId = $request->user_id;

        $result = DB::table('sharing_rule')
        ->select('sharing_rule.*')
        ->join('users', 'users.user_id', '=', 'sharing_rule.user_id')
        ->where('users.user_id', '=', $userId)
        ->get();
        return response()->json($result);
    }

    public function datauseraccess(Request $request){
        $results = DB::table('clientdetails')
        ->leftJoin('salesdetails', 'salesdetails.client_id', '=', 'clientdetails.client_id')
        ->leftJoin('sharing_rule', function ($join) use ($request) {
            $join->on(DB::raw('FIND_IN_SET(salesdetails.sourcing_emp_id, sharing_rule.associated_user_id)'), '>', DB::raw('0'));
        })
        ->whereIn('salesdetails.sourcing_emp_id', $request)
        ->select('clientdetails.*')
        ->get();
        return response()->json($results);
}


public function datachannelpartneraccess(Request $request){
    $result1 = DB::table('channelpartner')
    ->leftJoin('salesdetails', 'salesdetails.cp_id', '=', 'channelpartner.cp_id')
    ->leftJoin('sharing_rule', function ($join) use ($request) {
        $join->on(DB::raw('FIND_IN_SET(salesdetails.sourcing_emp_id, sharing_rule.associated_user_id)'), '>', DB::raw('0'));
    })
    ->whereIn('salesdetails.sourcing_emp_id', $request)
    ->select('channelpartner.*')
    ->get();
    return response()->json($result1);
}

public function dataInvoiceaccess(Request $request)
{
    $result1 = DB::table('invoice_multi')
        ->leftJoin('invoicedetids', 'invoicedetids.invoice_multi_id', '=', 'invoice_multi.invoice_multi_id')
        ->leftJoin('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
        ->leftjoin('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
        ->leftJoin('sharing_rule', function ($join) {
            $join->on(DB::raw('FIND_IN_SET(salesdetails.sourcing_emp_id, sharing_rule.associated_user_id)'), '>', DB::raw('0'));
        })
        ->whereIn('salesdetails.sourcing_emp_id', $request) // Pass the array of values to the whereIn method
        ->select('invoice_multi.*','debtor_company_det.cname')
        ->get();

    return response()->json($result1);
}


public function dataReciptaccess(Request $request)
{
    $result1 = DB::table('receiptdetails')
        ->leftJoin('invoicedetids', 'invoicedetids.invoicedetids_id', '=', 'receiptdetails.invoice_id')
        ->leftJoin('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
        ->join('clientdetails', 'clientdetails.client_id', '=', 'receiptdetails.client_id')
        ->leftJoin('sharing_rule', function ($join) {
            $join->on(DB::raw('FIND_IN_SET(salesdetails.sourcing_emp_id, sharing_rule.associated_user_id)'), '>', DB::raw('0'));
        })
        ->whereIn('salesdetails.sourcing_emp_id', $request) // Pass the array of values to the whereIn method
        ->select('receiptdetails.*','clientdetails.name','invoicedetids.invoice_num')
        ->get();

    return response()->json($result1);
}

public function dataCreditaccess(Request $request)
{
    $result2 = DB::table('credit_note')
        ->leftJoin('invoicedetids', 'invoicedetids.invoicedetids_id', '=', 'credit_note.invoice_id')
        ->leftJoin('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
        ->leftjoin('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoicedetids.company_id')
        ->leftJoin('sharing_rule', function ($join) {
            $join->on(DB::raw('FIND_IN_SET(salesdetails.sourcing_emp_id, sharing_rule.associated_user_id)'), '>', DB::raw('0'));
        })
        ->whereIn('salesdetails.sourcing_emp_id', $request) // Pass the array of values to the whereIn method
        ->select('credit_note.*','invoicedetids.client_id','invoicedetids.invoice_num', 'debtor_company_det.cname','debtor_company_det.debtor_company_det_id')
        ->get();

    return response()->json($result2);
}

public function datattendanceaccess(Request $request){
    $results = DB::table('emp_attendance')
    ->whereIn('emp_attendance.user_id', $request)
    ->select('emp_attendance.*')
    ->get();
    return response()->json($results);
}

// public function datattendanceaccess(Request $request){
//     $results = DB::table('emp_attendance')
//     ->whereIn('emp_attendance.user_id', $request)
//     ->select('emp_attendance.*')
//     ->get();
//     return response()->json($results);
// }

public function datamonthlyaccess(Request $request){
    // dd($request);
    $result3 = DB::table('monthly_salary')
    ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
    ->whereIn('monthly_salary.user_id', $request)
    ->select('monthly_salary.*','users.firstname','users.lastname')
    ->get();
    return response()->json($result3);
}

public function datadvanceSalaccess(Request $request){
    // dd($request);
    $result3 = DB::table('advance_salary')
    ->join('users', 'users.user_id', '=', 'advance_salary.user_id')
    ->whereIn('advance_salary.user_id', $request)
    ->select('advance_salary.*','users.firstname','users.lastname')
    ->get();
    return response()->json($result3);
}

public function datadvanceEmiaccess(Request $request){
    // dd($request);
    $result3 = DB::table('advance_emi_details')
    ->join('users', 'users.user_id', '=', 'advance_emi_details.user_id')
    ->join('advance_salary', 'advance_salary.adv_code', '=', 'advance_emi_details.adv_code')
    ->whereIn('advance_emi_details.user_id', $request)
    ->select('advance_emi_details.*','users.firstname','users.middlename','users.lastname','advance_salary.amount','advance_salary.adv_code')
    ->get();
    return response()->json($result3);
}

public function datawalkinaccess(Request $request){
    $data=DB::table('users')
    ->join('designations','designations.designation_id','=','users.designation')
    ->join('emp_status','emp_status.emp_status_id','=','users.status_id')
     ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
     ->whereRaw("(`designations`.`designation_id` = 9 or `designations`.`designation_id`= 10 or `designations`.`designation_id`= 11 or `designations`.`designation_id`= 8 or `designations`.`designation_id`= 7 or `designations`.`designation_id`= 6)")
     ->whereRaw("(`emp_status`.`empstatus` = 'Active')")
     ->whereIn('users.user_id', $request)
     ->get();
    return response()->json($data);
}
public function datauserperfoaccess(Request $request){
    $data=DB::table('users')
    ->select('users.firstname','users.middlename','users.lastname','users.designation','users.user_id','users.emp_code')
    ->whereIn('users.user_id', $request)
    ->get();
    return response()->json($data);
}
public function dataEmpIncaccess(Request $request){
    $users = DB::table('users')
    ->select('users.*','emp_status.*','designations.*')
    ->join('emp_status', 'emp_status.emp_status_id', '=', 'users.status_id')
    ->join('designations', 'designations.designation_id', '=', 'users.designation')
    ->whereIn('users.user_id', $request)
    ->get();
    return response()->json($users);
}

public function dataTeamwiseLaccess(Request $request)
{
    $createdAt = $request[0];
    $userIds = $request[1];

    $query = DB::table('leadgiven_list')
        ->select('users.user_id', 'leadgiven_list.*')
        ->leftJoin('users', 'users.emp_code', '=', 'leadgiven_list.emp_code')
        ->whereDate('leadgiven_list.created_at', $createdAt)
        ->whereIn('users.user_id', $userIds)
        ->get();

    return response()->json($query);
}

public function dataTeamwiseLaccess1(Request $request){
    $date = $request[0];
    $teamLeader = $request[1];
    $userIds = $request[2];
    
    $datelead1 = DB::table('leadgiven_list')
        ->select('users.user_id', 'leadgiven_list.*')
        ->leftJoin('users', 'users.emp_code', '=', 'leadgiven_list.emp_code')
        ->whereDate('leadgiven_list.created_at', $date)
        ->where('leadgiven_list.Team_Leader', $teamLeader)
        ->whereIn('users.user_id', $userIds)
        ->get();
    
    return response()->json($datelead1);
    
}
public function dataTeamwiseLaccess2(Request $request){
    $date = $request[0];
    $teamLeader = $request[1];
    $userId = $request[2];
    $userIds = $request[3];
    
    $datelead1 = DB::table('leadgiven_list')
        ->select('users.user_id', 'leadgiven_list.*')
        ->leftJoin('users', 'users.emp_code', '=', 'leadgiven_list.emp_code')
        ->whereDate('leadgiven_list.created_at', $date)
        ->where('leadgiven_list.Team_Leader', $teamLeader)
        ->Where('leadgiven_list.emp_code', '=', $userId)
        ->whereIn('users.user_id', $userIds)
        ->get();
    
    return response()->json($datelead1);
    
}

public function dataWeekwiseLaccess(Request $request){
    // $createdAt = $request[0][0];
    // $userIds = $request[1];
    $datelead = DB::table('datewise_lead')
                    ->select('users.user_id', 'datewise_lead.*')
                    ->leftJoin('users', 'users.emp_code', '=', 'datewise_lead.emp_code')
                    ->where('year', '=', $request[0][0])
                     ->where('Week', '=', $request[0][1])
                     ->whereIn('users.user_id', $request[1])
                    // ->Where('Team_Leader', '=', $request[1])
                    ->get();
    return response()->json($datelead);
}
public function dataWeekwiseLaccess1(Request $request){
 
    $datelead1 = DB::table('datewise_lead')
    ->select('users.user_id', 'datewise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'datewise_lead.emp_code')
    ->where('datewise_lead.year', '=', $request[0][0])
    ->where('datewise_lead.Week', '=', $request[0][1])
    ->where('datewise_lead.Team_Leader', '=', $request[1])
    ->whereIn('users.user_id', $request[2])
    ->get();

return response()->json($datelead1);

}

public function dataWeekwiseLaccess2(Request $request){
    
    $datelead1 = DB::table('datewise_lead')
        ->select('users.user_id', 'datewise_lead.*')
        ->leftJoin('users', 'users.emp_code', '=', 'datewise_lead.emp_code')
        ->where('datewise_lead.year', '=', $request[0][0])
        ->where('datewise_lead.Week', '=', $request[0][1])
        ->where('datewise_lead.Team_Leader', '=', $request[1])
        ->Where('datewise_lead.emp_code', '=', $request[2])
        ->whereIn('users.user_id', $request[3])
        ->get();
    
    return response()->json($datelead1);
    
}

public function dataMonthwiseLaccess(Request $request){
 
    $datelead2 = DB::table('monthwise_lead')
    ->select('users.user_id', 'monthwise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'monthwise_lead.emp_code')
    ->where('monthwise_lead.Year', '=', $request[0][0])
    ->where('monthwise_lead.month', '=', $request[0][1])
    ->whereIn('users.user_id', $request[1])
    ->get();

return response()->json($datelead2);

}
public function dataMonthwiseLaccess1(Request $request){
 
    $datelead2 = DB::table('monthwise_lead')
    ->select('users.user_id', 'monthwise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'monthwise_lead.emp_code')
    ->where('monthwise_lead.Year', '=', $request[0][0])
    ->where('monthwise_lead.month', '=', $request[0][1])
    ->Where('Team_Leader', '=', $request[1])
    ->whereIn('users.user_id', $request[2])
    ->get();

return response()->json($datelead2);
}

public function dataMonthwiseLaccess2(Request $request){
 
    $datelead2 = DB::table('monthwise_lead')
    ->select('users.user_id', 'monthwise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'monthwise_lead.emp_code')
    ->where('monthwise_lead.Year', '=', $request[0][0])
    ->where('monthwise_lead.month', '=', $request[0][1])
    ->Where('monthwise_lead.Team_Leader', '=', $request[1])
    ->Where('monthwise_lead.emp_code', '=', $request[2])
    ->whereIn('users.user_id', $request[3])
    ->get();

return response()->json($datelead2);
}

public function dataYearwiseLaccess(Request $request){
 
    $datelead2 = DB::table('monthwise_lead')
    ->select('users.user_id', 'monthwise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'monthwise_lead.emp_code')
    ->where('monthwise_lead.Year', '=',$request[0])
    ->whereIn('users.user_id', $request[1])
    ->get();

return response()->json($datelead2);

}
public function dataYearwiseLaccess1(Request $request){
 
    $datelead2 = DB::table('monthwise_lead')
    ->select('users.user_id', 'monthwise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'monthwise_lead.emp_code')
    ->where('monthwise_lead.Year', '=',$request[0])
    ->Where('monthwise_lead.Team_Leader', '=',$request[1])
    ->whereIn('users.user_id', $request[2])
    ->get();

return response()->json($datelead2);
}

public function dataYearwiseLaccess2(Request $request){
 
    $datelead2 = DB::table('monthwise_lead')
    ->select('users.user_id', 'monthwise_lead.*')
    ->Join('users', 'users.emp_code', '=', 'monthwise_lead.emp_code')
    ->where('monthwise_lead.Year', '=',$request[0])
    ->Where('monthwise_lead.Team_Leader', '=',$request[1])
    ->Where('monthwise_lead.emp_code', '=', $request[2])
    ->whereIn('users.user_id', $request[3])
    ->get();

return response()->json($datelead2);
}



}
