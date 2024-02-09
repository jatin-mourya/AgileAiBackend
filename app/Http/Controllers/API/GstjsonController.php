<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gstjson;
//use DB   
use Illuminate\Support\Facades\DB;;

class GstjsonController extends Controller
{
    public function index()
    {
        $newGstjson = Gstjson::all();
	    	return response()->json($newGstjson);
      
       
    }
    public function create(Request $request)
    {
        $newGstjson = new Gstjson([
			      'ctin' => $request->get('ctin'),
            'num' => $request->get('num'),
            'csamt' => $request->get('csamt'),
            'samt' => $request->get('samt'),
            'rt' => $request->get('rt'),
            'txval' => $request->get('txval'),
            'camt' => $request->get('camt'),
            'val' => $request->get('val'),
            'inv_typ' => $request->get('inv_typ'),
            'flag' => $request->get('flag'),
            'pos' => $request->get('pos'),
            'updby' => $request->get('updby'),
            'idt' => $request->get('idt'),
			       'rchrg' => $request->get('rchrg'),
            'cflag' => $request->get('cflag'),
            'inum' => $request->get('inum'),
            'chksum' => $request->get('chksum'),
            'inv_month' => $request->get('inv_month'),
            'financial_year' => $request->get('financial_year'),
            'financial_month' => $request->get('financial_month'),
            'jsonfilename' => $request->get('jsonfilename')

		]);
    }
    public function store(Request $request)
    {

		$newGstjson = new Gstjson([
            'ctin' => $request->get('ctin'),
            'num' => $request->get('num'),
            'csamt' => $request->get('csamt'),
            'samt' => $request->get('samt'),
            'rt' => $request->get('rt'),
            'txval' => $request->get('txval'),
            'camt' => $request->get('camt'),
            'val' => $request->get('val'),
            'inv_typ' => $request->get('inv_typ'),
            'flag' => $request->get('flag'),
            'pos' => $request->get('pos'),
            'updby' => $request->get('updby'),
            'idt' => $request->get('idt'),
		      	'rchrg' => $request->get('rchrg'),
            'cflag' => $request->get('cflag'),
            'inum' => $request->get('inum'),
            'chksum' => $request->get('chksum'),
            'created_at' => $request->get('created_at'),
            'updated_at' => $request->get('updated_at'),
            'inv_month' => $request->get('inv_month'),
            'financial_year' => $request->get('financial_year'),
            'financial_month' => $request->get('financial_month')
		]);

		$newGstjson->save();

		return response()->json($newGstjson);
    }
    public function jsonupload(Request $request){
        // dd($request);  
        $length =  $request->length;
        for ($i=0; $i < $length; $i++) {
    
          $img[$i] = $request->file('jsonfilename'.$i);
          $name = $request->file('jsonfilename'.$i)->getClientOriginalName();
          $destination = 'public/img';
          $img[$i]->move(('../../Admin-Angular-backup-login-new30/src/app/pages/form/gstdetailslist/_files'), $name);
          $images[] = $name;
          $image1 = new gstjson();
          $image1->jsonfilename = $name;
          $image1->save();
        }
          return response()->json($image1);
      }

    public function invoicejoin($month)
    {
        $newGstjson = Gstjson::all();
        $newGstjson = DB::table('invoice')
        ->join('gst_json', 'gst_json.inum', '=', 'invoice.invoice_num')
        ->select('invoice.*','gst_json.*')
        ->whereMonth('invoice.invoice_date', $month)
        ->get();
		return response()->json($newGstjson);

    }

    public function jsonmonthjoin()
    {
        // dd($month);
        $newGstjson = Gstjson::all();
        $newGstjson = DB::table('gst_json')
                 ->join('month', 'month.id', '=', 'gst_json.financial_month')
                 ->select('inv_month', DB::raw('COUNT(camt) as Jcount'),DB::raw('SUM(camt) as ctotal'), DB::raw('SUM(samt) as stotal'), DB::raw('SUM(csamt) as itotal'),'month.month')
                 ->groupBy('inv_month','month.month')
                 ->get();
		return response()->json($newGstjson);
    }

    public function invmonthjoin()
    {
        $newGstjson = Gstjson::all();
        $newGstjson = DB::table('invoice')
                ->select(DB::raw("DATE_FORMAT(invoice_date, '%Y-%m') as new_date"), DB::raw('SUM(cgst_amt) as invctotal'), DB::raw('COUNT(cgst_amt) as Invcount'), DB::raw('SUM(sgst_amt) as invstotal'), DB::raw('SUM(igst_amt) as invitotal'), DB::raw('SUM(total_gst_amt) as total'))
                ->groupby('new_date')
                ->get();
                
		return response()->json($newGstjson);
    }

    public function updateCreate(Request $request){
      
         $newGstjson = Gstjson::updateOrCreate(
    
          ['inum' => $request->get('inum')],
            [
              'ctin' => $request->get('ctin'),
              'num' => $request->get('num'),
              'csamt' => $request->get('csamt'),
              'samt' => $request->get('samt'),
              'rt' => $request->get('rt'),
              'txval' => $request->get('txval'),
              'camt' => $request->get('camt'),
              'val' => $request->get('val'),
              'inv_typ' => $request->get('inv_typ'),
              'flag' => $request->get('flag'),
              'pos' => $request->get('pos'),
              'updby' => $request->get('updby'),
              'idt' => $request->get('idt'),
              'rchrg' => $request->get('rchrg'),
              'cflag' => $request->get('cflag'),
              'chksum' => $request->get('chksum'),
              'created_at' => $request->get('created_at'),
              'updated_at' => $request->get('updated_at'),
              'inv_month' => $request->get('inv_month'),
              'financial_year' => $request->get('financial_year'),
              'financial_month' => $request->get('financial_month')
            ]
        );
        return response()->json($newGstjson);
      }
}
