<?php

namespace App\Http\Controllers\API;
use App\Models\ReceiptDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use DB   
use Illuminate\Support\Facades\DB;;

class ReceiptDetailsController extends Controller
{

    public function index()
    {

        // $Receiptdetails = DB::table('receiptdetails')
        // ->orderBy('updated_at', 'DESC')
        // ->get();
        // return response()->json($Receiptdetails);

        $Receiptdetails = DB::table('receiptdetails')
        ->join('invoice_multi', 'invoice_multi.invoice_multi_id', '=', 'receiptdetails.invoice_id')
        ->join('clientdetails', 'clientdetails.client_id', '=', 'receiptdetails.client_id')
        ->select('receiptdetails.*','invoice_multi.invoice_multi_id','invoice_multi.invoice_num','clientdetails.name')
        // ->select('receiptdetails.*','invoice_multi.invoice_multi_id','invoice_multi.invoice_num')
        ->orderBy('receiptdetails.updated_at','DESC')
        ->get();
        return response()->json($Receiptdetails);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newReceiptdetails = new Receiptdetails([
			
			'invoice_id' => $request->get('invoice_id'),
            'payment_mode' => $request->get('payment_mode'),
            'instument_no' => $request->get('instument_no'),
            'received_amt' => $request->get('received_amt'),
            'receivable_amt' => $request->get('receivable_amt'),
            'instument_date' => $request->get('instument_date'),
            'received_taxable_amt' => $request->get('received_taxable_amt'),
            'received_gst_amt' => $request->get('received_gst_amt'),
            'received_tds_amt' => $request->get('received_tds_amt'),
            'credit_date' => $request->get('credit_date'),
            'credit_account' => $request->get('credit_account'),
            'client_id' => $request->get('client_id'),
            'suspense_amount' => $request->get('suspense_amount')

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
            'payment_mode' => 'required',
            'instument_no' => 'required',
            'received_amt' => 'required',
             'receivable_amt' => '',
            'instument_date' => 'required',
            'received_taxable_amt' => 'required',
            'received_gst_amt' => 'required',
            'received_tds_amt' => 'required',
            'credit_date' => 'required',
            'credit_account' => 'required',
            'suspense_amount' => 'required',
            'client_id' => 'required'
		]);

		$newReceiptdetails = new Receiptdetails([

            'invoice_id' => $request->get('invoice_id'),
            'client_id' => $request->get('client_id'),
            'payment_mode' => $request->get('payment_mode'),
            'instument_no' => $request->get('instument_no'),
            'received_amt' => $request->get('received_amt'),
            'receivable_amt' => $request->get('receivable_amt'),
            'instument_date' => $request->get('instument_date'),
            'received_taxable_amt' => $request->get('received_taxable_amt'),
            'received_gst_amt' => $request->get('received_gst_amt'),
            'received_tds_amt' => $request->get('received_tds_amt'),
            'credit_date' => $request->get('credit_date'),
            'credit_account' => $request->get('credit_account'),
            'suspense_amount' => $request->get('suspense_amount'),
		]);

		$newReceiptdetails->save();

		return response()->json($newReceiptdetails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($client_id)
    {
        $receiptdetails = Receiptdetails::findOrFail($client_id);
		return response()->json($receiptdetails);

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

        $receiptdetails = Receiptdetails::findOrFail($client_id);
		
		$receiptdetails = Receiptdetails::find($client_id);
        $receiptdetails->update($request->all());
        return $receiptdetails;

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
    public function destroy($client_id)
    {
        $receiptdetails = Receiptdetails::findOrFail($client_id);
		$receiptdetails->delete();

		return response()->json($receiptdetails::all());
    }
    
  
    public function getreceiptdata($client_id)
    {
        $sales = DB::table('invoicedetids')
        ->join('invoice_multi','invoice_multi.invoice_multi_id','=','invoicedetids.invoice_multi_id')
        ->select('invoicedetids.*','invoice_multi.invoice_multi_id')
        // ->select('invoicedetids.*','invoice_multi.invoice_num','invoice_multi.invoice_multi_id')
        ->where('invoicedetids.client_id','=',$client_id)
        // ->where('invoicedetids.client_id',$client_id)
        ->get();

        return response()->json($sales);
    }
    public function upCreReceipt(Request $request){
       
         $Receiptdetails = new Receiptdetails(
 
            [   'invoice_id' => $request->get('invoice_id'),
                'client_id' => $request->get('client_id'),
                'receivable_amt' => $request->get('receivable_amt'),
                'payment_mode' => $request->get('payment_mode'),
                'instument_no' => $request->get('instument_no'),
                'received_amt' => $request->get('received_amt'),
                'instument_date' => $request->get('instument_date'),
                'received_taxable_amt' => $request->get('received_taxable_amt'),
                'received_gst_amt' => $request->get('received_gst_amt'),
                'received_tds_amt' => $request->get('received_tds_amt'),
                'credit_date' => $request->get('credit_date'),
                'credit_account' => $request->get('credit_account'),
                'suspense_amount' => $request->get('suspense_amount'),
            ]
        );
        
      return response()->json($Receiptdetails);
    }
    
        //shilka*Report module//
    public function getReceiptCountReport()
    {   

      

        $salesdetails = DB::table('receiptdetails')
                         ->select( DB::raw('SUM(received_amt) as amount'),DB::raw('DATE_FORMAT(credit_date,"%M-%Y") as date',DB::raw("(COUNT(*)) as count")))
                         ->where(DB::raw('YEAR(credit_date)'),'=',DB::raw('YEAR(CURDATE())'))
                         ->groupBy (DB::raw('DATE_FORMAT(credit_date,"%M-%Y")'))
                        ->get();
                   
                    $dateOfData = array();
        foreach($salesdetails as $key=> $value){
            $dateKey = date('m/Y', strtotime($value->date));
            $dateOfData[$dateKey] = $value->amount;
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
    
    public function monthwisedatalist1($credit_date){
        $dateValue = explode('-',$credit_date);
        $datelead = DB::table('receiptdetails')
                        ->select('*')
                        ->whereMonth('credit_date', '=', $dateValue[1])
                        ->whereYear('credit_date', '=', $dateValue[0])
                        ->get();
		return response()->json($datelead);
     }
     public function monthfilterdata1($credit_date){
        $dateValue = explode('-',$credit_date);
        $datelead = DB::table('receiptdetails')
                        ->select('*')
                        ->whereMonth('credit_date', '=', $dateValue[1])
                        ->whereYear('credit_date', '=', $dateValue[0])
                      
                        ->get();
		return response()->json($datelead);
     }

     public function getdatevalue1 ()
     {
       $monthyear = DB::table('receiptdetails')
       ->select(DB::raw('DISTINCT(DATE_FORMAT(credit_date,"%M %Y")) as date'))
       ->where(DB::raw('YEAR(credit_date)'),'=',DB::raw('YEAR(CURDATE())'))
    //   ->orderBy(DB::raw('Month(credit_date)'))
       ->get();
    $dateOfData = array();
    foreach($monthyear as $key=> $value){
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
          $dateOfData2[] = $value;
        }
        return response()->json($dateOfData2);
        }
        
        //shikha*ReportModule//
}
