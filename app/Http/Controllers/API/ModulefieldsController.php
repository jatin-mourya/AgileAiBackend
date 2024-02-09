<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulefields;

class ModulefieldsController extends Controller
{
    public function index()
    {
        $modulefields = Modulefields::all();
        // $modulefields = DB::table('salesdetails')
        //                 ->join('clientdetails', 'clientdetails.client_id', '=', 'salesdetails.client_id')
        //                 ->join('projects', 'projects.project_id', '=', 'salesdetails.project_id')
        //                 ->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
        //                 ->join('booking_status','booking_status.deal_status_id','=','salesdetails.deal_status_id')
        //                 ->join('leadsource','leadsource.leadsource_id','=','salesdetails.leadsource_id')
        //                 ->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
        //                 ->join('users','users.user_id','=','salesdetails.sourcing_emp_id')
        //                 //->AND('users','users.user_id','=','salesdetails.closing_emp_id')
        //                 ->join('teams','teams.team_id','=','salesdetails.team_id')
        //                 ->join('invoice', 'invoice.sales_id','=','salesdetails.sales_id')
        //                 ->join('inv_status', 'inv_status.inv_status_id', '=', 'invoice.inv_status_id')
        //                 ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', '=', 'invoice.company_id')
        //                 ->join('clientdetails','clientdetails.name','=','module_fields.table_field')
        //                 ->select('salesdetails.sales_id','clientdetails.name','projects.project_name','subprojects.subproject_name', 'booking_status.status', 'leadsource.leadsource','salesdetails.booking_date','channelpartner.cp_name','users.firstname','users.middlename','users.lastname','teams.teamname','invoice.*','inv_status.status','debtor_company_det.cname',
        //                 'clientdetails.name')
        //                 ->get();
		return response()->json($modulefields);

        // $data = Modulefields::select('module_name')->where('module_field_name_2', 'Client Name')->get();
        // return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newModulefields = new Modulefields([
			'module_name' => $request->get('module_name'),
            'module_field_name' => $request->get('module_field_name')
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
        
        if($request->table_field != null){
            $table_field = $request->table_field;
            $modulefieldsModel = new Modulefields();
            $data4 = $modulefieldsModel->getModulefields1($table_field);
            return response()->json($data4);
      }else{
            $module_name = $request->module_name;
            $modulefieldsModel = new Modulefields();
            $data = $modulefieldsModel->getModulefields($module_name);
            return response()->json($data);
      }
                $module_name = $request->module_name;
                $modulefieldsModel = new Modulefields();
                $data1 = $modulefieldsModel->getSecModulefields($module_name);
                return response()->json($data1);
    
                $module_field_name_2 = $request->module_field_name_2;
                $modulefieldsModel = new Modulefields();
                $data1 = $modulefieldsModel->getDropdownlist($module_field_name_2);
                return response()->json($data1);
    
                $module_name = $request->module_name;
                $modulefieldsModel = new Modulefields();
                $data3 = $modulefieldsModel->gettablefield($module_name);
                return response()->json($data3);
    
                // $table_field = $request->table_field;
                // $modulefieldsModel = new Modulefields();
                // $data4 = $modulefieldsModel->getvalue($table_field);
                // return response()->json($data4);
    
               
    
            $request->validate([
                'module_name' => 'required',
                 'module_field_name' => 'required'
            ]);
    
            $newModulefields = new Modulefields([
                'module_name' => $request->get('module_name'),
                'module_field_name' => $request->get('module_field_name')
            ]);
    
            $newModulefields->save();
    
            return response()->json($newModulefields);
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($module_id)
    {
        $modulefields = Modulefields::findOrFail($module_id);
		return response()->json($modulefields);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($module_id)
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
    public function update(Request $request, $module_id)
    {
		
		$modulefields = Modulefields::findOrFail($module_id);
		
		$modulefields = Modulefields::find($module_id);
        $modulefields->update($modulefields->all());
        return $modulefields;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($module_id)
    {
        $modulefields = Modulefields::findOrFail($module_id);
		$modulefields->delete();

		return response()->json($modulefields::all());
    }

  
}
