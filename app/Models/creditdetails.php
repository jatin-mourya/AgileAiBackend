<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditdetails extends Model
{
    use HasFactory;
    protected $table = 'tblcreditnotedetails';

	protected $primaryKey = 'tblcreditnote_id';
	
    protected $fillable = [
        'tblcreditnote_multi_id ',
        'invoice_multi_id',
        'gst_no',
        'company_id',
        'invoice_num',
        'client_id',
        'old_taxable',
        'payout_value',
        'sales_id',
        'credit_note_taxable',
        'total_creditnote_amt',
        'consideration_value',
        'case_payout_percentage',
        'cgst_amt',
        'sgst_amt',
        'igst_amt',
        'total_gst_amt',
        'tds_rate',
        'deductible_tds_amt',
        'due_amt',
        'invoice_type_id',
        'discription',
       ];
}
