<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InvoiceMulti;
//use DB   
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Disbursement;

class InvoiceMultiController extends Controller
{
    // by jatin
    // by jatin

    public function getDisbursements($disb_id)
    {
        $disbursementType = DB::table('tbl_hlsanction')
            ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
            ->join('tbl_hldisbursement', 'tbl_hldisbursement.sanction_id', '=', 'tbl_hlsanction.sanction_id')
            ->select('bank_details.payout_on')
            ->where('tbl_hldisbursement.disb_id', $disb_id)
            ->get();
        // return response()->json($disbursementType);
        if (count($disbursementType) > 0) {

            if ($disbursementType[0]->payout_on == 'sanction') {
                $disbursement = DB::table('tbl_hlsanction')

                    ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
                    ->join('tbl_hldisbursement', 'tbl_hldisbursement.sanction_id', '=', 'tbl_hlsanction.sanction_id')
                    ->join('tbl_hlclients', 'tbl_hlclients.client_id', '=', 'tbl_hlsanction.client_id')

                    ->select('tbl_hldisbursement.client_id', 'tbl_hldisbursement.disb_id', 'tbl_hlsanction.sanction_id', 'bank_details.payout_on', 'bank_details.bank_id', 'bank_details.bank_name', 'tbl_hlsanction.sanction_loan_amt as disb_amt', 'tbl_hlsanction.sanction_date as disb_date', DB::raw("CONCAT(tbl_hlclients.fname,'_',tbl_hlclients.lname,'-',tbl_hldisbursement.File_no) AS name"))
                    ->where('tbl_hldisbursement.disb_id', $disb_id)
                    ->get();
                return response()->json($disbursement);
            } else if ($disbursementType[0]->payout_on == 'net_disbursement') {
                $disbursement = DB::table('tbl_hlsanction')

                    ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
                    ->join('tbl_hldisbursement', 'tbl_hldisbursement.sanction_id', '=', 'tbl_hlsanction.sanction_id')
                    ->join('tbl_hlclients', 'tbl_hlclients.client_id', '=', 'tbl_hlsanction.client_id')

                    ->select('tbl_hldisbursement.client_id', 'tbl_hldisbursement.disb_id', 'tbl_hlsanction.sanction_id', 'bank_details.payout_on', 'bank_details.bank_id', 'bank_details.bank_name', 'tbl_hldisbursement.disb_amt as disb_amt', 'tbl_hldisbursement.disb_date as disb_date', DB::raw("CONCAT(tbl_hlclients.fname,'_',tbl_hlclients.lname,'-',tbl_hldisbursement.File_no) AS name"))
                    ->where('tbl_hldisbursement.disb_id', $disb_id)
                    ->get();
                return response()->json($disbursement);
            }

        } else {
            return response()->json(['message' => 'not found']);

        }

        // $disburse = DB::table('tbl_hlsanction')
        //     ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
        //     ->select('tbl_hlsanction.*')
        //     ->where('tbl_hlsanction.client_id', $client_id)
        //     ->get();
        // return response()->json($disburse);
    }
    // get inv type id
    public function checkMaxPayout(Request $request)
    {

        $client = $request->input('client_id');
        $taxable_amt = $request->input('taxable_amt');
        $invMultiId = $request->input('invoice_multi_id');

        $InvoiceDetids = DB::table('salesdetails')
            ->select('salesdetails.net_payout')
            ->where('salesdetails.client_id', $client)
            ->get();

        // if ($InvoiceDetids->first()->net_payout < $taxable_amt) {
        if (count($InvoiceDetids) > 0) {
            if ($InvoiceDetids[0]->net_payout < $taxable_amt) {
                return response()->json(["isGreater" => true, "net_payout" => $InvoiceDetids->first()->net_payout]);
            } else {
                return response()->json(["isGreater" => false, "net_payout" => $InvoiceDetids->first()->net_payout]);
            }
        } else {
            return response()->json(["message" => "not found"]);
        }
    }
    public function getRealestateClients($id)
    {
        $data1 = DB::table('salesdetails')
            ->join('clientdetails', 'clientdetails.client_id', '=', 'salesdetails.client_id')
            ->select('clientdetails.client_id', 'clientdetails.name')
            ->where('salesdetails.debtor_company_det_id', $id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereIn('salesdetails.payout_status_id', [3, 4])
            ->get();
        return response()->json($data1);
    }
    public function getHomeloansClients($id)
    {   // first check payout_on if sanction or net_disbursement
        $data = DB::table('tbl_hlsanction')
            ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
            ->join('tbl_hlclients', 'tbl_hlclients.client_id', '=', 'tbl_hlsanction.client_id')
            ->join('tbl_hldisbursement', 'tbl_hldisbursement.client_id', '=', 'tbl_hlsanction.client_id')
            ->where('bank_details.bank_id', $id)
            ->select('tbl_hlclients.client_id', 'tbl_hldisbursement.disb_id', DB::raw("CONCAT(tbl_hlclients.fname,'_',tbl_hlclients.lname,'-',tbl_hldisbursement.File_no) AS name"))
            ->get();
        return response()->json($data);
    }
    // by jatin
    // by jatin
    // get inv type id
    public function getInvTypeId($invID)
    {
        $InvoiceMulti = DB::table('invoice_multi')
            ->select('invoice_multi.invoice_type_id')
            ->where('invoice_multi.invoice_multi_id', $invID)
            ->get();
        return response()->json($InvoiceMulti);
    }
    // get invoice multi & invoice_detids
    public function getInvoice($invID, $invTypeId)
    {
        // get INVOICE MULTI
        $InvoiceMulti = DB::table('invoice_multi')
            ->select('*')
            // ->join('invoicedetids','invoicedetids.invoice_multi_id','=','invoice_multi.invoice_multi_id')
            ->where('invoice_multi.invoice_multi_id', $invID)
            ->get();

        // get INVOICE_DETIDS
        if ($invTypeId == 1) {
            $InvoiceDetids = DB::table('invoicedetids')
                // ->select('invoicedetids.*')
                ->select('invoicedetids.*', 'projects.project_name', 'salesdetails.flat_no', 'salesdetails.wing', 'salesdetails.building_name')
                ->join('salesdetails', 'salesdetails.client_id', '=', 'invoicedetids.client_id')
                ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
                ->where('invoicedetids.invoice_multi_id', $invID)
                ->get();
        } else if ($invTypeId == 2) {
            $InvoiceDetids = DB::table('invoicedetids')
                // ->select('invoicedetids.*')
                ->select('invoicedetids.*', 'tbl_hldisbursement.disb_amt', 'tbl_hldisbursement.disb_date')
                ->join('tbl_hldisbursement', 'tbl_hldisbursement.client_id', '=', 'invoicedetids.client_id')
                ->where('invoicedetids.invoice_multi_id', $invID)
                ->get();

            // $disbursementType = DB::table('tbl_hlsanction')
            //     ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
            //     ->join('tbl_hldisbursement', 'tbl_hldisbursement.sanction_id', '=', 'tbl_hlsanction.sanction_id')
            //     ->select('bank_details.payout_on')
            //     ->where('tbl_hldisbursement.disb_id', $disb_id)
            //     ->get();
            // // return response()->json($disbursementType);
            // if (count($disbursementType) > 0) {

            //     if ($disbursementType[0]->payout_on == 'sanction') {
            //         $disbursement = DB::table('tbl_hlsanction')

            //             ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
            //             ->join('tbl_hldisbursement', 'tbl_hldisbursement.sanction_id', '=', 'tbl_hlsanction.sanction_id')
            //             ->join('tbl_hlclients', 'tbl_hlclients.client_id', '=', 'tbl_hlsanction.client_id')

            //             ->select('tbl_hldisbursement.client_id', 'tbl_hldisbursement.disb_id', 'tbl_hlsanction.sanction_id', 'bank_details.payout_on', 'bank_details.bank_id', 'bank_details.bank_name', 'tbl_hlsanction.sanction_loan_amt as disb_amt', 'tbl_hlsanction.sanction_date as disb_date', DB::raw("CONCAT(tbl_hlclients.fname,'_',tbl_hlclients.lname,'-',tbl_hldisbursement.File_no) AS name"))
            //             ->where('tbl_hldisbursement.disb_id', $disb_id)
            //             ->get();
            //         return response()->json($disbursement);
            //     } else if ($disbursementType[0]->payout_on == 'net_disbursement') {
            //         $disbursement = DB::table('tbl_hlsanction')

            //             ->join('bank_details', 'bank_details.bank_id', '=', 'tbl_hlsanction.bank_name')
            //             ->join('tbl_hldisbursement', 'tbl_hldisbursement.sanction_id', '=', 'tbl_hlsanction.sanction_id')
            //             ->join('tbl_hlclients', 'tbl_hlclients.client_id', '=', 'tbl_hlsanction.client_id')

            //             ->select('tbl_hldisbursement.client_id', 'tbl_hldisbursement.disb_id', 'tbl_hlsanction.sanction_id', 'bank_details.payout_on', 'bank_details.bank_id', 'bank_details.bank_name', 'tbl_hldisbursement.disb_amt as disb_amt', 'tbl_hldisbursement.disb_date as disb_date', DB::raw("CONCAT(tbl_hlclients.fname,'_',tbl_hlclients.lname,'-',tbl_hldisbursement.File_no) AS name"))
            //             ->where('tbl_hldisbursement.disb_id', $disb_id)
            //             ->get();
            //         return response()->json($disbursement);
            //     }

            // } else {
            //     return response()->json(['message' => 'not found']);

            // }

        } else {
            $InvoiceDetids = [];
        }
        return response()->json(["invMultiData" => $InvoiceMulti, "invDetidsData" => $InvoiceDetids]);
    }
    public function updateInvoice(Request $request)
    {
        $invoice = InvoiceMulti::find($request->input('invoice_multi_id'));
        $invoice->invoice_date = $request->input('invoice_date');
        $invoice->cgst_amt = $request->input('cgst_amt');
        $invoice->sgst_amt = $request->input('sgst_amt');
        $invoice->igst_amt = $request->input('igst_amt');
        $invoice->total_gst_amt = $request->input('total_gst_amt');
        $invoice->total_invoice_amt = $request->input('total_invoice_amt');
        $invoice->tds_rate = $request->input('tds_rate');
        $invoice->receivable_tds_amt = $request->input('receivable_tds_amt');
        $invoice->receivable_amt = $request->input('receivable_amt');
        $invoice->received_amt = $request->input('received_amt');
        $invoice->due_amt = $request->input('due_amt');
        $invoice->inv_submitted_date = $request->input('inv_submitted_date');
        $invoice->save();

        return response()->json($invoice);
    }
    // by jatin
    // by jatin

    public function index()
    {
        $InvoiceMulti = InvoiceMulti::all();
        $InvoiceMulti = DB::table('invoice_multi')
            ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
            ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice_multi.inv_status_id')
            ->select('invoice_multi.*', 'invoice_multi.invoice_multi_id', 'invoice_multi.invoice_num', 'invoice_multi.company_id', 'invoice_multi.total_gst_amt', 'debtor_company_det.cname', 'debtor_company_det.gst_no', 'inv_status.status')
            // ->select('invoice_multi.invoice_multi_id','invoice_multi.invoice_num','invoice_multi.company_id','invoice_multi.total_gst_amt','debtor_company_det.cname', 'debtor_company_det.cgst','inv_status.status')
            ->orderBy('invoice_multi.updated_at', 'DESC')
            ->get();
        return response()->json($InvoiceMulti);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newInvoiceMulti = new InvoiceMulti([

            'client_id' => $request->get('client_id'),
            'company_id' => $request->get('company_id'),
            'sales_id' => $request->get('sales_id'), //not
            'invoice_num' => $request->get('invoice_num'),
            'gst_no' => $request->get('gst_no'),
            'invoice_date' => $request->get('invoice_date'),
            'payout_percentage' => $request->get('payout_percentage'), //not
            'taxable_amt' => $request->get('taxable_amt'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_invoice_amt' => $request->get('total_invoice_amt'),
            'tds_rate' => $request->get('tds_rate'),
            'receivable_tds_amt' => $request->get('receivable_tds_amt'),
            'receivable_amt' => $request->get('receivable_amt'),
            'received_amt' => $request->get('received_amt'),
            'suspense_amt' => $request->get('suspense_amt'), //not
            'inv_status_id' => $request->get('inv_status_id'),
            'inv_submitted_date' => $request->get('inv_submitted_date'),
            'due_amt' => $request->get('due_amt'),
            'credit_note_amt' => $request->get('credit_note_amt'), //not
            'invoice_type_id' => $request->get('invoice_type_id')
        ]);
        // return response()->json($newInvoiceMulti);
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


            // 'client_id' => '',
            'sales_id' => '',
            'company_id' => 'required',
            'gst_no' => '',
            'invoice_num' => 'required|unique:invoice_multi,invoice_num',
            'invoice_date' => 'required',
            'invoice_type_id' => '',
            'payout_percentage' => '',
            'taxable_amt' => 'required',
            'cgst_amt' => 'required',
            'sgst_amt' => 'required',
            'igst_amt' => '',
            'total_gst_amt' => 'required',
            'total_invoice_amt' => 'required',
            'tds_rate' => 'required',
            'receivable_tds_amt' => 'required',
            'receivable_amt' => 'required',
            'received_amt' => '',
            'suspense_amt' => '',
            'due_amt' => '',
            'credit_note_amt' => '',
            'inv_status_id' => 'required',
            'inv_submitted_date' => 'required'
        ]);

        $newInvoiceMulti = new InvoiceMulti([


            // 'client_id' => $request->get('client_id'),
            'company_id' => $request->get('company_id'),
            'sales_id' => $request->get('sales_id'),
            'gst_no' => $request->get('gst_no'),
            'invoice_num' => $request->get('invoice_num'),
            'invoice_date' => $request->get('invoice_date'),
            'payout_percentage' => $request->get('payout_percentage'),
            'taxable_amt' => $request->get('taxable_amt'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_invoice_amt' => $request->get('total_invoice_amt'),
            'tds_rate' => $request->get('tds_rate'),
            'receivable_tds_amt' => $request->get('receivable_tds_amt'),
            'receivable_amt' => $request->get('receivable_amt'),
            'received_amt' => $request->get('received_amt'),
            'suspense_amt' => $request->get('suspense_amt'),
            'inv_status_id' => $request->get('inv_status_id'),
            'inv_submitted_date' => $request->get('inv_submitted_date'),
            'due_amt' => $request->get('due_amt'),
            'credit_note_amt' => $request->get('credit_note_amt'),
            'invoice_type_id' => $request->get('invoice_type_id')
        ]);

        $newInvoiceMulti->save();

        return response()->json($newInvoiceMulti);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //     public function show($invoice_multi_id)
    //     {
    //         $InvoiceMulti = DB::table('invoice_multi')
    //         ->join('invoicedetids','invoicedetids.invoice_multi_id','=','invoice_multi.invoice_multi_id')
    //         ->join('clientdetails', 'clientdetails.client_id','=','invoicedetids.client_id')
    //         ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice_multi.inv_status_id')
    //         ->join('salesdetails', 'salesdetails.client_id', '=', 'invoicedetids.client_id')
    //         ->join('projects','projects.project_id','=','salesdetails.project_id')
    //         ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id','=','invoice_multi.company_id')
    //         ->select('invoice_multi.*','clientdetails.name','projects.project_name','clientdetails.client_id','salesdetails.*','debtor_company_det.*','inv_status.*','invoicedetids.*')
    //         ->where('invoice_multi.invoice_multi_id',$invoice_multi_id)
    //         ->get();
    // 		return response()->json($InvoiceMulti);

    //     }


    public function show($invoice_multi_id)
    {
        //  $InvoiceMulti = DB::table('invoice_multi')
        //  ->join('invoicedetids','invoicedetids.invoice_multi_id','=','invoice_multi.invoice_multi_id')
        //  ->join('clientdetails', 'clientdetails.client_id','=','invoicedetids.client_id')
        //  ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice_multi.inv_status_id')
        //  ->join('salesdetails', 'salesdetails.client_id', '=', 'invoicedetids.client_id')
        //  ->join('projects','projects.project_id','=','salesdetails.project_id')
        //  ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id','=','invoice_multi.company_id')
        //  ->select('invoice_multi.','clientdetails.name','projects.project_name','clientdetails.client_id','salesdetails.','debtor_company_det.','inv_status.','invoicedetids.*')
        //  ->where('invoice_multi.invoice_multi_id',$invoice_multi_id)
        //  ->toSql();
        //  return response()->json($InvoiceMulti);
        $InvoiceMulti = DB::table('invoice_multi')
            ->select(
                'invoice_multi.*',
                'salesdetails.sales_id',
                'invoicedetids.taxable_amt',
                'invoicedetids.credit_note_amt',
                'salesdetails.flat_no',
                'salesdetails.wing',
                'salesdetails.building_name',
                'salesdetails.case_payout_percentage',
                'salesdetails.consideration_value',
                'clientdetails.name',
                'debtor_company_det.cname',
                'projects.project_name',
                'tbl_hldisbursement.disb_date',
                'tbl_hldisbursement.disb_amt',
                'invoicedetids.case_payout_percentage',
                'invoicedetids.discription',
                'invoicedetids.consideration_value',
                'tblcreditnote_multi.total_creditnote_amt'
            )


            // ->select('invoice_multi.*', 'invoicedetids.*','salesdetails.sales_id','invoicedetids.taxable_amt', 'salesdetails.flat_no', 'salesdetails.wing', 'salesdetails.building_name', 'salesdetails.case_payout_percentage', 'salesdetails.consideration_value', 'clientdetails.name', 'debtor_company_det.cname', 'projects.project_name')
            // ->select('invoice_multi.*','salesdetails.sales_id','invoicedetids.taxable_amt', 'salesdetails.flat_no', 'salesdetails.wing', 'salesdetails.building_name', 'salesdetails.case_payout_percentage', 'salesdetails.consideration_value', 'clientdetails.name', 'debtor_company_det.cname', 'projects.project_name')

            ->leftjoin('tblcreditnote_multi', 'tblcreditnote_multi.invoice_num', '=', 'invoice_multi.invoice_num')
            ->leftjoin('invoicedetids', 'invoicedetids.invoice_multi_id', '=', 'invoice_multi.invoice_multi_id')
            ->leftjoin('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
            ->leftjoin('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoicedetids.company_id')
            ->leftjoin('clientdetails', 'clientdetails.client_id', '=', 'invoicedetids.client_id')
            ->leftjoin('projects', 'projects.project_id', '=', 'salesdetails.project_id')
            ->leftjoin('tbl_hldisbursement', 'tbl_hldisbursement.client_id', '=', 'invoicedetids.client_id')
            ->where('invoice_multi.invoice_multi_id', $invoice_multi_id)
            ->get();
        return response()->json($InvoiceMulti);
    }

    public function invoice_multi1($invoice_multi_id)
    {
        //  $InvoiceMulti = DB::table('invoice_multi')
        //  ->join('invoicedetids','invoicedetids.invoice_multi_id','=','invoice_multi.invoice_multi_id')
        //  ->join('clientdetails', 'clientdetails.client_id','=','invoicedetids.client_id')
        //  ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice_multi.inv_status_id')
        //  ->join('salesdetails', 'salesdetails.client_id', '=', 'invoicedetids.client_id')
        //  ->join('projects','projects.project_id','=','salesdetails.project_id')
        //  ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id','=','invoice_multi.company_id')
        //  ->select('invoice_multi.','clientdetails.name','projects.project_name','clientdetails.client_id','salesdetails.','debtor_company_det.','inv_status.','invoicedetids.*')
        //  ->where('invoice_multi.invoice_multi_id',$invoice_multi_id)
        //  ->toSql();
        //  return response()->json($InvoiceMulti);
        $InvoiceMulti = DB::table('invoice_multi')
            ->select('invoice_multi.*', 'invoicedetids.*', 'salesdetails.sales_id', 'invoicedetids.taxable_amt', 'salesdetails.flat_no', 'salesdetails.wing', 'salesdetails.building_name', 'salesdetails.case_payout_percentage', 'salesdetails.consideration_value', 'clientdetails.name', 'debtor_company_det.cname', 'projects.project_name')
            // ->select('invoice_multi.*','salesdetails.sales_id','invoicedetids.taxable_amt', 'salesdetails.flat_no', 'salesdetails.wing', 'salesdetails.building_name', 'salesdetails.case_payout_percentage', 'salesdetails.consideration_value', 'clientdetails.name', 'debtor_company_det.cname', 'projects.project_name')
            ->leftjoin('invoicedetids', 'invoicedetids.invoice_multi_id', '=', 'invoice_multi.invoice_multi_id')
            ->leftjoin('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
            ->leftjoin('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoicedetids.company_id')
            ->leftjoin('clientdetails', 'clientdetails.client_id', '=', 'invoicedetids.client_id')
            ->leftjoin('projects', 'projects.project_id', '=', 'salesdetails.project_id')
            ->where('invoice_multi.invoice_multi_id', $invoice_multi_id)
            ->get();
        return response()->json($InvoiceMulti);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($client_id)
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
    public function update(Request $request, $client_id)
    {
        $InvoiceMulti = InvoiceMulti::findOrFail($client_id);

        $InvoiceMulti = InvoiceMulti::find($client_id);
        $InvoiceMulti->update($request->all());
        return $InvoiceMulti;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {
        $InvoiceMulti = InvoiceMulti::findOrFail($client_id);
        $InvoiceMulti->delete();

        return response()->json($InvoiceMulti::all());
    }

    public function getCgst($id)
    {
        $debtor_company_det = DB::table('debtor_company_det')
            ->select('*')
            ->where('debtor_company_det_id', $id)
            ->get();

        return response()->json($debtor_company_det);
    }

    public function getlastid()
    {
        $debtor_company_det = DB::table('invoice_multi')
            ->select('*')
            ->limit(1)
            ->orderBy('invoice_multi.invoice_multi_id', 'DESC')
            ->get();

        return response()->json($debtor_company_det);
    }
    public function getReceivableamt($id)
    {

        $data = DB::table('invoice_multi')->where('invoice_multi_id', $id)->get();
        return $data;
    }
    public function getclientid2($id)
    {
        $data1 = DB::table('salesdetails')
            ->join('clientdetails', 'clientdetails.client_id', '=', 'salesdetails.client_id')
            ->select('clientdetails.client_id', 'clientdetails.name', 'salesdetails.sales_id')
            ->where('salesdetails.debtor_company_det_id', $id)
            ->where('salesdetails.deal_status_id', '=', 1)
            ->whereIn('salesdetails.payout_status_id', [3, 4])
            ->get();
        return response()->json($data1);
    }


    public function in_Maha(Request $request)
    {
        //dd($request->all());
        $year = $request->get('year');
        $year1 = json_decode($year);
        $month = $request->get('month');

        $month1 = json_decode($month);
        $InvoiceMulti = InvoiceMulti::all();
        $InvoiceMulti = DB::table('invoice_multi')
            ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
            ->select('invoice_date as in_invoice_date', 'payout_percentage as in_payout_percentage', DB::raw('SUM(taxable_amt) as in_taxable_total'), DB::raw('SUM(cgst_amt) as in_ctotal'), DB::raw('SUM(invoice_multi.sgst_amt) as in_stotal'), DB::raw('SUM(igst_amt) as in_itotal'), DB::raw('SUM(total_gst_amt) as in_total_gst_amt'))
            ->where('debtor_company_det.gst_no', 'like', '27%')
            ->whereYear('invoice_date', '=', $year1)
            ->whereMonth('invoice_date', '=', $month1)
            ->groupBy('invoice_date', 'payout_percentage')
            ->get();

        return response()->json($InvoiceMulti);
    }

    public function out_of_Maha(Request $request)
    {
        $year = $request->get('year');
        $year1 = json_decode($year);
        $month = $request->get('month');
        $month1 = json_decode($month);
        $InvoiceMulti = InvoiceMulti::all();
        $outOfMahaInvoice = DB::table('invoice_multi')
            ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
            ->select('invoice_date', 'payout_percentage', DB::raw('SUM(taxable_amt) as taxable_total'), DB::raw('SUM(cgst_amt) as ctotal'), DB::raw('SUM(invoice_multisgst_amt) as stotal'), DB::raw('SUM(igst_amt) as itotal'), DB::raw('SUM(total_gst_amt) as total_gst_amt'))
            ->where('debtor_company_det.gst_no', 'not like', '%27%')
            ->whereYear('invoice_date', '=', $year1)
            ->whereMonth('invoice_date', '=', $month1)
            ->groupBy('invoice_date', 'payout_percentage')
            ->get();

        return response()->json($outOfMahaInvoice);
    }
    public function getallinvoice()
    {

        $tdsrate = InvoiceMulti::all();
        return response()->json($tdsrate);
    }

    function pendinginvoice()
    {
        $pendinginvoice = DB::table('invoice_multi')
            ->select('*')
            //   ->where('inv_status_id','2')
            ->whereIn('inv_status_id', [2, 8])
            ->get();

        return response()->json($pendinginvoice);
    }

    //invoice chart//
    public function getinvoicevalue1()
    {
        $invoData = DB::table('invoice_multi')
            ->select(DB::raw('COUNT(inv_status_id ) as received'), DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date', DB::raw("(COUNT(*)) as count")))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->where('inv_status_id', '=', 1)
            // ->orderBy(DB::raw('Month(invoice_date)'))
            ->groupBy(DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
            ->get();
        // return response()->json($invoData);
        $dateOfData = array();
        foreach ($invoData as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->received;
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }

    //pending count//
    public function getinvoicevalue2()
    {
        $invoData = DB::table('invoice_multi')
            ->select(DB::raw('COUNT(inv_status_id ) as pending'), DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date', DB::raw("(COUNT(*)) as count")))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->where('inv_status_id', '=', 2)
            // ->orderBy(DB::raw('Month(invoice_date)'))
            ->groupBy(DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
            ->get();
        $dateOfData = array();
        foreach ($invoData as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->pending;
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }
    //pending count//
    //partial pending//
    public function getinvoicevalue3()
    {
        $invoData = DB::table('invoice_multi')
            ->select(DB::raw('COUNT(inv_status_id ) as partial'), DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date', DB::raw("(COUNT(*)) as count")))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->where('inv_status_id', '=', 8)
            // ->orderBy(DB::raw('Month(invoice_date)'))
            ->groupBy(DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
            ->get();
        $dateOfData = array();
        foreach ($invoData as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->partial;
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }
    //partial pending//
    //    public function getmonthvalue1 ()
    //    {
    //      $monthyear = DB::table('invoice_multi')
    //      ->select(DB::raw('DISTINCT(DATE_FORMAT(invoice_date,"%M %Y")) as date'))
    //      ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
    //      ->orderBy(DB::raw('Month(invoice_date)'))
    //      ->get();
    //      foreach($monthyear as $key=> $value){
    //              $date[] = $value->date;
    //              //$amount[] = $value->amount;
    //          }

    //   return response()->json($date);
    //       }
    public function getmonthvalue1()
    {
        $invoData = DB::table('invoice_multi')
            ->select(DB::raw('DISTINCT(DATE_FORMAT(invoice_date,"%M %Y")) as date'))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            //  ->orderBy(DB::raw('Month(invoice_date)'))
            ->get();
        $dateOfData = array();
        foreach ($invoData as $key => $value) {
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }

    //invoice sum//
    public function getinvoiceSum1()
    {
        $invoSumData = DB::table('invoice_multi')
            ->select(DB::raw('Sum(received_amt) as received'), DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date', DB::raw("(COUNT(*)) as count")))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->where('inv_status_id', '=', 1)
            // ->orderBy(DB::raw('Month(invoice_date)'))
            ->groupBy(DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
            ->get();
        $sumOfData = array();
        foreach ($invoSumData as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $sumOfData[$dateKey] = $value->received;
        }

        for ($i = 1; $i < 13; $i++) {
            foreach ($sumOfData as $key => $value) {
                $month_no = explode("/", $key);
                if ($month_no[0] === sprintf('%02d', $i)) {
                    $fullmonths[$key] = $value;
                    continue 2;
                }
            }
            $fullmonths[sprintf('%02d', $i) . date('Y')] = 0;
        }
        foreach ($fullmonths as $key => $value) {
            // $dateKey = date('m/Y', strtotime($value->date));
            $sumOfData1[] = $value;
        }
        return response()->json($sumOfData1);
    }
    public function getinvoiceSum2()
    {
        $invoSumData1 = DB::table('invoice_multi')
            ->select(DB::raw('Sum(due_amt) as pending'), DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date', DB::raw("(COUNT(*)) as count")))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->where('inv_status_id', '=', 2)
            // ->orderBy(DB::raw('Month(invoice_date)'))
            ->groupBy(DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
            ->get();

        $dateOfData = array();
        foreach ($invoSumData1 as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->pending;
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }
    public function getinvoiceSum3()
    {
        $invoSumData2 = DB::table('invoice_multi')
            ->select(DB::raw('Sum(received_amt) as partial_pending'), DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date', DB::raw("(COUNT(*)) as count")))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            ->where('inv_status_id', '=', 8)
            // ->orderBy(DB::raw('Month(invoice_date)'))
            ->groupBy(DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
            ->get();

        $dateOfData = array();
        foreach ($invoSumData2 as $key => $value) {
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->partial_pending;
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfDataSum[] = $value;
        }
        return response()->json($dateOfDataSum);
    }

    public function getmonthvalue2()
    {
        $invoData = DB::table('invoice_multi')
            ->select(DB::raw('DISTINCT(DATE_FORMAT(invoice_date,"%M %Y")) as date'))
            ->where(DB::raw('YEAR(invoice_date)'), '=', DB::raw('YEAR(CURDATE())'))
            //  ->orderBy(DB::raw('Month(invoice_date)'))
            ->get();
        $dateOfData = array();
        foreach ($invoData as $key => $value) {
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
            // $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
    }

    public function invomonthwisedatalist($invoice_date)
    {
        $dateValue = explode('-', $invoice_date);
        $datelead = DB::table('invoice_multi')
            // ->select(invoice_multi)
            ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice_multi.inv_status_id')
            ->select('invoice_multi.*', 'inv_status.status')
            ->whereMonth('invoice_date', '=', $dateValue[1])
            ->whereYear('invoice_date', '=', $dateValue[0])
            ->get();
        return response()->json($datelead);
    }

    public function getDisbursement()
    {
        $Disbursement = Disbursement::all();
        return response()->json($Disbursement);
    }


    public function getDisbursement1($client_id)
    {
        $disburse = DB::table('tbl_hldisbursement')
            ->select('tbl_hldisbursement.*')
            ->where('client_id', $client_id)
            ->get();
        return response()->json($disburse);
    }
    // by jatin
    // by jatin
    // by jatin
    // by jatin
    public function invoiceNumExists($num)
    {
        $invNumExists = DB::table('invoice_multi')
            ->select('*')
            ->where('invoice_num', $num)
            ->get();

        if (count($invNumExists)) {
            return response()->json(['bool' => true]);
        } else {
            return response()->json(['bool' => false]);
        }
        // return response()->json($invNumExists);
    }
    // by jatin
    // by jatin
    // by jatin
    // by jatin
}
