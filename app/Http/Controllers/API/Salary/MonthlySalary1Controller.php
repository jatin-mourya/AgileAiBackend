<?php

namespace App\Http\Controllers\API\Salary;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Monthlysalary;


class MonthlySalary1Controller extends Controller
{
    //
    public function index()
    {
        $monthlysalary1 = Monthlysalary1::all();
        $monthlysalary1 = DB::table('monthly_salary')
                        ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        ->select('users.firstname','users.lastname', 'monthly_salary.*')
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
            'present_days' => $request->get('present_days'),
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
            'echeque' => $request->get('echeque'),
             'tds_paid_status' => $request->get('tds_paid_status'),
            'paid_amount' => $request->get('paid_amount'),
            'payment_details' => $request->get('payment_details'),
             'pending_amount' => $request->get('pending_amount'),
            'm_hra' => $request->get('m_hra'),
            'm_medical_all' => $request->get('m_medical_all'),
            'm_uniform_all' => $request->get('m_uniform_all'),
            'm_travelling_all' => $request->get('m_travelling_all'),
            'm_wfh' => $request->get('m_wfh'),
            'm_education_all' => $request->get('m_education_all'),
            'm_employee_pf' => $request->get('m_employee_pf')
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
		
		    	'user_id' => '',
            'basic_pay' => '',
            'salary_month' => '',
            'absent_days' => '',
            'no_of_late_marks' => '',
            'penalty_leave_days' => '',
            'extra_days' => '',
            'net_present_days' => '',
            'monthly_basic_salary' => '',
            'monthly_variable_pay' => '',
            'reimbursement' => '',
            'incentives' => '',
            'deduction' => '',
            'liabilities' => '',
            'total_pay' => '',
            'tds_deducted' => '',
            'net_pay' => '',
            'status' => '',
            'remark' => '',
            'paid_amount' => '',
            'payment_details' => '',
            'pending_amount' => '',
            'TDS_paid' => '',
            'net_salary_paid' => '',
             'm_hra' => '',
             'm_medical_all' => '',
             'm_uniform_all' => '',
             'm_travelling_all' => '',
             'm_wfh' => '',
             'm_education_all' => '',
		]);

	$monthlysalary1 = new MonthlySalary([
		
			'user_id' => $request->get('user_id'),
            'basic_pay' => $request->get('basic_pay'),
            'salary_month' => $request->get('salary_month'),
            // 'no_of_late_marks' => $request->get('no_of_late_marks'),
            // 'penalty_leave_days' => $request->get('penalty_leave_days'),
            // 'extra_days' => $request->get('extra_days'),
            'present_days' => $request->get('present_days'),
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
             'echeque' => $request->get('echeque'),
             'tds_paid_status' => $request->get('tds_paid_status'),
            'paid_amount' => $request->get('paid_amount'),
            'payment_details' => $request->get('payment_details'),
            'pending_amount' => $request->get('pending_amount'),
            'm_hra' => $request->get('m_hra'),
            'm_medical_all' => $request->get('m_medical_all'),
            'm_uniform_all' => $request->get('m_uniform_all'),
            'm_travelling_all' => $request->get('m_travelling_all'),
            'm_wfh' => $request->get('m_wfh'),
            'm_education_all' => $request->get('m_education_all'),
            'm_employee_pf' => $request->get('m_employee_pf')
		]);

		$monthlysalary1->save();

		return response()->json($monthlysalary1);
    }

    public function show($monthly_salary_id)
    {
        $monthlysalary1 = Monthlysalary1::findOrFail($monthly_salary_id);
		return response()->json($monthlysalary1);


    }
     public function monthlysalarydata1(Request $request)
    {
        $month = $request->month;
        $monthlysalary1 = DB::table('monthly_salary')
                        ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary.user_id')
                      ->select('users.firstname','users.lastname','teamdetails.*', 'monthly_salary.*')
                        ->where('monthly_salary.salary_month',$month)
                        ->get();
		return response()->json($monthlysalary1);

    }
    
     public function EmpData7(Request $request)
    {
        $user_id1 = $request->user_id;
        $monthlysalary1 = DB::table('monthly_salary')
                        ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        // ->join('teamdetails','teamdetails.user_id','=','monthly_salary.user_id')
                      ->select('users.firstname','users.lastname', 'monthly_salary.*')
                        ->where('monthly_salary.user_id',$user_id1)
                        ->get();
		return response()->json($monthlysalary1);

    }
    
     public function reportdata1(Request $request)
    {
        $user_id2 = $request->user_id;
        $month = $request->month;


        $data1 = DB::table('monthly_salary')
                        ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary.user_id')
                        ->join('teams','teams.team_id','=','teamdetails.team_id')
                        ->select('users.firstname','users.lastname','teamdetails.*', 'monthly_salary.*','teams.teamname')
                        ->where('monthly_salary.salary_month',$month)
                        ->where('monthly_salary.user_id',$user_id2)
                        ->get();
		return response()->json($data1);
      
    }
    
    
    
    
    
    public function monthlysalarydata(Request $request)
    {
        $team_id = $request->team_id;
        $month = $request->month;


        $monthlysalary1 = DB::table('monthly_salary')
                        ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary.user_id')
                        ->join('teams','teams.team_id','=','teamdetails.team_id')
                        ->select('users.firstname','users.lastname','teamdetails.*', 'monthly_salary.*','teams.teamname')
                        ->where('teamdetails.team_id',$team_id)
                        ->where('monthly_salary.salary_month',$month)
                        ->get();
		return response()->json($monthlysalary1);
    }
    
      public function monthlysalarydata2(Request $request)
    {
        $user_id6 = $request->user_id;
        $team_id = $request->team_id;
        $month = $request->month;


        $monthlysalary4 = DB::table('monthly_salary')
                        ->join('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        ->join('teamdetails','teamdetails.user_id','=','monthly_salary.user_id')
                        ->join('teams','teams.team_id','=','teamdetails.team_id')
                        ->select('users.firstname','users.lastname','teamdetails.*', 'monthly_salary.*','teams.teamname')
                        ->where('teamdetails.team_id',$team_id)
                        ->where('monthly_salary.salary_month',$month)
                        ->where('monthly_salary.user_id',$user_id6)
                        ->get();
		return response()->json($monthlysalary4);
    }
    
    
    
    
}
