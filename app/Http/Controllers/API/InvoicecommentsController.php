<?php

// namespace App\Http\Controllers\API;
namespace App\Http\Controllers\API;
use App\Models\InvoiceComments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use DB   
use Illuminate\Support\Facades\DB;;

class InvoicecommentsController extends Controller
{

    public function index()
    {
        return DB::all();
        // $invoicecomments = InvoiceComments::all();
        // $invoicecomments = DB::table('invoice_comments')
        //         ->orderBy('updated_at','DESC')
        //         ->get();
		// return response()->json($invoicecomments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newTeamleaders = new InvoiceComments([
            'user_id' => $request->get('user_id'),
            'invoice_multi_id' => $request->get('invoice_multi_id'),
            'comments' => $request->get('comments'),
            // 'user_id' => $request->get('user_id')
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
			'invoice_multi_id' => 'required',
            'comments' => 'required',
            // 'user_id' => 'required'
		]);

		$newInvoiceComments = new InvoiceComments([
            'user_id' => $request->get('user_id'),
			'invoice_multi_id' => $request->get('invoice_multi_id'),
            'comments' => $request->get('comments')
            // 'user_id' => $request->get('user_id')
		]);
        // return response()->json($newInvoiceComments);


		$newInvoiceComments->save();

		return response()->json($newInvoiceComments);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($invoice_multi_id)
    {
        $invoicecomments = DB::table('invoice_comments')
                    ->join('users', 'users.user_id', '=', 'invoice_comments.user_id')
                    ->select('invoice_comments.*','users.user_id','users.firstname','users.middlename','users.lastname')
                    ->where('invoice_comments.invoice_multi_id',$invoice_multi_id)
                    ->get();
		return response()->json($invoicecomments);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice_comment_id)
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
    public function update(Request $request, $invoice_comment_id)
    {

        $invoicecomments = InvoiceComments::findOrFail($invoice_comment_id);
		
		$invoicecomments = InvoiceComments::find($invoice_comment_id);
        $invoicecomments->update($request->all());
        return $invoicecomments;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice_comment_id)
    {
        $invoicecomments = InvoiceComments::findOrFail($invoice_comment_id);
		$invoicecomments->delete();

		return response()->json($invoicecomments::all());
    }
}