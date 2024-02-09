<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halfyearincentive extends Model
{
    protected $table = 'halfyear_incentive';
    protected $primaryKey = 'half_id';
    
    protected $fillable = [
        'half_id',
        'user_id',
        'halfsoucring_no',
        'halfsoucring_amt',
        'from_date',
        'to_date',
        'eligibility_ince',
        'halfyear_inc_amt',
        'halfyear_eligible',
        'paid_amt',
        'pending_amt',
        'm_remark',
        'inc_type'
      ];
}
