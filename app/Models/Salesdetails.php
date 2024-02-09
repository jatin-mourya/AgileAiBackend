<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class Salesdetails extends Model
{
    use HasFactory;

	protected $table = 'salesdetails';

	protected $primaryKey = 'sales_id';
    
    protected $fillable = [
        //'slug',
		'sales_id',
        'client_id',
		'cp_id',
		'debtor_company_det_id',
		'project_id',
		'subproject_id',
		'booking_date',
		'building_name',
		'wing',
		'flat_no',
		'consideration_value',
		'case_payout_percentage',
		'payout_value',
		'extra_payout_percentage',
		'extra_payout_value',
		'net_extra_payout',
		'shared_payout',
		'shared_payout_value',
		'net_shared_payout',
		'net_payout',
		//'pending_invoice_amount',
		'deal_status_id',
		'payout_status_id',
		'sourcing_emp_id',
		'closing_emp_id',
		'team_id',
		'leadsource_id',
		'booking_id',
		'remark',
		'BA1_amt_paid',
		'BA2_amt_paid',
		'leadreceived_date',
		'cv_range',
		'business_value',
		'shared_deals',
		'bv_add',
		'total_payout',
		'received_amt'
      ];


}
