<?php

namespace App\Http\Controllers\API\Salary;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Monthlytarget;

class MonthlytargetController extends Controller
{
    public function index()
    {
        //$monthlytarget = Monthlytarget::all();
        $monthlytarget = DB::table('monthly_target')
                            ->join('users','users.user_id','=','monthly_target.user_id')
                            ->select('users.user_id','users.firstname','users.middlename','users.lastname','monthly_target.*')
                            ->where('boolean_value', '1')
                            ->orderBy('monthly_target.updated_at','DESC')
                            ->get();
		return response()->json($monthlytarget);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newAdvancesalary = new Monthlytarget([
			
			'salary_package_id' => $request->get('salary_package_id'),
            'user_id' => $request->get('user_id'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'status' => $request->get('status')
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
		
			'salary_package_id' => 'required',
            'user_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'status' => 'required'
		]);

		$newMonthlytarget = new Monthlytarget([
		
			'salary_package_id' => $request->get('salary_package_id'),
            'user_id' => $request->get('user_id'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'status' => $request->get('status')
		]);

		$newMonthlytarget->save();

		return response()->json($newMonthlytarget);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($monthly_target_id)
    {
        //$advancesalary = Monthlytarget::findOrFail($monthly_target_id);
        $monthlytarget = DB::table('monthly_target')
        ->join('users','users.user_id','=','monthly_target.user_id')
        ->join('salary_package','salary_package.salary_package_id','=','monthly_target.salary_package_id')
        ->select('users.user_id','users.firstname','users.middlename','users.lastname','monthly_target.*','salary_package.basic_pay')
        ->where('monthly_target.boolean_value','1')
        ->where('monthly_target.monthly_target_id', $monthly_target_id)
        ->orderBy('monthly_target.updated_at','DESC')
        ->get();
		return response()->json($monthlytarget);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($monthly_target_id)
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
    public function update(Request $request, $monthly_target_id)
    {

        $monthlytarget = Monthlytarget::findOrFail($monthly_target_id);
		
		$monthlytarget = Monthlytarget::find($monthly_target_id);
        $monthlytarget->update($request->all());
        return $monthlytarget;

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
    public function destroy($monthly_target_id)
    {
        $monthlytarget = Monthlytarget::findOrFail($monthly_target_id);
		//$monthlytarget->delete();

        $monthlytarget = Monthlytarget::find($monthly_target_id);
        if ($monthlytarget) {
            $monthlytarget->boolean_value = 0;
            $monthlytarget->save();
            return $monthlytarget;
        }

		//return response()->json($monthlytarget::all());
    }

    public function getsalarybyuser_id($id){
        $salary = DB::table('salary_package')
        ->select('salary_package.*')
        ->where('salary_package.user_id', $id)
        ->where('boolean_value', '1')
        ->get();
        return response()->json($salary);
    }
}
