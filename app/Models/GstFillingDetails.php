<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstFillingDetails extends Model
{
    use HasFactory;
    protected $table = 'gst_fillingdetails';

	protected $primaryKey = 'gst_filling_det_id';
    
    protected $fillable = [
        'invoice_id',
        'invoice_id',
        'inv_type',
        'gstr1_month',
        'gstr1_amount',
        'filed_status'
		
      ];
}
