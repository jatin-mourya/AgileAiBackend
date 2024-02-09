<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usergroup;
use App\Models\Users;
use App\Models\sharing_access;
use App\Models\reportuser;

class UsergroupController extends Controller
{
    

public function index()
{
    $usergroups = Usergroup::all();

    $result = [];

    foreach ($usergroups as $usergroup) {
        $associatedUserIds = json_decode($usergroup->associated_user_id, true);

        // Fetch users based on the matching user_ids
        $users = Users::whereIn('user_id', $associatedUserIds)
            ->select('firstname', 'lastname')
            ->get();

        $userNames = $users->map(function ($user) {
            return $user->firstname . ' ' . $user->lastname;
        });

        $result[] = [
            'id' => $usergroup->id,
            'data_group_id' =>$usergroup->data_group_id,
            'group_id' => $usergroup->group_id,
            'user_id' => $usergroup->user_id,
            'associated_user_id' => $userNames->toArray(),
            'created_at' => $usergroup->created_at,
            'updated_at' => $usergroup->updated_at,
        ];
    }

    return $result;
}



    public function create(Request $request)
    {
        $newuser = new Usergroup([
            'data_group_id' => $request->get('data_group_id'),
            'group_id' => $request->get('group_id'),
            'user_id' => $request->get('user_id'),
            'associated_user_id' => $request->get('associated_user_id')
            
		]);
    }

    // public function update(Request $request, $id){
    //     $usergroup = Usergroup::findOrFail($id);
		
	// 	$usergroup = Usergroup::find($id);
    //     $usergroup->update($request->all());
    //     return $usergroup;

    // }
    public function addUpdateDataSharingPointUsers($id)
    {
        // $data_sharing_group = data_sharing_group::findOrFail($id);
        // $dataSharing = data_sharing_point::whereIn('user_id', json_decode($data_sharing_group->users))->delete();
        
        $data_sharing_rule = sharing_access::where('contacts', $id)->get();
        // $data_sharing_rule = data_sharing_point::whereJsonContains('data_sharing_rules_id', $id)->toSql();
        foreach ($data_sharing_rule as $dskey => $dsVal) {
            $dsrData = ["Can_be_accessed" => $dsVal['Can_be_accessed'], "contacts"=> $dsVal['contacts']];
            //return $dsrData;
            // $this->store($dsrData, $dsVal);
            $test[] = $this->addOrUpdateSharingPoints($dsrData, $dsVal);
            }
        return $test;
    }
    public function addOrUpdateSharingPoints(array $data, $dataSharingRule)
    {
        $reportUserId = $data['contacts'] ?? null;
        $group_user_id = $reportUserId ? json_decode(reportuser::find($reportUserId)->user_id) : null;
        // return $group_user_id;
    
        if (!is_null($group_user_id) && is_array($group_user_id)) {
            foreach ($group_user_id as $gkey => $user_id) {
                $dataSharing = Usergroup::firstOrNew(['user_id' => $user_id]);
    
                if (isset($dataSharing->user_id)) {
                    $lastData = Usergroup::where('user_id', $user_id)->value('associated_user_id');
    
                    $lastDataArray = json_decode($lastData, true) ?? [];
                    $newDataValue = json_decode(reportuser::find($data['Can_be_accessed'])->user_id) ?? [];
    
                    foreach ($newDataValue as $nkey => $nVal) {
                        if (!in_array($nVal, $lastDataArray)) {
                            $lastDataArray[] = $nVal;
                        }
                    }
                    
                    /* to add json array for data_sharing_rules_id */
                    $lastSharingRulesData = Usergroup::where('user_id', $user_id)->value('data_group_id');
                    // return  ['lastSharingRulesData123' => $lastSharingRulesData];
                    $lastSharingRulesDataArray = json_decode($lastSharingRulesData, true) ?? [];
                    $newSharingRulesDataValue = [$dataSharingRule->id];
                    
                    foreach ($newSharingRulesDataValue as $nkey => $nsrVal) {
                        if (!in_array($nsrVal, $lastSharingRulesDataArray)) {
                            $lastSharingRulesDataArray[] = $nsrVal;
                        }
                    }
    
                    $dataSharing->data_group_id = json_encode($lastSharingRulesDataArray);
                    $dataSharing->user_id = $user_id;
                    $dataSharing->group_id = $data['contacts'];
                    $dataSharing->associated_user_id = json_encode($lastDataArray);
                    // return  ['dataSharing123' => $dataSharing];
                    $dataSharing->save();
                } else {
                    $dataSharing->group_id = $data['contacts'];
                    $dataSharing->data_group_id = json_encode([$dataSharingRule->id]);
                    $dataSharing->user_id = $user_id;
                    $dataSharing->associated_user_id = reportuser::find($data['can_be_accessed'])->user_id;
                    return  $dataSharing;
                    $dataSharing->save();
                }
            }
        } else {
            return ['error' => 'Invalid group_user_id data.'];
        }
    }
    

    
    // public function addOrUpdateSharingPoints(array $data, $dataSharingRule)
    // {
    //     $reportUserId = $data['user_id'] ?? null;
    //     $group_user_id = $reportUserId ? json_decode(reportuser::find($reportUserId)->user_id) : null;
    //      //return response()->json(['user_id' => $group_user_id]);
       
        
    //      foreach ($group_user_id as $gkey => $user_id) {
    //         $dataSharing = Usergroup::firstOrNew(['user_id' => $user_id]);
    //         if (isset($dataSharing->user_id)) {
    //             $lastData = Usergroup::where('user_id', $user_id)->value('user_id');
               
