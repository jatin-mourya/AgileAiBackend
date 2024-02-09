<?php

namespace App\Http\Controllers\API;
// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientpaymentschedule;

class ClientpaymentscheduleController extends Controller
{

    public function index()
    {
        $clientpaymentschedule = Clientpaymentschedule::all();
        $clientpaymentschedule = DB::table('client_payment_schedule')
                        ->join('users', 'users.user_id', '=', 'client_payment_schedule.updated_by')
                        ->select('users.firstname','users.middlename','users.lastname', 'client_payment_schedule.*')
                        ->where('boolean_value', '1')
                        ->orderBy('client_payment_schedule.updated_at','DESC')
                        ->get();
		return response()->json($clientpaymentschedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newClientpaymentschedule = new Clientpaymentschedule([
			
			'sales_id' => $request->get('sales_id'),
            'BA1_amt_paid' => $request->get('BA1_amt_paid'),
            'BA2_amt_paid' => $request->get('BA2_amt_paid'),
            'registration_date' => $request->get('registration_date'),
            'updated_by' => $request->get('updated_by')
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
		
			'sales_id' => 'required',
            'BA1_amt_paid' => 'required',
            'BA2_amt_paid' => 'required',
            'registration_date' => 'required',
            'updated_by' => 'required'
		]);

		$newClientpaymentschedule = new Clientpaymentschedule([
		
			'sales_id' => $request->get('sales_id'),
            'BA1_amt_paid' => $request->get('BA1_amt_paid'),
            'BA2_amt_paid' => $request->get('BA2_amt_paid'),
            'registration_date' => $request->get('registration_date'),
            'updated_by' => $request->get('updated_by')
		]);

		$newClientpaymentschedule->save();

		return response()->json($newClientpaymentschedule);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($client_payment_schedule_id)
    {
        $clientpaymentschedule = Clientpaymentschedule::findOrFail($client_payment_schedule_id);
		return response()->json($clientpaymentschedule);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($client_payment_schedule_id)
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
    public function update(Request $request, $client_payment_schedule_id)
    {

        $clientpaymentschedule = Clientpaymentschedule::findOrFail($client_payment_schedule_id);
		
		$clientpaymentschedule = Clientpaymentschedule::find($client_payment_schedule_id);
        $clientpaymentschedule->update($request->all());
        return $clientpaymentschedule;

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
    public function destroy($client_payment_schedule_id)
    {
        $clientpaymentschedule = Clientpaymentschedule::findOrFail($client_payment_schedule_id);
		//$clientpaymentschedule->delete();

        $clientpaymentschedule = Clientpaymentschedule::find($client_payment_schedule_id);
        if ($clientpaymentschedule) {
            $clientpaymentschedule->boolean_value = 0;
            $clientpaymentschedule->save();
            return $clientpaymentschedule;
        }

		//return response()->json($clientpaymentschedule::all());
    }
}
