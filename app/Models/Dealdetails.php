<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealdetails extends Model
{
    protected $table = 'deals_details';

    protected $primaryKey = 'deal_id';

  protected $fillable = [
      'user_id',
      'salary_justify',
      'business_target',
      'leadsource',
      'from_date',
      'to_date',
      'deal_status',
      'attented_day',
      'actual_sales',
      'walking_sourcing',
      'walking_closing',
      'leads_given',
      'deal_sourcing',
      'deal_closing',
      'business_value'
    ];
}
