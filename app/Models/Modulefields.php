<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class Modulefields extends Model
{
    use HasFactory;

    protected $table = 'module_fields';

	protected $primaryKey = 'module_field_id';
    
    protected $fillable = [
        'module_name',
        'module_field_name',
        'module_field_name_2',
        'table_value',
        'table_field'
      ];

    
      function getModulefields($module_name)
    {
       $data=DB::table('module_fields')->where('module_name',$module_name)->get();
       return $data;
    }

        function getSecModulefields($module_name)
    {
       $data1=DB::table('module_fields')->where('module_name',$module_name)->get();
       return $data1;
    }

        function getDropdownlist($module_field_name_2)
    {
       $data1=DB::table('module_fields')->where('module_field_name_2',$module_field_name_2)->get();
       return $data1;

    }

        //function getModulefields1($table_field)
    //{

        // $data4=DB::table('module_fields')->where('table_field',$table_field)->get();
        // return $data4;

        //$data4 = DB::table('salesdetails')
                       
                //->leftjoin('teams','teams.team_id','=','salesdetails.team_id')
                //->distinct()
                //->select($table_field)
                //->get();
                //return $data4;
    //}

    function getModulefields1($table_field)
    {
     if($table_field == 'projects.project_name')
     {
      $data1 = DB::table('projects')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'clientdetails.name')
     {
      $data1 = DB::table('clientdetails')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     
     if($table_field == 'subprojects.subproject_name')
     {
      $data1 = DB::table('subprojects')
               ->select($table_field)
               ->get();
               return ($data1);
     }

     if($table_field == 'channelpartner.cp_name')
     {
      $data1 = DB::table('channelpartner')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     
     if($table_field == 'invoice.invoice_num')
     {
      $data1 = DB::table('invoice')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     
     if($table_field == 'invoice.invoice_date')
     {
      $data1 = DB::table('invoice')
               ->select($table_field)
               ->get();
               return ($data1);
     }

     if($table_field == 'invoice.invoice_date')
     {
      $data1 = DB::table('invoice')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'invoice.due_amt')
     {
      $data1 = DB::table('invoice')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'invoice.credit_note_amt')
     {
      $data1 = DB::table('invoice')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'salary_package.basic_pay')
     {
      $data1 = DB::table('salary_package')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'salary_package.monthly_salary')
     {
      $data1 = DB::table('salary_package')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'salary_package.yearly_salary')
     {
      $data1 = DB::table('salary_package')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'users.firstname')
     {
      $data1 = DB::table('users')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'teams.teamname')
     {
      $data1 = DB::table('teams')
               ->select($table_field)
               ->get();
               return ($data1);
     }
     if($table_field == 'users.email')
     {
      $data1 = DB::table('users')
               ->select($table_field)
               ->get();
               return ($data1);
     }
   


    }
}
