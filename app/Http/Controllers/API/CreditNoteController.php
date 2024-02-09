<?php

namespace App\Http\Controllers\API;
use App\Models\CreditNote;
use App\Models\Invoicedetids;
// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    
    public function index()
    {
        $creditnote = Creditnote::all();
        $creditnote = DB::table('credit_note')
        ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'credit_note.company_id')
        // ->join('invoice', 'invoice.invoice_id', '=', 'credit_note.invoice_id')
        // ->select('credit_note.*','invoice.invoice_id','invoice.invoice_num', 'debtor_company_det.cname','debtor_company_det.debtor_company_det_id')
        ->join('invoicedetids', 'invoicedetids.client_id', '=', 'credit_note.client_id')
        ->join('clientdetails','clientdetails.client_id','=','invoicedetids.client_id')
        ->select('credit_note.*','clientdetails.name','invoicedetids.client_id','invoicedetids.invoice_num', 'debtor_company_det.cname','debtor_company_det.debtor_company_det_id')
        ->orderBy('credit_note.updated_at','DESC')
        ->get();
        return response()->json($creditnote);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newCreditnote = new Creditnote([
			
			'invoice_id' => $request->get('invoice_id'),
            'company_id' => $request->get('company_id'),
            'client_id' => $request->get('client_id'),
            'credit_note_num' => $request->get('credit_note_num'),
            'taxable_amt' => $request->get('taxable_amt'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_credit_note_amt' => $request->get('total_credit_note_amt'),
            'credit_note_submitted_date' => $request->get('credit_note_submitted_date'),
            'credit_note_date' => $request->get('credit_note_date'),
            'icredit_note_status' => $request->get('icredit_note_status')
            
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
		
		
            'invoice_id' => 'required',
            'company_id' => 'required',
            'client_id' => 'required',
            'credit_note_num' => 'required',
           'taxable_amt' => 'required',
            'cgst_amt' => 'required',
            'sgst_amt' =>'required',
            'igst_amt' => 'required',
            'total_gst_amt' => 'required',
            'total_credit_note_amt' => 'required',
            'credit_note_date' => 'required',
            'credit_note_submitted_date' => 'required',
            'icredit_note_status' => 'required'
		]);

		$newCreditnote = new Creditnote([
		
		
            'invoice_id' => $request->get('invoice_id'),
            'company_id' => $request->get('company_id'),
            'client_id' => $request->get('client_id'),
            'credit_note_num' => $request->get('credit_note_num'),
             'taxable_amt' => $request->get('taxable_amt'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_credit_note_amt' => $request->get('total_credit_note_amt'),
            'credit_note_date' => $request->get('credit_note_date'),
            'credit_note_submitted_date' => $request->get('credit_note_submitted_date'),
            'icredit_note_status' => $request->get('icredit_note_status'),
		]);

		$newCreditnote->save();

		return response()->json($newCreditnote);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($credit_note_id)
    {
        $creditnote = DB::table('invoice_multi')
        ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
        ->join('invoicedetids', 'invoicedetids.client_id', '=', 'invoice_multi.client_id')
        ->join('clientdetails','clientdetails.client_id','=','invoicedetids.client_id')
        ->select('invoice_multi.*','clientdetails.name','invoicedetids.client_id','invoicedetids.invoice_num', 'debtor_company_det.cname','debtor_company_det.debtor_company_det_id')
        // ->select('invoice_multi.*', 'debtor_company_det.cname','debtor_company_det.debtor_company_det_id')
        // ->join('invoice', 'invoice.invoice_id', '=', 'invoice_multi.invoice_id')
        // ->select('invoice_multi.*','invoice.invoice_id','invoice.invoice_num', 'debtor_company_det.cname','debtor_company_det.debtor_company_det_id')
        ->where('invoice_multi.invoice_multi_id',$credit_note_id)
        ->get();
		return response()->json($creditnote);

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

        $creditnote = Creditnote::findOrFail($client_id);
		
		$creditnote = Creditnote::find($client_id);
        $creditnote->update($request->all());
        return $creditnote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {
        $creditnote = Creditnote::findOrFail($client_id);
		$creditnote->delete();

		return response()->json($creditnote::all());
    }
    
    
        function invoiceCreditNote(Request $request)
    {
    // $company_id = $request->get('company_id');
    // $client_id  = $request->get('client_id ');
    // $invoice_multi_id = $request->get('invoice_multi_id');
    // $credit_note_amt = $request->get('credit_note_amt');

    // $data = DB::table('invoicedetids')
    //         ->where('company_id',$company_id)
    //         ->where('client_id',$client_id)
    //         ->where('invoice_multi_id',$invoice_multi_id)
    //         ->update(["credit_note_amt" =>$credit_note_amt]);
    // return response()->json($data);
    $data = Invoicedetids::
    where(['invoice_multi_id' => $request->get('invoice_multi_id'),'client_id' => $request->get('client_id')])
    ->update(['credit_note_amt' =>  $request->get('credit_note_amt')]);
    return $data;
    }
}
