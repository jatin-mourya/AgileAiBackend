<?php

namespace App\Http\Controllers\API\Salary;
       
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Advancesalary;

class AdvancesalaryController extends Controller
{
    public function index()
    {
        $advancesalary = Advancesalary::all();
        $advancesalary = DB::table('advance_salary')
                        ->join('users', 'users.user_id', '=', 'advance_salary.user_id')
                        //->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
                        //->join('team_status','team_status.team_status_id','=','team_leaders.status')
                        ->select('users.firstname','users.middlename','users.lastname', 'advance_salary.*')
                        ->where('boolean_value', '1')
                        ->orderBy('advance_salary.updated_at','DESC')
                        ->get();
		return response()->json($advancesalary);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newAdvancesalary = new Advancesalary([
			
			'user_id' => $request->get('user_id'),
           'adv_code' => $request->get('adv_code'),
            'advanced_paid_date' => $request->get('advanced_paid_date'),
            'amount' => $request->get('amount'),
            'paid' => $request->get('paid'),
            'pending_amount' => $request->get('pending_amount'),
            'adv_amount' => $request->get('adv_amount'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark'),
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
           'adv_code' =>'',
            'advanced_paid_date' => '',
            'amount' => '',
            'paid' => '',
            'pending_amount' => '',
            'adv_amount' => '',
            'status' => 'required',
            'remark' => 'required'
		]);

		$newAdvancesalary = new Advancesalary([
		
			'user_id' => $request->get('user_id'),
           'adv_code'=> $request->get('adv_code'),
            'advanced_paid_date' => $request->get('advanced_paid_date'),
            'amount' => $request->get('amount'),
            'paid' => $request->get('paid'),
            'pending_amount' => $request->get('pending_amount'),
            'adv_amount' => $request->get('adv_amount'),
            'status' => $request->get('status'),
            'remark' => $request->get('remark')
		]);

		$newAdvancesalary->save();

		return response()->json($newAdvancesalary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($advance_salary_id)
    {
        $advancesalary = Advancesalary::findOrFail($advance_salary_id);
		return response()->json($advancesalary);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($advance_salary_id)
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
    public function update(Request $request, $advance_salary_id)
    {

        $advancesalary = Advancesalary::findOrFail($advance_salary_id);
		
		$advancesalary = Advancesalary::find($advance_salary_id);
        $advancesalary->update($request->all());
        return $advancesalary;

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
    public function destroy($advance_salary_id)
    {
        $advancesalary = Advancesalary::findOrFail($advance_salary_id);
		//$advancesalary->delete();

        $advancesalary = Advancesalary::find($advance_salary_id);
        if ($advancesalary) {
            $advancesalary->boolean_value = 0;
            $advancesalary->save();
            return $advancesalary;
        }

		//return response()->json($advancesalary::all());
    }


    public function AdvanceEmi()
    {
    
        $data = DB::table('advance_salary')
                       ->select('*')
                        //->where('advance_salary_id','1')
                        ->orderBy('advance_salary_id','DESC')->limit(1)
                    //    ->orderBy('adv_code','DESC')->limit(1)
                        ->get();
                        //return("hello");
		return response()->json($data);
      
    }

    public function AdvanceDeduction($user_id)
    {
    
        $data1 = DB::table('advance_salary')
                        ->select('*')
                        ->where('user_id',$user_id)
                        ->get();

		return response()->json($data1);
      
    }

    public function updateAdvSal(Request $request){
        // dd($request->all());
        $Advancesalary1 = Advancesalary::
              where(['user_id' => $request->get('user_id'),
              'adv_code' => $request->get('adv_code')
              ])
              ->update([
            'pending_amount' =>  $request->get('pending_amount'),
            'paid' =>  $request->get('paid'),
            'amount' =>  $request->get('amount'),
            'status' =>  $request->get('status'),
            
              ]);
   
        return $Advancesalary1;
    }

    // public function getUpdateSal($user_id){
    //      dd($request->all());
    //     $Advancesalary1 = Advancesalary::
    //           where(['user_id' => $request->get('user_id')
    //          // 'adv_code' => $request->get('adv_code')
    //           ])
    //           ->update([
    //         'pending_amount' =>  $request->get('pending_amount')
    //         // 'paid' =>  $request->get('paid'),
    //         // 'amount' =>  $request->get('amount')
    //           ]);
   
    //     return $Advancesalary1;
    // //     $data1 = DB::table('advance_salary')
    // //     ->select('*')
    // //     ->where('user_id',$user_id)
    // //     ->get();

    // //     return response()->json($data1);

    // // }
   
}
