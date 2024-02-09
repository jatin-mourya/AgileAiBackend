<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\rolepermission;
class rolepermissionController extends Controller
{
    public function index()
    {
        $designations = DB::table('permission')
                            ->select('*')
                            ->get();
		return response()->json($designations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $DesignationsPerm = new rolepermission([
			
            'designation_id' => $request->get('designation_id'),
            'tabs' => $request->get('tabs')
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
		// $designationPerm = new rolepermission([
		
		// 	'designation_id' => $request->get('designation_id'),
    //         'tabs' => $request->get('tabs')
		// ]);

		// $designationPerm->save();

		// return response()->json($designationPerm);
    {
      $data = $request->all();

      // Validate the request data
      $validator = Validator::make($data, [
          'designation_id' => '',
          'tabs' => '',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 400);
      }

      $designationId = $data['designation_id'];

      // Check if the designation_id already exists in the table
      $designation = rolepermission::where('designation_id', $designationId)->first();

      if ($designation) {
          // Update the existing record
          $designation->tabs = $data['tabs'];
          $designation->save();
      } else {
          // Insert a new record
          $designation = rolepermission::create($data);
      }

      return response()->json(['designation' => $designation], 201);
  }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update()
    {
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
       
    }

    public function getPermissions($designationId)
    {
        $permissions = RolePermission::where('designation_id', $designationId)
        ->first();
        return response()->json($permissions);
    }



    // public function prodesignations(Request $request){
    //     // $designationId = $request->designation;;

    //     $result = DB::table('permission')
    //     ->select('permission.designation_id', 'users.designation','permission.tabs')
    //     ->distinct()
    //     ->join('users', 'permission.designation_id', '=', 'users.designation')
    //     ->where('users.designation', '=',  $request[0])
    //     ->get();
    //     return response()->json($result);
    // }

    public function prodesignations(Request $request){
        // $designationId = $request->designation;;

        $result = DB::table('permission_access')
        ->select('permission_access.*', 'users.designation')
        ->distinct()
        ->join('users', 'users.designation', '=', 'permission_access.designation')
        ->where('users.designation', '=',  $request[0])
        ->get();
        return response()->json($result);
    }

    public function prodesignations1($designation_id)
{
    // $designationId = $request->designation_id;
    $result1 = DB::table('permission')
    ->select('permission.*')
    ->where('permission.designation_id', '=',  $designation_id)
    ->get();
    return response()->json($result1);
    
}
}
