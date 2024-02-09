<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\creditdetails;
use Illuminate\Support\Facades\DB;
class CreditdetailsController extends Controller
{
   
    public function index()
    {
        $creditdetails = creditdetails::all();
        return response()->json($creditdetails);
    }

    public function create(Request $request)
    {
        $creditdetails = new creditdetails([
            // "invoicedetids_id"=> $request->get("invoicedetids_id'),
            'tblcreditnote_multi_id' => $request->get('tblcreditnote_multi_id'),
			'invoice_multi_id' => $request->get('invoice_multi_id'),
            'gst_no' => $request->get('gst_no'),
            'invoice_num' => $request->get('invoice_num'),
            'company_id' => $request->get('company_id'),
            'client_id' => $request->get('client_id'),
            'payout_value' => $request->get('payout_value'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            'sales_id' => $request->get('sales_id'),
            'consideration_value' => $request->get('consideration_value'),
            'taxable_amt' => $request->get('taxable_amt'),
            'old_taxable' => $request->get('old_taxable'),
            'credit_note_taxable' => $request->get('credit_note_taxable'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_creditnote_amt' => $request->get('total_creditnote_amt'),
            'tds_rate' => $request->get('tds_rate'),
            'deductible_tds_amt' => $request->get('deductible_tds_amt'),
            'invoice_type_id' => $request->get('invoice_type_id'),
            'discription' => $request->get('discription')
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tblcreditnote_multi_id' => '', 
            'invoice_multi_id' => '',
            'gst_no' => '',
            'company_id' => '',
            'invoice_num' =>'',
            'client_id' => '',
            'old_taxable'=>'',
            'payout_value'=>'',
            'case_payout_percentage'=>'',
            'sales_id'=>'',
            'credit_note_taxable'=>'',
            'total_creditnote_amt'=>'',
            'consideration_value' => '',
            'cgst_amt' => '',
            'sgst_amt' => '',
            'igst_amt'=>'',
            'total_gst_amt' => '',
            'tds_rate' => '',
            'deductible_tds_amt' =>'',
            'invoice_type_id'=>'',
            'discription'=>''
		]);

		$newInvoicedetids = new creditdetails([
            // 'invoicedetids_id'=> $request->get('invoicedetids_id'),
            'tblcreditnote_multi_id'=> $request->get('tblcreditnote_multi_id'),
		    'invoice_multi_id' => $request->get('invoice_multi_id'),
            'gst_no' => $request->get('gst_no'),
            'invoice_num' => $request->get('invoice_num'),
            'company_id' => $request->get('company_id'),
            'client_id' => $request->get('client_id'),
            'payout_value' => $request->get('payout_value'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            'sales_id' => $request->get('sales_id'),
            'consideration_value' => $request->get('consideration_value'),
            'taxable_amt' => $request->get('taxable_amt'),
            'old_taxable' => $request->get('old_taxable'),
            'credit_note_taxable' => $request->get('credit_note_taxable'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_creditnote_amt' => $request->get('total_creditnote_amt'),
            'tds_rate' => $request->get('tds_rate'),
            'deductible_tds_amt' => $request->get('deductible_tds_amt'),
            'invoice_type_id' => $request->get('invoice_type_id'),
            'discription' => $request->get('discription')
		]);

		$newInvoicedetids->save();

		return response()->json($newInvoicedetids);
    }

    // public function show($tblcreditnote_id)
    // {
    //     $invoicedetids = creditdetails::findOrFail($tblcreditnote_id);
	// 	return response()->json($invoicedetids);
    // }

    public function show(Request $request , $invoice_multi_id)
    {
        $invoicedetids = creditdetails::where(['invoice_multi_id'=>$invoice_multi_id] ,$request->id )
        ->get();
		return response()->json($invoicedetids);

    }


    // public function update(Request $request, $invoice_multi_id)
    // {

    //     $invoicedetids = creditdetails::findOrFail($invoice_multi_id);
		
	// 	$invoicedetids = creditdetails::find($invoice_multi_id);
    //     $invoicedetids->update($request->all());
    //     return $invoicedetids;
    // }

    public function update(Request $request, $invoice_multi_id)
    {
        $invoicedetids = creditdetails::findOrFail($invoice_multi_id);
        $creditnote_up['credit_note_taxable'] = $request->credit_note_taxable ;
        $invoicedetids = creditdetails::where('tblcreditnote_id', '=', $request->tblcreditnote_id);
        $invoicedetids->update($creditnote_up);
        return response()->json($invoicedetids);
    }

//     public function update(Request $request, $invoice_multi_id)
// {
//     try {
//         $invoicedetids = creditdetails::findOrFail($invoice_multi_id);

//         $creditnote_up['credit_note_taxable'] = $request->credit_note_taxable;
//         $invoicedetids = creditdetails::where('tblcreditnote_id', '=', $request->tblcreditnote_id);
//         $invoicedetids->update($creditnote_up);

//         return response()->json($invoicedetids);
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }


  

    

    public function destroy($tblcreditnote_id)
    {
        $invoicedetids = creditdetails::findOrFail($tblcreditnote_id);
		$invoicedetids->delete();

		return response()->json($invoicedetids::all());
    }

    public function getinvoicedataforCredit(Request $request){
    $invoices = DB::table('tblcreditnotedetails')
    ->select('tblcreditnotedetails.*','projects.project_name','salesdetails.flat_no', 'salesdetails.building_name','clientdetails.name')
    ->join('salesdetails', 'salesdetails.sales_id', '=', 'tblcreditnotedetails.sales_id')
    ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
    ->join('clientdetails','clientdetails.client_id','=','tblcreditnotedetails.client_id')
    ->where('tblcreditnotedetails.invoice_num',$request->id )
    ->get();
    return response()->json($invoices);
}

// public function getinvoicedataforCredit(Request $request){
//     $invoices = DB::table('tblcreditnotedetails')
//     ->select('tblcreditnotedetails.*', 'projects.project_name','clientdetails.name')
//     ->join('salesdetails', 'salesdetails.sales_id', '=', 'tblcreditnotedetails.sales_id')
//     ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
//     ->join('clientdetails','clientdetails.client_id','=','tblcreditnotedetails.client_id')
//     ->where('tblcreditnotedetails.invoice_num',$request->id )
//     ->get();
//     return response()->json($invoices);
// }


}





