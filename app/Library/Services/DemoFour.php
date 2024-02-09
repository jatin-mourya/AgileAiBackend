<?php
namespace App\Library\Services;
use App\Models\monthbasislead;
use DB;
   
class DemoFour
{
    public function doSomethingUseful3()
    {
      $someModel = new monthbasislead;
         $someModel->setConnection('mysql2'); 
         $fromdate = date("Y-m-d ",  strtotime(' -31 day'));
        $todate = date("Y-m-d ",  strtotime(' -1 day'));
          print_r($todate);
        echo "<br>";
        print_r($fromdate);
        //  todate = today -1 (monday)  
        //  fromdate = today -7 day(wed)
         $leadgiven = DB::connection('mysql2')->select("CALL leads_date_basis(?,?)", array($fromdate ,$todate));
        //  $leadgiven = DB::connection('mysql2')->select('call leads_date_basis ("2023-02-01" , "2023-02-07")');
        //  return response()->json($leadgiven);
        //   $leadCount;
        foreach ($leadgiven as $lead) {
            if(1)
            {
                DB::table('monthwise_lead')->insert([
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