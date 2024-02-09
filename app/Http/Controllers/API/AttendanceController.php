<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// //use DB   
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::all();
		return response()->json($attendance);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $attendance = new Attendance([
            'emp_code' => $request->get('emp_code'),
            'user_id' => $request->get('user_id'),
            'emp_name' => $request->get('emp_name'),
            'd1' => $request->get('d1'),
            'd2' => $request->get('d2'),
            'd3' => $request->get('d3'),
            'd4' => $request->get('d4'),
            'd5' => $request->get('d5'),
            'd6' => $request->get('d6'),
            'd7' => $request->get('d7'),
            'd8' => $request->get('d8'),
            'd9' => $request->get('d9'),
            'd10' => $request->get('d10'),
            'd11' => $request->get('d11'),
            'd12' => $request->get('d12'),
            'd13' => $request->get('d13'),
            'd14' => $request->get('d14'),
            'd15' => $request->get('d15'),
            'd16' => $request->get('d16'),
            'd17' => $request->get('d17'),
            'd18' => $request->get('d18'),
            'd19' => $request->get('d19'),
            'd20' => $request->get('d20'),
            'd21' => $request->get('d21'),
            'd22' => $request->get('d22'),
            'd23' => $request->get('d23'),
            'd24' => $request->get('d24'),
            'd25' => $request->get('d25'),
            'd26' => $request->get('d26'),
            'd27' => $request->get('d27'),
            'd28' => $request->get('d28'),
            'd29' => $request->get('d29'),
            'd30' => $request->get('d30'),
            'd31' => $request->get('d31'),
            'year' => $request->get('year'),
            'month' => $request->get('month'),
            'present_days' => $request->get('present_days'),
            'absent_days' => $request->get('absent_days'),
            'half_days' => $request->get('half_days'),
            'late_marks' => $request->get('late_marks')

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
        //dd($request->all());
        $attendance = new Attendance([
            'emp_code' => $request->get('emp_code'),
            'user_id' => $request->get('user_id'),
            'emp_name' => $request->get('emp_name'),
            'd1' => $request->get('d1'),
            'd2' => $request->get('d2'),
            'd3' => $request->get('d3'),
            'd4' => $request->get('d4'),
            'd5' => $request->get('d5'),
            'd6' => $request->get('d6'),
            'd7' => $request->get('d7'),
            'd8' => $request->get('d8'),
            'd9' => $request->get('d9'),
            'd10' => $request->get('d10'),
            'd11' => $request->get('d11'),
            'd12' => $request->get('d12'),
            'd13' => $request->get('d13'),
            'd14' => $request->get('d14'),
            'd15' => $request->get('d15'),
            'd16' => $request->get('d16'),
            'd17' => $request->get('d17'),
            'd18' => $request->get('d18'),
            'd19' => $request->get('d19'),
            'd20' => $request->get('d20'),
            'd21' => $request->get('d21'),
            'd22' => $request->get('d22'),
            'd23' => $request->get('d23'),
            'd24' => $request->get('d24'),
            'd25' => $request->get('d25'),
            'd26' => $request->get('d26'),
            'd27' => $request->get('d27'),
            'd28' => $request->get('d28'),
            'd29' => $request->get('d29'),
            'd30' => $request->get('d30'),
            'd31' => $request->get('d31'),
            'month' => $request->get('month'),
            'year' => $request->get('year'),
            'present_days' => $request->get('present_days'),
            'absent_days' => $request->get('absent_days'),
            'half_days' => $request->get('half_days'),
            'late_marks' => $request->get('late_marks')

        ]);
     $attendance->save();
  
     return response()->json($attendance);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

//     public function update(Request $request, $id)
//     {
//         $month = $request->get('year');
//         $emp_code = $request->get('emp_code');
//         $attendance = Attendance::findOrFail($id);
// 		$attendance = Attendance::where(['emp_code' => $emp_code, 'year' =>$month])
//                   ->first()
//                   ->update($request->all());
//         return $attendance;
		
//     }


  public function updateatt(Request $request)
    {
        $data = Attendance::
            where(['id' => $request->get('id')])
            ->update([
                'd1' => $request->get('d1'),
                'd2' => $request->get('d2'),
			    'd3' => $request->get('d3'),
                'd4' => $request->get('d4'),
                'd5' => $request->get('d5'),
			    'd6' => $request->get('d6'),
                'd7' => $request->get('d7'),
                'd8' => $request->get('d8'),
			    'd9' => $request->get('d9'),
                'd10' => $request->get('d10'),
                'd11' => $request->get('d11'),
			    'd12' => $request->get('d12'),
                'd13' => $request->get('d13'),
                'd14' => $request->get('d14'),
			    'd15' => $request->get('d15'),
                'd16' => $request->get('d16'),
                'd17' => $request->get('d17'),
			    'd18' => $request->get('d18'),
                'd19' => $request->get('d19'),
                'd20' => $request->get('d20'),
			    'd21' => $request->get('d21'),
                'd22' => $request->get('d22'),
                'd23' => $request->get('d23'),
                'd24' => $request->get('d24'),
                'd25' => $request->get('d25'),
			    'd26' => $request->get('d26'),
                'd27' => $request->get('d27'),
                'd28' => $request->get('d28'),
			    'd29' => $request->get('d29'),
                'd30' => $request->get('d30'),
                'd31' => $request->get('d31'),
			    

            ]);
        return $data;
		
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function attendance_monthwise(Request $request){
    //     $month = $request->get('year');
    //    // dd($month);
    //     $attendance = Attendance::all();
    //     // $attendance1 = DB::table('emp_attendance')
    //     //              ->select('emp_attendance.*')
    //     //              ->where('year','=',$month)
    //     //              ->where('user_id','!=','null')
    //     //              ->get();
    //   return response()->json($attendance);
    // }


    public function attendance_monthwise(Request $request)
    {
        $month = $request->get('year');
        $data1 = DB::table('emp_attendance')
        ->select('*')
        ->where('user_id','!=','null')
        ->where('year','=',$month)
        ->get();
		return response()->json($data1);
      
    }


//     public function attendance_monthwise(Request $request)
//     {
      
//         $data1 = DB::table('emp_attendance')
//         ->select('*')
//         ->where('user_id','!=','null')
//         ->get();
// 		return response()->json($data1);
      
//     }


    public function get_month(Request $request){
        
        $attendance = Attendance::all();
        $outOfMahaInvoice = DB::table('months')
        ->join('emp_attendance', 'emp_attendance.month', '=', 'months.month_id')
        ->select('months.month_id as id','months.month_name as month','emp_attendance.year as month_year')
        ->groupBy('emp_attendance.month','emp_attendance.year','months.month_name','months.month_id')
        ->get();

        return response()->json($outOfMahaInvoice);
    
    }

    public function get_teamWise(Request $request){
       
        $attendances =[];
        $count=[];
        $month_year = $request->get('month');
        $team_id = $request->get('team_id');
        //dd($month_year, $team_id );
        $data = DB::table('teamdetails')
                    ->join('users', 'users.user_id', '=', 'teamdetails.user_id')
                    ->select('users.firstname', 'users.user_id', 'users.emp_code')
                    ->where('teamdetails.team_id',$team_id)
                    ->where('teamdetails.status','=','1')
                    ->get();
        
        $data1 = response()->json($data);
        $data1Arr = $data1->getData();
    	// return response()->json($data1Arr);

        for($i=0; $i<count($data1Arr); $i++){
            $user_id = $data1Arr[$i]->user_id;
        
            $attendances[] = DB::table('emp_attendance')
                        ->join('users', 'users.user_id', '=', 'emp_attendance.user_id')
                        ->join('salary_package', 'salary_package.user_id', '=', 'users.user_id')
                        // ->select('users.emp_code','users.user_id','users.firstname','emp_attendance.present_days','emp_attendance.half_days','emp_attendance.absent_days', 'salary_package.salary_package_id', 'salary_package.basic_pay','emp_attendance.month')
                        ->select('users.emp_code','users.user_id','users.firstname','emp_attendance.present_days','emp_attendance.half_days','emp_attendance.absent_days', 'salary_package.*','emp_attendance.month')
                        ->where('emp_attendance.user_id', $user_id)
                        ->where('emp_attendance.year', $month_year)
                        ->get();

        }
        for($i=0; $i<count($attendances); $i++){
            
            $count[] = $attendances[$i];
        } 

		return response()->json($count);
        
       
    }

    public function attendance_userdata(Request $request){
     
        $attendance1 = DB::table('users')
        ->select(DB::raw('DISTINCT(SUBSTRING(users.emp_code,4))'),'users.user_id')
        ->join('emp_attendance', DB::raw('CONCAT("EMP",emp_attendance.emp_code)'), '=','users.emp_code')
       
        ->get();
        

        // $newarray = array();
        // foreach($attendance1 as $key=>$value) {
        //     $newarray[$key]['user_id'] = $value['user_id'];
        //     $newarray[$key]['emp_code'] = $value['emp_code'];
        // }
        //echo "<pre>";print_r($newarray);
      //return response()->json($newarray);
      return response()->json($attendance1);
    }

    public function useremp(Request $request){
     
        $attendance2 = DB::table('users')
        ->select('users.emp_code','users.user_id')
        //->join('emp_attendance', DB::raw('CONCAT("EMP",emp_attendance.emp_code)'), '=','users.emp_code')
       
        ->get();
      return response()->json($attendance2);
    }
    public function employeeemp(Request $request){
     
        $attendance3 = DB::table('emp_attendance')
        ->select('emp_attendance.emp_name','emp_attendance.emp_code',
        'emp_attendance.d1',
        'emp_attendance.d2',
        'emp_attendance.d3',
        'emp_attendance.d4',
        'emp_attendance.d5',
        'emp_attendance.d6',
        'emp_attendance.d7',
        'emp_attendance.d8',
        'emp_attendance.d9',
        'emp_attendance.d10',
        'emp_attendance.d11',
        'emp_attendance.d12',
        'emp_attendance.d13',
        'emp_attendance.d14',
        'emp_attendance.d15',
        'emp_attendance.d16',
        'emp_attendance.d17',
        'emp_attendance.d18',
        'emp_attendance.d19',
        'emp_attendance.d20',
        'emp_attendance.d21',
        'emp_attendance.d22',
        'emp_attendance.d23',
        'emp_attendance.d24',
        'emp_attendance.d25',
        'emp_attendance.d26',
        'emp_attendance.d27',
        'emp_attendance.d28',
        'emp_attendance.d29',
        'emp_attendance.d30',
        'emp_attendance.d31',
        'emp_attendance.month',
        'emp_attendance.year',
        'emp_attendance.present_days',
        'emp_attendance.absent_days',
        'emp_attendance.half_days',
        'emp_attendance.late_marks'

       
       
      
        )
        //->join('emp_attendance', DB::raw('CONCAT("EMP",emp_attendance.emp_code)'), '=','users.emp_code')
       
        ->get();
      return response()->json($attendance3);
    }


    public function tdata(){
     
        $attendance3 = DB::table('emp_attendance')
        ->where('user_id', '=', 'NULL')->delete();
        // ->truncate();
        //->join('emp_attendance', DB::raw('CONCAT("EMP",emp_attendance.emp_code)'), '=','users.emp_code')
      return response()->json($attendance3);
    }
    // public function insertalldata(Request $request){
     
    //     $attendance2 = DB::table('emp_attendance')
    //     ->select('*')
    //     ->get();
    //   return response()->json($attendance2);
    // }
    
    ///updated attendance code/////
      public function convertdate()
    {
    
        $data = DB::table('emp_attendance')
                       ->select('*')
                        ->orderBy('id','DESC')->limit(1)
                    
                        ->get();
                        //return("hello");
		return response()->json($data);
      
    }   

    public function getlastyear($year)
    {
        $data = DB::table('emp_attendance')
                       ->select('emp_attendance.emp_name','emp_attendance.emp_code',
                       'emp_attendance.d1',
                       'emp_attendance.d2',
                       'emp_attendance.d3',
                       'emp_attendance.d4',
                       'emp_attendance.d5',
                       'emp_attendance.d6',
                       'emp_attendance.d7',
                       'emp_attendance.d8',
                       'emp_attendance.d9',
                       'emp_attendance.d10',
                       'emp_attendance.d11',
                       'emp_attendance.d12',
                       'emp_attendance.d13',
                       'emp_attendance.d14',
                       'emp_attendance.d15',
                       'emp_attendance.d16',
                       'emp_attendance.d17',
                       'emp_attendance.d18',
                       'emp_attendance.d19',
                       'emp_attendance.d20',
                       'emp_attendance.d21',
                       'emp_attendance.d22',
                       'emp_attendance.d23',
                       'emp_attendance.d24',
                       'emp_attendance.d25',
                       'emp_attendance.d26',
                       'emp_attendance.d27',
                       'emp_attendance.d28',
                       'emp_attendance.d29',
                       'emp_attendance.d30',
                       'emp_attendance.d31',
                       'emp_attendance.month',
                       'emp_attendance.year',
                       'emp_attendance.present_days',
                       'emp_attendance.absent_days',
                       'emp_attendance.half_days',
                       'emp_attendance.late_marks'
               
                      )
                       ->where('year','=',$year)
                        ->get();
                        //return("hello");
		return response()->json($data);
      
    }   



}
