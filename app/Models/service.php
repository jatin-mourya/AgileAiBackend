<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Library\Services\DemoOne;

class service extends Model
{
    use HasFactory;

	protected $connection = 'mysql2';
	
	protected $table = 'daily_leadcount_projectwise';

	protected $primaryKey = 'leadcount_id';
    
    protected $fillable = [
		'cf_1359',
		'Hot_Lead',
		'warm_Lead',
		'Cold_Lead'
      ];

}
