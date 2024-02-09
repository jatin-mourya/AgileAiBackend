<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gstr2a extends Model
{
    use HasFactory;
    protected $table = 'gstr2a';

	protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'ctin',
        'cfs',
        'cfs3b',
        'fldtr1',
        'flprdr1',
        'chksum',
        'idt',
        'inum',
        'inv_typ',
        'camt',
        'csamt',
        'iamt',
        'rt',
        'samt',
        'txval',
        'pos',
        'rchrg',
        'val',
        'num',
        'gstr2a_filename',
        'inv_month',
        'financial_year',
        'financial_month'
      ];
}
