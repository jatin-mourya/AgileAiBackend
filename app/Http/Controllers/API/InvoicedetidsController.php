<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoicedetids;
use Illuminate\Support\Facades\DB;

class InvoicedetidsController extends Controller
{

    // by jatin
    // by jatin
    public function updateInvoiceDetids(Request $request)
    {
        $client_id = $request->input('client_id');
        $company_id = $request->input('company_id');
        $invoice_num = $request->input('invoice_num');

        $invoicedetids = Invoicedetids::where('client_id', $client_id)
            ->where('company_id', $company_id)
            ->where('invoice_num', $invoice_num)
            ->first();

        if ($invoicedetids) {
            $invoicedetids->update([
                'case_payout_percentage' => $request->input('case_payout_percentage'),
                'taxable_amt' => $request->input('taxable_amt'),
            ]);
        }
        $updatedRow = Invoicedetids::find($invoicedetids->invoicedetids_id);
        return response()->json($updatedRow);
    }

    public function index()
    {
        $invoicedetids = Invoicedetids::all();
        return response()->json($invoicedetids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newInvoicedetids = new Invoicedetids([

            'invoice_multi_id' => $request->get('invoice_multi_id'),
            'sales_id' => $request->get('sales_id'),
            'gst_no' => $request->get('gst_no'),
            'invoice_num' => $request->get('invoice_num'),
            'company_id' => $request->get('company_id'),
            'client_id' => $request->get('client_id'),
            'payout_value' => $request->get('payout_value'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            //  'payout_percentage' => $request->get('payout_percentage'),
            'consideration_value' => $request->get('consideration_value'),
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
            'due_amt' => $request->get('due_amt'),
            'credit_note_amt' => $request->get('credit_note_amt'),
            'invoice_type_id' => $request->get('invoice_type_id'),
            'discription' => $request->get('discription')
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
            'invoice_multi_id' => 'required',
            'sales_id' => '',
            'gst_no' => '',
            'invoice_num' => '',
            'invoice_type_id' => '',
            'discription',
            'company_id' => 'required',
            'client_id' => '',
            'payout_value' => 'required',
            'case_payout_percentage' => '',
            //  'payout_percentage' => '',
            'consideration_value' => '',
            'taxable_amt' => '',
            'cgst_amt' => '',
            'sgst_amt' => '',
            'igst_amt' => '',
            'total_gst_amt' => '',
            'total_invoice_amt' => '',
            'tds_rate' => '',
            'receivable_tds_amt' => '',
            'receivable_amt' => '',
            'received_amt' => '',
            'suspense_amt' => '',
            'due_amt' => '',
            'credit_note_amt' => ''
        ]);

        $newInvoicedetids = new Invoicedetids([

            'invoice_multi_id' => $request->get('invoice_multi_id'),
            'sales_id' => $request->get('sales_id'),
            'gst_no' => $request->get('gst_no'),
            'invoice_num' => $request->get('invoice_num'),
            'company_id' => $request->get('company_id'),
            'client_id' => $request->get('client_id'),
            'payout_value' => $request->get('payout_value'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            // 'payout_percentage' => $request->get('payout_percentage'),
            'consideration_value' => $request->get('consideration_value'),
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
            'due_amt' => $request->get('due_amt'),
            'credit_note_amt' => $request->get('credit_note_amt'),
            'invoice_type_id' => $request->get('invoice_type_id'),
            'discription' => $request->get('discription')
        ]);

        $newInvoicedetids->save();

        return response()->json($newInvoicedetids);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($invoicedetids_id)
    {
        $invoicedetids = Invoicedetids::findOrFail($invoicedetids_id);
        return response()->json($invoicedetids);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($invoicedetids_id)
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
    public function update(Request $request, $invoicedetids_id)
    {

        $invoicedetids = Invoicedetids::findOrFail($invoicedetids_id);

        $invoicedetids = Invoicedetids::find($invoicedetids_id);
        $invoicedetids->update($request->all());
        return $invoicedetids;

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
    public function destroy($invoicedetids_id)
    {
        $invoicedetids = Invoicedetids::findOrFail($invoicedetids_id);
        $invoicedetids->delete();

        return response()->json($invoicedetids::all());
    }
}
