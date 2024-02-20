<?php

namespace App\Http\Controllers\API;

//use DB   
use Illuminate\Support\Facades\DB;

;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Debtorcompanydet;

class DebtorcompanydetController extends Controller
{
    // by jatin 
    // by jatin 
    public function getCompanyByInvType($invType)
    {
        // if bank has no gst number, then dont send bank
        if ($invType == 1) {
            $companies = DB::table('debtor_company_det as c')
                ->select('c.debtor_company_det_id as id', 'c.cname as name', 'c.gst_no')
                ->where('c.invoice_type_id', 1)
                ->where('c.gst_no', '!=', '')
                // ->orderBy('updated_at', 'DESC')
                ->get();
            return response()->json($companies);
        } else if ($invType == 2) {
            $banks = DB::table('bank_details as c')
                ->select('c.bank_id as id', 'c.bank_name as name', 'c.gst_no', 'c.payout_on')
                ->where('c.gst_no', '!=', '')
                ->get();
            return response()->json($banks);
        } else {
            return response()->json(["message" => "no companies found"]);
        }
    }
    // by jatin 
    // by jatin 
    public function index()
    {
        $debtorcompanydet = DB::table('debtor_company_det')
            ->orderBy('updated_at', 'DESC')
            ->get();
        return response()->json($debtorcompanydet);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newDebtorcompanydet = new Debtorcompanydet([

            'cname' => $request->get('cname'),
            'cpan' => $request->get('cpan'),
            'gst_no' => $request->get('gst_no'),
            'registered_address' => $request->get('registered_address'),
            'billing_address' => $request->get('billing_address'),
            'contact1' => $request->get('contact1'),
            'contact2' => $request->get('contact2'),
            'email1' => $request->get('email1'),
            'email2' => $request->get('email2'),
            'profile_score' => $request->get('profile_score')
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

            'cname' => 'required|unique:debtor_company_det,cname',
            'cpan' => '',
            'gst_no' => '',
            'registered_address' => '',
            'billing_address' => '',
            'contact1' => '',
            'email1' => '',
            'profile_score' => ''
        ]);

        $newDebtorcompanydet = new Debtorcompanydet([

            'cname' => $request->get('cname'),
            'cpan' => $request->get('cpan'),
            'gst_no' => $request->get('gst_no'),
            'registered_address' => $request->get('registered_address'),
            'billing_address' => $request->get('billing_address'),
            'contact1' => $request->get('contact1'),
            'contact2' => $request->get('contact2'),
            'email1' => $request->get('email1'),
            'email2' => $request->get('email2'),
            'profile_score' => $request->get('profile_score')
        ]);

        $newDebtorcompanydet->save();

        return response()->json($newDebtorcompanydet);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($debtor_company_det_id)
    {
        $debtorcompanydet = Debtorcompanydet::findOrFail($debtor_company_det_id);
        return response()->json($debtorcompanydet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($debtor_company_det_id)
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
    public function update(Request $request, $debtor_company_det_id)
    {

        $debtorcompanydet = Debtorcompanydet::findOrFail($debtor_company_det_id);

        $debtorcompanydet = Debtorcompanydet::find($debtor_company_det_id);
        $debtorcompanydet->update($request->all());
        return $debtorcompanydet;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($debtor_company_det_id)
    {
        $debtorcompanydet = Debtorcompanydet::findOrFail($debtor_company_det_id);
        $debtorcompanydet->delete();

        return response()->json($debtorcompanydet::all());
    }
}
