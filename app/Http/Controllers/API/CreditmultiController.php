<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\creditmulti;
use App\Models\Invoicedetids;
use Illuminate\Support\Facades\DB;

class CreditmultiController extends Controller
{
    public function index()
    {
        // invoice_multi
        $InvoiceMulti = creditmulti::all();
        $InvoiceMulti = DB::table('tblcreditnote_multi')
        ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'tblcreditnote_multi.company_id')
        ->join('inv_status', 'inv_status.inv_status_id', '=', 'tblcreditnote_multi.inv_status_id')
        ->select('tblcreditnote_multi.*','tblcreditnote_multi.tblcreditnote_multi_id','tblcreditnote_multi.invoice_num','tblcreditnote_multi.company_id','tblcreditnote_multi.total_gst_amt','debtor_company_det.cname', 'debtor_company_det.gst_no','inv_status.status')
        // ->select('tblcreditnote_multi.tblcreditnote_multi_id','tblcreditnote_multi.invoice_num','tblcreditnote_multi.company_id','tblcreditnote_multi.total_gst_amt','debtor_company_det.cname', 'debtor_company_det.cgst','inv_status.status')
        ->orderBy('tblcreditnote_multi.updated_at','DESC')
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
        $newInvoiceMulti = new creditmulti([
            'tblcreditnote_multi_id'=> $request->get('tblcreditnote_multi_id'),
			// 'invoice_multi_id'=> $request->get('invoice_multi_id'),
            'credit_note_number'=> $request->get('credit_note_number'),
            'credit_note_date'=> $request->get('credit_note_date'),
			// 'client_id' => $request->get('client_id'),
            'company_id' => $request->get('company_id'),
            'invoice_num' => $request->get('invoice_num'),
            'gst_no' => $request->get('gst_no'),
            'invoice_date' => $request->get('invoice_date'),
            'case_payout_percentage' => $request->get('case_payout_percentage'),
            'credit_note_taxable' => $request->get('credit_note_taxable'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_creditnote_amt' => $request->get('total_creditnote_amt'),
            'tds_rate' => $request->get('tds_rate'),
            'deductible_tds_amt' => $request->get('deductible_tds_amt'),
            'receivable_amt' => $request->get('receivable_amt'),
            'received_amt' => $request->get('received_amt'),
            'suspense_amt' => $request->get('suspense_amt'),
            'inv_status_id' => $request->get('inv_status_id'),
            'creditnote_submitted_date' => $request->get('creditnote_submitted_date'),
            'due_amt' => $request->get('due_amt'),
            'credit_note_amt' => $request->get('credit_note_amt'),
            'invoice_type_id' => $request->get('invoice_type_id')
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
		
		
            // 'client_id' => '',
            'credit_note_number' => 'required|unique:tblcreditnote_multi,credit_note_number',
            'credit_note_date' => '',
            'company_id' => 'required',
            'gst_no' => '',
            'invoice_num' => '',
            'invoice_date' => '',
            'invoice_type_id' => '',
            'cgst_amt' => 'required',
            'sgst_amt' => 'required',
            'igst_amt'=>'',
            'total_gst_amt' => 'required',
            'total_creditnote_amt' => '',
            'tds_rate' => 'required',
            'deductible_tds_amt' =>'required',
            'inv_status_id' => '',
            'creditnote_submitted_date' => ''
		]);

		$newInvoiceMulti = new creditmulti([
            'tblcreditnote_multi_id'=> $request->get('tblcreditnote_multi_id'),
            // 'invoice_multi_id'=> $request->get('invoice_multi_id'),
            'credit_note_number'=> $request->get('credit_note_number'),
            'credit_note_date'=> $request->get('credit_note_date'),
            // 'client_id' => $request->get('client_id'),
            'company_id' => $request->get('company_id'),
            'gst_no' => $request->get('gst_no'),
            'invoice_num' => $request->get('invoice_num'),
            'invoice_date' => $request->get('invoice_date'),
            'credit_note_taxable' => $request->get('credit_note_taxable'),
            'cgst_amt' => $request->get('cgst_amt'),
            'sgst_amt' => $request->get('sgst_amt'),
            'igst_amt' => $request->get('igst_amt'),
            'total_gst_amt' => $request->get('total_gst_amt'),
            'total_creditnote_amt' => $request->get('total_creditnote_amt'),
            'tds_rate' => $request->get('tds_rate'),
            'deductible_tds_amt' => $request->get('deductible_tds_amt'),
            'inv_status_id' => $request->get('inv_status_id'),
            'creditnote_submitted_date' => $request->get('creditnote_submitted_date'),
            'invoice_type_id' => $request->get('invoice_type_id')
		]);

		$newInvoiceMulti->save();

		return response()->json($newInvoiceMulti);
    }
    

