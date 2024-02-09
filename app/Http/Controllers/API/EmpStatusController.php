<?php

namespace App\Http\Controllers\API;
use App\Models\EmpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use DB   
use Illuminate\Support\Facades\DB;;

class EmpStatusController extends Controller
{
    public function index()
  {
    $empstatus = Empstatus::all();
 
    return response()->json($empstatus);
  }
  //public function create()
  //{
    //$newEmpstatus = new Empstatus([
    //'empstatus' => $request->get('empstatus'),
  
    // ]);
  //}
  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  //public function store(Request $request)
  //{
    //$request->validate([
      //'empstatus' => 'required|max:255',
   
    //]);

    //$newEmpstatus = new Empstatus([
      //'empstatus' => $request->get('empstatus')
     
    //]);

    //$newEmpstatus->save();

    //return response()->json($newEmpstatus);
  //}

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($emp_status_id)
  {
    $empstatus = Empstatus::findOrFail($emp_status_id);
    return response()->json($empstatus);
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $emp_status_id)
  {
    $empstatus = Empstatus::findOrFail($emp_status_id);
    $empstatus = Empstatus::find($emp_status_id);
    $empstatus->update($request->all());
    return $empstatus;

    
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($emp_status_id)
  {
    $empstatus = Empstatus::findOrFail($emp_status_id);
    $empstatus->delete();

    return response()->json($empstatus::all());
  }
}
