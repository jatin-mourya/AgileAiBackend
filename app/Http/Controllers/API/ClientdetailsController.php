<?php

namespace App\Http\Controllers\API;
// //use DB   use Illuminate\Support\Facades\DB;;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientdetails;

class ClientdetailsController extends Controller
{
    public function index()
    {
       
        $clientdetails = DB::table('clientdetails')
                        ->select('client_id','name','date_of_birth','mobile1','email1','catrgory_id','occupation_id','address')
                        ->orderBy('updated_at', 'DESC')
                        ->get();
		return response()->json($clientdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newClientdetails = new Clientdetails([
			
			'name' => $request->get('name'),
            'mobile1' => $request->get('mobile1'),
            'mobile2' => $request->get('mobile2'),
            'email1' => $request->get('email1'),
            'email2' => $request->get('email2'),
            'date_of_birth' => $request->get('date_of_birth'),
            'catrgory_id' => $request->get('catrgory_id'),
            'occupation_id' => $request->get('occupation_id'),
            'address' => $request->get('address')
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
		
			'name' => 'required',
            'mobile1' => '',
            'mobile2' => '',
            'email1' => '',
            'email2' => '',
            'date_of_birth' => '',
            'catrgory_id' => '',
            'occupation_id' => '',
            'address' => ''
		]);

		$newClientdetails = new Clientdetails([
		
			'name' => $request->get('name'),
            'mobile1' => $request->get('mobile1'),
            'mobile2' => $request->get('mobile2'),
            'email1' => $request->get('email1'),
            'email2' => $request->get('email2'),
            'date_of_birth' => $request->get('date_of_birth'),
            'catrgory_id' => $request->get('catrgory_id'),
            'occupation_id' => $request->get('occupation_id'),
            'address' => $request->get('address')
		]);

		$newClientdetails->save();

		return response()->json($newClientdetails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($client_id)
    {
        $clientdetails = Clientdetails::findOrFail($client_id);
		return response()->json($clientdetails);

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

        $clientdetails = Clientdetails::findOrFail($client_id);
		
		$clientdetails = Clientdetails::find($client_id);
        $clientdetails->update($request->all());
        return $clientdetails;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {
        $clientdetails = Clientdetails::findOrFail($client_id);
		$clientdetails->delete();

		return response()->json($clientdetails::all());
    }
}
