<?php

namespace App\Http\Controllers\API;
use App\Models\Inv_Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Inv_statusController extends Controller
{
    public function index()
    {
        $inv_status = Inv_status::all();
        // $inv_status = DB::table('inv_status')
        // ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'inv_status.company_id')
        // ->join('salesdetails', 'salesdetails.sales_id', '=', 'inv_status.sales_id')
        // ->select('inv_status.*','salesdetails.sales_id', 'debtor_company_det.cname')
        // ->get();
		return response()->json($inv_status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newInv_status = new Inv_status([
			
			'status' => $request->get('status'),
           

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
		
		
            'status' => 'required',
           
		]);

		$newInv_status = new Inv_status([
		
		
            'status' => $request->get('status'),
           
		]);

		$newInv_status->save();

		return response()->json($newInv_status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($client_id)
    {
        $inv_status = Inv_status::findOrFail($client_id);
		return response()->json($inv_status);

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

        $inv_status = Inv_status::findOrFail($client_id);
		
		$inv_status = Inv_status::find($client_id);
        $inv_status->update($request->all());
        return $inv_status;

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
        $inv_status = Inv_status::findOrFail($client_id);
		$inv_status->delete();

		return response()->json($inv_status::all());
    }
}
