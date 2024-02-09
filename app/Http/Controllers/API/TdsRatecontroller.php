<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TdsRate;


class TdsRatecontroller extends Controller
{
  public function index()
  {
    $tdsrate = TdsRate::all();
    return response()->json($tdsrate);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($tds_rate_id)
  {
    $tdsrate = TdsRate::findOrFail($tds_rate_id);
    return response()->json($tdsrate);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $tds_rate_id)
  {
    $tdsrate = TdsRate::findOrFail($tds_rate_id);
    $tdsrate = TdsRate::find($tds_rate_id);
    $tdsrate->update($request->all());
    return $tdsrate;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($tds_rate_id)
  {
    $tdsrate = TdsRate::findOrFail($tds_rate_id);
    $tdsrate->delete();

    return response()->json($tdsrate::all());
  }
}
