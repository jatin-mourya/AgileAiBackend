<?php

namespace App\Http\Controllers\API;
use App\Models\BookingStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingStatusController extends Controller
{
    public function index()
  {
    $bookingstatus = BookingStatus::all();
    return response()->json($bookingstatus);
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($deal_status_id)
  {
    $bookingstatus = BookingStatus::findOrFail($deal_status_id);
    return response()->json($bookingstatus);
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $deal_status_id)
  {
    $bookingstatus = BookingStatus::findOrFail($deal_status_id);
    $bookingstatus = BookingStatus::find($deal_status_id);
    $bookingstatus->update($request->all());
    return $bookingstatus;

    
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($deal_status_id)
  {
    $bookingstatus = BookingStatus::findOrFail($deal_status_id);
    $bookingstatus->delete();

    return response()->json($bookingstatus::all());
  }
}
