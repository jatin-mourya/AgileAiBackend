<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salescomments;

class SalescommentsController extends Controller
{

    public function index()
    {
        $salescomments = Salescomments::all();
        $salescomments = DB::table('sales_comments')
                ->orderBy('updated_at','DESC')
                ->get();
		return response()->json($salescomments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newTeamleaders = new Salescomments([
            'user_id' => $request->get('user_id'),
            'sales_id' => $request->get('sales_id'),
            'comment' => $request->get('comment'),
            'user_id' => $request->get('user_id')
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
            'user_id' => 'required',
			'sales_id' => 'required',
            'comment' => 'required',
            'user_id' => 'required'
		]);

		$newSalescomments = new Salescomments([
            'user_id' => $request->get('user_id'),
			'sales_id' => $request->get('sales_id'),
            'comment' => $request->get('comment'),
            'user_id' => $request->get('user_id')
		]);

		$newSalescomments->save();

		return response()->json($newSalescomments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($sales_id)
    {
       // $salescomments = Salescomments::findOrFail($sales_id);
        $salescomments = DB::table('sales_comments')
                    ->join('users', 'users.user_id', '=', 'sales_comments.user_id')
                    ->select('sales_comments.*','users.user_id','users.firstname','users.middlename','users.lastname')
                    ->where('sales_comments.sales_id',$sales_id)
                    ->get();
		return response()->json($salescomments);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sales_comment_id)
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
    public function update(Request $request, $sales_comment_id)
    {

        $salescomments = Salescomments::findOrFail($sales_comment_id);
		
		$salescomments = Salescomments::find($sales_comment_id);
        $salescomments->update($request->all());
        return $salescomments;

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
    public function destroy($sales_comment_id)
    {
        $salescomments = Salescomments::findOrFail($sales_comment_id);
		$salescomments->delete();

		return response()->json($salescomments::all());
    }
}
