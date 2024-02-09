<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB  
 use Illuminate\Support\Facades\DB;;

class Months extends Model
{
    use HasFactory;

    protected $table = 'months';

	protected $primaryKey = 'month_id';
    
    protected $fillable = [
        //'slug',
        'month_name ',
        'month_value',
       
      ];

      function getState1($salary_month)
      {
       $data=DB::table('months')->where('month_name',$salary_month)->get();
       return $data;
      }
}