    //             $lastDataArray = json_decode($lastData, true) ?? [];
    //             $newDataValue = json_decode(reportuser::find($data['user_id'])->users) ?? [];
                
    //             foreach ($newDataValue as $nkey => $nVal) {
    //                 if (!in_array($nVal, $lastDataArray)) {
    //                     $lastDataArray[] = $nVal;
    //                 }
    //             }

    //             /* to add json array for data_sharing_rules_id */
    //             $lastSharingRulesData = Usergroup::where('user_id', $user_id)->value('id');
    //             $lastSharingRulesDataArray = json_decode($lastSharingRulesData, true) ?? [];
    //             $newSharingRulesDataValue = array($dataSharingRule->id);//json_decode(data_sharing_rule::find($data['group_id'])) ?? [];
                
    //             foreach ($newSharingRulesDataValue as $nkey => $nsrVal) {
    //                 if (!in_array($nsrVal, $lastSharingRulesDataArray)) {
    //                     $lastSharingRulesDataArray[] = $nsrVal;
    //                 }
    //             }

    //             $dataSharing->data_sharing_rules_id = json_encode($lastSharingRulesDataArray);//$dataSharingRule->id;
    //             $dataSharing->user_id = $user_id;
    //             $dataSharing->can_be_access_users_id = json_encode($lastDataArray);
    //             $dataSharing->save();
    //         }
    //         else
    //         {
    //             // $dataSharing->can_be_access_users_id = "'".data_sharing_group::find($data['can_access_to_group_id'])->users."'";
    //             $dataSharing->group_id = $data['group_id'];
    //             $dataSharing->data_sharing_rules_id = json_encode(array($dataSharingRule->id));
    //             $dataSharing->user_id = $user_id;
    //             $dataSharing->user_id = reportuser::find($data['user_id'])->users;
    //             $dataSharing->save();
    //         }
    //     }
    //    // return $dataSharing;
    //     return response()->json(['user_id' => $dataSharing]);
    // }
    // public function addOrUpdateSharingPoints(array $data, $dataSharingRule)
    // {
    //     $reportUserId = $data['user_id'];
    //     $group_user_id = json_decode(reportuser::find($reportUserId)->user_id);
    //      return response()->json(['user_id' => $group_user_id]);
    
    //     foreach ($group_user_id as $gkey => $user_id) {
    //         $dataSharing = Usergroup::firstOrNew(['user_id' => $user_id]);
    
    //         if (isset($dataSharing->user_id)) {
    //             $lastData = Usergroup::where('user_id', $user_id)->value('user_id');
    //             return response()->json(['lastData' => $lastData]);
    //             $lastDataArray = json_decode($lastData, true) ?? [];
    //             $newDataValue = json_decode(reportuser::find($data['user_id'])->users) ?? [];
    
    //             foreach ($newDataValue as $nkey => $nVal) {
    //                 if (!in_array($nVal, $lastDataArray)) {
    //                     $lastDataArray[] = $nVal;
    //                 }
    //             }
    
    //             /* to add json array for data_sharing_rules_id */
    //             $lastSharingRulesData = Usergroup::where('user_id', $user_id)->value('id');
    //             $lastSharingRulesDataArray = json_decode($lastSharingRulesData, true) ?? [];
    //             $newSharingRulesDataValue = array($dataSharingRule->id);//json_decode(data_sharing_rule::find($data['group_id'])) ?? [];
    
