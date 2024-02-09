<?php

namespace App\Http\Controllers;
//use DB   
use Illuminate\Support\Facades\DB;;
use Illuminate\Http\Request;
use App\Http\Controllers\controller;
use App\Models\activitylogs;

class ActivitylogsController extends Controller
{

    
    public function index()
    {
        $active = activitylogs :: all();
        
        return response()-> json($active);
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => '',
            'username' => '',
            'action' => '',
            'modelname' => '',
			'previous' => '',
            'current' => '',
           
		]);

		$newupdate_Projects = new Projects([
            'user_id' => $request -> get('user_id'),
            'username' => $request -> get('username'),
            'action' => $request -> get('action'),
            'modelname' => $request -> get('modelname'),
			'previous' => $request->get('previous'),
            'current' => $request->get('current'),
            
		]);

		$newupdate_Projects->save();

		return response()->json($newupdate_Projects);
    
    }


   

    //get 
        public function getupdatesdeatil()
        {
            $activitylogs = activitylogs::all();
    
                    $activitylogs = DB::table('activitylogs')
                            ->select('activitylogs.*')
                            // ->leftjoin('builders_group', 'builders_group.builder_group_id', '=', 'activitylogs.builder_group_id')
                            // ->leftjoin('debtor_company_det','debtor_company_det.debtor_company_det_id', '=', 'activitylogs.debtor_company_det_id')
                            // ->select('activitylogs.*','debtor_company_det.cname','builders_group.name')
                            //->orderBy('activitylogs.updated_at', 'DESC')
                            ->get();
            return response()->json($activitylogs);
        
        }

     
    //post
       
public function registercreate(Request $request)
{
    $request->validate([
        'user_id' => '',
        'username' => '',
        'action' => '',
        'modelname' => '',
        'action' => '',
        'previous' => '',
        'current' => '',
    ]);

    $updates = new activitylogs();
    
    $updates->user_id = json_encode($request->input('user_id'));
    $updates->username = json_encode($request->input('username'));
    $updates->modelname = $request->input('modelname');
    $updates->action = $request->input('action');
    $updates->previous = json_encode($request->input('previous'));
    $updates->current = json_encode($request->input('current'));
    $updates->save();
    return response()->json($updates);
    
}

        
        //getbyId


public function getidupdatesdeatil($id)
{
    $getdataoneid = DB::table('activitylogs')
        ->select('activitylogs.*')
        ->where('activitylogs.id', $id)
        //->orderBy('activitylogs.updated_at', 'DESC')
        ->get();
    
    return response()->json($getdataoneid);
}




        //patch
        public function updatemydata(Request $request, $id){
            $projects = activitylogs::findOrFail($id);
		    $projects = activitylogs::find($id);
            $projects->update($request->all());
            // return $projects;
        }

        //deleteById
    

        public function deleteData($id)
        {
            $updatesDetails = activitylogs::findOrFail($id);
    
            
            if ($updatesDetails) {
                
                $updatesDetails->delete();
                return response()->json(['message' => 'Data deleted successfully'], 200);
            }
    
        }
    
}
