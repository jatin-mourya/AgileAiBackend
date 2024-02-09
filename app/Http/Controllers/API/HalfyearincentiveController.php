<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halfyearincentive;
//use DB   
use Illuminate\Support\Facades\DB;;

class HalfyearincentiveController extends Controller
{
    public function index(){
        // $Halfyearincentive = Halfyearincentive::all();
		// return response()->json($Halfyearincentive);

        $Halfyearincentive = Halfyearincentive::all();
        $Halfyearincentive = DB::table('halfyear_incentive')
                        ->join('users', 'users.user_id', '=', 'halfyear_incentive.user_id')
                        ->select('users.firstname','users.middlename','users.lastname', 'halfyear_incentive.*')
                        ->get();
		return response()->json($Halfyearincentive);
    }

    public function create(Request $request)
    {
        $newHalfyearincentive = new Halfyearincentive([
			'halfsoucring_no' => $request->get('halfsoucring_no'),
			'halfsoucring_amt' => $request->get('halfsoucring_amt'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'user_id' => $request->get('user_id'),
            'eligibility_ince' => $request->get('eligibility_ince'),
            'halfyear_inc_amt' => $request->get('halfyear_inc_amt'),
            'paid_amt' => $request->get('paid_amt'),
            'inc_type' => $request->get('inc_type')
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
			'halfsoucring_no' => '',
			'halfsoucring_amt' => '',
            'from_date' => '',
            'to_date' => '',
            'user_id' =>'',
            'eligibility_ince'=>'',
            'halfyear_inc_amt' => '',
            'paid_amt' =>'',
            'inc_type'=>''
		]);

		$newHalfyearincentive = new Halfyearincentive([
			'halfsoucring_no' => $request->get('halfsoucring_no'),
			'halfsoucring_amt' => $request->get('halfsoucring_amt'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'user_id' => $request->get('user_id'),
            'eligibility_ince' => $request->get('eligibility_ince'),
            'halfyear_inc_amt' => $request->get('halfyear_inc_amt'),
            'paid_amt' => $request->get('paid_amt'),
            'inc_type' => $request->get('inc_type')
		]);

		$newHalfyearincentive->save();

		return response()->json($newHalfyearincentive);
    }

    public function show($id)
    {
        $Halfyearincentive = Halfyearincentive::findOrFail($id) ;
		return response()->json($Halfyearincentive);
    }

    public function update(Request $request, $id)
    {
       
		$Halfyearincentive = Halfyearincentive::findOrFail($id);
		
		$Halfyearincentive = Halfyearincentive::find($id);
        $Halfyearincentive->update($request->all());
        return $Halfyearincentive;
		
    }

    public function destroy($id)
    {
        $Halfyearincentive = Halfyearincentive::findOrFail($id);
		$Halfyearincentive->delete();

		return response()->json($Halfyearincentive::all());
    }
    public function upCreHalfInce(Request $request){
        
        $newHalfyearincentive = Halfyearincentive::updateOrCreate(
  
        [   'user_id' => $request->get('user_id'),
            'from_date' =>  $request->get('from_date'),
            'to_date' =>  $request->get('to_date'),
        ],
          [
            'eligibility_ince' => $request->get('eligibility_ince')
            // 'halfsoucring_no' => $request->get('halfsoucring_no'),
			// 'halfsoucring_amt' => $request->get('halfsoucring_amt')
          ]
      );
      return response()->json($newHalfyearincentive);
    }
    public function updatehalfYear(Request $request){
        // dd($request->all());
        $Halfyearincentive = Halfyearincentive::
            where(['user_id' => $request->get('user_id'),
                    'from_date' =>  $request->get('from_date'),
                    'to_date' =>  $request->get('to_date')
            ])
            ->update([
                'eligibility_ince' => $request->get('eligibility_ince'),
                'halfsoucring_no' => $request->get('halfsoucring_no'),
			    'halfsoucring_amt' => $request->get('halfsoucring_amt')

            ]);
        return $Halfyearincentive;
    }
    public function SourcehalfyearData(Request $request){

        $half_from_date=$request->half_from_date;
        $half_to_date=$request->half_to_date;
        $half_user_id = $request->half_user_id;

        $data = DB::table('tbl_monthly_incentive')
        ->select(DB::raw('SUM(gi_no_of_sourcing) as leadcount'),DB::raw("SUM(business_value) as business_value"))
        ->where('user_id',$half_user_id)
        ->whereBetween('from_date', [$half_from_date, $half_to_date])
        ->get();
        return response()->json($data);
    }
    public function HalfYearDetails(Request $request){

        $half_from_date = $request->half_from_date;
        $cv_range = $request->cv_range;
        $leadcount = $request->leadcount;
        $ince_freq = 'Half Yearly Incentive';

        $rang_data = DB::table('tbl_incentives')
        ->select($cv_range)
        ->where('tbl_incentives.cat1_target','<=',$leadcount)
        ->where('tbl_incentives.ince_freq',$ince_freq)
        ->where('tbl_incentives.from_date','<=',$half_from_date)
        ->where('tbl_incentives.to_date','>=',$half_from_date)
        ->orderBy('id','DESC')
        ->limit(1)
        ->get();

        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();

        return response()->json($cv_range1);
    }
    public function gethalfyearUser($user_id){

        $data=DB::table('users')
        ->join('halfyear_incentive','halfyear_incentive.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','halfyear_incentive.*')
        ->where('users.user_id',$user_id)
        ->get();
        return response()->json($data);
    }

    //06-03-2023
    public function getCurrentLastUser(){
        $data=DB::table('halfyear_incentive')
        ->select('*')
        ->orderBy('half_id','desc')
        ->limit(1)
        ->get();
        return response()->json($data);
    }

    public function getHalfYearDeals(Request $request){
        $userid = $request->get('userid');
        $bookings = $request->get('bookings');
        $bookinge = $request->get('bookinge');
        $gethalfyeardeals=DB::table('salesdetails')
        ->select('*')
        ->where('sourcing_emp_id','=',$userid)
        ->where('deal_status_id','=',1)
        ->whereBetween('booking_date', [$bookings,$bookinge])
        ->get();
        return response()->json($gethalfyeardeals);
    }


    public function updateHalfYearIncetive(Request $request){
        // dd($request->all());
        $updatehalfyearincetive = Halfyearincentive::
            where(['user_id' => $request->get('user_id'),
                    'from_date' =>  $request->get('from_date'),
                    'to_date' =>  $request->get('to_date')
            ])
            ->update([
                'eligibility_ince' => $request->get('eligibility_ince'),
                'halfsoucring_no' => $request->get('halfsoucring_no'),
			    'halfsoucring_amt' => $request->get('halfsoucring_amt'),
                'halfyear_inc_amt' => $request->get('halfyear_inc_amt'),

            ]);
        return $updatehalfyearincetive;
    }


    //getHalfYear User
    public function getHalfYearUserr(Request $request){
        $userid = $request->get('userid');
        $bookings = $request->get('startdate');
        $bookinge = $request->get('enddate');
        $data=DB::table('halfyear_incentive')
        ->select('*')
        ->where('user_id','=',$userid)
        ->where('from_date','=',$bookings)
        ->where('to_date','=',$bookinge)
        ->get();
        return response()->json($data);
    }


    public function getIncentiveB18(Request $request){
        $rangevalue = $request->get('rangevalue');
        $data=DB::table('tbl_incentives')
        ->select($rangevalue)
        ->where('id','=',13)
        ->get();
        return response()->json($data);
    }

    public function getIncentiveA18(Request $request){
        $rangevalue = $request->get('rangevalue');
        $data=DB::table('tbl_incentives')
        ->select($rangevalue)
        ->where('id','=',14)
        ->get();
        return response()->json($data);
    }

    //15-04-2023
    public function getQUHR(Request $request){
        $userid = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        
        $dataA=DB::table('quarterly_incentive')
        ->select('*')
        ->where('user_id','=',$userid)
        ->where('from_date','=',$from_date);
        
        $dataB=DB::table('quarterly_incentive')
        ->select('*')
        ->where('user_id','=',$userid)
        ->where('to_date','=',$to_date)
        ->union($dataA)
        ->get();

        return response()->json($dataB);
    }


    public function uhyiUsingQU(Request $request){
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $halfyear_eligible = $request->get('halfyear_eligible');

        $data = DB::table('halfyear_incentive')
                          ->where('user_id',$user_id)
                          ->where('from_date',$from_date)
                          ->where('to_date',$to_date)
                          ->update(['halfyear_eligible'=>$halfyear_eligible]);            
        return response()->json($data);
    }
    
    
    /////changes///////
        public function Empfilter3($user_id)
    {
        $datahalfyear=DB::table('users')
        ->join('halfyear_incentive','halfyear_incentive.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','halfyear_incentive.*')
        ->where('users.user_id',$user_id)
        ->get();
        return response()->json($datahalfyear);
    }
}
