<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditmulti extends Model
{
    use HasFactory;
    protected $table = 'tblcreditnote_multi';

	protected $primaryKey = 'tblcreditnote_multi_id';
	
    protected $fillable = [
        'invoice_multi_id ',
        'credit_note_number',
        'credit_note_date',
        'gst_no',
        'company_id',
        'invoice_num',
        'invoice_date',
        'credit_note_taxable',
        'cgst_amt',
        'sgst_amt',
        'igst_amt',
        'total_gst_amt',
        'total_creditnote_amt',
        'tds_rate',
        'deductible_tds_amt',
        'creditnote_submitted_date',
        'inv_status_id',
        'invoice_type_id',
        ];
}
