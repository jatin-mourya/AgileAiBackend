<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ConsultancyFess;

class ConsultancyFessController extends Controller
{


    public function index()
    {  
        $newCF = ConsultancyFess::all();
        // $empdocuments = DB::table('users')
        // ->orderBy('users.updated_at','DESC')
        // ->get();
		return response()->json($newCF);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
     {
         $newCF = new ConsultancyFess([
             'sales_id' => $request->get('sales_id'),
            //  'booking_date' => $request->get('booking_date'),
            //  'booking_status' => $request->get('booking_status'),
            //  'project_name' => $request->get('project_name'),
            //  'client_name' => $request->get('client_name'),
            //  'cv_value' => $request->get('cv_value'),
            //  'payout_value' => $request->get('payout_value'),
            //  'lead_source' => $request->get('lead_source'),
             'consultancy_fees' => $request->get('consultancy_fees'),

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
             'sales_id' => 'required',
            //  'booking_date' => 'required',
            //  'booking_status' => 'required',
            //  'project_name' => 'required',
            //  'client_name' => 'required',
            //  'cv_value' => 'required',
            //  'lead_source' => 'required',
            //  'payout_value' => 'required',
             'consultancy_fees'=>'required'
            //  'actual_payout' => 'required',
         ]);
 
         $newCF = new ConsultancyFess([
             'sales_id' => $request->get('sales_id'),
            //  'booking_date' => $request->get('booking_date'),
            //  'booking_status' => $request->get('booking_status'),
            //  'project_name' => $request->get('project_name'),
            //  'client_name' => $request->get('client_name'),
            //  'cv_value' => $request->get('cv_value'),
            //  'payout_value' => $request->get('payout_value'),
            //  'lead_source' => $request->get('lead_source'),
             'consultancy_fees' => $request->get('consultancy_fees'),
         ]);
 
         $newCF->save();
 
         
         return response()->json($newCF);
         
         // return ('message','Success! You have added data successfully.');
 
     
     }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($cf_id)
    {
        $newCF = ConsultancyFess::findOrFail($cf_id);
		return response()->json($newCF);
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
    public function update(Request $request,$client_id)
    {
        $newCF = ConsultancyFess::findOrFail($client_id);

		$request->validate([
            'sales_id' => 'required',
			// 'booking_date' => 'required',
            // 'booking_status' => 'required',
            // 'project_name' => 'required',
            // 'client_name' => 'required',
            // 'cv_value' => 'required',
            // 'payout_value' => 'required',
            // 'lead_source' => 'required',
            'consultancy_fees' => 'required'
            // 'actual_payout' => 'required',
		]);

        $newCF->sales_id = $request->get('sales_id');
		// $newCF->booking_date = $request->get('booking_date');
        // $newCF->booking_status = $request->get('booking_status');
        // $newCF->project_name = $request->get('project_name');
        // $newCF->client_name = $request->get('client_name');
        // $newCF->cv_value = $request->get('cv_value');
        // $newCF->payout_value = $request->get('payout_value');
        // $newCF->lead_source = $request->get('lead_source');
        $newCF->consultancy_fees = $request->get('consultancy_fees');
     

		$newCF->save();

		return response()->json($newCF);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($client_id)
    {
        $newCF = ConsultancyFess::findOrFail($client_id);
		$newCF->delete();

		return response()->json($newCF::all());
    }

    




    
    public function getUserDesgination($designation_id){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

        // dd($designation_id);
        // $data=DB::table('designations')
        // ->select('designation')
        // ->where('designation_id','=' ,$designation_id)
        // ->get();
        // // return response()->json($data);

    }


    public function getCFCValue(){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

  
        $data=DB::table('salesdetails')
        ->select('*')
        ->leftJoin('team_leaders','team_leaders.user_id','=','salesdetails.team_id')
        ->where('team_leaders.region_head','=',6)
        ->get();
        return response()->json($data);


    }


    public function getSelectedDesignation($d_id){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

  
        $data=DB::table('users')
        ->select('*')
        ->join('designations','users.designation','=','designations.designation_id')
        ->where('users.designation','=',$d_id)
        ->get();
        return response()->json($data);

    }


    public function getstRegionHead($rh_id){
        // $sourcing_emp_id_emp_id = $request->get('sourcing_emp_id_emp_id');

  
        $data=DB::table('team_leaders')
        ->select('*')
        ->join('designations','users.designation','=','designations.designation_id')
        ->where('users.designation','=',$rh_id)
        ->get();
        return response()->json($data);

    }

    //29-12-2022 2 query
    // public function userTLRH($u_id){  
    // $data=DB::table('salesdetails')
    // ->select('*')
    // ->leftJoin('team_leaders','team_leaders.user_id','=','salesdetails.team_id')
    // ->where('team_leaders.region_head','=',$u_id)
    // ->get();
    // return response()->json($data);

    // }

    // $data=DB::table('salesdetails')
    // ->select('salesdetails.*','team_leaders.team_leader_name','projects.project_name','leadsource.leadsource','clientdetails.name','booking_status.status')
    // ->leftJoin('team_leaders','team_leaders.user_id','=','salesdetails.team_id')
    // ->leftJoin('projects','projects.project_id','=','salesdetails.project_id')
    // ->leftJoin('leadsource','leadsource.leadsource_id','=','salesdetails.leadsource_id')
    // ->leftJoin('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
    // ->leftJoin('booking_status','booking_status.deal_status_id','=','salesdetails.deal_status_id')
    // ->where('team_leaders.region_head','=',$u_id)
    // ->get();

    //update api 30-12-2022
    public function userTLRH($u_id){ 
    // dd($u_id); 
    $data=DB::table('salesdetails')
    // ->select('salesdetails.*','team_leaders.team_leader_name','projects.project_name','leadsource.leadsource','clientdetails.name','booking_status.status')
    ->select('*')
    ->leftJoin('consultancyfees','consultancyfees.sales_id','=','salesdetails.sales_id')
    ->leftJoin('team_leaders','team_leaders.team_id','=','salesdetails.team_id')
    ->leftJoin('projects','projects.project_id','=','salesdetails.project_id')
    ->leftJoin('leadsource','leadsource.leadsource_id','=','salesdetails.leadsource_id')
    ->leftJoin('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
    ->leftJoin('booking_status','booking_status.deal_status_id','=','salesdetails.deal_status_id')
    ->where('team_leaders.region_head','=',$u_id)
    ->get();
    // ->toSql();
    return response()->json($data);

    // $site = "Website";

    // foreach($data as $dat) 
    // {
    // if ( $mysite.leadsource !== $site )
    // {
    //     echo $mysite;
    //     dd($mysite)
    // }
    // }

    // echo '<pre>';
    // print_r("1st data",$data);

    // echo '</pre>';
    

    }


    //vishal 1-20-2023 
    public function userTLRH2($u_id,$startdate,$enddate){
      // $startdate,$enddate, 
      // dd($startdate,$enddate); 
      $data=DB::table('salesdetails')
      // ->select('salesdetails.*','team_leaders.team_leader_name','projects.project_name','leadsource.leadsource','clientdetails.name','booking_status.status')
      ->select('*')
      ->leftJoin('consultancyfees','consultancyfees.sales_id','=','salesdetails.sales_id')
      ->leftJoin('team_leaders','team_leaders.team_id','=','salesdetails.team_id')
      ->leftJoin('projects','projects.project_id','=','salesdetails.project_id')
      ->leftJoin('leadsource','leadsource.leadsource_id','=','salesdetails.leadsource_id')
      ->leftJoin('clientdetails','clientdetails.client_id','=','salesdetails.client_id')
      ->leftJoin('booking_status','booking_status.deal_status_id','=','salesdetails.deal_status_id')
      ->Where('team_leaders.region_head','=',"$u_id")
      ->whereBetween('booking_date',["$startdate","$enddate"])
      ->get();
      // ->toSql();
      return response()->json($data);
  
      // $site = "Website";
  
      // foreach($data as $dat) 
      // {
      // if ( $mysite.leadsource !== $site )
      // {
      //     echo $mysite;
      //     dd($mysite)
      // }
      // }
  
      // echo '<pre>';
      // print_r("1st data",$data);
  
      // echo '</pre>';
      
  
      }


    // public function getUsersCF(){  
    // $data=DB::table('users')
    // ->select('user_id', 'firstname', 'lastname', 'designation')
    // ->get();
    // return response()->json($data);
    
    // }

    //update
    function getUsersCF(){  
    $data=DB::table('users')
    ->select('*')
    ->join('designations','users.designation','=','designations.designation_id')
    ->where('users.designation','=',4)
    ->get();
    return response()->json($data);
        
    }


    public function getUsersDesignationNo($uu_id){  
    $data=DB::table('users')
    ->select('*')
    ->where('users.user_id','=',$uu_id)
    ->get();
    return response()->json($data);

    }

    // public function addUserCF(){  
    // $data=DB::table('users')
    // ->select('user_id', 'firstname', 'lastname', 'designation')
    // ->get();
    // return response()->json($data);
        
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    // public function store(Request $request){
    //     echo "<pre>";
    //     print_r($request->all());

    //     $cfobj=new ConsultancyFess;
    //     //obj->table field = $req ['form field']
    //     $cfobj->booking_date=$request['booking_date'];
    //     $cfobj->booking_status=$request['booking_status'];
    //     $cfobj->building_name=$request['building_name'];
    //     $cfobj->client_id=$request['client_id'];
    //     $cfobj->consideration_value=$request['consideration_value'];
    //     $cfobj->actual_payout=$request['actual_payout'];
    //     $cfobj->save();

    //     return response()->json($cfobj);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   



    // public function store(Request $request) {
    //     $booking_date = $request->get('booking_date');
    //     $booking_status = $request->get('booking_status');
    //     $building_name = $request->get('building_name');
    //     $client_id = $request->get('client_id');
    //     $consideration_value = $request->get('consideration_value');
    //     $leadsource_id = $request->get('leadsource_id');
    //     $actual_payout = $request->get('actual_payout');
    //     DB::table('consultancyfees')->insert('insert into consultancyfees (booking_date,booking_status,building_name,client_id,consideration_value,leadsource_id,actual_payout) values(?)',[$booking_date,$booking_status,$building_name,$client_id,$consideration_value,$leadsource_id,$actual_payout]);
    //     echo "Record inserted successfully.<br/>";
    //     echo '<a href = "/insert">Click Here</a> to go back.';


    //     ConsultancyFess::insert(
    //         ['booking_status' => '1', 'votes' => 0]
    //     );

    //  }



    //update data 03-01-2023
    public function updateTable() {
        DB::table('consultancyfees')
        ->where('client_id', 12)
        ->update(['building_name' =>DB::raw("'New One'")]);
        $updateuser = DB::table('consultancyfees')->find(12);
        print_r($updateuser);
     }

     function updatedateteamcf(Request $request){
        $building_name = $request->get('building_name');
        $consideration_value = $request->get('consideration_value');
        $client_id = $request->get('client_id');
      //   dd($resignation_date, $user_id);
        $temsdateupdatecf = DB::table('consultancyfees')
        //from user we get user_id and resignation_date after geting that we update to_date field with resignation date
                          ->where('client_id',$client_id)
                          ->update(['building_name'=> $building_name,"consideration_value"=>$consideration_value]);
                         
  
      return response()->json($temsdateupdatecf);
      
      }


      function updatedateteamcfdelete(Request $request){
        $client_id = $request->get('client_id');
      //   dd($resignation_date, $user_id);
        $temsdateupdatecfdelete = DB::table('consultancyfees')
        //from user we get user_id and resignation_date after geting that we update to_date field with resignation date
                          ->where('client_id',$client_id)
                          ->delete();
      return response()->json($temsdateupdatecfdelete);
      
      }



      //call store procesure 16-01-2023
      public function getcfvalue($sid){
        $get_consultancyfees = DB::select(
        "CALL get_consultancyfees(@p1,@p2,@p3)");
        return response()->json($get_consultancyfees);
      }

      //call sales storage 17-01-2023
      public function getsalescfvalue($cv,$pv,$pid,$lid){
        // dd("log",$cv,$pv,$pid,$lid);
        DB::select("call get_salesdetailscf($cv,$pv,$pid,$lid,@consultancy_value)");
        $results = DB::select('select @consultancy_value as consultancy_value');

        // return dd($results[0]->consultancy_value);

        // $get_salesdetailscf = DB::select(
            
        //     "CALL get_salesdetailscf(5500000,5000,27,2,@consultancy_value);
        //      SELECT consultancy_value;"
        // );
        // print_r($get_salesdetailscf);
        // dd($get_salesdetailscf);
        return response()->json($results);
        
      }


      //get new inserted data from saledetails 
      public function newrecordsaledetails(){  
        $data=DB::table('saledetailsinsert')
        ->select('*')
        ->orderBy('sales_id','desc')
        ->limit(1)
        ->get();
        return response()->json($data);
            
      }


      //get new updated record
      public function updaterecordsaledetails(){  
        $data=DB::table('saledetailsupdate')
        ->select('*')
        ->orderBy('sales_id','desc')
        ->limit(1)
        ->get();
        return response()->json($data);
            
      }


      //update consultancyfees using sales_id
      function updatecv(Request $request){
        $sales_id = $request->get('sales_id');
        $consultancy_fees = $request->get('consultancy_fees');
      //   dd($resignation_date, $user_id);
        $updatecvvalue = DB::table('consultancyfees')
                          ->where('sales_id',$sales_id)
                          ->update(['consultancy_fees'=> $consultancy_fees]);
                         
  
      return response()->json($updatecvvalue);
      
      }


      //update saledetails id 18-1-2023
      function updatesaleids(Request $request){
      $sales_id = $request->get('sales_id');
      $extra_payout_value = $request->get('extra_payout_value');
      //dd($resignation_date, $user_id);
      $updateepv = DB::table('salesdetails')
                        ->where('sales_id',$sales_id)
                        ->update(['extra_payout_value'=> $extra_payout_value]);
                       

      return response()->json($updateepv);
      
      }

      //get all saledetails data 18-1-2023
      function getsaledetailsdata(){
        $getdata = DB::table('salesdetails')
        ->select('*')
        ->get();
        return response()->json($getdata);
        }

    



}
