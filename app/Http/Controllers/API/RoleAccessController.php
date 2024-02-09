<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RoleAccess;
class RoleAccessController extends Controller
{
    public function index()
    {
        $designations = DB::table('permission_access')
                            ->select('*')
                            ->get();
		return response()->json($designations);
        // dd($designations);
    }

    public function create(Request $request)
    {
        $roleAccess = RoleAccess::create([
            'designation' => $request->get('designation'),
            'tab_id' => $request->get('tab_id'),
            'haveedit' => $request->get('haveedit'),
            'haveadd' => $request->get('haveadd'),
            'havedelete' => $request->get('havedelete'),
            'haveview' => $request->get('haveview')
        ]);

        // return response()->json(['roleAccess' => $roleAccess], 201);
    }

    public function rolestore(Request $request){
        $data = $request->all();
        foreach($data as $value)
        {
            
            $newReports = new RoleAccess();
            $newReports->designation = $value['designation'];
            $newReports->tab_id = $value['tab_id'];
            $newReports->haveedit = $value['haveedit'];
            $newReports->haveadd = $value['haveadd'];
            $newReports->havedelete = $value['havedelete'];
            $newReports->haveview = $value['haveview'];
            $newReports->save();
        }
        
        
        // dd($newReports);
    return response()->json($data);
   
    // return response()->json($data);
    }

// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'designation' => '',
//         'tab_id' => '',
//         'haveedit' => '',
//         'haveadd' => '',
//         'havedelete' => '',
//         'haveview' => '',
//     ]);
    
//     $newdata = new RoleAccess([
    
//         'designation' => $request->get('designation'),
//         'tab_id' => $request->get('tab_id'),
//         'haveedit' => $request->get('haveedit'),
//         'haveadd' => $request->get('haveadd'),
//         'havedelete' => $request->get('havedelete'),
//         'haveview' => $request->get('haveview')


//     ]);

//     $newdata->save();

//     return response()->json($newdata);
// }

public function getdesignationperm(Request $request)
{
    // $designationId = $request->designation_id;
    // $tabId = $request->tabs;
    
    $designationId = $request->designation_id; // Static designation ID
    $tabsKey = $request->tabs; // Static tabs key

    $row = DB::table('permission')
    ->select('permission.*')
        ->where('designation_id', $designationId)
        ->first();

    if ($row) {
        $tabsData = json_decode($row->tabs, true);
        $tabValue = $tabsData[$tabsKey] ?? null;
    } else {
        $tabValue = null;
    }

    return response()->json($tabValue);
    }
    



// public function getdesignationperm(Request $request)
// {
//     $designationpre = $request->designation_id;
//     dd($designationpre, 200);
// }





public function checktabdesignations(Request $request){
    $designationpre = $request->designation_id;
    $result = DB::table('permission')
    ->select('permission.*')
    
    ->where('designation_id', '=' , $designationpre)
    ->get();
    // return response()->json($result);
}


}





