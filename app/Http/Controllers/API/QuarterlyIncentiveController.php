<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuarterlyIncentive;
// //use DB   use Illuminate\Support\Facades\DB;;
use Illuminate\Support\Facades\DB;

class QuarterlyIncentiveController extends Controller
{
    public function index(){
        // $QuarterlyIncentive = QuarterlyIncentive::all();
		// return response()->json($QuarterlyIncentive);

        $QuarterlyIncentive = QuarterlyIncentive::all();
        $QuarterlyIncentive = DB::table('quarterly_incentive')
                        ->join('users', 'users.user_id', '=', 'quarterly_incentive.user_id')
                        ->select('users.firstname','users.middlename','users.lastname', 'quarterly_incentive.*')
                        ->get();
		return response()->json($QuarterlyIncentive);
    }

    public function create(Request $request)
    {
        $newQuarterlyIncentive = new QuarterlyIncentive([
			'soucring_no' => $request->get('soucring_no'),
			'sourcing_amt' => $request->get('sourcing_amt'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'user_id' => $request->get('user_id'),
            'eligibility_ince' => $request->get('eligibility_ince'),
            'quarterly_inc_amt' => $request->get('quarterly_inc_amt'),
            'paid_amt' => $request->get('paid_amt'),
            'inc_type' => $request->get('inc_type')
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
			'soucring_no' => '',
			'sourcing_amt' => '',
            'from_date' => '',
            'to_date' => '',
            'user_id' =>'',
            'eligibility_ince'=>'',
            'quarterly_inc_amt' =>'',
            'paid_amt'=>'',
            'inc_type'=>''
		]);

		$newQuarterlyIncentive = new QuarterlyIncentive([
			'soucring_no' => $request->get('soucring_no'),
			'sourcing_amt' => $request->get('sourcing_amt'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'user_id' => $request->get('user_id'),
            'eligibility_ince' => $request->get('eligibility_ince'),
            'quarterly_inc_amt' => $request->get('quarterly_inc_amt'),
            'paid_amt' => $request->get('paid_amt'),
            'inc_type' => $request->get('inc_type')
		]);

		$newQuarterlyIncentive->save();

		return response()->json($newQuarterlyIncentive);
    }

    public function show($id)
    {
        $QuarterlyIncentive = QuarterlyIncentive::findOrFail($id) ;
		return response()->json($QuarterlyIncentive);
    }

    public function update(Request $request, $id)
    {
       
		$QuarterlyIncentive = QuarterlyIncentive::findOrFail($id);
		
		$QuarterlyIncentive = QuarterlyIncentive::find($id);
        $QuarterlyIncentive->update($request->all());
        return $QuarterlyIncentive;
		
    }

    public function destroy($id)
    {
        $quarterlyIncentive = QuarterlyIncentive::findOrFail($id);
		$quarterlyIncentive->delete();

		return response()->json($quarterlyIncentive::all());
    }

    public function upCreQuarInce(Request $request){
        
        $newQuarterlyIncentive = QuarterlyIncentive::updateOrCreate(
  
        [   'user_id' => $request->get('user_id'),
            'from_date' =>  $request->get('from_date'),
            'to_date' =>  $request->get('to_date'),
        ],
          [
            'eligibility_ince' => $request->get('eligibility_ince')
            // 'soucring_no' => $request->get('soucring_no'),
			// 'sourcing_amt' => $request->get('sourcing_amt')
          ]
      );
      return response()->json($newQuarterlyIncentive);
    }

    public function getUsersQ(){

        $data = DB::table('users')
        ->select('user_id','firstname','lastname')
        ->where(function ($query) {
            $query ->where('users.designation',8)
            ->orWhere('users.designation',9)
            ->orWhere('users.designation',10);
        })  
        ->get();
        return response()->json($data);
    }

    public function SourceQuaData(Request $request){

        $from_date=$request->from_date;
        $to_date=$request->to_date;
        $user_id = $request->user_id;

        $data = DB::table('tbl_monthly_incentive')
        // ->select(DB::raw('SUM(gi_no_of_sourcing) as leadcount'),DB::raw("SUM(business_value) as business_value"))
         //3-3-2023
        //->select(DB::raw('SUM(gi_no_of_sourcing) as leadcount'),DB::raw("SUM(business_value) as business_value"))
        ->select(DB::raw('SUM(gi_no_of_sourcing) as leadcount'),DB::raw("SUM(gi_sourcing_amt) as business_value"))
        ->where('user_id',$user_id)
        ->whereBetween('from_date', [$from_date, $to_date])
        // ->whereBetween('to_date', [$from_date, $to_date])
        ->get();
        return response()->json($data);
    }

    public function quarterlyData(Request $request){

        $from_date = $request->from_date;
        $cv_range = $request->cv_range;
        $leadcount = $request->leadcount;
        $ince_freq = 'Quaterly Incentive';

        $rang_data = DB::table('tbl_incentives')
        ->select($cv_range)
        ->where('tbl_incentives.cat1_target','<=',$leadcount)
        ->where('tbl_incentives.ince_freq',$ince_freq)
        ->where('tbl_incentives.from_date','<=',$from_date)
        ->where('tbl_incentives.to_date','>=',$from_date)
        ->orderBy('id','DESC')
        ->limit(1)
        ->get();

        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();

        return response()->json($cv_range1);
    }

    public function updateQuarterly(Request $request){
        // dd($request->all());
        $QuarterlyIncentive = QuarterlyIncentive::
            where(['user_id' => $request->get('user_id'),
                    'from_date' =>  $request->get('from_date'),
                    'to_date' =>  $request->get('to_date')
            ])
            ->update([
                'eligibility_ince' => $request->get('eligibility_ince'),
                'soucring_no' => $request->get('soucring_no'),
			    'sourcing_amt' => $request->get('sourcing_amt')

            ]);
        return $QuarterlyIncentive;
    }
    public function quarterlydetails($user_id){

        $data=DB::table('users')
        ->join('quarterly_incentive','quarterly_incentive.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','quarterly_incentive.*')
        ->where('users.user_id',$user_id)
        ->get();
        return response()->json($data);
    }

     //3-3-2023
     public function getQuarterlyDeals(Request $request){
        $userid = $request->get('userid');
        $bookings = $request->get('bookings');
        $bookinge = $request->get('bookinge');
        $getquarterlydeals=DB::table('salesdetails')
        ->select('*')
        ->where('sourcing_emp_id','=',$userid)
        ->where('deal_status_id','=',1)
        ->whereBetween('booking_date', [$bookings,$bookinge])
        ->get();
        return response()->json($getquarterlydeals);
    }


    public function getRange(Request $request){
        $range = $request->get('range');
        $bookings = $request->get('bookings');
        $bookinge = $request->get('bookinge');
        $getrange=DB::table('tbl_incentive_range')
        ->select('*')
        ->where('business_value','<',$range)
        ->where('business_value1','>=',$range)
        ->get();
        return response()->json($getrange);
    }

    public function getQuarterlyIncentive(Request $request){
        $colf = $request->get('colf');
        $incefreq = $request->get('incefreq');
        $cat1target = $request->get('cat1target');
        $idno = $request->get('idno');
        $getqi=DB::table('tbl_incentives')
        ->select($colf)
        ->where('ince_freq','=',$incefreq)
        ->where('cat1_target','=',$cat1target)
        ->where('id','=',$idno)
        ->get();
        return response()->json($getqi);
    }

    public function getQIData(){
        $getqidata=DB::table('quarterly_incentive')
        ->select('*')
        ->orderBy('id','desc')
        ->limit(1)
        ->get();
        return response()->json($getqidata);
    }


    //4-3-2023
    public function updateQuarterlyIncetive(Request $request){
        // dd($request->all());
        $updatequarterlyincetive = QuarterlyIncentive::
            where(['user_id' => $request->get('user_id'),
                    'from_date' =>  $request->get('from_date'),
                    'to_date' =>  $request->get('to_date')
            ])
            ->update([
                'eligibility_ince' => $request->get('eligibility_ince'),
                'soucring_no' => $request->get('soucring_no'),
			    'sourcing_amt' => $request->get('sourcing_amt'),
                'quarterly_inc_amt' => $request->get('quarterly_inc_amt'),

            ]);
        return $updatequarterlyincetive;
    }


    //check data present or not
    public function getPresentDeal(Request $request){
        $userid = $request->get('user_id');
        $sdate = $request->get('sdate');
        $edate = $request->get('edate');
        $getqi=DB::table('quarterly_incentive')
        ->select('*')
        ->where('user_id','=',$userid)
        ->where('from_date','=',$sdate)
        ->where('to_date','=',$edate)
        ->get();
        return response()->json($getqi);
    }



    public function getIncentiveBBEight(Request $request){
        $rangevalue = $request->get('rangevalue');
        $data=DB::table('tbl_incentives')
        ->select($rangevalue)
        ->where('id','=',11)
        ->get();
        return response()->json($data);
    }

    public function getIncentiveAAEight(Request $request){
        $rangevalue = $request->get('rangevalue');
        $data=DB::table('tbl_incentives')
        ->select($rangevalue)
        ->where('id','=',12)
        ->get();
        return response()->json($data);
    }


    public function getUserBYMY(Request $request){
        $userid = $request->get('user_id');
        $fromdate = $request->get('from_date');
        $todate = $request->get('to_date');
        $data=DB::table('quarterly_incentive')
        ->select('*')
        ->where('user_id','=',$userid)
        ->where('from_date','=',$fromdate)
        ->where('to_date','=',$todate)
        ->get();
        return response()->json($data);
    }


    //15-04-2023 quaterly eligibility
    //get all user of tbl_monthly_incentive in quater format
    public function getTblMIQU(Request $request){
        $userid = $request->get('user_id');
        $fromMY = $request->get('fromMY');
        $toMY = $request->get('toMY');
        $data=DB::table('tbl_monthly_incentive')
        ->select('*')
        ->where('user_id','=',$userid)
        ->whereBetween('YearMonth',[$fromMY,$toMY])
        ->get();
        return response()->json($data);
    }


    public function uqiUsingMU(Request $request){
        $user_id = $request->get('user_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $quarterly_eligible = $request->get('quarterly_eligible');

        $data = DB::table('quarterly_incentive')
                          ->where('user_id',$user_id)
                          ->where('from_date',$from_date)
                          ->where('to_date',$to_date)
                          ->update(['quarterly_eligible'=>$quarterly_eligible]);            
        return response()->json($data);
    }
    
    ////changes////
        public function Empfilter2($user_id)
    {
        $dataquarter=DB::table('users')
        ->join('quarterly_incentive','quarterly_incentive.user_id','=','users.user_id')
        ->select('users.firstname','users.lastname','quarterly_incentive.*')
        ->where('users.user_id',$user_id)
        ->get();
        return response()->json($dataquarter);
    }


}
