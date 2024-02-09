<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdsRate extends Model
{
    use HasFactory;

	protected $table = 'tds_rate';

	protected $primaryKey = 'tds_rate_id';
    
    protected $fillable = [
        //'slug',
        'CGST',
		'SGST',
		'IGST',
		'from_date',
		'TDS_rate',
		
      ];
}
