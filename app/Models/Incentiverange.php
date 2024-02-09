<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentiverange extends Model
{
    protected $table = 'tbl_incentive_range';
    protected $primaryKey = 'id_range'; 

    protected $fillable = [
        'business_value',
        'business_value1',
        'business_cat'
      ];
}
