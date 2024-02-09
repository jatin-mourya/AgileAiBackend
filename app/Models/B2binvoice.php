<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2binvoice extends Model
{
    use HasFactory;
    protected $table = 'b2binvoices';

	protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'Supp_gstin',
        'inv_no',
        'inv_dt',
        'inv_val',
        'rate',
        'total_tax_val',
        'int_tax',
        'central_tax',
        'sta_ut_tax',
        'cess',
        'total_tax_amt',
        'party_name'
      ];
}
