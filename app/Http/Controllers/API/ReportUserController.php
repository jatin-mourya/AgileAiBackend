<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reportuser;
use App\Models\Users;
use App\Models\Usergroup;
use App\Models\sharing_access;

use Illuminate\Support\Facades\Validator;


class ReportUserController extends Controller
{
   

    public function index()
    {
        $reportuser = reportuser::all();
		return response()->json($reportuser);

        
    }
//     public function index()
// {
//     $usergroups = reportuser::all();

//     $result = [];

//     foreach ($usergroups as $usergroup) {
//         $associatedUserIds = json_decode($usergroup->associated_user_id, true);

//         // Fetch users based on the matching user_ids
//         $users = Users::whereIn('user_id', $associatedUserIds)
//             ->select('firstname', 'lastname')
//             ->get();

//         $userNames = $users->map(function ($user) {
//             return $user->firstname . ' ' . $user->lastname;
//         });

//         $result[] = [
//             'id' => $usergroup->id,
//             'group_id' => $usergroup->group_id,
//             'user_id' => $usergroup->user_id,
//             'associated_user_id' => $userNames->toArray(),
//             'created_at' => $usergroup->created_at,
//             'updated_at' => $usergroup->updated_at,
//         ];
//     }

//     return $result;
// }
    public function create(Request $request)
    {
        $newuser = new reportuser([
            'group_name' => $request->get('group_name'),
            'team_id' => $request->get('team_id'),
            'user_id' => $request->get('user_id'),
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
		]);

		$newdata = new reportuser([
		
			'group_name' => $request->get('group_name'),
            'team_id' => $request->get('team_id'),
            'user_id' => $request->get('user_id')

		]);

		$newdata->save();

		return response()->json($newdata);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = reportuser::findOrFail($id) ;
		return response()->json($data);
    }

   

    public function update(Request $request, $id){
        $usergroup = reportuser::findOrFail($id);
		
		$usergroup = reportuser::find($id);
        $usergroup->update($request->all());
        return $usergroup;

    }
    public function destroy($id)
    {
        $user = reportuser::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully', $user]);
    }





    
public function getSharingData()
{
   
    $regiondata3 = DB::table('user_group')
    ->select('users.firstname','users.middlename','users.lastname','user_group.*')
    ->leftjoin('users', 'users.user_id', '=', 'user_group.user_id')
     ->get();
    
    return response()->json($regiondata3);


}

public function getsharing()
{
   
    $regiondata3 = DB::table('user_group')
    ->select('users.firstname','users.middlename','users.lastname','user_group.*')
    ->leftjoin('users', 'users.user_id', '=', 'user_group.user_id')
     ->get();
    
    return response()->json($regiondata3);


}


public function deleteValueAndAssociations()
{
    // Step 1: Delete "314" from Table 1
    reportuser::where('user_id', 'LIKE', '%"314"%')->delete();

    // Step 2: Remove "314" from Table 2
    $table2Records = Usergroup::where('associated_user_id', 'LIKE', '%"314"%')->get();

    foreach ($table2Records as $record) {
        $associatedUserId = json_decode($record->associated_user_id);
        $updatedUserIds = array_diff($associatedUserId, [314]);
        $record->associated_user_id = json_encode(array_values($updatedUserIds));
        $record->save();
    }
}
// public function updateUserGroup(Request $request)
// {
//     $id = $request->input('id');
//     $userGroup = reportuser::find($id);
// dd($userGroup);
//     if (!$userGroup) {
//         return response()->json(['error' => 'User group not found'], 404);
//     }

//     // Validate and handle the updated user_id field
//     $updatedUserIds = $request->input('data1');
//     if (!is_array($updatedUserIds)) {
//         return response()->json(['error' => 'Invalid user_id data'], 400);
//     }

//     // Get the previous user_id and associated_user_id arrays from Table 1 (userGroup)
//     $previousUserIds = $userGroup->user_id;
//     $previousAssociatedUserIds = $userGroup->associated_user_id;

//     // Update the user_id field in Table 1 (userGroup)
//     $userGroup->user_id = $updatedUserIds;
//     $userGroup->save();

//     // Check if there's a matching group_id in Table 2 (sharing_access)
//     $groupMatches = sharing_access::where('contacts', $id)->orWhere('Can_be_accessed', $id)->get();

//     // If there are matching group_ids, update the associated_user_id in Table 3 (sharing_rule)
//     if ($groupMatches->count() > 0) {
//         $dataGroupId = $groupMatches->pluck('id');
//         $groupId = $groupMatches->pluck('Can_be_accessed', 'contacts');

//         foreach ($dataGroupId as $dgId) {
//             $sharingRules = Usergroup::where('data_group_id', $dgId)->where('group_id', $groupId[$id])->get();

//             foreach ($sharingRules as $sharingRule) {
//                 $associatedUserIds = $sharingRule->associated_user_id;
//                 $associatedUserIds = array_merge($associatedUserIds, $updatedUserIds);
//                 $sharingRule->associated_user_id = $associatedUserIds;
//                 $sharingRule->save();
//             }
//         }
//     }

//     return response()->json(['message' => 'User group updated successfully'], 200);
// }

}