    //             foreach ($newSharingRulesDataValue as $nkey => $nsrVal) {
    //                 if (!in_array($nsrVal, $lastSharingRulesDataArray)) {
    //                     $lastSharingRulesDataArray[] = $nsrVal;
    //                 }
    //             }
    
    //             $dataSharing->data_sharing_rules_id = json_encode($lastSharingRulesDataArray);//$dataSharingRule->id;
    //             $dataSharing->user_id = $user_id;
    //             $dataSharing->can_be_access_users_id = json_encode($lastDataArray);
    //             $dataSharing->save();
    //         } else {
    //             // $dataSharing->can_be_access_users_id = "'".data_sharing_group::find($data['can_access_to_group_id'])->users."'";
    //             $dataSharing->group_id = $data['group_id'];
    //             $dataSharing->data_sharing_rules_id = json_encode(array($dataSharingRule->id));
    //             $dataSharing->user_id = $user_id;
    //             $dataSharing->can_be_access_users_id = reportuser::find($data['can_access_to_group_id'])->users;
    //             $dataSharing->save();
    //         }
    //     }
    //     return $dataSharing;
    // }
    
// public function update(Request $request, $id)
// {
//      /* to delete the all users from data_sharing_point having related group  */
//      $data_sharing_group = reportuser::findOrFail($id);
//      $dataSharing = Usergroup::whereIn('user_id', json_decode($data_sharing_group->user_id))->where('group_id', $id)->get();
//      if(!$dataSharing->isEmpty()) Usergroup::whereIn('user_id', json_decode($data_sharing_group->user_id))->delete();
     

//      $data_sharing_rule = sharing_access::where('contacts', $id)->get();
//      $result = $this->addUpdateDataSharingPointUsers($id);
//     return response()->json(['dataSharing' => $result]);
    
   
// }
// public function updateSharingPointAccessUsersId(array $data, $id)
// {
//     //create array column to data_sharing_rule_id and store all matching array in json formate
//     $getDataSharingRuleId = sharing_access::where('Can_be_accessed', $id)->get();
//     foreach ($getDataSharingRuleId as $dsrkey => $dsrVal) {
//         $dataSharingPointUsers = Usergroup::whereJsonContains('data_group_id', $dsrVal->id)->get();
//         foreach ($dataSharingPointUsers as $dspkey => $dspVal) {
//             $group_user_id = json_decode(reportuser::find($id)->user_id);
            
//             $diff1 = array_diff(json_decode($dspVal->Can_be_accessed), $group_user_id);
//             $newDataSharingPointUsers = array_merge($diff1, $data['user_id']);
//             $dspVal->update(["Can_be_accessed" => json_encode($newDataSharingPointUsers)]);
//         }
//     }
//     return true;
// }

public function updateSharingPointAccessUsersId(array $data, $id)
{
    //create array column to data_sharing_rule_id and store all matching array in json format
    $getDataSharingRuleId = sharing_access::where('Can_be_accessed', $id)->get();
    return response()->json(['updateSharingPointAccessUsersId' => $getDataSharingRuleId]);
   // return response()->json($getDataSharingRuleId,'200');
    foreach ($getDataSharingRuleId as $dsrkey => $dsrVal) {
        $dataSharingPointUsers = Usergroup::whereJsonContains('data_group_id', $dsrVal->id)->get();
        foreach ($dataSharingPointUsers as $dspkey => $dspVal) {
            $group_user_id = json_decode(reportuser::find($id)->user_id);
            $canBeAccessed = $dspVal->Can_be_accessed ? json_decode($dspVal->Can_be_accessed) : [];
            $diff1 = array_diff($canBeAccessed, $group_user_id);
           
            $newDataSharingPointUsers = array_merge($diff1, $data['user_id']);
            $dspVal->update(["Can_be_accessed" => json_encode($newDataSharingPointUsers)]);
        }
    }
    //return true;
}

public function updateSharingPointAccessUsers(array $data, $id)
{
    $getDataSharingRuleId = sharing_access::where('Can_be_accessed', $id)->get();
    foreach ($getDataSharingRuleId as $dsrkey => $dsrVal) {
        $dataSharingPointUsers = Usergroup::whereJsonContains('data_group_id', $dsrVal->id)->get();
        foreach ($dataSharingPointUsers as $dspkey => $dspVal) {
            $group_user_id = json_decode(reportuser::find($id)->user_id);
            $canBeAccessed = $dspVal->associated_user_id ? json_decode($dspVal->associated_user_id) : [];
            $diff1 = array_diff($canBeAccessed, $group_user_id);
            
            $newDataSharingPointUsers = array_merge($diff1, json_decode($data['user_id']));
            $dspVal->update(["associated_user_id" => json_encode($newDataSharingPointUsers)]);
        }
    }
    return response()->json(['newDataSharingPointUsers' => $newDataSharingPointUsers, 'canBeAccessed' => $canBeAccessed, 'group_user_id' => $group_user_id, 'merge' => json_decode($data['user_id'])]);
}

// public function Usergroupadd(Request $request)
// {
//     return response()->json(["new" => $request->all()]);
// }


public function Usergroupadd(Request $request)
{
   // $user = Usergroup::
   $usergroups = Usergroup::all();
    //    $user = new Usergroup();
   $usergroups->user_id = $request->input('user_id');
   return response()->json($usergroups, 200);
   
    $user->data = $request->input('data');
    $user->save();

    return response()->json($user, 200);
}
// public function update(Request $request, $id)
// {
//     $getDataSharingRuleId = sharing_access::where('Can_be_accessed', $id)->get();
//     $accessdata = $this->updateSharingPointAccessUsers($request->all(), $id);
//     // //return response()->json(['abc' => $accessdata]);
     
//      /* to delete the all users from data_sharing_point having related group  */
//      $data_sharing_group = reportuser::findOrFail($id);
//      $dataSharing = Usergroup::whereIn('user_id', json_decode($data_sharing_group->user_id))->where('group_id', $id)->get();
//      if(!$dataSharing->isEmpty()) Usergroup::whereIn('user_id', json_decode($data_sharing_group->user_id))->delete();
//      /*data reportuser saved*/
//      $usergroup = reportuser::findOrFail($id);
		
//      $usergroup = reportuser::find($id);
//      $usergroup->update($request->all());

//      $data_sharing_rule = sharing_access::where('contacts', $id)->get();
//      $result = $this->addUpdateDataSharingPointUsers($id);
   
// }

public function update(Request $request, $id)
{
    $getDataSharingRuleId = sharing_access::where('Can_be_accessed', $id)->get();
    // if(!$getDataSharingRuleId->isEmpty()) $this->updateSharingPointAccessUsersId($request->all(), $id);
    if(!$getDataSharingRuleId->isEmpty()) $this->updateSharingPointAccessUsers($request->all(), $id);
    // return response()->json(['abc' => $access]);
     
     /* to delete the all users from data_sharing_point having related group  */
     $data_sharing_group = reportuser::findOrFail($id);
     $dataSharing = Usergroup::whereIn('user_id', json_decode($data_sharing_group->user_id))->where('group_id', $id)->get();
     if(!$dataSharing->isEmpty()) Usergroup::whereIn('user_id', json_decode($data_sharing_group->user_id))->delete();
     /*data reportuser saved*/
     $usergroup = reportuser::findOrFail($id);
		
     $usergroup = reportuser::find($id);
     $usergroup->update($request->all());

     $data_sharing_rule = sharing_access::where('contacts', $id)->get();
     if(!$data_sharing_rule->isEmpty()) $result = $this->addUpdateDataSharingPointUsers($id);
     return response()->json(['message' => 'Sharing Access add successfully']);
    //   return response()->json(['abc'=>'data found']);
}
    public function destroy($id)
    {
        $record = Usergroup::findOrFail($id);
        $groupId = $record->group_id;
        $record->delete();
        Usergroup::where('group_id', $groupId)->delete();
        
        return response()->json(['message' => 'Sharing Access deleted successfully']);
    }
    
//working code/////////////

// public function store(Request $request)
// {
//     $dataGroupId = $request->input('data_group_id');
//     $groupId = $request->input('group_id');

//     $userIds = $request->input('user_id');
//     $associatedUserIds = $request->input('associated_user_id');
//     if (!is_null($groupId) && !is_null($userIds) && !is_null($associatedUserIds) && count($userIds) === count($associatedUserIds)) {
//         $storedData = [];
//         // dd($userIds);
//         foreach (json_decode($userIds['user_id']) as $index => $userId) {
           
//             $sharingRule = Usergroup::firstOrNew(['user_id' => $userId]);
           
            
//             // if(!$dataSharing->isEmpty())
//             if(isset($sharingRule->associated_user_id))
//             {
//                 $lastData = Usergroup::where('user_id', $userId)->value('associated_user_id');
//                 $lastDataArray = json_decode($lastData, true) ?? [];
//                 $newDataValue = json_decode($associatedUserIds['user_id']);//json_decode(reportuser::find($associatedUserIds['user_id'])->user_id) ?? [];
         
                
//                 foreach ($newDataValue as $nkey => $nVal) {
//                     if (!in_array($nVal, $lastDataArray)) {
//                         $lastDataArray[] = $nVal;
//                     }
//                 }

//                 //data_group_id add data
//             //     $lastSharingRulesData = Usergroup::where('user_id', $userId)->value('data_group_id');
//             //     $lastSharingRulesDataArray = json_decode($lastSharingRulesData, true) ?? [];
//             // return response()->json(['message' => 'Data stored successfully', 'data' => $storedData], 201);

//             //     //$newSharingRulesDataValue = array($dataSharingRule->id);//json_decode(data_sharing_rule::find($data['group_id'])) ?? [];
               
//             //     foreach ($newSharingRulesDataValue as $nkey => $nsrVal) {
//             //         if (!in_array($nsrVal, $lastSharingRulesDataArray)) {
//             //             $lastSharingRulesDataArray[] = $nsrVal;
//             //         }
//             //     }
//                 //////////////////////////////////////////
//                  $sharingRule->user_id = $userId;
//                 $sharingRule->associated_user_id = json_encode($lastDataArray);
//                 $sharingRule->save(); 
//             }
//             else
//             {  
//                 $sharingRule = Usergroup::create([
                   
//                     'data_group_id' => $dataGroupId,
//                     'group_id' => $groupId,
//                     'user_id' => $userId,
//                     'associated_user_id' => $associatedUserIds['user_id'],
//                 ]);
//             }
//             $storedData[] = $sharingRule;
//         }
//             return response()->json(['message' => 'Data stored successfully', 'data' => $storedData], 201);

           
//     }

  
// }

public function store(Request $request)
{
    $dataGroupId = $request->input('data_group_id');
    $groupId = $request->input('group_id');

    $userIds = $request->input('user_id');
    $associatedUserIds = $request->input('associated_user_id');

    if (!is_null($groupId) && !is_null($userIds) && !is_null($associatedUserIds) && count($userIds) === count($associatedUserIds)) {
        $storedData = [];

        foreach (json_decode($userIds['user_id']) as $index => $userId) {
            $sharingRule = Usergroup::firstOrNew(['user_id' => $userId]);

            if (isset($sharingRule->associated_user_id)) {
                $lastData = Usergroup::where('user_id', $userId)->value('associated_user_id');
                $lastDataArray = json_decode($lastData, true) ?? [];
                $newDataValue = json_decode($associatedUserIds['user_id']);

                foreach ($newDataValue as $nkey => $nVal) {
                    if (!in_array($nVal, $lastDataArray)) {
                        $lastDataArray[] = $nVal;
                    }
                }

                $sharingRule->user_id = $userId;
                $sharingRule->associated_user_id = json_encode($lastDataArray);
                $sharingRule->save();

                // Fetch the existing data_group_id array
                $existingDataGroupId = json_decode($sharingRule->data_group_id, true) ?? [];

                // If the new data_group_id is not already in the array, add it
                if (!in_array($dataGroupId, $existingDataGroupId)) {
                    $existingDataGroupId[] = $dataGroupId;
                }

                // Save the updated data_group_id array
                $sharingRule->data_group_id = json_encode($existingDataGroupId);
                $sharingRule->save();
            } else {
                $sharingRule = Usergroup::create([
                    'data_group_id' => json_encode([$dataGroupId]), // Save the data_group_id as an array
                    'group_id' => $groupId,
                    'user_id' => $userId,
                    'associated_user_id' => $associatedUserIds['user_id'],
                ]);
            }
            $storedData[] = $sharingRule;
        }

        return response()->json(['message' => 'Data stored successfully', 'data' => $storedData], 201);
    }
}

#####################################
// public function updateData(Request $request)
// {
//     // $firstArray = ['288', '324'];
//     $secondArray = ['215', '240'];
//     // $firstArray = $request->input('first_array');
//     // $firstArray = $request->input('first_array');
//     // $secondArray = $request->input('second_array');
//     // Retrieve existing associated_user_ids as arrays
//     $existingAssociatedUserIds = Usergroup::whereIn('user_id', $firstArray)
//         ->pluck('associated_user_id')
//         ->map(function ($item) {
//             return json_decode($item, true);
//         })
//         ->toArray();

//     // Merge the second array with the existing associated_user_id arrays
//     $mergedData = array_merge($existingAssociatedUserIds, [$secondArray]);

//     // Flatten the nested arrays
//     $mergedData = $this->flattenArray($mergedData);

//     // Remove any duplicate values
//     $mergedData = array_values(array_unique($mergedData));

//     // Update the associated_user_id column with the merged data
//     Usergroup::whereIn('user_id', $firstArray)
//         ->update(['associated_user_id' => json_encode($mergedData)]);

//     return response()->json([
//         'message' => 'Data updated and stored successfully',
//         'merged_data' => $mergedData
//     ]);
// }

//Helper function to flatten nested arrays
protected function flattenArray($array)
{
    $result = [];

    foreach ($array as $item) {
        if (is_array($item)) {
            $result = array_merge($result, $this->flattenArray($item));
        } else {
            $result[] = $item;
        }
    }

    return $result;
}






// public function updateUserGroup1(Request $request)
// {
//     // Assuming you have a 'users' table and a corresponding User model

//     // Get the user ID from the request (replace 'user_id' with your actual field name)
//     $user_id = $request->input('user_id');

//     // Retrieve the existing user data from the database
//     $user = Usergroup::find($user_id);

//     // if (!$user) {
//     //     // If the user with the given ID does not exist, handle the case accordingly
//     //     return response()->json(['message' => 'User not found'], 404);
//     // }

//     // Now you have the existing user data in the $user variable
//     // You can access and modify the user data as needed

//     // For example, you can update user attributes based on the request data:
//     // $user->name = $request->input('name');
//     // $user->email = $request->input('email');
//     $user->user_id = $request->input('user_id');

//     // Save the updated user data back to the database
//     $user->save();

//     // Optionally, you can return a response with the updated user data
//     return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
// }
public function checkDataExists(Request $request)
{
    $userId = $request->input('user_id');

    $exists = Usergroup::where('user_id', $userId)->exists();

    return response()->json($userId);
}

// public function updateUser(Request $request)
// {
//     $userId = $request->input('user_id');
//     $associatedUserIds = $request->input('associated_user_id');

//     // Find the existing user data in the 'Usergroup' table based on the 'user_id'
//     $existingUser = Usergroup::where('user_id', $userId)->first();

//     if (!$existingUser) {
//         return response()->json(['message' => 'User not found'], 404);
//     }

//     // Merge the existing associated_user_ids with the new data from the request
//     $existingAssociatedUserIds = json_decode($existingUser->associated_user_id, true) ?? [];
//     $newAssociatedUserIds = json_decode($associatedUserIds, true) ?? [];
//     $mergedAssociatedUserIds = array_unique(array_merge($existingAssociatedUserIds, $newAssociatedUserIds));

//     // Update the 'associated_user_id' field for the specific user
//     $existingUser->associated_user_id = json_encode($mergedAssociatedUserIds);
//     $existingUser->save();

//     // Optionally, you can return a response with the updated user data
//     return response()->json(['message' => 'User updated successfully', 'user' => $existingUser], 200);
// }
public function deleteByGroupId($groupId)
    {
        try {
            // Use the Eloquent model to delete records
            $deletedCount = SharingRule::where('group_id', $groupId)->delete();

            // Success message or further actions
            return "Successfully deleted {$deletedCount} records with group_id={$groupId}.";
        } catch (\Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }

   
    public function checkDatauser(Request $request)
    {
        // Update the reportuser table
        $reportuser = reportuser::find($request->id);
        $reportuser->update($request->all());
    
        $updatedGroupId = $reportuser->group_id;
        $sharing_access_records = sharing_access::where('group_id', $updatedGroupId)->get();
        foreach ($sharing_access_records as $sharing_access_record) {
            Usergroup::where('group_id', $sharing_access_record->group_id)->delete();
        }
    
        $updatedData = [
            'group_id' => $updatedGroupId,
            // Add other fields as needed
        ];
    
        Usergroup::create($updatedData);
    
        return response()->json([
            'message' => 'Data updated successfully!',
        ]);
    }
    

   

}


  

