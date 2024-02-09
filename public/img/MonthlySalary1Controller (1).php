<?php

namespace App\Http\Controllers\API\Salary;
// //use DB   use Illuminate\Support\Facades\DB;;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Monthlysalary1;


class MonthlySalary1Controller extends Controller
{
    //
    public function index()
    {

        $monthlysalary1 = Monthlysalary1::all();
        $monthlysalary1 = DB::table('monthly_salary1')
                        ->join('users', 'users.user_id', '=', 'monthly_salary1.user_id')
                        ->select('users.firstname','users.lastname', 'monthly_salary1.*')
                        ->get();
		return response()->json($monthlysalary1);

        // $monthlysalary1 = Monthlysalary1::all();
        // return response()->json($monthlysalary1);
    }
    

    public function create(Request $request)
    {
        $monthlysalary1 = new Monthlysalary1([
			
			'user_id' => $request->get('user_id'),
            'basic_pay' => $request->get('basic_pay'),
            'salary_month' => $request->get('salary_month'),
            // 'no_of_late_marks' => $request->get('no_of_late_marks'),
            // 'penalty_leave_days' => $request->get('penalty_leave_days'),
            // 'extra_days' => $request->get('extra_days'),
            'net_present_days' => $request->get('net_present_days'),
            'monthly_basic_salary' => $request->get('monthly_basic_salary'),
            'monthly_variable_pay' => $request->get('monthly_variable_pay'),
            'reimbursement' => $request->get('reimbursement'),
            'incentives' => $request->get('incentives'),
            'deduction' => $request->get('deduction'),
            'liabilities' => $request->get('liabilities'),
            'total_pay' => $request->get('total_pay'),
            'tds_deducted' => $request->get('tds_deducted'),
           // 'net_pay' => $request->get('net_pay'),
           'net_salary_paid' => $request->get('net_salary_paid'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark'),
            'paid_amount' => $request->get('paid_amount'),
            'payment_details' => $request->get('payment_details'),
            'pending_amount' => $request->get('pending_amount')
		]);
    }

    public function store(Request $request)
    {
        // $request->validate([
		
		// 	'user_id' => 'required',
        //     'basic_pay' => '',
        //     'salary_month' => 'required',
        //     'absent_days' => 'required',
        //     'no_of_late_marks' => 'required',
        //     'penalty_leave_days' => 'required',
        //     'extra_days' => 'required',
        //     'net_present_days' => 'required',
        //     'monthly_basic_salary' => 'required',
        //     'monthly_variable_pay' => 'required',
        //     'reimbursement' => 'required',
        //     'incentives' => 'required',
        //     'deduction' => 'required',
        //     'liabilities' => 'required',
        //     'total_pay' => 'required',
        //     'tds_deducted' => 'required',
        //     'net_pay' => 'required',
        //     'status' => 'required',
        //     'remark' => 'required',
        //     'paid_amount' => 'required',
        //     'payment_details' => 'required',
        //     'pending_amount' => 'required',
        //     'TDS_paid' => 'required',
        //     'net_salary_paid' => 'required'
		// ]);

		$monthlysalary1 = new MonthlySalary1([
		
			'user_id' => $request->get('user_id'),
            'basic_pay' => $request->get('basic_pay'),
            'salary_month' => $request->get('salary_month'),
            // 'no_of_late_marks' => $request->get('no_of_late_marks'),
            // 'penalty_leave_days' => $request->get('penalty_leave_days'),
            // 'extra_days' => $request->get('extra_days'),
            'net_present_days' => $request->get('net_present_days'),
            'monthly_basic_salary' => $request->get('monthly_basic_salary'),
            'monthly_variable_pay' => $request->get('monthly_variable_pay'),
            'reimbursement' => $request->get('reimbursement'),
            'incentives' => $request->get('incentives'),
            'deduction' => $request->get('deduction'),
            'liabilities' => $request->get('liabilities'),
            'total_pay' => $request->get('total_pay'),
            'tds_deducted' => $request->get('tds_deducted'),
            //'net_pay' => $request->get('net_pay'),
            'net_salary_paid' => $request->get('net_salary_paid'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark'),
            'paid_amount' => $request->get('paid_amount'),
            'payment_details' => $request->get('payment_details'),
            'pending_amount' => $request->get('pending_amount')
		]);

		$monthlysalary1->save();

		return response()->json($monthlysalary1);
    }

    public function show($monthly_salary_id)
    {
        $monthlysalary1 = Monthlysalary1::findOrFail($monthly_salary_id);
		return response()->json($monthlysalary1);


    }
    public function monthlysalarydata(Request $request)
    {
        // dd($request->all());
        $team_id = $request->team_id;
        $month = $request->month;


        $monthlysalary1 = DB::table('monthly_salary1')
                        ->join('users', 'users.user_id', '=', 'monthly_salary1.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary1.user_id')
                        ->join('teams','teams.team_id','=','teamdetails.team_id')
                        ->select('users.firstname','users.lastname','teamdetails.*', 'monthly_salary1.*','teams.teamname')
                        ->where('teamdetails.team_id',$team_id)
                        ->where('monthly_salary1.salary_month',$month)
                        ->get();
                        //return("hello");
		return response()->json($monthlysalary1);

        // $monthlysalary1 = Monthlysalary1::all();
        // return response()->json($monthlysalary1);
    }

    
    public function monthlysalarydata1(Request $request)
    {
         //dd($request->all());
       // $team_id = $request->team_id;
        $month = $request->month;
        // return $month;

        $monthlysalary1 = DB::table('monthly_salary1')
                        ->join('users', 'users.user_id', '=', 'monthly_salary1.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary1.user_id')
                       ->select('users.firstname','users.lastname','teamdetails.*', 'monthly_salary1.*')
                       // ->select('monthly_salary1.*')
                        //->where('teamdetails.team_id',$team_id)
                        ->where('monthly_salary1.salary_month',$month)
                        //->where('monthly_salary1.salary_month',$user)
                        ->get();
                        //return("hello");
		return response()->json($monthlysalary1);

        // $monthlysalary1 = Monthlysalary1::all();
        // return response()->json($monthlysalary1);
    }

    // <!---new-->
    public function EmpData()
    {
 
        $data1 = DB::table('monthly_salary1')
                         ->join('users', 'users.user_id', '=', 'monthly_salary1.user_id')
                         ->select('users.firstname','users.middlename','users.lastname','monthly_salary1.*')
                         //->select('monthly_salary1.*')
                         //->where('monthly_salary1.user_id',$user_id)
                         // ->select('*')
                       
                        ->get();
		return response()->json($data1);
      
    }
    public function reportdata1($user_id)
    {
        //$user_id = $request->user_id;
        $data1 = DB::table('monthly_salary1')
                         ->join('users', 'users.user_id', '=', 'monthly_salary1.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary1.user_id')
                         ->select('users.firstname','users.lastname','monthly_salary1.*')
                         ->where('monthly_salary1.user_id',$user_id)
                         // ->select('*')
                       
                        ->get();
		return response()->json($data1);
      
    }

}
