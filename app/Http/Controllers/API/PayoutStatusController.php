<?php

namespace App\Http\Controllers\API;
use App\Models\PayoutStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayoutStatusController extends Controller
{
    public function index()
  {
    $payoutstatus = PayoutStatus::all();
    return response()->json($payoutstatus);
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($payout_status_id)
  {
    $payoutstatus = PayoutStatus::findOrFail($payout_status_id);
    return response()->json($payoutstatus);
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $payout_status_id)
  {
    $payoutstatus = PayoutStatus::findOrFail($payout_status_id);
    $payoutstatus = PayoutStatus::find($payout_status_id);
    $payoutstatus->update($request->all());
    return $payoutstatus;

    
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($payout_status_id)
  {
    $payoutstatus = PayoutStatus::findOrFail($payout_status_id);
    $payoutstatus->delete();

    return response()->json($payoutstatus::all());
  }
}
