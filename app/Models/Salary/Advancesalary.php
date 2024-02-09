<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advancesalary extends Model
{
    use HasFactory;
	
	protected $table = 'advance_salary';

	protected $primaryKey = 'advance_salary_id';
	
	protected $fillable = [
        //'slug',
        
        'user_id',
       'adv_code',
		'advanced_paid_date',
		'amount',
		'paid',
        //'emi_amount',
        //'repaid_amount',
		'pending_amount',
        'adv_amount',
        'status',
        'remark'
      ];
}
