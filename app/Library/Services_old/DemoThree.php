<?php
namespace App\Library\Services;
use App\Models\Datebasislead;
use DB;
   
class DemoThree
{
    public function doSomethingUseful2()
    {
      $someModel = new Datebasislead;
         $someModel->setConnection('mysql2');
        //  $paramOne = "2020-10-16";
        //  $paramTwo = "2021-01-12";
    
         $leadgiven = DB::connection('mysql2')->select('call leads_date_basis ("2021-06-02", "2022-12-28")');
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
                'Hot_Lead' =>$lead->Hot_Lead
                ]);
            }    
        }
         
    }
}