    public function show($tblcreditnote_multi_id)
    {
        // invoice_multi
       $InvoiceMulti = DB::table('tblcreditnote_multi')
       ->select('tblcreditnote_multi.*','debtor_company_det.cname','inv_status.status') //,'tblcreditnote_multi.taxable_amt',
        ->join('inv_status', 'inv_status.inv_status_id', '=', 'tblcreditnote_multi.inv_status_id')
       ->leftjoin('invoicedetids','tblcreditnote_multi.tblcreditnote_multi_id','=','tblcreditnote_multi.tblcreditnote_multi_id')
       ->leftjoin('debtor_company_det','debtor_company_det.debtor_company_det_id','=','tblcreditnote_multi.company_id')
       ->where('tblcreditnote_multi.tblcreditnote_multi_id',$tblcreditnote_multi_id)
       ->first();
       return response()->json($InvoiceMulti);

    }

    

    public function update(Request $request, $tblcreditnote_multi_id)
    {
        $InvoiceMulti = creditmulti::findOrFail($tblcreditnote_multi_id);
		
		$InvoiceMulti = creditmulti::find($tblcreditnote_multi_id);
        $InvoiceMulti->update($request->all());
        return $InvoiceMulti;
    }
    public function destroy($tblcreditnote_multi_id)
    {
        $InvoiceMulti = creditmulti::findOrFail($tblcreditnote_multi_id);
		$InvoiceMulti->delete();

		return response()->json($InvoiceMulti::all());
    }

    public function getCgst($id){
        $debtor_company_det = DB::table('debtor_company_det')
        ->select('*')
        ->where('debtor_company_det_id',$id)
        ->get();
      
		return response()->json($debtor_company_det);

    }

 
    public function getinvoicedate(Request $request){
        // $invoiceDate = DB::table('invoicedetids')
        // ->select('invoice_multi.invoice_date')
        // ->leftjoin('invoice_multi','invoice_multi.invoice_num' ,'=','invoicedetids.invoice_num')
        // ->where('invoicedetids.invoice_num', $request-> id)
        // ->first();
        $invoiceDate = DB::table('invoicedetids')
        ->select('invoice_multi.invoice_date')
        ->leftJoin('invoice_multi', 'invoice_multi.invoice_num', '=', 'invoicedetids.invoice_num')
        ->where('invoicedetids.invoice_num', $request-> id)
        ->limit(1)
        ->first();
    
		return response()->json($invoiceDate);

    }

    public function getclientid2($id){
        $data1=DB::table('salesdetails')
        ->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
        ->select('clientdetails.client_id','clientdetails.name')
        ->where('salesdetails.debtor_company_det_id',$id)
        ->where('salesdetails.deal_status_id', '=', 1)
        ->whereIn('salesdetails.payout_status_id',[3,4])
        ->get();
        return response()->json($data1);
    }


