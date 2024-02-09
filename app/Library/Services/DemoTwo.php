<?php
namespace App\Library\Services;
use App\Models\teamlead;
use DB;
   
class DemoTwo
{
    public function doSomethingUseful1()
    {
      $someModel = new teamlead;
         $someModel->setConnection('mysql2');
    
         $leadgiven = DB::connection('mysql2')->select('call daily_leadgiven_users()');
        //  return response()->json($leadgiven);
        //   $leadCount;
        foreach ($leadgiven as $lead) {
            if(1)
            {
                DB::table('leadgiven_list')->insert([
                'Team_Leader' =>$lead->Team_Leader,
                'username' =>$lead->username,
                'emp_code' =>$lead->emp_code,
                'Cold_Lead' =>$lead->Cold_Lead,
                'warm_Lead' =>$lead->warm_Lead,
                'Hot_Lead' =>$lead->Hot_Lead
                ]);
            }    
        }
         
    }
}