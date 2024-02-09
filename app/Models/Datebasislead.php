<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Library\Services\DemoThree;

class Datebasislead extends Model
{
    use HasFactory;

	protected $connection = 'mysql2';
	
	protected $table = 'datewise_lead';

	protected $primaryKey = 'datewise_lead_id';
    
    protected $fillable = [
		'Team_Leader',
		'username',
		'emp_code',
		'Hot_Lead',
		'warm_Lead',
		'Cold_Lead',
		'Week',
		'month',
		'year'
      ];

}
