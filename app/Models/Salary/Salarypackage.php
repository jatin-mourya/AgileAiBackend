<?php

namespace App\Models\Salary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class Salarypackage extends Model
{
    use HasFactory;

    protected $table = 'salary_package';

	protected $primaryKey = 'salary_package_id';

    protected $fillable = [
        //'slug',
        'user_id',
        'annual_ctc',
        'basic_pay',
        'medical_all',
        'travelling_all',
        'wfh',
        'uniform_all',
        'education_all',
        'employer_pf',
        'employee_pf',
        'gratuity',
        'hra',
        'prof_tax',
        'gross_total',
        'monthlygross',
        'tds',
        'net_pay',
        'annual_pay',
        'gender',
        'package_type',
		'from_date',
		'to_date',
        'activity',
		// 'basic_pay',
		// 'variable_pay',
        // 'yearly_bonus',
        // 'monthly_salary',
        // 'yearly_salary',
        // 'remark'
      ];

      function getState($user_id)
    {
       $data=DB::table('salary_package')->where('user_id',$user_id)->get();
       return $data;
    }
}
