<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gstr2a;
//use DB   
use Illuminate\Support\Facades\DB;;

class Gstr2aController extends Controller
{
    public function index()
    {
        $newgstr2a = gstr2a::all();
    return response()->json($newgstr2a);
       
    }
    public function create(Request $request)
    {
        // dd($request->all()); 
        $newgstr2a = new gstr2a([
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
    $newgstr2a = new gstr2a([
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
  
    $newgstr2a->save();
  
    return response()->json($newgstr2a);
    }
    public function uploadgstr2a(Request $request){
        // dd($request);  
        $length =  $request->length;
        for ($i=0; $i < $length; $i++) {
    
          $img[$i] = $request->file('gstr2a_filename'.$i);
          $name = $request->file('gstr2a_filename'.$i)->getClientOriginalName();
          $destination = 'public/img';
          $img[$i]->move(('../../Angular_Auth/src/app/pages/form/account/gstr2a/gstr2a_files'), $name);
          $images[] = $name;
          $image1 = new gstr2a();
          $image1->gstr2a_filename = $name;
          $image1->save();
        }
          return response()->json($image1);
    }
    public function invoicegstr2a($month)
    {
         //dd($request->all());
        $gstr2a = DB::table('gstr2a')
        ->select('gstr2a.inum','gstr2a.camt', 'gstr2a.iamt','gstr2a.samt','gstr2a.idt',
                'b2binvoices.inv_no','b2binvoices.central_tax' ,'b2binvoices.int_tax','b2binvoices.inv_dt','b2binvoices.total_tax_amt','b2binvoices.sta_ut_tax')
        ->leftJoin('b2binvoices', 'b2binvoices.inv_no','=','gstr2a.inum')
        ->whereMonth('gstr2a.idt',$month);
        
        $b2binvoices = DB::table('b2binvoices')
        ->select('gstr2a.inum','gstr2a.camt', 'gstr2a.iamt','gstr2a.samt','gstr2a.idt',
                'b2binvoices.inv_no','b2binvoices.central_tax' ,'b2binvoices.int_tax','b2binvoices.inv_dt','b2binvoices.total_tax_amt','b2binvoices.sta_ut_tax')
        ->leftJoin('gstr2a','gstr2a.inum','=', 'b2binvoices.inv_no')
       ->whereMonth('b2binvoices.inv_dt',$month)
        ->unionAll($gstr2a)
        //->distinct()
        ->get();
        return response()->json($b2binvoices);
    }


    public function gstr2amonthj()
    {
      // dd($month);
      $newgstr2a = gstr2a::all();
      $newgstr2a = DB::table('gstr2a')
                ->join('month', 'month.id', '=', 'gstr2a.financial_month')
                ->select('inv_month', DB::raw('COUNT(inum) as gstrA2count'),DB::raw('SUM(camt) as ctotal'), DB::raw('SUM(samt) as stotal'), DB::raw('SUM(iamt) as itotal'),'month.month')
                ->groupBy('inv_month','month.month')
                ->get();
    return response()->json($newgstr2a);
    }
  
    public function b2bmonthj(Request $request)
    {
        $newgstr2a = gstr2a::all();
        $newgstr2a = DB::table('b2binvoices')
                ->select(DB::raw("DATE_FORMAT(inv_dt, '%Y-%m') as new_date"), DB::raw('SUM(central_tax) as b2bctotal'), DB::raw('COUNT(inv_no) as b2bcount'), DB::raw('SUM(sta_ut_tax) as b2bstotal'), DB::raw('SUM(int_tax) as b2bitotal'), DB::raw('SUM(total_tax_amt) as b2btotal'))
                ->groupby('new_date')
                ->get();
                
    return response()->json($newgstr2a);
    }
  
    public function updateCreate2A(Request $request){
        // dd($request->get('inum'));
        $request->validate([

          'financial_year' => 'required',
          'financial_month' => 'required'
       ]);
         $newgstr2a = gstr2a::updateOrCreate(
    
          ['inum' => $request->get('inum')],
            [
              'ctin' => $request->get('ctin'),
              'cfs' => $request->get('cfs'),
              'cfs3b' => $request->get('cfs3b'),
              'fldtr1' => $request->get('fldtr1'),
              'flprdr1' => $request->get('flprdr1'),
              'chksum' => $request->get('chksum'),
              'idt' => $request->get('idt'),
              'inv_typ' => $request->get('inv_typ'),
              'camt' => $request->get('camt'),
              'csamt' => $request->get('csamt'),
              'iamt' => $request->get('iamt'),
              'rt' => $request->get('rt'),
              'samt' => $request->get('samt'),
              'txval' => $request->get('txval'),
              'pos' => $request->get('pos'),
              'rchrg' => $request->get('rchrg'),
              'val' => $request->get('val'),
              'num' => $request->get('num'),
              'gstr2a_filename' => $request->get('gstr2a_filename'),
              'inv_month' => $request->get('inv_month'),
              'financial_year' => $request->get('financial_year'),
              'financial_month' => $request->get('financial_month')
            ]
        );
        return response()->json($newgstr2a);
    }
}
