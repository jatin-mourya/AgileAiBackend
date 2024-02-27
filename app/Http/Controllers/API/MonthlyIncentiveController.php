<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\MonthlyIncentive;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MonthlyIncentiveController extends Controller
{
    // public function index()
    // {
    //     $MonthlyIncentive = MonthlyIncentive::all();
    //  return response()->json($MonthlyIncentive);
    // }

    public function index()
    {

        $MonthlyIncentive = MonthlyIncentive::all();
        $MonthlyIncentive = DB::table('tbl_monthly_incentive')
            ->join('users', 'users.user_id', '=', 'tbl_monthly_incentive.user_id')
            ->select('users.firstname', 'users.middlename', 'users.lastname', 'tbl_monthly_incentive.*')
            ->get();
        return response()->json($MonthlyIncentive);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newMonthlyIncentive = new MonthlyIncentive([
            // 'ince_id' => $request->get('ince_id'),
            'user_id' => $request->get('user_id'),
            'ince_freq' => $request->get('ince_freq'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'YearMonth' => $request->get('YearMonth'),
            'gi_no_of_sourcing' => $request->get('gi_no_of_sourcing'),
            'gi_no_of_closing' => $request->get('gi_no_of_closing'),
            'gi_sourcing_amt' => $request->get('gi_sourcing_amt'),
            'gi_closing_amt' => $request->get('gi_closing_amt'),
            'ai_sourcing_ince' => $request->get('ai_sourcing_ince'),
            'ai_closing_ince' => $request->get('ai_closing_ince'),
            'ai_sourcing_amt' => $request->get('ai_sourcing_amt'),
            'pi_sourcing_ince' => $request->get('pi_sourcing_ince'),
            'pi_closing_ince' => $request->get('pi_closing_ince'),
            'pi_sourcing_amt' => $request->get('pi_sourcing_amt'),
            'pi_closing_amt' => $request->get('pi_closing_amt'),
            'eligibility_ince' => $request->get('eligibility_ince'),
            'eligibility_bonus' => $request->get('eligibility_bonus'),
            // 'business_value'  =>  $request->get('business_value'),
            // 'ince_status'  =>  $request->get('ince_status'),
            'payout_bonus' => $request->get('payout_bonus'),
            'monthly_eligible' => $request->get('monthly_eligible'),
            'paid_amt' => $request->get('paid_amt'),
            'pending_amt' => $request->get('pending_amt'),
            'inc_type' => $request->get('inc_type'),
            'created_at' => $request->get('created_at'),
            'updated_at' => $request->get('updated_at')

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

            // 'user_id' =>  'required',
            'user_id' => '',
            'ince_freq' => '',
            'from_date' => '',
            'to_date' => '',
            'YearMonth' => '',
            'gi_no_of_sourcing' => '',
            'gi_no_of_closing' => '',
            'gi_sourcing_amt' => '',
            'gi_closing_amt' => '',
            'ai_sourcing_ince' => '',
            'ai_closing_ince' => '',
            'ai_sourcing_amt' => '',
            'pi_sourcing_ince' => '',
            'pi_closing_ince' => '',
            'pi_sourcing_amt' => '',
            'pi_closing_amt' => '',
            'eligibility_ince' => '',
            'eligibility_bonus' => '',
            // 'business_value' => '',
            // 'ince_status' => '',
            'payout_bonus' => '',
            'monthly_eligible' => '',
            'paid_amt' => '',
            'pending_amt' => '',
            'inc_type' => ''
        ]);


        $newMonthlyIncentive = new MonthlyIncentive([

            'user_id' => $request->get('user_id'),
            'ince_freq' => $request->get('ince_freq'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'YearMonth' => $request->get('YearMonth'),
            'gi_no_of_sourcing' => $request->get('gi_no_of_sourcing'),
            'gi_no_of_closing' => $request->get('gi_no_of_closing'),
            'gi_sourcing_amt' => $request->get('gi_sourcing_amt'),
            'gi_closing_amt' => $request->get('gi_closing_amt'),
            'ai_sourcing_ince' => $request->get('ai_sourcing_ince'),
            'ai_closing_ince' => $request->get('ai_closing_ince'),
            'ai_sourcing_amt' => $request->get('ai_sourcing_amt'),
            'pi_sourcing_ince' => $request->get('pi_sourcing_ince'),
            'pi_closing_ince' => $request->get('pi_closing_ince'),
            'pi_sourcing_amt' => $request->get('pi_sourcing_amt'),
            'pi_closing_amt' => $request->get('pi_closing_amt'),
            'eligibility_ince' => $request->get('eligibility_ince'),
            // 'business_value'  =>  $request->get('business_value'),
            // 'ince_status'  =>  $request->get('ince_status'),
            'eligibility_bonus' => $request->get('eligibility_bonus'),
            'payout_bonus' => $request->get('payout_bonus'),
            'monthly_eligible' => $request->get('monthly_eligible'),
            'paid_amt' => $request->get('paid_amt'),
            'pending_amt' => $request->get('pending_amt'),
            'inc_type' => $request->get('inc_type'),
        ]);

        $newMonthlyIncentive->save();

        return response()->json($newMonthlyIncentive);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $MonthlyIncentive = MonthlyIncentive::findOrFail($id);
    //  return response()->json($MonthlyIncentive);
    // }
    public function show($user_id)
    {
        // $MonthlyIncentive = MonthlyIncentive::findOrFail($ince_id);
        // return response()->json($MonthlyIncentive);

        $MonthlyIncentive = DB::table('tbl_monthly_incentive')->whereIn('user_id', [$user_id])->get();
        return response()->json($MonthlyIncentive);
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

    public function update(Request $request, $ince_id)
    {

        $MonthlyIncentive = MonthlyIncentive::findOrFail($ince_id);

        $MonthlyIncentive = MonthlyIncentive::find($ince_id);
        $MonthlyIncentive->update($request->all());
        return $MonthlyIncentive;
    }
    public function update1(Request $request)
    {

        $MonthlyIncentive = MonthlyIncentive::where([
            'user_id' => $request->get('user_id'),
            'YearMonth' => $request->get('YearMonth')
        ])
            ->update([
                'ince_freq' => $request->get('ince_freq'),
                'gi_no_of_sourcing' => $request->get('gi_no_of_sourcing'),
                'gi_sourcing_amt' => $request->get('gi_sourcing_amt'),
                'business_value' => $request->get('business_value'),
                'eligibility_ince' => $request->get('eligibility_ince'),
                'eligibility_bonus' => $request->get('eligibility_bonus')
            ]);

        return $MonthlyIncentive;
    }
    public function update2(Request $request)
    {

        $MonthlyIncentive = MonthlyIncentive::where([
            'user_id' => $request->get('user_id'),
            'YearMonth' => $request->get('YearMonth')
        ])
            ->update([
                'ince_freq' => $request->get('ince_freq'),
                'gi_no_of_closing' => $request->get('gi_no_of_closing'),
                'gi_closing_amt' => $request->get('gi_closing_amt')
            ]);

        return $MonthlyIncentive;
    }
    public function update3(Request $request)
    {
        // dd($request->all());
        $MonthlyIncentive = MonthlyIncentive::where([
            'user_id' => $request->get('user_id'),
            'YearMonth' => $request->get('YearMonth')
        ])
            ->update([
                'ai_closing_amt' => $request->get('ai_closing_amt'),
                'ai_closing_ince' => $request->get('ai_closing_ince')
            ]);

        return $MonthlyIncentive;
    }
    public function update4(Request $request)
    {
        // dd($request->all());
        $MonthlyIncentive = MonthlyIncentive::where([
            'user_id' => $request->get('user_id'),
            'YearMonth' => $request->get('YearMonth')
        ])
            ->update([
                'ai_sourcing_amt' => $request->get('ai_sourcing_amt'),
                'ai_sourcing_ince' => $request->get('ai_sourcing_ince')
            ]);

        return $MonthlyIncentive;
    }
    public function updatepiS(Request $request)
    {
        // dd($request->all());
        $MonthlyIncentive = MonthlyIncentive::where([
            'user_id' => $request->get('user_id'),
            'YearMonth' => $request->get('YearMonth')
        ])
            ->update([
                // 'ince_status' =>  $request->get('ince_status'),
                'pi_sourcing_amt' => $request->get('pi_sourcing_amt'),
                'pi_sourcing_ince' => $request->get('pi_sourcing_ince')
            ]);

        return $MonthlyIncentive;
    }
    public function updatepiC(Request $request)
    {
        // dd($request->all());
        $MonthlyIncentive = MonthlyIncentive::where([
            'user_id' => $request->get('user_id'),
            'YearMonth' => $request->get('YearMonth')
        ])
            ->update([
                'pi_closing_amt' => $request->get('pi_closing_amt'),
                'pi_closing_ince' => $request->get('pi_closing_ince')

            ]);

        return $MonthlyIncentive;
    }

    public function destroy($id)
    {
        $MonthlyIncentive = MonthlyIncentive::findOrFail($id);
        $MonthlyIncentive->delete();

        return response()->json($MonthlyIncentive::all());
    }
    // public function monthlyinceData($id)
    // {
    //     $data=DB::table('users')
    //         ->join('teamdetails','teamdetails.user_id','=','users.user_id')
    //         ->join('teams','teams.team_id','=','teamdetails.team_id')
    //         ->join('designations','designations.designation_id','=','users.designation')
    //         ->select('users.user_id','users.user_id','teamdetails.*','teams.*','designations.*')
    //         ->where('users.user_id',$id)
    //         ->get();
    //         return $data;
    // }

    // public function lead_count(Request $request){
    //     //dd($request->all());
    //     //$status_id='1'; 
    //     $from = $request->from_date;
    //     $to = $request->to_date;
    //     $user_id =$request->user_id;

    //     $data=DB::table('users')
    //     ->join('salesdetails','salesdetails.sourcing_emp_id','=','users.user_id')
    //     ->join('invoicedetids','invoicedetids.sales_id','=','salesdetails.sales_id')
    //     ->join('invoice','invoice.invoice_id','=','invoicedetids.invoice_id')
    //     ->select(DB::raw('count(*) as user_count'),DB::raw("SUM(receivable_amt) as ince_receivable_amt"))
    //     ->where('salesdetails.deal_status_id','1')   
    //     ->whereBetween('booking_date', [$from, $to])
    //     ->where('users.user_id',$user_id)
    //     ->get();
    //     return response()->json($data);
    // }

    public function ClosingData(Request $request)
    {

        $closing_emp_id = $request->closing_emp_id;
        $year = $request->year;
        $month = $request->month;
        $data = DB::table('users')
            ->join('salesdetails', 'salesdetails.closing_emp_id', '=', 'users.user_id')
            ->select('users.*', 'salesdetails.*')
            ->where('salesdetails.closing_emp_id', $closing_emp_id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->distinct()
            ->get(['salesdetails.sales_id']);
        return response()->json($data);
    }
    public function SourcingData(Request $request)
    {

        $sourcing_emp_id = $request->sourcing_emp_id;
        $year = $request->year;
        $month = $request->month;
        $data = DB::table('users')
            ->join('salesdetails', 'salesdetails.sourcing_emp_id', '=', 'users.user_id')
            ->select('users.*', 'salesdetails.*')
            ->where('salesdetails.sourcing_emp_id', $sourcing_emp_id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->distinct()
            ->get(['salesdetails.sales_id']);
        return response()->json($data);
    }

    public function invoiceInceMulti($id)
    {

        $data = DB::table('invoicedetids')
            ->leftjoin('invoice_multi', 'invoicedetids.invoice_multi_id', '=', 'invoice_multi.invoice_multi_id')
            ->leftjoin('salesdetails', 'invoicedetids.sales_id', '=', 'salesdetails.sales_id')
            ->select('invoice_multi.*', 'invoicedetids.*', 'salesdetails.*')
            ->where('invoice_multi.invoice_multi_id', $id)
            ->get();
        return response()->json($data);
    }
    public function inceReceiptData(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $client_id = $request->client_id;
        $data = DB::table('invoicedetids')
            ->join('receiptdetails', 'receiptdetails.invoice_id', '=', 'invoicedetids.invoice_multi_id')
            ->join('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
            ->select('invoicedetids.invoice_multi_id', 'invoicedetids.client_id as in_client_id', 'salesdetails.*', 'receiptdetails.invoice_id')
            ->where('invoicedetids.invoice_multi_id', $invoice_id)
            ->where('invoicedetids.client_id', $client_id)
            ->get();
        return response()->json($data);
    }

    public function SourSaleInce(Request $request)
    {
        //dd($request->all());
        $year = $request->year;
        $month = $request->month;
        $booking_date = $request->booking_date;
        $sourcing_emp_id = $request->sourcing_emp_id;
        $ince_type = $request->ince_type;
        $ince_freq = $request->ince_freq;
        $LeadCount = $request->LeadCount;

        $data = DB::table('salesdetails')
            ->select('salesdetails.cv_range', DB::raw('count(*) as cv_total'))
            ->groupBy('salesdetails.cv_range')
            ->where('salesdetails.sourcing_emp_id', $sourcing_emp_id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->get();
        $data2 = response()->json($data);
        $cv_data = $data2->getData();

        for ($i = 0; $i < count($cv_data); $i++) {
            $cvData[] = $cv_data[$i]->cv_range;
        }
        $rang_data = [];
        for ($i = 0; $i < count($cv_data); $i++) {
            $rang_data[] = DB::table('tbl_incentives')
                ->select($cv_data[$i]->cv_range)
                ->Where('tbl_incentives.cat1_target', '<=', $LeadCount)
                ->where('tbl_incentives.ince_type', $ince_type)
                ->where('tbl_incentives.ince_freq', $ince_freq)
                ->where('tbl_incentives.from_date', '<=', $booking_date)
                ->where('tbl_incentives.to_date', '>=', $booking_date)
                ->get();
        }
        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();

        for ($i = 0; $i < count($cv_range1); $i++) {
            $value = str_replace('"', '', $cv_data[$i]->cv_range);
            $value1[] = $cv_range1[$i][0]->$value;

            $amt[] = ($value1[$i] * $cv_data[$i]->cv_total);
        }
        $valueData = (array_sum($amt));
        return response()->json($valueData);
    }
    public function CloseSaleInce(Request $request)
    {

        // $year = '2021';
        // $month = '07';
        // $closing_emp_id = '113';
        // $ince_type='Closing';
        // $ince_freq='Monthly Incentive';
        // $booking_date='2021-07-01';

        $year = $request->year;
        $month = $request->month;
        $booking_date = $request->booking_date;
        $closing_emp_id = $request->closing_emp_id;
        $ince_type = $request->ince_type;
        $ince_freq = $request->ince_freq;

        $data = DB::table('salesdetails')
            ->select('cv_range', DB::raw('count(*) as cv_total'))
            ->groupBy('cv_range')
            ->where('closing_emp_id', $closing_emp_id)
            ->where('deal_status_id', '=', 1)
            ->whereYear('booking_date', '=', $year)
            ->whereMonth('booking_date', '=', $month)
            ->where('cv_range', '!=', '')
            ->whereNotNull('cv_range')
            ->get();

        $data2 = response()->json($data);
        $cv_data = $data2->getData();


        $rang_data = [];
        for ($i = 0; $i < count($cv_data); $i++) {
            $rang_data[] = DB::table('tbl_incentives')
                ->select($cv_data[$i]->cv_range)
                ->where('tbl_incentives.ince_type', $ince_type)
                ->where('tbl_incentives.ince_freq', $ince_freq)
                ->where('tbl_incentives.from_date', '<=', $booking_date)
                ->where('tbl_incentives.to_date', '>=', $booking_date)
                ->get();
        }
        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();

        for ($i = 0; $i < count($cv_range1); $i++) {
            $value = str_replace('"', '', $cv_data[$i]->cv_range);
            $value1[] = $cv_range1[$i][0]->$value;

            $amt[] = ($value1[$i] * $cv_data[$i]->cv_total);
        }
        $valueData = (array_sum($amt));
        return response()->json($valueData);
    }
    public function invoiceInce(Request $request)
    {

        $year = $request->year;
        $month = $request->month;
        $closing_emp_id = $request->closing_emp_id;

        $data = DB::table('salesdetails')
            ->Join('invoicedetids', 'invoicedetids.sales_id', '=', 'salesdetails.sales_id')
            ->join('invoice_multi', 'invoice_multi.invoice_multi_id', '=', 'invoicedetids.invoice_multi_id')
            ->select('salesdetails.*')
            ->where('salesdetails.closing_emp_id', $closing_emp_id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->distinct()
            ->where(function ($query) {
                $query->where('invoice_multi.inv_status_id', 1)
                    ->orWhere('invoice_multi.inv_status_id', 2)
                    // ->orWhere('invoice_multi.inv_status_id',2)
                    ->orWhere('invoice_multi.inv_status_id', 8);
            })
            ->get(['salesdetails.sales_id']);
        return response()->json($data);
    }
    public function invoiceInceS(Request $request)
    {

        $year = $request->year;
        $month = $request->month;
        $sourcing_emp_id = $request->sourcing_emp_id;

        $data = DB::table('salesdetails')
            ->Join('invoicedetids', 'invoicedetids.sales_id', '=', 'salesdetails.sales_id')
            ->join('invoice_multi', 'invoicedetids.invoice_multi_id', '=', 'invoice_multi.invoice_multi_id')
            ->select('salesdetails.*')
            ->where('salesdetails.sourcing_emp_id', $sourcing_emp_id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->distinct()
            ->where(function ($query) {
                $query->where('invoice_multi.inv_status_id', 1)
                    ->orWhere('invoice_multi.inv_status_id', 2)
                    ->orWhere('invoice_multi.inv_status_id', 8);
            })
            ->get();
        return response()->json($data);
    }
    public function invoiceInceS1()
    {
        $duplicated = DB::table('invoicedetids')
            ->select('sales_id', DB::raw('count(`sales_id`) as occurences'))
            ->groupBy('sales_id')
            ->having('occurences', '>', 1)
            ->get();
        return response()->json($duplicated);
    }
    // public function invoiceInce(Request $request){

    //     $year = '2021';
    //     $month = '04';
    //     $closing_emp_id = '120';

    //     $data = DB::table('salesdetails')
    //     ->Join('invoicedetids', 'invoicedetids.sales_id', '=', 'salesdetails.sales_id')
    //     ->join('invoice_multi', 'invoice_multi.invoice_multi_id', '=', 'invoicedetids.invoice_multi_id')
    //     ->select('salesdetails.*','invoice_multi.inv_status_id','invoicedetids.invoice_multi_id')
    //     ->where('salesdetails.closing_emp_id',$closing_emp_id)
    //     ->whereYear('salesdetails.booking_date','=', $year)
    //     ->whereMonth('salesdetails.booking_date','=', $month)
    //     ->where('salesdetails.cv_range','!=','')
    //     ->whereNotNull('salesdetails.cv_range')
    //     ->distinct()
    //     ->where(function ($query) {
    //         $query ->where('invoice_multi.inv_status_id',1)
    //         ->orWhere('invoice_multi.inv_status_id',2);
    //     })       
    //     ->get(['salesdetails.sales_id']);
    //     return response()->json($data);
    // }
    // public function invoiceInceS(){

    //     $year = '2021';
    //     $month = '04';
    //     $sourcing_emp_id = '120';

    //     $data = DB::table('salesdetails')
    //      ->Join('invoicedetids', 'invoicedetids.sales_id', '=', 'salesdetails.sales_id')
    //      ->join('invoice_multi', 'invoicedetids.invoice_multi_id', '=', 'invoice_multi.invoice_multi_id')
    //      ->select('salesdetails.*','invoice_multi.inv_status_id','invoicedetids.invoice_multi_id')
    //     ->where('salesdetails.sourcing_emp_id',$sourcing_emp_id)
    //     ->whereYear('salesdetails.booking_date', '=', $year)
    //     ->whereMonth('salesdetails.booking_date', '=',$month)
    //     ->where('salesdetails.cv_range','!=','')
    //     ->whereNotNull('salesdetails.cv_range')
    //     ->distinct()
    //     ->where(function ($query) {
    //         $query ->where('invoice_multi.inv_status_id',1)
    //         ->orWhere('invoice_multi.inv_status_id',2);
    //     })       
    //     ->get(['salesdetails.sales_id']);
    //     return response()->json($data);
    // }

    public function CloInvoiceInce(Request $request)
    {
        // dd($request->all());
        $booking_date = $request->booking_date;
        $cv_range = $request->cv_range;
        $ince_type = 'Closing';
        $ince_freq = 'Monthly Incentive';

        $data2 = (array_count_values($cv_range));
        //dd($data2);

        $rang_data = DB::table('tbl_incentives')
            ->select($cv_range)
            ->where('tbl_incentives.ince_type', $ince_type)
            ->where('tbl_incentives.ince_freq', $ince_freq)
            ->where('tbl_incentives.from_date', '<=', $booking_date)
            ->where('tbl_incentives.to_date', '>=', $booking_date)
            ->get();
        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();
        $attributes = array_keys($data2);

        for ($i = 0; $i < count($attributes); $i++) {
            $a = $attributes[$i];
            $b = $cv_range1[0]->$a;
            $c = $data2[$a];
            $value2[] = $b * $c;
        }
        $valueData = (array_sum($value2));
        return response()->json($valueData);
    }
    public function SourInvoiceInce(Request $request)
    {
        // dd($request->all());
        $booking_date = $request->booking_date;
        $cv_range = $request->cv_range;
        $ince_type = 'Sourcing';
        $ince_freq = 'Monthly Incentive';

        $data2 = (array_count_values($cv_range));
        $rang_data = DB::table('tbl_incentives')
            ->select($cv_range)
            ->where('tbl_incentives.ince_type', $ince_type)
            ->where('tbl_incentives.ince_freq', $ince_freq)
            ->where('tbl_incentives.from_date', '<=', $booking_date)
            ->where('tbl_incentives.to_date', '>=', $booking_date)
            ->get();
        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();

        $attributes = array_keys($data2);

        for ($i = 0; $i < count($attributes); $i++) {
            $a = $attributes[$i];
            $b = $cv_range1[0]->$a;
            $c = $data2[$a];
            $value2[] = $b * $c;
        }
        $valueData = (array_sum($value2));
        return response()->json($valueData);
    }

    public function getReceiptClose(Request $request)
    {

        // dd($request->all());
        $year = $request->year;
        $month = $request->month;
        // $invoice_id = $request->invoice_id;
        $closing_emp_id = $request->closing_emp_id;
        $data = DB::table('invoicedetids')
            ->join('invoice_multi', 'invoice_multi.invoice_multi_id', '=', 'invoicedetids.invoice_multi_id')
            ->join('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
            ->join('receiptdetails', 'receiptdetails.invoice_id', '=', 'invoice_multi.invoice_multi_id')
            ->select('salesdetails.*')
            ->where('salesdetails.closing_emp_id', $closing_emp_id)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->distinct()
            ->where(function ($query) {
                $query->where('invoice_multi.inv_status_id', 1)
                    ->orWhere('invoice_multi.inv_status_id', 2);
            })
            ->get(['invoicedetids.sales_id']);
        return response()->json($data);
    }
    public function getReceiptSou(Request $request)
    {
        // dd($request->all());
        $year = $request->year;
        $month = $request->month;
        // $invoice_id = $request->invoice_id;
        $sourcing_emp_id = $request->sourcing_emp_id;
        $data = DB::table('invoicedetids')
            ->join('invoice_multi', 'invoice_multi.invoice_multi_id', '=', 'invoicedetids.invoice_multi_id')
            ->join('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
            ->join('receiptdetails', 'receiptdetails.invoice_id', '=', 'invoice_multi.invoice_multi_id')
            ->select('salesdetails.*')
            ->where('salesdetails.sourcing_emp_id', $sourcing_emp_id)
            ->whereYear('salesdetails.booking_date', '=', $year)
            ->whereMonth('salesdetails.booking_date', '=', $month)
            ->where('salesdetails.cv_range', '!=', '')
            ->whereNotNull('salesdetails.cv_range')
            ->distinct()
            ->where(function ($query) {
                $query->where('invoice_multi.inv_status_id', 1)
                    ->orWhere('invoice_multi.inv_status_id', 2);
            })
            ->get(['invoicedetids.sales_id']);
        return response()->json($data);
    }
    public function SourReceInce(Request $request)
    {
        //  dd($request->all());
        $booking_date = $request->booking_date;
        $cv_range = $request->cv_range;
        $ince_type = 'Sourcing';
        $ince_freq = 'Monthly Incentive';

        $data2 = (array_count_values($cv_range));
        $rang_data = DB::table('tbl_incentives')
            ->select($cv_range)
            ->where('tbl_incentives.ince_type', $ince_type)
            ->where('tbl_incentives.ince_freq', $ince_freq)
            ->where('tbl_incentives.from_date', '<=', $booking_date)
            ->where('tbl_incentives.to_date', '>=', $booking_date)
            ->get();
        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();

        $attributes = array_keys($data2);

        for ($i = 0; $i < count($attributes); $i++) {
            $a = $attributes[$i];
            $b = $cv_range1[0]->$a;
            $c = $data2[$a];
            $value2[] = $b * $c;
        }
        $valueData = (array_sum($value2));
        return response()->json($valueData);
    }
    public function CloseReceInce(Request $request)
    {

        //dd($request->all());
        $booking_date = $request->booking_date;
        $cv_range = $request->cv_range;
        $ince_type = 'Closing';
        $ince_freq = 'Monthly Incentive';

        $data2 = (array_count_values($cv_range));

        $rang_data = DB::table('tbl_incentives')
            ->select($cv_range)
            ->where('tbl_incentives.ince_type', $ince_type)
            ->where('tbl_incentives.ince_freq', $ince_freq)
            ->where('tbl_incentives.from_date', '<=', $booking_date)
            ->where('tbl_incentives.to_date', '>=', $booking_date)
            ->get();
        $data3 = response()->json($rang_data);
        $cv_range1 = $data3->getData();
        $attributes = array_keys($data2);

        for ($i = 0; $i < count($attributes); $i++) {
            $a = $attributes[$i];
            $b = $cv_range1[0]->$a;
            $c = $data2[$a];
            $value2[] = $b * $c;
        }
        $valueData = (array_sum($value2));
        return response()->json($valueData);
    }
    public function updateCreateInce(Request $request)
    {

        $newMonthlyIncentive = MonthlyIncentive::updateOrCreate(

            [
                'user_id' => $request->get('user_id'),
                'from_date' => $request->get('from_date'),
                'to_date' => $request->get('to_date'),
            ],
            [

                'ince_freq' => $request->get('ince_freq'),
                'YearMonth' => $request->get('YearMonth'),
                'gi_no_of_sourcing' => $request->get('gi_no_of_sourcing'),
                'gi_no_of_closing' => $request->get('gi_no_of_closing'),
                'gi_sourcing_amt' => $request->get('gi_sourcing_amt'),
                'gi_closing_amt' => $request->get('gi_closing_amt'),
                'ai_sourcing_ince' => $request->get('ai_sourcing_ince'),
                'ai_closing_ince' => $request->get('ai_closing_ince'),
                'ai_sourcing_amt' => $request->get('ai_sourcing_amt'),
                'pi_sourcing_ince' => $request->get('pi_sourcing_ince'),
                'pi_closing_ince' => $request->get('pi_closing_ince'),
                'pi_sourcing_amt' => $request->get('pi_sourcing_amt'),
                'pi_closing_amt' => $request->get('pi_closing_amt'),
                'eligibility_ince' => $request->get('eligibility_ince'),
                'eligibility_bonus' => $request->get('eligibility_bonus')
            ]
        );
        return response()->json($newMonthlyIncentive);
    }

    public function getTeamData($team_id)
    {
        $teamLeaders = DB::table('team_leaders')
            ->join('users', 'team_leaders.user_id', '=', 'users.user_id')
            ->join('teams', 'teams.team_id', '=', 'team_leaders.team_id')
            ->select('teams.team_id', 'teams.teamname', 'users.firstname', 'users.lastname', 'users.user_id')
            ->where('team_leaders.status', 1)
            ->where('teams.team_id', $team_id);

        $data = DB::table('teamdetails')
            ->join('users', 'users.user_id', '=', 'teamdetails.user_id')
            ->join('teams', 'teams.team_id', '=', 'teamdetails.team_id')
            ->select('teams.team_id', 'teams.teamname', 'users.firstname', 'users.lastname', 'users.user_id')
            ->where('teamdetails.status', '1')
            ->where('teamdetails.team_id', $team_id);

        $unionQuery = $teamLeaders->union($data)->get();
        return response()->json($unionQuery);
    }


    public function IncenUserwise($user_id)
    {

        $data = DB::table('users')
            ->join('tbl_monthly_incentive', 'tbl_monthly_incentive.user_id', '=', 'users.user_id')
            ->select('users.firstname', 'users.lastname', 'tbl_monthly_incentive.*')
            ->where('users.user_id', $user_id)
            ->get();
        return response()->json($data);
    }
    // public function getTeamUsers(){

    //     $data = DB::table('teamdetails')
    //     ->join('users','users.user_id','=','teamdetails.user_id')
    //     ->select('teamdetails.*','users.firstname','users.lastname')
    //     ->where('teamdetails.status','=','1')
    //     ->get();
    //     return response()->json($data);
    // }
    public function getTeamUsers()
    {

        $data = DB::table('users')
            ->select('user_id', 'firstname', 'lastname')
            ->where(function ($query) {
                $query->where('users.designation', 8)
                    ->orWhere('users.designation', 9)
                    ->orWhere('users.designation', 6)
                    ->orWhere('users.designation', 7)
                    ->orWhere('users.designation', 10);
            })
            ->get();
        return response()->json($data);
    }

    //21-2-2023
    public function getLastRecordMI()
    {

        $getlastrecord = DB::table('tbl_monthly_incentive')
            ->select('*')
            ->orderBy('ince_id', 'desc')
            ->limit(1)
            ->get();
        return response()->json($getlastrecord);
    }


    //23-2-2023
    public function getSouringDealMI(Request $request)
    {
        $booking_datestart = $request->get('booking_datestart');
        $booking_dateend = $request->get('booking_dateend');
        $souringempid = $request->get('souringempid');

        $getsouringdeal = DB::table('salesdetails')
            ->select('booking_date', 'sourcing_emp_id', 'cv_range')
            ->where('deal_status_id', '=', 1)
            ->where('sourcing_emp_id', '=', $souringempid)
            ->whereBetween('booking_date', [$booking_datestart, $booking_dateend])
            ->orderBy('booking_date', 'asc')
            ->limit(100)
            ->offset(3)
            ->get();
        return response()->json($getsouringdeal);
    }


    public function getClosingDealMI(Request $request)
    {
        $booking_datestart = $request->get('booking_datestart');
        $booking_dateend = $request->get('booking_dateend');
        $closingempid = $request->get('closingempid');

        $getclosingdeal = DB::table('salesdetails')
            ->select('booking_date', 'closing_emp_id', 'cv_range')
            ->where('closing_emp_id', '=', $closingempid)
            ->whereBetween('booking_date', [$booking_datestart, $booking_dateend])
            ->get();
        return response()->json($getclosingdeal);
    }


    public function getSouringDealMITest()
    {

        $getsouringdealtest = DB::table('salesdetails')
            ->select('booking_date', 'sourcing_emp_id', 'cv_range')
            ->where('sourcing_emp_id', '=', 607)
            ->whereBetween('booking_date', ['2023-02-01', '2023-02-28'])
            ->orderBy('booking_date', 'asc')
            ->limit(100)
            ->offset(3)
            ->get();
        return response()->json($getsouringdealtest);
    }

    //update bonus in monhlty incentive
    public function updateMiBonus(Request $request)
    {
        $bonus = $request->get('bonus');
        $fromdate = $request->get('fromdate');
        $userid = $request->get('userid');
        //dd($resignation_date, $user_id);
        $updatemibonus = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('from_date', $fromdate)
            ->update(['bonus' => $bonus]);


        return response()->json($updatemibonus);
    }


    //27-2-2023 write query for check souring emp deal that have deal_status_id 1 vishal3
    public function getSouringDealWihDealStatus(Request $request)
    {
        $userid = $request->get('userid');
        $bookings = $request->get('bookings');
        $bookinge = $request->get('bookinge');

        $getsouringdealwithdealstatus = DB::table('salesdetails')
            ->select('*')
            ->where('sourcing_emp_id', '=', $userid)
            ->where('deal_status_id', '=', 1)
            ->whereBetween('booking_date', [$bookings, $bookinge])
            ->get();
        return response()->json($getsouringdealwithdealstatus);
    }


    // public function getSouringDealWihDealStatus($id){
    //     $getsouringdealwithdealstatus=DB::table('salesdetails')
    //     ->select('*')
    //     ->where('sourcing_emp_id','=',$id)
    //     ->where('deal_status_id','=',1)
    //     ->whereBetween('booking_date', ["2023-03-01", "2023-03-31"])
    //     ->get();
    //     return response()->json($getsouringdealwithdealstatus);
    // }



    //27-2-2023 update Bonus Eligibility of bonus
    public function updateBE(Request $request)
    {
        $bonuse = $request->get('bonuse');
        $userid = $request->get('userid');
        $fromdate = $request->get('fromdate');
        $updatebe = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('from_date', $fromdate)
            ->update(['eligibility_bonus' => $bonuse]);


        return response()->json($updatebe);
    }


    public function updateGiNoSourcing(Request $request)
    {
        $ginos = $request->get('ginos');
        $userid = $request->get('userid');
        $fromdate = $request->get('fromdate');
        $updateginos = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('YearMonth', $fromdate)
            ->update(['gi_no_of_sourcing' => $ginos, 'gi_sourcing_amt' => $ginos]);

        return response()->json($updateginos);
    }


    public function updateGiNoClosing(Request $request)
    {
        $ginoc = $request->get('ginoc');
        $userid = $request->get('userid');
        $fromdate = $request->get('fromdate');
        $updateginoc = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('YearMonth', $fromdate)
            ->update(['gi_no_of_closing' => $ginoc, 'gi_closing_amt' => $ginoc]);

        return response()->json($updateginoc);
    }

    //28-2-2023
    public function updateAiNoSourcing(Request $request)
    {
        $ainos = $request->get('ainos');
        $userid = $request->get('userid');
        $fromdate = $request->get('fromdate');
        $updateainos = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('YearMonth', $fromdate)
            ->update(['ai_sourcing_ince' => $ainos, 'ai_sourcing_amt' => $ainos]);

        return response()->json($updateainos);
    }

    public function updateAiNoClosing(Request $request)
    {
        $ainoc = $request->get('ainoc');
        $userid = $request->get('userid');
        $fromdate = $request->get('fromdate');
        $updateainoc = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('YearMonth', $fromdate)
            ->update(['ai_closing_ince' => $ainoc, 'ai_closing_amt' => $ainoc]);

        return response()->json($updateainoc);
    }



    //02-03-2023 get souring emp to update payable amount
    public function getSouringEmp(Request $request)
    {
        $semp = $request->get('semp');
        $yearmonth = $request->get('yearmonth');
        $getsouringemp = DB::table('tbl_monthly_incentive')
            ->select('*')
            ->where('user_id', $semp)
            ->where('YearMonth', $yearmonth)
            ->get();
        return response()->json($getsouringemp);
    }


    public function getSouringEmpPa(Request $request)
    {
        $userid = $request->get('userid');
        $payablebonus = $request->get('payablebonus');
        $yearmontha = $request->get('yearmontha');
        $getsouringemppa = DB::table('tbl_monthly_incentive')
            ->where('user_id', $userid)
            ->where('YearMonth', $yearmontha)
            ->update(['payable_bonus' => $payablebonus]);

        return response()->json($getsouringemppa);
    }


    //13-03-2023 get top 3 sales by using user id 
    public function getTopThreeSales($u_id)
    {
        $data = DB::table('salesdetails')
            ->select('sales_id')
            ->where('sourcing_emp_id', '=', $u_id)
            ->orderBy('booking_date', 'asc')
            ->limit(3)
            ->get();
        return response()->json($data);
    }

    //26-03-2023

    public function SourcingDataCount(Request $request)
    {
        $sourcing_emp_id = $request->sourcing_emp_id;
        $bookings = $request->bookings;
        $bookinge = $request->bookinge;
        $data = DB::table('salesdetails')
            ->select('*')
            ->where('sourcing_emp_id', $sourcing_emp_id)
            ->where('deal_status_id', '=', 1)
            ->whereBetween('booking_date', ["$bookings", "$bookinge"])
            ->get();
        $dataCount = $data->count();
        return response()->json($dataCount);
    }

    public function getIncentiveRangee($tblir)
    {
        $data = DB::table('tbl_incentive_range')
            ->select('business_cat')
            ->where('business_value', '<=', $tblir)
            ->where('business_value1', '>=', $tblir)
            ->get();
        return response()->json($data);
    }


    public function getTblIncentivesRangee($tir)
    {
        $data = DB::table('tbl_incentives')
            ->select($tir)
            ->where('id', '=', "9")
            ->where('ince_type', '=', "Sourcing")
            ->where('ince_freq', '=', "Monthly Incentive")
            ->get();
        return response()->json($data);
    }


    //04-04-2023 edit part
    public function uMonthlyIncentiveS(Request $request)
    {
        $user_id = $request->get('user_id');
        $ince_freq = $request->get('ince_freq');
        $gi_no_of_sourcing = $request->get('gi_no_of_sourcing');
        $gi_sourcing_amt = $request->get('gi_sourcing_amt');
        $bookingMY = $request->get('bookingMY');

        $inceEli = $request->get('incEligibility');
        $bonusEli = $request->get('bonEligibility');
        $bonus = $request->get('bonusvalue');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->update([
                'ince_freq' => $ince_freq,
                'gi_no_of_sourcing' => $gi_no_of_sourcing,
                'gi_sourcing_amt' => $gi_sourcing_amt,
                'eligibility_ince' => $inceEli,
                'eligibility_bonus' => $bonusEli,
                'bonus' => $bonus
            ]);

        return response()->json($data);
    }


    // public function uMonthlyIncentiveS(Request $request){
    //     $user_id = $request->get('user_id');
    //     $ince_freq = $request->get('ince_freq');
    //     $gi_no_of_sourcing = $request->get('gi_no_of_sourcing');
    //     $gi_sourcing_amt = $request->get('gi_sourcing_amt');
    //     $bookingMY = $request->get('bookingMY');

    //     $inceEli = $request->get('incEligibility');
    //     $bonusEli = $request->get('bonEligibility');

    //     $data = DB::table('tbl_monthly_incentive')
    //                       ->where('user_id',$user_id)
    //                       ->where('YearMonth',$bookingMY)
    //                       ->update(['ince_freq'=> $ince_freq,'gi_no_of_sourcing'=>$gi_no_of_sourcing,'gi_sourcing_amt'=>$gi_sourcing_amt]);

    //     return response()->json($data);
    // }


    public function getMonthlyUser(Request $request)
    {
        $user_id = $request->get('user_id');
        $bookingMY = $request->get('bookingMY');
        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->get();
        return response()->json($data);
    }


    //closing deals
    public function ClosingDataCount(Request $request)
    {
        $closing_emp_id = $request->closing_emp_id;
        $bookings = $request->bookings;
        $bookinge = $request->bookinge;
        $data = DB::table('salesdetails')
            ->select('*')
            ->where('closing_emp_id', $closing_emp_id)
            ->where('deal_status_id', '=', 1)
            ->whereBetween('booking_date', ["$bookings", "$bookinge"])
            ->get();
        $dataCount = $data->count();
        return response()->json($dataCount);
    }


    public function getTblIncentivesRangeeCC($tir)
    {
        $data = DB::table('tbl_incentives')
            ->select($tir)
            ->where('id', '=', "10")
            ->where('ince_type', '=', "Closing")
            ->where('ince_freq', '=', "Monthly Incentive")
            ->get();
        return response()->json($data);
    }


    public function uMonthlyIncentiveCC(Request $request)
    {
        $user_id = $request->get('user_id');
        $gi_no_of_closing = $request->get('gi_no_of_closing');
        $gi_closing_amt = $request->get('gi_closing_amt');
        $bookingMY = $request->get('bookingMY');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->update(['gi_no_of_closing' => $gi_no_of_closing, 'gi_closing_amt' => $gi_closing_amt]);

        return response()->json($data);
    }



    public function getSourcingIncentiveA($tir)
    {
        $data = DB::table('tbl_incentives')
            ->select($tir)
            ->where('id', '=', "9")
            ->get();
        return response()->json($data);
    }

    public function getClosingIncentiveA($tir)
    {
        $data = DB::table('tbl_incentives')
            ->select($tir)
            ->where('id', '=', "10")
            ->get();
        return response()->json($data);
    }


    //invoice 07-04-2023
    public function getInvoiceDetails(Request $request)
    {
        $sales_id = $request->get('sales_id');
        $data = DB::table('invoice_multi')
            ->select(DB::raw('count(*) as inv_status_id'))
            ->rightJoin('invoicedetids', 'invoice_multi.invoice_multi_id', '=', 'invoicedetids.invoice_multi_id')
            ->where('invoicedetids.sales_id', '=', $sales_id)
            ->whereIn('invoice_multi.inv_status_id', [1, 2, 8])
            ->get();
        return response()->json($data);
    }


    public function uMonthlyIncentiveSI(Request $request)
    {
        $user_id = $request->get('user_id');
        $ai_sourcing_ince = $request->get('ai_sourcing_ince');
        $ai_sourcing_amt = $request->get('ai_sourcing_amt');
        $bookingMY = $request->get('bookingMY');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->update(['ai_sourcing_ince' => $ai_sourcing_ince, 'ai_sourcing_amt' => $ai_sourcing_amt]);

        return response()->json($data);
    }


    public function uMonthlyIncentiveCI(Request $request)
    {
        $user_id = $request->get('user_id');
        $ai_closing_ince = $request->get('ai_closing_ince');
        $ai_closing_amt = $request->get('ai_closing_amt');
        $bookingMY = $request->get('bookingMY');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->update(['ai_closing_ince' => $ai_closing_ince, 'ai_closing_amt' => $ai_closing_amt]);

        return response()->json($data);
    }


    //08-04-2023 PR
    public function uMonthlyIncentivePRS(Request $request)
    {
        $user_id = $request->get('user_id');
        $pi_sourcing_ince = $request->get('pi_sourcing_ince');
        $pi_sourcing_amt = $request->get('pi_sourcing_amt');
        $bookingMY = $request->get('bookingMY');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->update(['pi_sourcing_ince' => $pi_sourcing_ince, 'pi_sourcing_amt' => $pi_sourcing_amt]);

        return response()->json($data);
    }


    public function uMonthlyIncentivePRC(Request $request)
    {
        $user_id = $request->get('user_id');
        $pi_closing_ince = $request->get('pi_closing_ince');
        $pi_closing_amt = $request->get('pi_closing_amt');
        $bookingMY = $request->get('bookingMY');

        $data = DB::table('tbl_monthly_incentive')
            ->where('user_id', $user_id)
            ->where('YearMonth', $bookingMY)
            ->update(['pi_closing_ince' => $pi_closing_ince, 'pi_closing_amt' => $pi_closing_amt]);

        return response()->json($data);
    }


    //19-04-2023
    public function getMDueUser(Request $request)
    {
        $user_id = $request->get('user_id');
        $data = DB::table('tbl_monthly_incentive')
            ->select('tbl_monthly_incentive.ince_id','tbl_monthly_incentive.user_id','tbl_monthly_incentive.inc_type','tbl_monthly_incentive.from_date','tbl_monthly_incentive.to_date','tbl_monthly_incentive.paid_amt','tbl_monthly_incentive.pending_amt', DB::raw("(tbl_monthly_incentive.pi_sourcing_amt + tbl_monthly_incentive.pi_closing_amt + tbl_monthly_incentive.payout_bonus) as incentive"))
            ->where('tbl_monthly_incentive.user_id', '=', $user_id)
            ->where('tbl_monthly_incentive.monthly_eligible', '=', 1)
            ->where('tbl_monthly_incentive.pending_amt', '!=', 0)
            // ->where('tbl_monthly_incentive.incentive', '!=', 0)
            ->get();
        // dd($data);
        return response()->json($data);
    }

    public function getQDueUser(Request $request)
    {
        $user_id = $request->get('user_id');
        $data = DB::table('quarterly_incentive')
            ->select('quarterly_incentive.id','quarterly_incentive.user_id','quarterly_incentive.inc_type','quarterly_incentive.from_date','quarterly_incentive.to_date','quarterly_incentive.paid_amt','quarterly_incentive.pending_amt','quarterly_incentive.quarterly_inc_amt as incentive')
            ->where('quarterly_incentive.user_id', '=', $user_id)
            ->where('quarterly_incentive.quarterly_eligible', '=', 1)
            ->where('quarterly_incentive.pending_amt', '!=', 0)
            ->get();
        return response()->json($data);
    }

    public function getHYDueUser(Request $request)
    {
        $user_id = $request->get('user_id');
        $data = DB::table('halfyear_incentive')
            ->select('halfyear_incentive.half_id','halfyear_incentive.user_id','halfyear_incentive.inc_type','halfyear_incentive.from_date','halfyear_incentive.to_date','halfyear_incentive.paid_amt','halfyear_incentive.pending_amt','halfyear_incentive.halfyear_inc_amt as incentive')
            ->where('halfyear_incentive.user_id', '=', $user_id)
            ->where('halfyear_incentive.halfyear_eligible', '=', 1)
            ->where('halfyear_incentive.pending_amt', '!=', 0)
            ->get();
        return response()->json($data);
    }

    public function getYDueUser(Request $request)
    {
        $user_id = $request->get('user_id');
        $data = DB::table('year_incentive')
            ->select('year_incentive.year_id','year_incentive.user_id','year_incentive.inc_type','year_incentive.from_date','year_incentive.to_date','year_incentive.paid_amt','year_incentive.pending_amt','year_incentive.year_inc_amt as incentive')
            ->where('year_incentive.user_id', '=', $user_id)
            ->where('year_incentive.yearly_eligible', '=', 1)
            ->where('year_incentive.pending_amt', '!=', 0)
            ->get();
        return response()->json($data);
    }


    //get Team and Tl id get users 
    public function getTeamTlIdUser(Request $request)
    {
        $team_id = $request->get('team_id');
        $team_leaders_id = $request->get('team_leaders_id');
        $data = DB::table('teamdetails')
            ->select('users.firstname', 'users.lastname', 'users.user_id')
            ->leftJoin('team_leaders', 'teamdetails.team_id', '=', 'team_leaders.team_id')
            ->leftJoin('users', 'teamdetails.user_id', '=', 'users.user_id')
            ->where('teamdetails.team_id', '=', $team_id)
            ->where('team_leaders.user_id', '=', $team_leaders_id)
            ->get();
        return response()->json($data);
    }

    /////changes////
    public function Empfilter1($user_id)
    {
        $datafilter = DB::table('users')
            ->join('tbl_monthly_incentive', 'tbl_monthly_incentive.user_id', '=', 'users.user_id')
            ->select('users.firstname', 'users.lastname', 'tbl_monthly_incentive.*')
            ->where('users.user_id', $user_id)
            ->get();
        return response()->json($datafilter);
    }
}
