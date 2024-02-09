<?php

namespace App\Http\Controllers\API;
use App\Models\GstFillingDetails;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GstFillingDetailsController extends Controller
{
    
    public function index()
    {
        $gstfillingdetails = Gstfillingdetails::all();
        $gstfillingdetails = DB::table('gst_fillingdetails')
        ->join('invoice', 'invoice.invoice_id', '=', 'gst_fillingdetails.invoice_id')
        ->select('gst_fillingdetails.*','invoice.invoice_id', 'invoice.invoice_num')
        ->orderBy('gst_fillingdetails.updated_at','DESC')
        ->get();
        return response()->json($gstfillingdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newGstfillingdetails = new Gstfillingdetails([
			
			'invoice_id' => $request->get('invoice_id'),
            'inv_type' => $request->get('inv_type'),
            'gstr1_month' => $request->get('gstr1_month'),
            'gstr1_amount' => $request->get('gstr1_amount'),
            'filed_status' => $request->get('filed_status'),
           
            
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
            'invoice_id' => 'required',
            'inv_type' => 'required',
            'gstr1_month' =>'required',
            'gstr1_amount' => 'required',
            'filed_status' => 'required',
           
		]);

		$newGstfillingdetails = new Gstfillingdetails([
		
		
            'invoice_id' => $request->get('invoice_id'),
            'inv_type' => $request->get('inv_type'),
            'gstr1_month' => $request->get('gstr1_month'),
            'gstr1_amount' => $request->get('gstr1_amount'),
            'filed_status' => $request->get('filed_status'),
		]);

		$newGstfillingdetails->save();

		return response()->json($newGstfillingdetails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($client_id)
    {
        $gstfillingdetails = Gstfillingdetails::findOrFail($client_id);
		return response()->json($gstfillingdetails);

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

        $gstfillingdetails = Gstfillingdetails::findOrFail($client_id);
		
		$gstfillingdetails = Gstfillingdetails::find($client_id);
        $gstfillingdetails->update($request->all());
        return $gstfillingdetails;

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
        $gstfillingdetails = Gstfillingdetails::findOrFail($client_id);
		$gstfillingdetails->delete();

		return response()->json($gstfillingdetails::all());
    }
}
