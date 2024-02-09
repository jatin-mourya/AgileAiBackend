<?php

namespace App\Http\Controllers\API\Salary;
//use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary\Advanceemi;

class AdvanceemiController extends Controller
{
    public function index()
    {
        //$advanceemi = Advanceemi::all();
        $advanceemi = DB::table('advance_emi_details')
                        ->join('advance_salary', 'advance_salary.adv_code', '=', 'advance_emi_details.adv_code')
                        ->join('users', 'users.user_id', '=', 'advance_salary.user_id')
                        ->select('advance_emi_details.*','users.firstname','users.middlename','users.lastname','advance_salary.amount','advance_salary.adv_code')
                        ->get();
       
		return response()->json($advanceemi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newAdvancesalary = new Advanceemi([
			
			// 'advance_salary_id' => $request->get('advance_salary_id'),
            'user_id' => $request->get('user_id'),
            'adv_code' => $request->get('adv_code'),
            'emi_deduct_date' => $request->get('emi_deduct_date'),
            'deduction_amount' => $request->get('deduction_amount'),
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
		
			// 'advance_salary_id' => 'required',
            'user_id' => 'required',
            'adv_code' => 'required',
            'emi_deduct_date' => 'required',
            'deduction_amount' => 'required',
            'remark' => 'required'
		]);

		$newAdvanceemi = new Advanceemi([
		
			// 'advance_salary_id' => $request->get('advance_salary_id'),
            'user_id' => $request->get('user_id'),
            'adv_code' => $request->get('adv_code'),
            'emi_deduct_date' => $request->get('emi_deduct_date'),
            'deduction_amount' => $request->get('deduction_amount'),
            'remark' => $request->get('remark')
		]);

		$newAdvanceemi->save();

		return response()->json($newAdvanceemi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function show($id)
    {
        $advanceemi = Advanceemi::findOrFail($id);
		return response()->json($advanceemi);


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
    public function update(Request $request, $id)
    {

        $advanceemi = Advanceemi::findOrFail($id);
		
		$advanceemi = Advanceemi::find($id);
        $advanceemi->update($request->all());
        return $advanceemi;

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
   
   
    public function destroy($id)
    {
        $advanceemi = Advanceemi::findOrFail($id);
		$advanceemi->delete();

		return response()->json($advanceemi::all());
    }
   
   
    public function Userdata($user_id)
    {
        
        $data1 = DB::table('advance_salary')
                        ->select('*')
                        ->where('user_id',$user_id)
                        ->where('amount','!=','0')
                        ->get();

		return response()->json($data1);
    }
    

    public function UserAdvanceEmi($adv_code)
    {
        
        $data1 = DB::table('advance_salary')
                        ->select('*')
                        ->where('adv_code',$adv_code)
                        ->get();

		return response()->json($data1);
    }

   

    public function deductamount(Request $request)
    {
    
        $data1 = DB::table('advance_emi_details')
                        ->select('*')
                        ->get();

		return response()->json($data1);
      
    }

   
    public function emiAmountId($user_id)
    {
 
        $data1 = DB::table('advance_emi_details')
                        ->join('users', 'users.user_id', '=', 'advance_emi_details.user_id')
                        ->select('users.firstname','users.middlename','users.lastname','advance_emi_details.*')
                       ->where('advance_emi_details.user_id',$user_id)
                       
                        //->where('adv_code',$adv_code)
                        ->get();

		return response()->json($data1);
      
    }
    // <!--new-->
    public function reportdata($user_id)
    {
 
        $data1 = DB::table('advance_emi_details')
                         ->join('users', 'users.user_id', '=', 'advance_emi_details.user_id')
                         ->select('users.firstname','users.middlename','users.lastname','advance_emi_details.*')
                         ->where('advance_emi_details.user_id',$user_id)
                         // ->select('*')
                       
                        ->get();
		return response()->json($data1);
      
    }

    // public function AdvanceEmi()
    // {
    
    //     $data = DB::table('advance_salary')
    //                    ->select('*')
    //                     //->where('advance_salary_id','1')
    //                    ->orderBy('adv_code','DESC')->limit(1)
    //                     ->get();
    //                     //return("hello");
	// 	return response()->json($data);
      
    // }
    public function dataUser1($id)
    {
 
        $data1 = DB::table('advance_emi_details')
                         ->join('users', 'users.user_id', '=', 'advance_emi_details.user_id')
                         ->select('users.firstname','users.middlename','users.lastname','advance_emi_details.*')
                         ->where('advance_emi_details.id',$id)
                         //->where('advance_emi_details.user_id',$emi_deduct_date)
                         // ->select('*')
                       
                        ->get();
		return response()->json($data1);
      
    }

    
}
