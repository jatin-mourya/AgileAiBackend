<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearIncentive extends Model
{
    protected $table = 'year_incentive';
    protected $primaryKey = 'year_id';
    
    protected $fillable = [
        'year_id',
        'user_id',
        'yearsourcing_no',
        'yearsourcing_amt',
        'from_date',
        'to_date',
        'eligibility_ince',
        'year_inc_amt',
        'yearly_eligible',
        'inc_type',
        'paid_amt',
        'pending_amt',
        'm_remark'
      ];
}
