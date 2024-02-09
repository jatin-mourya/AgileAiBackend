<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthlysalary extends Model
{
    use HasFactory;

    protected $table = 'monthly_salary';

	protected $primaryKey = 'monthly_salary_id';

    protected $fillable = [
        //'slug',
       'user_id',
		'basic_pay',
		'salary_month',
		'no_of_late_marks',
        'penalty_leave_days',
        'extra_days',
        'present_days',
        'monthly_basic_salary',
        'monthly_variable_pay',
        'reimbursement',
        'incentives',
        'deduction',
        'liabilities',
        'total_pay',
        'tds_deducted',
        'net_pay',
        'status',
        'remark',
        'paid_amount',
        'payment_details',
        'pending_amount',
        'TDS_paid',
        'net_salary_paid',
        'echeque',
        'tds_paid_status',
        'm_hra' ,
        'm_medical_all',
        'm_uniform_all',
        'm_travelling_all' ,
        'm_wfh',
        'm_education_all',
        'm_employee_pf'  
      ];
}
