<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $table = 'reports';

	protected $primaryKey = 'reports_id';
    
    protected $fillable = [
        //'slug',
        'report_name',
        'primary_module_name',
        'primary_module_field_name',
        'secondary_module_name',
        'secondary_module_field_name',
        'reports_field_1',
        'conditions',
        'reports_field_2',
        'table_value',
        'cal_sum',
        'cal_avg'
    ];
}
