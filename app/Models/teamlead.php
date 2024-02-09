<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Library\Services\DemoTwo;

class teamlead extends Model
{
    use HasFactory;

	protected $connection = 'mysql2';
	
	protected $table = 'leadgiven_list';

	protected $primaryKey = 'leadgiven_id';
    
    protected $fillable = [
		'Team_Leader',
		'username',
		'emp_code',
		'Cold_Lead',
		'warm_Lead',
		'Hot_Lead'
      ];

}
