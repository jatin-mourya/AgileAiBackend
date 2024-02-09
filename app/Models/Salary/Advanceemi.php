<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advanceemi extends Model
{
    use HasFactory;

    protected $table = 'advance_emi_details';

	protected $primaryKey = 'id';

    protected $fillable = [
        //'slug',
        // 'advance_salary_id',
        'user_id',
        'adv_code',
		'emi_deduct_date',
		'deduction_amount',
        'remark'
      ];
}
