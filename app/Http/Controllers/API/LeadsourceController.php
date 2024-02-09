<?php

namespace App\Http\Controllers\API;
use App\Models\Leadsource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadsourceController extends Controller
{
    public function index()
  {
    $leadsource = Leadsource::all();
    return response()->json($leadsource);
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($leadsource_id)
  {
    $leadsource = Leadsource::findOrFail($leadsource_id);
    return response()->json($leadsource);
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $leadsource_id)
  {
    $leadsource = Leadsource::findOrFail($leadsource_id);
    $leadsource = Leadsource::find($leadsource_id);
    $leadsource->update($request->all());
    return $leadsource;

    
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($leadsource_id)
  {
    $leadsource = Leadsource::findOrFail($leadsource_id);
    $leadsource->delete();

    return response()->json($leadsource::all());
  }
}
