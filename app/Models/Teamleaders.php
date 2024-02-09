<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;

class Teamleaders extends Model
{
    use HasFactory;

	protected $table = 'team_leaders';

	protected $primaryKey = 'team_leader_id';
    
    protected $fillable = [
        //'slug',
        'team_id',
		'user_id',
		'status',
		'team_leader_name',
		'from_date',
		'to_date',
        'region_head'
      ];

	  function getteam($team_id)
    {
     $data=DB::table('team_leaders')->where('team_id',$team_id)->where('boolean_value','1')->get();
     return $data;
    }
}
