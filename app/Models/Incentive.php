<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
   use HasFactory;
    protected $table = 'tbl_incentives';

	protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'ince_type',
        'ince_freq',
        'cat1_target',
        'cat2_target',
        'A',
        'B',
        'C',
        'D',
        'from_date',
        'to_date',
        'created_at',
        'updated_at'
      ];
}
