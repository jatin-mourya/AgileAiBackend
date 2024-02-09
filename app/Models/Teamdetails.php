<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teamdetails extends Model
{
    use HasFactory;

	protected $table = 'teamdetails';

	protected $primaryKey = 'team_detail_id';
    
    protected $fillable = [
        //'slug',
        'user_id',
		'team_id',
		'team_leader_name',
		'designation_id',
		'from_date',
		'to_date',
		'status',
		'team_leader_name'
      ];
}
