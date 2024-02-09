<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gstjson extends Model
{
    use HasFactory;
    protected $table = 'gst_json';

	protected $primaryKey = 'id';
    
    protected $fillable = [
        'ctin',
        'num',
        'csamt',
        'samt',
        'rt',
        'txval',
        'camt',
        'val',
        'inv_typ',
        'flag',
        'pos',
        'updby',
        'idt',
		'rchrg',
        'cflag',
        'inum',
        'chksum',
        'inv_month',
        'financial_year',
        'financial_month',
        'jsonfilename'
        
      ];
}
