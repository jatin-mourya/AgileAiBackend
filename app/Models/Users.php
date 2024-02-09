<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $primaryKey = "user_id";
    
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'mobile_no',
        'email',
        'emp_code',
        'password',
        'nickname',
        'password_confirmation',
        'date_of_birth',
        'pan_no',
        'qualification',
        'marital_status',
        'joining_date',
        'experience_in_year',
        'last_package',
        'designation',
        'remember_token',
        'permanant_address',
        'current_address',
        'home_contactno',
        'resignation_date',
        'status_id',
        'experience_in_months',
        'privious_company_contactname',
        'privious_company_contact',
        'source',
        'source_by',
        'remark_by_HR'

      ];

      function getUser($user_id)
    {
     $data=DB::table('users')->where('user_id',$user_id)->get();
     return $data;
    }
}
