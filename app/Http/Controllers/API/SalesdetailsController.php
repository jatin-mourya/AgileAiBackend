<?php

namespace App\Http\Controllers\API;

//use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salesdetails;
use App\Models\Leadsource;
use Illuminate\Support\Facades\Schema;

class SalesdetailsController extends Controller
{

    public function index()
    {
        // $salesdetails = Salesdetails::all();
        $salesdetails = DB::table('salesdetails')
            ->select('salesdetails.*', 'clientdetails.name', 'leadsource.leadsource', 'projects.project_name', 'booking_status.status', 'salesdetails.booking_date', 'u.firstname as ufirst', 'u.middlename as umiddle', 'u.lastname as ulast', 's.firstname as sfirst', 's.middlename as smiddle', 's.lastname as slast', 'teams.teamname')
            ->leftjoin(DB::raw('users u '), 'u.user_id', '=', 'salesdetails.sourcing_emp_id')
            ->leftjoin(DB::raw('users s '), 's.user_id', '=', 'salesdetails.closing_emp_id')
            ->leftjoin('clientdetails', 'clientdetails.client_id', '=', 'salesdetails.client_id')
            ->leftjoin('projects', 'projects.project_id', '=', 'salesdetails.project_id')
            ->leftjoin('booking_status', 'booking_status.deal_status_id', '=', 'salesdetails.deal_status_id')
            ->leftjoin('leadsource', 'leadsource.leadsource_id', '=', 'salesdetails.leadsource_id')
            // ->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
            ->leftjoin('users', 'users.user_id', '=', 'salesdetails.sourcing_emp_id')
            ->leftjoin('teams', 'teams.team_id', '=', 'salesdetails.team_id')
            // ->select('salesdetails.*','clientdetails.name','projects.project_name', 'booking_status.status','salesdetails.booking_date','users.firstname','users.middlename','users.lastname','teams.teamname')
            // ->select('salesdetails.*','clientdetails.name','projects.project_name', 'booking_status.status', 'leadsource.leadsource','salesdetails.booking_date','channelpartner.cp_name','users.firstname','users.middlename','users.lastname','teams.teamname')
            ->orderBy('salesdetails.updated_at', 'DESC')
            ->get();
        return response()->json($salesdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newSalesdetails = new Salesdetails([

            'client_id' => $request->get('client_id'),
            'debtor_company_det_id' => $request->get('debtor_company_det_id'),
            'project_id' => $request->get('project_id'),
            'subproject_id' => $request->get('subproject_id'),
            'booking_date' => $request->get('booking_date'),
            'building_name' => $request->get('building_name'),
            'wing' => $request->get('wing'),
            'flat_no' => $request->get('flat_no'),
            'consideration_value' => $request->get('consideration_value'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            'extra_payout_percentage' => $request->get('extra_payout_percentage'),
            'extra_payout_value' => $request->get('extra_payout_value'),
            'net_extra_payout' => $request->get('net_extra_payout'),
            'payout_value' => $request->get('payout_value'),
            'deal_status_id' => $request->get('deal_status_id'),
            'cp_id' => $request->get('cp_id'),
            'shared_payout' => $request->get('shared_payout'),
            'net_payout' => $request->get('net_payout'),
            'shared_payout_value' => $request->get('shared_payout_value'),
            'net_shared_payout' => $request->get('net_shared_payout'),
            'leadreceived_date' => $request->get('leadreceived_date'),
            'shared_deals' => $request->get('shared_deals'),
            //'pending_invoice_amount' => $request->get('pending_invoice_amount'),
            'payout_status_id' => $request->get('payout_status_id'),
            'sourcing_emp_id' => $request->get('sourcing_emp_id'),
            'closing_emp_id' => $request->get('closing_emp_id'),
            'team_id' => $request->get('team_id'),
            'leadsource_id' => $request->get('leadsource_id'),
            'booking_id' => $request->get('booking_id'),
            'remark' => $request->get('remark'),
            'BA1_amt_paid' => $request->get('BA1_amt_paid'),
            'BA2_amt_paid' => $request->get('BA2_amt_paid'),
            'registration_date' => $request->get('registration_date'),
            'cv_range' => $request->get('cv_range'),
            'business_value' => $request->get('business_value'),
            'bv_add' => $request->get('bv_add'),
            'total_payout' => $request->get('total_payout'),
            'received_amt' => $request->get('received_amt')

        ]);
        return response()->json($newSalesdetails);
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

            'client_id' => 'required',
            'cp_id' => '',
            'debtor_company_det_id' => '',
            'project_id' => 'required',
            'subproject_id' => '',
            'booking_date' => 'required',
            'building_name' => '',
            'wing' => 'required',
            'flat_no' => 'required',
            'consideration_value' => 'required',
            'case_payout_percentage' => '',
            'extra_payout_percentage' => '',
            'extra_payout_value' => '',
            'net_extra_payout' => '',
            'payout_value' => '',
            'deal_status_id' => '',
            'shared_payout' => '',
            'net_payout' => '',
            'shared_payout_value' => '',
            'net_shared_payout' => '',
            //'pending_invoice_amount' => 'required',
            'payout_status_id' => 'required',
            'sourcing_emp_id' => 'required',
            'closing_emp_id' => 'required',
            'team_id' => 'required',
            'leadsource_id' => 'required',
            'booking_id' => 'required',
            'remark' => '',
            'BA1_amt_paid' => 'required',
            'BA2_amt_paid' => 'required',
            'registration_date' => '',
            'leadreceived_date' => '',
            'cv_range' => '',
            'business_value' => '',
            'shared_deals' => '',
            'bv_add' => '',
            'total_payout' => '',
            'received_amt' => ''
        ]);

        $newSalesdetails = new Salesdetails([

            'client_id' => $request->get('client_id'),
            'debtor_company_det_id' => $request->get('debtor_company_det_id'),
            'project_id' => $request->get('project_id'),
            'subproject_id' => $request->get('subproject_id'),
            'booking_date' => $request->get('booking_date'),
            'building_name' => $request->get('building_name'),
            'wing' => $request->get('wing'),
            'flat_no' => $request->get('flat_no'),
            'consideration_value' => $request->get('consideration_value'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            'extra_payout_percentage' => $request->get('extra_payout_percentage'),
            'extra_payout_value' => $request->get('extra_payout_value'),
            'net_extra_payout' => $request->get('net_extra_payout'),
            'payout_value' => $request->get('payout_value'),
            'deal_status_id' => $request->get('deal_status_id'),
            'cp_id' => $request->get('cp_id'),
            'shared_payout' => $request->get('shared_payout'),
            'shared_payout_value' => $request->get('shared_payout_value'),
            'net_payout' => $request->get('net_payout'),
            'net_shared_payout' => $request->get('net_shared_payout'),
            //'pending_invoice_amount' => $request->get('pending_invoice_amount'),
            'payout_status_id' => $request->get('payout_status_id'),
            'sourcing_emp_id' => $request->get('sourcing_emp_id'),
            'closing_emp_id' => $request->get('closing_emp_id'),
            'team_id' => $request->get('team_id'),
            'leadsource_id' => $request->get('leadsource_id'),
            'booking_id' => $request->get('booking_id'),
            'remark' => $request->get('remark'),
            'BA1_amt_paid' => $request->get('BA1_amt_paid'),
            'BA2_amt_paid' => $request->get('BA2_amt_paid'),
            'registration_date' => $request->get('registration_date'),
            'leadreceived_date' => $request->get('leadreceived_date'),
            'cv_range' => $request->get('cv_range'),
            'business_value' => $request->get('business_value'),
            'bv_add' => $request->get('bv_add'),
            'shared_deals' => $request->get('shared_deals'),
            'total_payout' => $request->get('total_payout'),
            'received_amt' => $request->get('received_amt')
        ]);

        $newSalesdetails->save();

        return response()->json($newSalesdetails);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($sales_id)
    {
        // by jatin
        $salesdetails = Salesdetails::findOrFail($sales_id);
        $client = Salesdetails::findOrFail($sales_id)->client;
        return response()->json(["sale" => $salesdetails, "client" => $client]);
        // by jatin
    }


    // public function show(Request $request, $sales_id)
    // {
    //     $salesdetails = DB::table('salesdetails')
    //         ->select('salesdetails.*', 'channelpartner.cp_name', 'projects.project_name')
    //         ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
    //         ->leftjoin('channelpartner', 'channelpartner.cp_id', '=', 'salesdetails.cp_id')

    //         ->where('sales_id', $sales_id)
    //         ->first();
    //     return response()->json($salesdetails);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sales_id)
    {

        $salesdetails = Salesdetails::findOrFail($sales_id);

        $salesdetails = Salesdetails::find($sales_id);
        $salesdetails->update($request->all());
        return response()->json($salesdetails);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sales_id)
    {
        $salesdetails = Salesdetails::findOrFail($sales_id);
        $salesdetails->delete();

        return response()->json($salesdetails::all());
    }

    public function getTableColumns()
    {
        //return DB::getSchemaBuilder()->getColumnListing($salesdetails);

        // OR

        //return Schema::getColumnListing($table);

        $salesdetails = new Salesdetails;

        $table = $salesdetails->getTable();

        $columns = Schema::getColumnListing($table);

        //dd($columns);
        return $columns;
    }

    public function getSalesCount()
    {


        $leadsource = Leadsource::all();
        $leadsource = DB::table('leadsource')
            ->pluck('leadsource')
            ->toArray();
        $data1 = response()->json($leadsource);
        $leadsource1 = $data1->getData();
        $length = count($leadsource1);
        for ($i = 0; $i < $length; $i++) {

            $salesdetails[] = DB::table('salesdetails')
                ->join('leadsource', 'leadsource.leadsource_id', '=', 'salesdetails.leadsource_id')
                ->select('leadsource.leadsource')
                ->where('leadsource', $leadsource1[$i])
                ->get();
        }
        for ($i = 0; $i < count($salesdetails); $i++) {
            $count[] = count($salesdetails[$i]);
        }
        return response()->json($count);
    }

    public function getApply($data)
    {
        $data1 = explode(',', $data);
        $date1 = $data1[0];
        $date2 = $data1[1];

        $leadsource = Leadsource::all();
        $leadsource = DB::table('leadsource')
            ->pluck('leadsource')
            ->toArray();
        $data1 = response()->json($leadsource);

        $leadsource1 = $data1->getData();

        $length = count($leadsource1);
        for ($i = 0; $i < $length; $i++) {

            $salesdetails[] = DB::table('salesdetails')
                ->join('leadsource', 'leadsource.leadsource_id', '=', 'salesdetails.leadsource_id')
                ->select('leadsource.leadsource')
                ->where('leadsource', $leadsource1[$i])
                ->whereBetween('salesdetails.booking_date', [$date1, $date2])
                ->get();
        }
        for ($i = 0; $i < count($salesdetails); $i++) {
            $count[] = count($salesdetails[$i]);
        }
        return response()->json($count);
    }
    // used in add or edit invoice 
    public function getsales($client_id)
    {
        $sales = DB::table('salesdetails')
            ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
            ->select('salesdetails.*', 'projects.project_name')
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereIn('salesdetails.payout_status_id', [3, 4])
            ->where('client_id', $client_id)
            ->get();
        return response()->json($sales);
    }
    // used in add or edit invoice 

    public function getbookingid()
    {
        $sales = DB::table('salesdetails')
            ->select('salesdetails.*')
            ->orderBy('sales_id', 'DESC')
            ->get();
        return response()->json($sales);
    }

    //shikha*ReportModule//
    public function monthwisedata($booking_date)
    {

        $data1 = DB::table('salesdetails')
            ->select('*')
            ->where('booking_date', $booking_date)
            ->get();

        return response()->json($data1);
    }
    public function monthwisedatalist($booking_date)
    {
        $dateValue = explode('-', $booking_date);
        $datelead = DB::table('salesdetails')
            ->select('*')
            ->whereRaw("deal_status_id = '1'")
            ->whereMonth('booking_date', '=', $dateValue[1])
            ->whereYear('booking_date', '=', $dateValue[0])
            ->get();
        return response()->json($datelead);
    }
    public function monthfilterdata($booking_date)
    {
        // $newData = [0,0,0,0,0,0,0,0,0,0,0,0];
        $dateValue = explode('-', $booking_date);
        $datelead = DB::table('salesdetails')
            ->select('salesdetails.booking_date')
            ->whereRaw("deal_status_id = '1'")
            ->whereMonth('booking_date', '=', $dateValue[1])
            ->whereYear('booking_date', '=', $dateValue[0])
            ->get();

        return response()->json($datelead);
    }


    public function getdatevalue()
    {
        $monthyear = DB::table('salesdetails')
            ->select(DB::raw('DISTINCT(DATE_FORMAT(booking_date,"%M %Y")) as date'))
            ->where(DB::raw('YEAR(booking_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->get();
        $dateOfData = array();
        foreach ($monthyear as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->date;
        }

        for ($i = 1; $i < 13; $i++) {
            foreach ($dateOfData as $key => $value) {
                $month_no = explode("/", $key);
                if ($month_no[0] === sprintf('%02d', $i)) {
                    $fullmonths[$key] = $value;
                    continue 2;
                }
            }
            $fullmonths[sprintf('%02d', $i) . date('Y')] = 0;
        }
        foreach ($fullmonths as $key => $value) {
            $dateOfData3[] = $value;
        }
        return response()->json($dateOfData3);
    }

    public function getamountmonth()
    {
        $monthyear = DB::table('salesdetails')
            ->select(DB::raw('SUM(business_value) as amount'))
            ->where(DB::raw('YEAR(booking_date)'), '=', DB::raw('YEAR(CURDATE())-1'))
            ->groupBy(DB::raw('DATE_FORMAT(booking_date,"%M-%Y")'))
            ->orderBy(DB::raw('Month(booking_date)'))
            ->get();
        foreach ($monthyear as $key => $value) {
            $amount[] = $value->amount;
        }
        $array = ($amount);
        print_r(max($array));
        print_r("\n");
        print_r(min($array));
        return response()->json($array);
    }
    public function getSalesCountReport()
    {
        $salesdetails = DB::table('salesdetails')
            ->select(DB::raw('COUNT(deal_status_id ) as dsd'), DB::raw('SUM(business_value) as amount'), DB::raw('DATE_FORMAT(booking_date,"%M-%Y") as date'), DB::raw("(COUNT(*)) as count"))
            ->where(DB::raw('YEAR(booking_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->whereRaw("deal_status_id = '1'")
            ->groupBy(DB::raw('DATE_FORMAT(booking_date,"%M-%Y")'))
            ->get();
        $dateOfData = array();
        foreach ($salesdetails as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->amount;
            $dsd[] = $value->dsd;
        }

        for ($i = 1; $i < 13; $i++) {
            foreach ($dateOfData as $key => $value) {
                $month_no = explode("/", $key);
                if ($month_no[0] === sprintf('%02d', $i)) {
                    $fullmonths[$key] = $value;
                    continue 2;
                }
            }
            $fullmonths[sprintf('%02d', $i) . date('Y')] = 0;
        }
        foreach ($fullmonths as $key => $value) {
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }
}
