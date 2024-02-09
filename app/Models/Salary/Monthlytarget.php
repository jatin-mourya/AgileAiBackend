<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthlytarget extends Model
{
    use HasFactory;

    protected $table = 'monthly_target';

	protected $primaryKey = 'monthly_target_id';

    protected $fillable = [
        //'slug',
        'salary_package_id',
        'user_id',
		'from_date',
		'to_date',
		'status'
      ];
}
