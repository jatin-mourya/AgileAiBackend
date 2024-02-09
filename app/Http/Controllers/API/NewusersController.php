<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newusers;

class NewusersController extends Controller
{
    public function index()
    {  
        $newusers = Newusers::all();
        // $empdocuments = DB::table('users')
        // ->orderBy('users.updated_at','DESC')
        // ->get();
		return response()->json($newusers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$newusersData = $newusers->getNewusers($request->email);




        $newNewusers = new Newusers([
			'firstname' => $request->get('firstname'),
            'middlename' => $request->get('middlename'),
            'lastname' => $request->get('lastname'),
            'mobile_no' => $request->get('mobile_no'),
            'email' => $request->get('email'),
            'emp_code' =>$request->get('emp_code'),
            'name' => $request->get('name'),
            'password' => $request->get('password'),
            'conformpassword' => $request->get('conformpassword'),
            'date_of_birth' => $request->get('date_of_birth'),
            'pan_no' => $request->get('pan_no'),
            'qualification' => $request->get('qualification'),
            'marital_status' => $request->get('marital_status'),
            'joining_date' => $request->get('joining_date'),
            'experience_in_year' => $request->get('experience_in_year'),
            'last_package' => $request->get('last_package'),
			'roles' => $request->get('roles')
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
			'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'emp_code' => 'required',
            'name' => 'required',
            'nickname' => '',
            'password' => 'required',
            'conformpassword' => 'required',
            'date_of_birth' => 'required',
            'pan_no' => 'required',
            'qualification' => 'required',
            'marital_status' => 'required',
            'joining_date' => 'required',
            'experience_in_year' => 'required',
            'last_package' => 'required',
			'roles' => 'required'
		]);

		$newNewusers = new Newusers([
			'firstname' => $request->get('firstname'),
            'middlename' => $request->get('middlename'),
            'lastname' => $request->get('lastname'),
            'mobile_no' => $request->get('mobile_no'),
            'email' => $request->get('email'),
            'emp_code' => $request->get('emp_code'),
            'name' => $request->get('name'),
            'nickname' => $request->get('nickname'),
            'password' => $request->get('password'),
            'conformpassword' => $request->get('conformpassword'),
            'date_of_birth' => $request->get('date_of_birth'),
            'pan_no' => $request->get('pan_no'),
            'qualification' => $request->get('qualification'),
            'marital_status' => $request->get('marital_status'),
            'joining_date' => $request->get('joining_date'),
            'experience_in_year' => $request->get('experience_in_year'),
            'last_package' => $request->get('last_package'),
			'roles' => $request->get('roles')
		]);

		$newNewusers->save();

		return response()->json($newNewusers);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $newusers = Newusers::findOrFail($user_id);
		return response()->json($newusers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $user_id)
    {
        $newusers = Newusers::findOrFail($user_id);

		$request->validate([
			'firstname' => 'firstname',
            'middlename' => 'middlename',
            'lastname' => 'lastname',
            'mobile_no' => 'mobile_no',
            'email' => 'email',
            'emp_code' => 'emp_code',
            'name' => 'name',
            'nickname' => '',
            'password' => 'password',
            'conformpassword' => 'conformpassword',
            'date_of_birth' => 'date_of_birth',
            'pan_no' => 'pan_no',
            'qualification' => 'qualification',
            'marital_status' => 'marital_status',
            'joining_date' => 'joining_date',
            'experience_in_year' => 'experience_in_year',
            'last_package' => 'last_package',
			'roles' => 'roles'
		]);

		$newusers->firstname = $request->get('firstname');
        $newusers->middlename = $request->get('middlename');
        $newusers->lastname = $request->get('lastname');
        $newusers->mobile_no = $request->get('mobile_no');
        $newusers->email = $request->get('email');
        $newusers->emp_code = $request->get('emp_code');
        $newusers->name = $request->get('name');
        $newusers->nickname = $request->get('nickname');
        $newusers->password = $request->get('password');
        $newusers->conformpassword = $request->get('conformpassword');
        $newusers->date_of_birth = $request->get('date_of_birth');
        $newusers->pan_no = $request->get('pan_no');
        $newusers->qualification = $request->get('qualification');
        $newusers->marital_status = $request->get('marital_status');
        $newusers->joining_date = $request->get('joining_date');
        $newusers->experience_in_year = $request->get('experience_in_year');
        $newusers->last_package = $request->get('last_package');
		$newusers->roles = $request->get('roles');

		$newusers->save();

		return response()->json($newusers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $newusers = Newusers::findOrFail($user_id);
		$newusers->delete();

		return response()->json($newusers::all());
    }
}
