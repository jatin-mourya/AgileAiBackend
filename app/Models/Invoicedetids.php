<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicedetids extends Model
{
    use HasFactory;

    protected $table = 'invoicedetids';

    protected $primaryKey = 'invoicedetids_id';

    protected $fillable = [
        //'slug',
        'invoice_multi_id',
        'sales_id',
        'company_id',
        'gst_no',
        'client_id',
        'invoice_num',
        'payout_value',
        'case_payout_percentage',
        // 'payout_percentage',
        'consideration_value',
        'taxable_amt',
        'cgst_amt',
        'sgst_amt',
        'igst_amt',
        'total_gst_amt',
        'total_invoice_amt',
        'tds_rate',
        'receivable_tds_amt',
        'receivable_amt',
        'received_amt',
        'suspense_amt',
        'due_amt',
        'credit_note_amt',
        'invoice_type_id',
        'discription',
        'disb_id',
    ];
}
