<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class Disbursement extends Model
{
    use HasFactory;

	protected $table = 'tbl_hldisbursement';

	protected $primaryKey = 'disb_id';
    
    protected $fillable = [
        'client_id',
		'sanction_id',
		'sanction_file',
		'disb_date',
		'login_date',
		'disb_amt',
		'bank_name',
		'pending_disb',
		'description',
		'File_no',
		'status',
		'disbursement_status',
		'LRT_amt'
      ];


}
