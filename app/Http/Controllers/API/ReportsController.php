<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\Salesdetails;
use App\Models\Clientdetails;
use App\Models\Modulefields;
use App\Models\Projects;
use App\Models\Subprojects;




class ReportsController extends Controller
{
    public function index()
    {
      $reports = Reports::all();
     // dd(response()->json($reports));
     $reports = DB::table('reports')
     ->orderBy('updated_at','DESC')
     ->get();

		  return response()->json($reports);
    }


    public function getid(){
      $reports = DB::table('reports')
                ->select('reports.reports_id','primary_module_name','secondary_module_name')
                ->orderBy('reports_id','DESC')
                ->limit(1)
                ->get();
                //dd($reports);
      return response()->json($reports);
    }


    public function calculation(){
      $calculation = DB::table('calculations_fields')
                ->select('*')
                ->get();
                //dd($reports);
      return response()->json($calculation);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newReports = new Reports([
			    'report_name' => $request->get('report_name'),
			    'primary_module_name' => $request->get('primary_module_name'),
          'primary_module_field_name' => $request->get('primary_module_field_name'),
          'secondary_module_name' => $request->get('secondary_module_name'),
          'secondary_module_field_name' => $request->get('secondary_module_field_name'),
          'reports_field_1' => $request->get('reports_field_1'),
          'conditions' => $request->get('conditions'),
          'reports_field_2' => $request->get('reports_field_2'),
          'cal_sum' => $request->get('cal_sum'),
          'cal_avg' => $request->get('cal_avg')
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
			    'report_name' => 'required',
			    'primary_module_name' => 'required',
          'primary_module_field_name' => 'required',
          'secondary_module_name' => '',
          'secondary_module_field_name' => '',
          'reports_field_1' => 'required',
          'conditions' => 'required',
          'reports_field_2' => 'required',
          'cal_sum' => '',
          'cal_avg' => ''
            
		]);

		$newReports = new Reports([
			    'report_name' => $request->get('report_name'),
          'primary_module_name' => $request->get('primary_module_name'),
          //'primary_module_field_name' => json_encode($request->get('primary_module_field_name')),
          'primary_module_field_name' => $request->get('primary_module_field_name'),
          'secondary_module_name' => $request->get('secondary_module_name'),
          //'secondary_module_field_name' => json_encode($request->get('secondary_module_field_name'))
          'secondary_module_field_name' => $request->get('secondary_module_field_name'),
          'reports_field_1' => $request->get('reports_field_1'),
          'conditions' => $request->get('conditions'),
          'reports_field_2' => $request->get('reports_field_2'),
          'cal_sum' => $request->get('cal_sum'),
          'cal_avg' => $request->get('cal_avg')
           
		]);

		$newReports->save();

		return response()->json($newReports);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reports_id)
    {
        $reports = Reports::findOrFail($reports_id);
		    return response()->json($reports);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($reports_id)
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
    public function update(Request $request, $reports_id)
    {
        if ($request->get('cal_sum') != Null && $request->get('cal_avg') != Null)
        {
        $data =implode(',',$request->get('cal_sum'));
        $data1 =implode(',',$request->get('cal_avg'));
        $reports = DB::table('reports') 
              ->where('reports_id', $reports_id)
              ->update(array('cal_sum' => $data,'cal_avg' => $data1));
        return $reports;
        }
        elseif($request->get('cal_sum') != Null && $request->get('cal_avg') == Null)
        {
          $data =implode(',',$request->get('cal_sum'));
          $reports = DB::table('reports') 
                ->where('reports_id', $reports_id)
                ->update(array('cal_sum' => $data,'cal_avg' => NULL));

          return $reports;
        }
          elseif($request->get('cal_sum') == Null && $request->get('cal_avg') != Null)
        {
          $data =implode(',',$request->get('cal_avg'));
          $reports = DB::table('reports') 
                ->where('reports_id', $reports_id)
                ->update(array('cal_sum' => NULL,'cal_avg' => $data));
          return $reports;
        }
        else
        {
        $reports = DB::table('reports') 
        ->where('reports_id', $reports_id)
        ->update(array('cal_sum' => NULL,'cal_avg' => NULL));
        return $reports;
        }
       
		
    }

    public function addsum(Request $request, $reports_id){
      //dd($data);
      $reports = DB::table('reports') 
                ->where('reports_id', $id)
                ->update(array('cal_sum' => $request->all()))
                ->get();
                return $reports;
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reports_id)
    {
      $reports = Reports::findOrFail($reports_id);
		  $reports->delete();

		return response()->json($reports::all());
    }

public function calsum($reports_id)
    {
      $reports = Reports::findOrFail($reports_id);
      $data = response()->json($reports);
     $reports_field_1 =  $data->getData()->reports_field_1;
   
     //for where condition //
   
     // $variable = strstr($reports_field_1, '.');
     // $reports_field_1 = str_replace(".","",$variable);
     $primary_module_name = $data->getData()->primary_module_name;
     $secondary_module_name = $data->getData()->secondary_module_name;

    //for where condition value//
     $reports_field_2 =  $data->getData()->reports_field_2;
     $cal_sum = $data->getData()->cal_sum;
     if($cal_sum != null){
     $stringarr2 = explode(',',$cal_sum);
     $length2 = count($stringarr2);
     for($i=0; $i<$length2; $i++){
     $headerArr2[] = $stringarr2[$i];
    }  
    for($i=0; $i<$length2; $i++){
      if(($primary_module_name == 'Sales' && $secondary_module_name == 'Users') || ($primary_module_name == 'Users' && $secondary_module_name == 'Sales'))
        {
    $reports1[] = DB::table('salesdetails')
                ->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
                ->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
                ->join('projects','projects.project_id','=','salesdetails.project_id')
                ->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
                ->join('users','users.user_id','=','salesdetails.sourcing_emp_id')
                ->join('teamdetails','teamdetails.user_id','=','users.user_id')
                ->join('teams','teams.team_id','=','teamdetails.team_id')
                ->join('designations','designations.designation_id','=','teamdetails.designation_id')
               ->select(DB::raw("SUM($stringarr2[$i])"))
               ->where( $reports_field_1, $reports_field_2)
               ->get()
               ->toArray();
        }

        if(($primary_module_name == 'Invoice' && $secondary_module_name == 'Sales') || ($primary_module_name == 'Sales' && $secondary_module_name == 'Invoice'))
     {
    $reports1[] = DB::table('salesdetails')
                ->join('invoice', 'invoice.sales_id', '=', 'salesdetails.sales_id')
                ->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
                ->join('projects','projects.project_id','=','salesdetails.project_id')
                ->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
                ->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
               ->select(DB::raw("SUM($stringarr2[$i])"))
               ->where( $reports_field_1, $reports_field_2)
               ->get()
               ->toArray();
        }
               
             //dd($reports1);
          }
         // dd($reports1);
         $reports1 = [];
         $result = [];
          for($i=0; $i<count($reports1); $i++){
            for($j=0; $j<count($reports1[$i]); $j++){
              $result[]=$reports1[$i][$j];

            }
          }
          return response()->json($result);
        }
        else{
          $result2 = [];
          return response()->json($result2);
                    }
        }




 public function calavrg($reports_id){

          $reports = Reports::findOrFail($reports_id);
          $data = response()->json($reports);
          $primary_module_name = $data->getData()->primary_module_name;
          $secondary_module_name = $data->getData()->secondary_module_name;
        
          $reports_field_1 =  $data->getData()->reports_field_1;
          $reports_field_2 =  $data->getData()->reports_field_2;
        
                  $cal_avg = $data->getData()->cal_avg;
                  if($cal_avg != null){
               
                  $stringarr3 = explode(',',$cal_avg);
                  $length3 = count($stringarr3);
                  for($i=0; $i<$length3; $i++){
                  $headerArr3[] = $stringarr3[$i];
                }  
              for($i=0; $i<$length3; $i++){
                if(($primary_module_name == 'Sales' && $secondary_module_name == 'Users') || ($primary_module_name == 'Users' && $secondary_module_name == 'Sales'))
                {
           
               $reports2[] = DB::table('salesdetails')
                            ->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
                            ->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
                            ->join('projects','projects.project_id','=','salesdetails.project_id')
                            ->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
                            ->join('users','users.user_id','=','salesdetails.sourcing_emp_id')
                            ->join('teamdetails','teamdetails.user_id','=','users.user_id')
                            ->join('teams','teams.team_id','=','teamdetails.team_id')
                            ->join('designations','designations.designation_id','=','teamdetails.designation_id')
                            ->select(DB::raw("AVG($stringarr3[$i])"))
                            ->where( $reports_field_1, $reports_field_2)
                            ->get();
                          }
                 
             
        
             if(($primary_module_name == 'Invoice' && $secondary_module_name == 'Sales') || ($primary_module_name == 'Sales' && $secondary_module_name == 'Invoice'))
             {
                $reports2[] = DB::table('salesdetails')
                            ->join('invoice', 'invoice.sales_id', '=', 'salesdetails.sales_id')
                            ->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
                            ->join('projects','projects.project_id','=','salesdetails.project_id')
                            ->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
                            ->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
                             ->select(DB::raw("AVG($stringarr3[$i])"))
                             ->where( $reports_field_1, $reports_field_2)
                             ->get();
                           }
                 
                          }
         
        
                      // dd($reports1);
                       for($i=0; $i<count($reports2); $i++){
                         for($j=0; $j<count($reports2[$i]); $j++){
                           $result2[]=$reports2[$i][$j];
             
                         }
                       }
                       return response()->json($result2);
                 
                }
                  else
                  {
        $result2 = [];
        return response()->json($result2);
                  }    
        }


public function generatereports($reports_id){

  $reports = Reports::findOrFail($reports_id);
  return response()->json($reports);

  $data = response()->json($reports);
  //for select query//
 
  $primary_module_name = $data->getData()->primary_module_name;
  $secondary_module_name = $data->getData()->secondary_module_name;

$primary_module_field_name = $data->getData()->primary_module_field_name;
$stringarr = explode(',',$primary_module_field_name);
$length = count($stringarr);
for($i=1; $i<$length; $i+=2){
$headerArr[] = $stringarr[$i];
}

$secondary_module_field_name = $data->getData()->secondary_module_field_name;
$stringarr1 = explode(',',$secondary_module_field_name);
$length1 = count($stringarr1);
for($i=1; $i<$length1; $i+=2){
$headerArr1[] = $stringarr1[$i];
}

$reports_field_1 =  $data->getData()->reports_field_1;

//for where condition //

// $variable = strstr($reports_field_1, '.');
// $reports_field_1 = str_replace(".","",$variable);


//for where condition value//
$reports_field_2 =  $data->getData()->reports_field_2;

$array = array_merge($headerArr, $headerArr1);




//  *********************   Users  + Salary  ********************


if(($primary_module_name == 'Users' && $secondary_module_name == 'Salary') || ($primary_module_name == 'Salary' && $secondary_module_name == 'Users'))
{
$reports = DB::table('salary_package')
->join('users', 'users.user_id', '=', 'salary_package.user_id')
->join('teamdetails','teamdetails.user_id','=','users.user_id')
->join('teams','teams.team_id','=','teamdetails.team_id')
->Join('monthly_salary','monthly_salary.user_id','=','users.user_id')
->join('designations','designations.designation_id','=','teamdetails.designation_id')
->select($array)
->where($reports_field_1, $reports_field_2)
->get()
->toArray();
return response()->json($reports);
}

//  *********************   Invoice + sales  ********************

if(($primary_module_name == 'Invoice' && $secondary_module_name == 'Sales') || ($primary_module_name == 'Sales' && $secondary_module_name == 'Invoice'))
{
$reports = DB::table('salesdetails')
->join('invoice', 'invoice.sales_id', '=', 'salesdetails.sales_id')
->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
->join('projects','projects.project_id','=','salesdetails.project_id')
->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
->select($array)
->where($reports_field_1, $reports_field_2)
->get()
->toArray();
return response()->json($reports);
}

//  *********************  Users + Sales    ********************
if(($primary_module_name == 'Sales' && $secondary_module_name == 'Users') || ($primary_module_name == 'Users' && $secondary_module_name == 'Sales')){
$reports = DB::table('salesdetails')
->join('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
->join('channelpartner','channelpartner.cp_id','=','salesdetails.cp_id')
->join('projects','projects.project_id','=','salesdetails.project_id')
->join('subprojects','subprojects.subproject_id','=','salesdetails.subproject_id')
->join('users','users.user_id','=','salesdetails.sourcing_emp_id')
->join('teamdetails','teamdetails.user_id','=','users.user_id')
->join('teams','teams.team_id','=','teamdetails.team_id')
->join('designations','designations.designation_id','=','teamdetails.designation_id')

->select($array)
->where($reports_field_1, $reports_field_2)
->get()
->toArray();
return response()->json($reports);
}

}

}
