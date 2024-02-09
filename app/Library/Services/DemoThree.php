<?php
namespace App\Library\Services;
use App\Models\Datebasislead;
use DB;
use Carbon\Carbon;
   
class DemoThree
{
    public function doSomethingUseful2()
    {
      $someModel = new Datebasislead;
         $someModel->setConnection('mysql2'); 
        // $now = new DateTime();
        // print_r($now->format('Y-m-d H:i:s'));  
    //   date_default_timezone_set('Asia/Kolkata');   
        $fromdate = date("Y-m-d ",  strtotime(' -7 day'));
        $todate = date("Y-m-d ",  strtotime(' -1 day'));
// $time = date("Y-m-d H:i:s", strtotime(' -7 day')); 
// Declare @startDate Date = DATEADD(month, DATEDIFF(month,0,GETDATE())- 1, 0);
// Declare @endDate   Date = DATEADD(month, DATEDIFF(month,0,GETDATE())   , 0);

// EXEC DBO.usp_PRODUCTS @startDate , @endDate  ;
        print_r($todate);
        echo "<br>";
        print_r($fromdate);
        // exit;
        // echo $now->getTimestamp(); 
        //  todate = today -1 (monday)  
        //  fromdate = today -7 day(wed)
         $leadgiven = DB::connection('mysql2')->select("CALL leads_date_basis(?,?)", array($fromdate ,$todate));
        //  return response()->json($leadgiven);
        //   $leadCount;
        foreach ($leadgiven as $lead) {
            if(1)
            {
                DB::table('datewise_lead')->insert([
                
               
               
                'Team_Leader' =>$lead->Team_Leader,
                'username' =>$lead->username,
                'emp_code' =>$lead->emp_code,
                'Cold_Lead' =>$lead->Cold_Lead,
                'warm_Lead' =>$lead->warm_Lead,
                'Hot_Lead' =>$lead->Hot_Lead,
                'Week' =>$lead->Week,
                 'month' =>$lead->month,
                  'year' =>$lead->year
                ]);
            }    
        }
         
    }
}