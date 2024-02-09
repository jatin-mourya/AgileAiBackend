<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\B2binvoice;
// //use DB   use Illuminate\Support\Facades\DB;;
use Illuminate\Support\Facades\DB;

class B2binvoiceController extends Controller
{
    public function index()
    {
        $newb2binvoice = DB::table('b2binvoices')
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json($newb2binvoice);
    }
    public function show($id)
    {
        $b2binvoice = B2binvoice::whereNotNull('inv_no')->findOrFail($id);
		    return response()->json($b2binvoice);
    }
    public function showId($id)
    {
       $B2binvoice =  DB::table('b2binvoices')->whereIn('inv_no', [$id])->get();
      return response()->json($B2binvoice);
    }
    public function create(Request $request)
    {
        $newb2binvoice = new B2binvoice([
          'inv_no' => $request->get('inv_no'),
          'Supp_gstin' => $request->get('Supp_gstin'),
          'party_name' => $request->get('party_name'),
          'inv_dt' => $request->get('inv_dt'),
          'inv_val' => $request->get('inv_val'),
          'rate' => $request->get('rate'),
          'total_tax_val' => $request->get('total_tax_val'),
          'int_tax' => $request->get('int_tax'),
          'central_tax' => $request->get('central_tax'),
          'sta_ut_tax' => $request->get('sta_ut_tax'),
          'cess' => $request->get('cess'),
          'total_tax_amt' => $request->get('total_tax_amt'),
  
        ]);
    }

    public function store(Request $request)
    {
      
      $newb2binvoice = new B2binvoice([
        'inv_no' => $request->get('inv_no'),
        'Supp_gstin' => $request->get('Supp_gstin'),
        'party_name' => $request->get('party_name'),
        'inv_dt' => $request->get('inv_dt'),
        'inv_val' => $request->get('inv_val'),
        'rate' => $request->get('rate'),
        'total_tax_val' => $request->get('total_tax_val'),
        'int_tax' => $request->get('int_tax'),
        'central_tax' => $request->get('central_tax'),
        'sta_ut_tax' => $request->get('sta_ut_tax'),
        'cess' => $request->get('cess'),
        'total_tax_amt' => $request->get('total_tax_amt'),

      ]);

		$newb2binvoice->save();

		return response()->json($newb2binvoice);
    }
    public function updateCreateB2B(Request $request){
    
        $newb2binvoice = B2binvoice::updateOrCreate(
  
        ['inv_no' => $request->get('inv_no')],
          [
            'Supp_gstin' => $request->get('Supp_gstin'),
            'party_name' => $request->get('party_name'),
            'inv_dt' => $request->get('inv_dt'),
            'inv_val' => $request->get('inv_val'),
            'rate' => $request->get('rate'),
            'total_tax_val' => $request->get('total_tax_val'),
            'int_tax' => $request->get('int_tax'),
            'central_tax' => $request->get('central_tax'),
            'sta_ut_tax' => $request->get('sta_ut_tax'),
            'cess' => $request->get('cess'),
            'total_tax_amt' => $request->get('total_tax_amt'),
            
          ]
      );
      return response()->json($newb2binvoice);
    }
    
    
    public function in_Maha_pur(Request $request)
      {
          $year = $request->get('year');
          $year1 = json_decode($year);
          $month = $request->get('month');
          $month1 = json_decode($month);
           $newb2binvoice = DB::table('b2binvoices')
                   ->select('rate as in_rate',DB::raw('SUM(total_tax_amt) as in_taxable_total'), DB:: raw('SUM(central_tax) as in_central'), DB::raw('SUM(sta_ut_tax) as in_sta'),DB::raw('SUM(int_tax) as in_int'))
                   ->where('Supp_gstin', 'like', '27%')
                   ->whereYear('inv_dt', '=' ,$year1)
                   ->whereMonth('inv_dt', '=' ,$month1)
                   ->groupBy('rate')
                   ->get();
                  
         return response()->json($newb2binvoice);
  
        
      }

      public function out_Maha_pur(Request $request)
      {
        $year = $request->get('year');
        $year1 = json_decode($year);
        $month = $request->get('month');
        $month1 = json_decode($month);
           $newb2binvoice = DB::table('b2binvoices')
                   ->select('rate as out_rate',DB::raw('SUM(total_tax_amt) as out_taxable_total'), DB::raw('SUM(central_tax) as out_central'), DB::raw('SUM(sta_ut_tax) as out_sta'),DB::raw('SUM(int_tax) as out_int'))
                   ->where('Supp_gstin', 'not like', '%27%')
                   ->whereYear('inv_dt', '=' ,$year1)
                   ->whereMonth('inv_dt', '=' ,$month1)
                   ->groupBy('rate')
                   ->get();
                  
         return response()->json($newb2binvoice);
  
        
      }
}
