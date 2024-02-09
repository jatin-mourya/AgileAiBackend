<?php

namespace App\Http\Controllers\API;
// //use DB  
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channelpartner;

class ChannelpartnerController extends Controller
{
    public function index()
    {
        $channelpartner = DB::table('channelpartner')
                        ->select('cp_id','cp_name','catrgory_id','occupation_id','address','date_of_birth','email1','mobile1','channelpan')
                        ->orderBy('updated_at', 'DESC')
                        ->where('boolean_value', '1')
                        ->get();
        return response()->json($channelpartner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newChannelpartner = new Channelpartner([
			
			'cp_name' => $request->get('cp_name'),
            'mobile1' => $request->get('mobile1'),
            'mobile2' => $request->get('mobile2'),
            'email1' => $request->get('email1'),
            'email2' => $request->get('email2'),
            'date_of_birth' => $request->get('date_of_birth'),
            'catrgory_id' => $request->get('catrgory_id'),
            'occupation_id' => $request->get('occupation_id'),
            'address' => $request->get('address'),
            'channelpan' => $request->get('channelpan')
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
		
			'cp_name' => 'required',
            'mobile1' => '',
            'mobile2' => '',
            'email1' => '',
            'email2' => '',
            'date_of_birth' => '',
            'catrgory_id' => '',
            'occupation_id' => '',
            'address' => '',
            'channelpan' => ''
		]);

		$newChannelpartner = new Channelpartner([
		
			'cp_name' => $request->get('cp_name'),
            'mobile1' => $request->get('mobile1'),
            'mobile2' => $request->get('mobile2'),
            'email1' => $request->get('email1'),
            'email2' => $request->get('email2'),
            'date_of_birth' => $request->get('date_of_birth'),
            'catrgory_id' => $request->get('catrgory_id'),
            'occupation_id' => $request->get('occupation_id'),
            'address' => $request->get('address'),
            'channelpan' => $request->get('channelpan')
		]);

		$newChannelpartner->save();

		return response()->json($newChannelpartner);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($cp_id)
    {
        $channelpartner = Channelpartner::findOrFail($cp_id);
		return response()->json($channelpartner);

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cp_id)
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
    public function update(Request $request, $cp_id)
    {

        $channelpartner = Channelpartner::findOrFail($cp_id);
		
		$channelpartner = Channelpartner::find($cp_id);
        $channelpartner->update($request->all());
        return $channelpartner;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cp_id)
    {
        $channelpartner = Channelpartner::findOrFail($cp_id);

        $channelpartner = Channelpartner::find($cp_id);
        if ($channelpartner) {
            $channelpartner->boolean_value = 0;
            $channelpartner->save();
            return $channelpartner;
    }
}
}