    public function in_Maha(Request $request){
            //dd($request->all());
            $year = $request->get('year');
            $year1 = json_decode($year);
            $month = $request->get('month');

            $month1 = json_decode($month);
            $InvoiceMulti = creditmulti::all();
            $InvoiceMulti = DB::table('invoice_multi')
                    ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
                    ->select('invoice_date as in_invoice_date','case_payout_percentage as in_payout_percentage',DB::raw('SUM(taxable_amt) as in_taxable_total'), DB::raw('SUM(cgst_amt) as in_ctotal'), DB::raw('SUM(invoice_multi.sgst_amt) as in_stotal'),DB::raw('SUM(igst_amt) as in_itotal'),DB::raw('SUM(total_gst_amt) as in_total_gst_amt'))
                    ->where('debtor_company_det.gst_no', 'like', '27%')
                    ->whereYear('invoice_date', '=' ,$year1)
                    ->whereMonth('invoice_date', '=' ,$month1)
                    ->groupBy('invoice_date','case_payout_percentage')
                    ->get();
                    
            return response()->json($InvoiceMulti);
    }

    public function out_of_Maha(Request $request){
            $year = $request->get('year');
            $year1 = json_decode($year);
            $month = $request->get('month');
            $month1 = json_decode($month);
            $InvoiceMulti = creditmulti::all();
            $outOfMahaInvoice = DB::table('invoice_multi')
            ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice_multi.company_id')
            ->select('invoice_date','case_payout_percentage',DB::raw('SUM(taxable_amt) as taxable_total'), DB::raw('SUM(cgst_amt) as ctotal'), DB::raw('SUM(invoice_multisgst_amt) as stotal'),DB::raw('SUM(igst_amt) as itotal'),DB::raw('SUM(total_gst_amt) as total_gst_amt'))
            ->where('debtor_company_det.gst_no', 'not like', '%27%')
            ->whereYear('invoice_date', '=' ,$year1)
            ->whereMonth('invoice_date', '=' ,$month1)  
            ->groupBy('invoice_date','case_payout_percentage')
            ->get();

            return response()->json($outOfMahaInvoice);
    }
    public function getallinvoice(){

        $tdsrate = creditmulti::all();
        return response()->json($tdsrate);
    }

   function pendinginvoice(){
    $pendinginvoice = DB::table('invoice_multi')
                   ->select('*')
                //   ->where('inv_status_id','2')
                   ->whereIn('inv_status_id',[2,8])
                   ->get();

return response()->json($pendinginvoice);
    }
    
