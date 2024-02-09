<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newusers extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'mobile_no',
        'email',
        'emp_code',
        'name',
        'nickname',
        'password',
        'conformpassword',
        'date_of_birth',
        'pan_no',
        'qualification',
        'marital_status',
        'joining_date',
        'experience_in_year',
        'last_package',
        'roles'
      ];

    function getNewusers($skip,$limit){
          $data= DB::table('users')->skip($skip)->take($limit)->get();
          return $data;
    }

    function getTotalNewusers(){
      $data= DB::table('users')->get()->count();
      return $data;
}
}
