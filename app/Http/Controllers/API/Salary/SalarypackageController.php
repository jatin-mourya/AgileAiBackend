<?php

namespace App\Http\Controllers\API\Salary;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Salarypackage;

class SalarypackageController extends Controller
{
    public function index()
    {
        $salarypackage = Salarypackage::all();
        $salarypackage = DB::table('salary_package')
                        ->join('users', 'users.user_id', '=', 'salary_package.user_id')
                        //->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
                        //->join('team_status','team_status.team_status_id','=','team_leaders.status')
                        ->select('users.firstname','users.middlename','users.lastname', 'salary_package.*')
                        ->where('boolean_value', '1')
                        ->orderBy('salary_package.updated_at','DESC')
                        ->get();
		return response()->json($salarypackage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newSalarypackage = new Salarypackage([
			
			'user_id' => $request->get('user_id'),
            'annual_ctc' => $request->get('annual_ctc'),
            'basic_pay' => $request->get('basic_pay'),
            'medical_all' => $request->get('medical_all'),
            'travelling_all' => $request->get('travelling_all'),
            'wfh' => $request->get('wfh'),
            'uniform_all' => $request->get('uniform_all'),
            'education_all' => $request->get('education_all'),
            'employer_pf' => $request->get('employer_pf'),
            'employee_pf' => $request->get('employee_pf'),
            'gratuity' => $request->get('gratuity'),
            'hra' => $request->get('hra'),
            'prof_tax' => $request->get('prof_tax'),
            'gross_total' => $request->get('gross_total'),
            'monthlygross' => $request->get('monthlygross'),
            'tds' => $request->get('tds'),
            'net_pay' => $request->get('net_pay'),
            'annual_pay' => $request->get('annual_pay'),
            'gender' => $request->get('gender'),
            'package_type' => $request->get('package_type'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'activity' => $request->get('activity'),
            // 'basic_pay' => $request->get('basic_pay'),
            // 'variable_pay' => $request->get('variable_pay'),
            // 'yearly_bonus' => $request->get('yearly_bonus'),
            // 'monthly_salary' => $request->get('monthly_salary'),
            // 'yearly_salary' => $request->get('yearly_salary'),
            // 'remark' => $request->get('remark'),
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
            
                'user_id' => '',
                'annual_ctc' => '',
                'basic_pay' => '',
                'medical_all' => '',
                'travelling_all' => '',
                'wfh' => '',
                'uniform_all' => '',
                'education_all' => '',
                'employer_pf' => '',
                'employee_pf' => '',
                'gratuity' => '',
                'hra' => '',
                'prof_tax' => '',
                'gross_total' => '',
                'monthlygross' => '',
                'tds' => '',
                'net_pay' => '',
                'annual_pay' => '',
                'gender' => '',
                'package_type' => '',
                'from_date' => '',
                'to_date' => '',
                'activity' => '',
                // 'basic_pay' => '',
                // 'variable_pay' => '',
                // 'yearly_bonus' => '',
                // 'monthly_salary' => '',
                // 'yearly_salary' => '',
                // 'remark' => ''
            ]);
    
            $newSalarypackage = new Salarypackage([
            
                'user_id' => $request->get('user_id'),
                'annual_ctc' => $request->get('annual_ctc'),
                'basic_pay' => $request->get('basic_pay'),
                'medical_all' => $request->get('medical_all'),
                'travelling_all' => $request->get('travelling_all'),
                'wfh' => $request->get('wfh'),
                'uniform_all' => $request->get('uniform_all'),
                'education_all' => $request->get('education_all'),
                'employer_pf' => $request->get('employer_pf'),
                'employee_pf' => $request->get('employee_pf'),
                'gratuity' => $request->get('gratuity'),
                'hra' => $request->get('hra'),
                'prof_tax' => $request->get('prof_tax'),
                'gross_total' => $request->get('gross_total'),
                'monthlygross' => $request->get('monthlygross'),
                'tds' => $request->get('tds'),
                'net_pay' => $request->get('net_pay'),
                'annual_pay' => $request->get('annual_pay'),
                'gender' => $request->get('gender'),
                'package_type' => $request->get('package_type'),
                'from_date' => $request->get('from_date'),
                'to_date' => $request->get('to_date'),
                'activity' => $request->get('activity'),
                // 'basic_pay' => $request->get('basic_pay'),
                // 'variable_pay' => $request->get('variable_pay'),
                // 'yearly_bonus' => $request->get('yearly_bonus'),
                // 'monthly_salary' => $request->get('monthly_salary'),
                // 'yearly_salary' => $request->get('yearly_salary'),
                // 'remark' => $request->get('remark')
            ]);
    
            $newSalarypackage->save();
            return response()->json($newSalarypackage);
    
            // return response()->json($request->all());
        
    
          
           
       
    }
 
    public function getSalarypackageData($user_id)
    {

        $salarypackageId =  DB::table('salary_package')
        ->join('users', 'users.user_id', '=', 'salary_package.user_id')
        ->select('*')
        ->where('salary_package.user_id',$user_id)->get();
        //return($tblfeaturedimages);
        return response()->json($salarypackageId);
        // dd($user_id);
        // $salarypackageId = Salarypackage::find($user_id);
		// return response()->json($salarypackageId);
    
}

public function getState(Request $request)
    {
    $user_id = $request->user_id;
    $subprojectsModel = new Salarypackage();
    $data = $subprojectsModel->getState($user_id);
    return response()->json($data);
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($salary_package_id)
    {
        $salarypackage = Salarypackage::findOrFail($salary_package_id);
		return response()->json($salarypackage);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($salary_package_id)
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
    public function update(Request $request, $salary_package_id)
    {

        $salarypackage = Salarypackage::findOrFail($salary_package_id);
		
		$salarypackage = Salarypackage::find($salary_package_id);
        $salarypackage->update($request->all());
        return $salarypackage;

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
    public function destroy($salary_package_id)
    {
        $salarypackage = Salarypackage::findOrFail($salary_package_id);
		//$salarypackage->delete();

        $salarypackage = Salarypackage::find($salary_package_id);
        if ($salarypackage) {
            $salarypackage->boolean_value = 0;
            $salarypackage->save();
            // $salarypackage->delete();
            return $salarypackage;
        }

		//return response()->json($salarypackage::all());
    }
}
