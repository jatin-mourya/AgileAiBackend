<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMulti extends Model
{
    use HasFactory;

    protected $table = 'invoice_multi';

    protected $primaryKey = 'invoice_multi_id';

    protected $fillable = [
        //'slug',
        'client_id',
        'sales_id',
        'company_id',
        'invoice_num',
        'invoice_date',
        'payout_percentage',
        'taxable_amt',
        'gst_no',
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
        'inv_status_id',
        'inv_submitted_date',
        'due_amt',
        'credit_note_amt',
        'invoice_type_id'

    ];
}
