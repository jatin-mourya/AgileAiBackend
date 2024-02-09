<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sharing_access;

class sharingaccessController extends Controller
{
    public function index()
    {
        $query = DB::table('sharing_access')
        ->select('sharing_access.*','u.group_name as ugroup_name','s.group_name as sgroup_name')
        ->join('user_group as u', 'u.id', '=', 'sharing_access.contacts')
        ->join('user_group as s', 's.id', '=', 'sharing_access.Can_be_accessed')
        ->get();
		return response()->json($query);
    }
    
    public function create(Request $request)
    {
        $newuser = new sharing_access([
            'contacts' => $request->get('contacts'),
            'Can_be_accessed' => $request->get('Can_be_accessed')
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
		]);

		$newdata = new sharing_access([
		
            'contacts' => $request->get('contacts'),
            'Can_be_accessed' => $request->get('Can_be_accessed')
           

		]);

		$newdata->save();

		return response()->json($newdata);
    }
    public function show($id)
    {
        $data = sharing_access::findOrFail($id) ;
		return response()->json($data);
    }

    public function update(Request $request, $id){
        $usergroup = sharing_access::findOrFail($id);
		
		$usergroup = sharing_access::find($id);
        $usergroup->update($request->all());
        return $usergroup;

    }
    public function destroy($id)
    {
        $user = sharing_access::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Sharing Aceess deleted successfully', $user]);
    }
    public function getallUSR()
    {
       
        $regiondata3 = DB::table('sharing_access')
        ->join('user_group', 'user_group.id', '=', 'sharing_access.Can_be_accessed')
        ->select('sharing_access.*', 'user_group.group_name as group1', 'user_group.user_id')
        ->get();
        
        return response()->json($regiondata3);
    
    
    }
//     
}
