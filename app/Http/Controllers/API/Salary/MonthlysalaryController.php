<?php

namespace App\Http\Controllers\API\Salary;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Monthlysalary;

class MonthlysalaryController extends Controller
{
    public function index()
    {
        $monthlysalary = Monthlysalary::all();
        $monthlysalary = DB::table('monthly_salary')
                        ->leftjoin('users', 'users.user_id', '=', 'monthly_salary.user_id')
                        //->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
                        //->join('team_status','team_status.team_status_id','=','team_leaders.status')
                        ->select('users.firstname','users.middlename','users.lastname', 'monthly_salary.*')
                        ->where('monthly_salary.boolean_value', '1')
                        ->orderBy('monthly_salary.updated_at','DESC')
                        ->get();
		return response()->json($monthlysalary);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newMonthlysalary = new Monthlysalary([
			
			'user_id' => $request->get('user_id'),
            'basic_pay' => $request->get('basic_pay'),
            'salary_month' => $request->get('salary_month'),
            'absent_days' => $request->get('absent_days'),
            'no_of_late_marks' => $request->get('no_of_late_marks'),
            'penalty_leave_days' => $request->get('penalty_leave_days'),
            'extra_days' => $request->get('extra_days'),
            'net_present_days' => $request->get('net_present_days'),
            'monthly_basic_salary' => $request->get('monthly_basic_salary'),
            'monthly_variable_pay' => $request->get('monthly_variable_pay'),
            'reimbursement' => $request->get('reimbursement'),
            'incentives' => $request->get('incentives'),
            'deduction' => $request->get('deduction'),
            'liabilities' => $request->get('liabilities'),
            'total_pay' => $request->get('total_pay'),
            'tds_deducted' => $request->get('tds_deducted'),
            'net_pay' => $request->get('net_pay'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark'),
            'paid_amount' => $request->get('paid_amount'),
            'payment_details' => $request->get('payment_details'),
            'pending_amount' => $request->get('pending_amount'),
            
            'm_hra' => $request->get('m_hra'),
            'm_medical_all' => $request->get('m_medical_all'),
            'm_uniform_all' => $request->get('m_uniform_all'),
            'm_travelling_all' => $request->get('m_travelling_all'),
            'm_wfh' => $request->get('m_wfh'),
            'm_education_all' => $request->get('m_education_all'),
            'm_employee_pf' => $request->get('m_employee_pf'),
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
		
			'user_id' => 'required|unqiue',
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

		$newMonthlysalary = new Monthlysalary([
		
			'user_id' => $request->get('user_id'),
            'basic_pay' => $request->get('basic_pay'),
            'salary_month' => $request->get('salary_month'),
            'absent_days' => $request->get('absent_days'),
            'no_of_late_marks' => $request->get('no_of_late_marks'),
            'penalty_leave_days' => $request->get('penalty_leave_days'),
            'extra_days' => $request->get('extra_days'),
            'net_present_days' => $request->get('net_present_days'),
            'monthly_basic_salary' => $request->get('monthly_basic_salary'),
            'monthly_variable_pay' => $request->get('monthly_variable_pay'),
            'reimbursement' => $request->get('reimbursement'),
            'incentives' => $request->get('incentives'),
            'deduction' => $request->get('deduction'),
            'liabilities' => $request->get('liabilities'),
            'total_pay' => $request->get('total_pay'),
            'tds_deducted' => $request->get('tds_deducted'),
            'net_pay' => $request->get('net_pay'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark'),
            'paid_amount' => $request->get('paid_amount'),
            'payment_details' => $request->get('payment_details'),
            'pending_amount' => $request->get('pending_amount'),
            'm_hra' => $request->get('m_hra'),
            'm_medical_all' => $request->get('m_medical_all'),
            'm_uniform_all' => $request->get('m_uniform_all'),
            'm_travelling_all' => $request->get('m_travelling_all'),
            'm_wfh' => $request->get('m_wfh'),
            'm_education_all' => $request->get('m_education_all'),
            'm_employee_pf' => $request->get('m_employee_pf'),
            
		]);

		$newMonthlysalary->save();

		return response()->json($newMonthlysalary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($monthly_salary_id)
    {
        $monthlysalary = Monthlysalary::findOrFail($monthly_salary_id);
		return response()->json($monthlysalary);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($monthly_salary_id)
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
    public function update(Request $request, $monthly_salary_id)
    {

        $monthlysalary = Monthlysalary::findOrFail($monthly_salary_id);
		
		$monthlysalary = Monthlysalary::find($monthly_salary_id);
        $monthlysalary->update($request->all());
        return $monthlysalary;

        // $teamleaders = Teamleaders::findOrFail($team_leader_id);

        // $teamleaders = Teamleaders::find($team_leader_id);
        // $teamleaders->status = $request->input('status');
        // $teamleaders->update();
        
        // return response()->json($teamleaders);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($monthly_salary_id)
    {
        $monthlysalary = Monthlysalary::findOrFail($monthly_salary_id);
		//$monthlysalary->delete();

        $monthlysalary = Monthlysalary::find($monthly_salary_id);
        if ($monthlysalary) {
            $monthlysalary->boolean_value = 0;
            $monthlysalary->save();
            return $monthlysalary;
        }

		//return response()->json($monthlysalary::all());
    }
}