    //invoice chart//
      public function getinvoicevalue1 (){
        $invoData = DB::table('invoice_multi')
        ->select( DB::raw('COUNT(inv_status_id ) as received'),DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
        ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
        ->where('inv_status_id','=',1)
        // ->orderBy(DB::raw('Month(invoice_date)'))
        ->groupBy (DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
        ->get();
        // return response()->json($invoData);
        $dateOfData = array();
        foreach($invoData as $key=> $value){
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->received;
        }

        for ($i=1;$i<13;$i++) {
            foreach ($dateOfData as $key => $value) {
                $month_no =  explode("/", $key);
                if ($month_no[0] === sprintf('%02d', $i))
                {
                    $fullmonths[$key] = $value;
                    continue 2;
                }
            }
            $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
          }
          foreach($fullmonths as $key=> $value){
              // $dateKey = date('m/Y', strtotime($value->date));
              $dateOfData1[] = $value;
            }
            return response()->json($dateOfData1);
    }

//pending count//
public function getinvoicevalue2 (){
    $invoData = DB::table('invoice_multi')
        ->select( DB::raw('COUNT(inv_status_id ) as pending'),DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
        ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
        ->where('inv_status_id','=',2)
        // ->orderBy(DB::raw('Month(invoice_date)'))
        ->groupBy (DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
        ->get();
        $dateOfData = array();
        foreach($invoData as $key=> $value){
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->pending;
        }

        for ($i=1;$i<13;$i++) {
            foreach ($dateOfData as $key => $value) {
                $month_no =  explode("/", $key);
                if ($month_no[0] === sprintf('%02d', $i))
                {
                    $fullmonths[$key] = $value;
                    continue 2;
                }
            }
            $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
          }
          foreach($fullmonths as $key=> $value){
              // $dateKey = date('m/Y', strtotime($value->date));
              $dateOfData1[] = $value;
            }
            return response()->json($dateOfData1);
}
//pending count//
//partial pending//
public function getinvoicevalue3 (){
    $invoData = DB::table('invoice_multi')
        ->select( DB::raw('COUNT(inv_status_id ) as partial'),DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
        ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
        ->where('inv_status_id','=',8)
        // ->orderBy(DB::raw('Month(invoice_date)'))
        ->groupBy (DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
        ->get();
        $dateOfData = array();
        foreach($invoData as $key=> $value){
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->partial;
        }

        for ($i=1;$i<13;$i++) {
            foreach ($dateOfData as $key => $value) {
                $month_no =  explode("/", $key);
                if ($month_no[0] === sprintf('%02d', $i))
                {
                    $fullmonths[$key] = $value;
                    continue 2;
                }
            }
            $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
          }
          foreach($fullmonths as $key=> $value){
              // $dateKey = date('m/Y', strtotime($value->date));
              $dateOfData1[] = $value;
            }
            return response()->json($dateOfData1);
}
public function getmonthvalue1 (){
    $invoData = DB::table('invoice_multi')
    ->select(DB::raw('DISTINCT(DATE_FORMAT(invoice_date,"%M %Y")) as date'))
         ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
        //  ->orderBy(DB::raw('Month(invoice_date)'))
         ->get();
$dateOfData = array();
foreach($invoData as $key=> $value){
    $dateKey = date('m/Y', strtotime($value->date));
    $dateOfData[$dateKey] = $value->date;
}

for ($i=1;$i<13;$i++) {
    foreach ($dateOfData as $key => $value) {
        $month_no =  explode("/", $key);
        if ($month_no[0] === sprintf('%02d', $i))
        {
            $fullmonths[$key] = $value;
            continue 2;
        }
    }
    $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
  }
  foreach($fullmonths as $key=> $value){
      // $dateKey = date('m/Y', strtotime($value->date));
      $dateOfData1[] = $value;
    }
    return response()->json($dateOfData1);

  }

//invoice sum//
public function getinvoiceSum1 (){
    $invoSumData = DB::table('invoice_multi')
    ->select( DB::raw('Sum(received_amt) as received'),DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
    ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
    ->where('inv_status_id','=',1)
    // ->orderBy(DB::raw('Month(invoice_date)'))
    ->groupBy (DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
    ->get();
    $sumOfData = array();
    foreach($invoSumData as $key=> $value){
        $dateKey = date('m/Y', strtotime($value->date));
        $sumOfData[$dateKey] = $value->received;
    }
    
    for ($i=1;$i<13;$i++) {
        foreach ($sumOfData as $key => $value) {
            $month_no =  explode("/", $key);
            if ($month_no[0] === sprintf('%02d', $i))
            {
                $fullmonths[$key] = $value;
                continue 2;
            }
        }
        $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
    }
    foreach($fullmonths as $key=> $value){
        // $dateKey = date('m/Y', strtotime($value->date));
        $sumOfData1[] = $value;
    }
    return response()->json($sumOfData1);
}
public function getinvoiceSum2 (){
    $invoSumData1 = DB::table('invoice_multi')
    ->select( DB::raw('Sum(due_amt) as pending'),DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
    ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
    ->where('inv_status_id','=',2)
    // ->orderBy(DB::raw('Month(invoice_date)'))
    ->groupBy (DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
    ->get();
    
    $dateOfData = array();
    foreach($invoSumData1 as $key=> $value){
        $dateKey = date('m/Y', strtotime($value->date));
        $dateOfData[$dateKey] = $value->pending;
    }

    for ($i=1;$i<13;$i++) {
        foreach ($dateOfData as $key => $value) {
            $month_no =  explode("/", $key);
            if ($month_no[0] === sprintf('%02d', $i))
            {
                $fullmonths[$key] = $value;
                continue 2;
            }
        }
        $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
      }
      foreach($fullmonths as $key=> $value){
          // $dateKey = date('m/Y', strtotime($value->date));
          $dateOfData1[] = $value;
        }
        return response()->json($dateOfData1);
}
   public function getinvoiceSum3(){
    $invoSumData2 = DB::table('invoice_multi')
    ->select( DB::raw('Sum(received_amt) as partial_pending'),DB::raw('DATE_FORMAT(invoice_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
    ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
    ->where('inv_status_id','=',8)
    // ->orderBy(DB::raw('Month(invoice_date)'))
    ->groupBy (DB::raw('DATE_FORMAT(invoice_date,"%M-%Y")'))
    ->get();
   
    $dateOfData = array();
    foreach($invoSumData2 as $key=> $value){
        $dateKey = date('m/Y', strtotime($value->date));
        $dateOfData[$dateKey] = $value->partial_pending;
    }

    for ($i=1;$i<13;$i++) {
        foreach ($dateOfData as $key => $value) {
            $month_no =  explode("/", $key);
            if ($month_no[0] === sprintf('%02d', $i))
            {
                $fullmonths[$key] = $value;
                continue 2;
            }
        }
        $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
      }
      foreach($fullmonths as $key=> $value){
          // $dateKey = date('m/Y', strtotime($value->date));
          $dateOfDataSum[] = $value;
        }
        return response()->json($dateOfDataSum);
}

public function getmonthvalue2 (){
    $invoData = DB::table('invoice_multi')
    ->select(DB::raw('DISTINCT(DATE_FORMAT(invoice_date,"%M %Y")) as date'))
         ->where(DB::raw('YEAR(invoice_date)'),'=',DB::raw('YEAR(CURDATE())'))
        //  ->orderBy(DB::raw('Month(invoice_date)'))
         ->get();
$dateOfData = array();
foreach($invoData as $key=> $value){
    $dateKey = date('m/Y', strtotime($value->date));
    $dateOfData[$dateKey] = $value->date;
}

for ($i=1;$i<13;$i++) {
    foreach ($dateOfData as $key => $value) {
        $month_no =  explode("/", $key);
        if ($month_no[0] === sprintf('%02d', $i))
        {
            $fullmonths[$key] = $value;
            continue 2;
        }
    }
    $fullmonths[sprintf('%02d', $i).date('Y')] = 0;  
  }
  foreach($fullmonths as $key=> $value){
      // $dateKey = date('m/Y', strtotime($value->date));
      $dateOfData1[] = $value;
    }
    return response()->json($dateOfData1);

  }

public function invomonthwisedatalist($invoice_date){
    $dateValue = explode('-',$invoice_date);
    $datelead = DB::table('invoice_multi')
                    // ->select(invoice_multi)
                    ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice_multi.inv_status_id')
    ->select('invoice_multi.*','inv_status.status')
                    ->whereMonth('invoice_date', '=', $dateValue[1])
                    ->whereYear('invoice_date', '=', $dateValue[0])
                    ->get();
    return response()->json($datelead);
 }

 public function getDisbursement(){
    $Disbursement = Disbursement::all();
    return response()->json($Disbursement);
 }


 public function getDisbursement1($client_id)
{
    $disburse = DB::table('tbl_hldisbursement')
    ->select('tbl_hldisbursement.*')
    ->where('client_id',$client_id)
    ->get();
return response()->json($disburse);

}
   

public function getinvoicedata1($company_id){
    $data1=DB::table('invoice_multi')
    ->select('company_id','invoice_num','invoice_date')
    ->where('company_id',$company_id)
    ->get();
    return response()->json($data1);
}

public function getinvoicedata2(Request $request){
   


    $invoices = DB::table('invoicedetids')
    ->select('invoicedetids.*', 'projects.project_name', 'salesdetails.flat_no', 'salesdetails.building_name','clientdetails.name')
    ->join('salesdetails', 'salesdetails.sales_id', '=', 'invoicedetids.sales_id')
    ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
    ->join('clientdetails','clientdetails.client_id','=','invoicedetids.client_id')
    ->where('invoicedetids.invoice_num',$request->id )
    ->get();
    return response()->json($invoices);
}


public function getinvoicedata3(Request $request){
   
    $records = Invoicedetids::leftJoin('tblcreditnote_multi', 'invoicedetids.invoice_num', '=', 'tblcreditnote_multi.invoice_num')
    ->whereNull('tblcreditnote_multi.invoice_num')
    ->tosql();
     return response()->json($records);
}
}