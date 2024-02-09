<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetails extends Model
{
    use HasFactory;

    protected $table = 'receiptdetails';

	protected $primaryKey = 'receipt_id';
    
    protected $fillable = [
        //'slug',
        'invoice_id',
        'payment_mode',
        'instument_no',
        'received_amt',
        'receivable_amt',
        'instument_date',
        'received_taxable_amt',
        'received_gst_amt',
        'received_tds_amt',
        'credit_date',
        'credit_account',
        'client_id',
        'suspense_amount'
		
      ];
}
