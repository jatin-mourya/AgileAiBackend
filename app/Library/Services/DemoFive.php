<?php
namespace App\Library\Services;
use App\Models\yearbasislead;
use DB;
   
class DemoFive
{
    public function doSomethingUseful4()
    {
      $someModel = new yearbasislead;
         $someModel->setConnection('mysql2'); 
         
        $fromdate = date("Y-m-d ",  strtotime(' -31 day'));
        $todate = date("Y-m-d ",  strtotime(' -1 day'));
        print_r($fromdate);
        echo "<br>";
          print_r($todate);
        //  todate = today -1 (monday)  
        //  fromdate = today -7 day(wed)
         $leadgiven = DB::connection('mysql2')->select("CALL leads_date_basis(?,?)", array($fromdate ,$todate));
        //  return response()->json($leadgiven);
        //   $leadCount;
        foreach ($leadgiven as $lead) {
            if(1)
            {
                DB::table('yearwise_lead')->insert([
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