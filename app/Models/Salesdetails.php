<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// For Table Relationship 
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// For Table Relationship 

class Salesdetails extends Model
{
	use HasFactory;

	protected $table = 'salesdetails';

	protected $primaryKey = 'sales_id';

	protected $fillable = [
		"sales_id",
		"client_id",
		"cp_id",
		"debtor_company_det_id",
		"project_id",
		"subproject_id",
		"booking_date",
		"building_name",
		"wing",
		"flat_no",
		"consideration_value",
		"cv_range",
		"business_value",
		"bv_add",
		"case_payout_percentage",
		"payout_value",
		"extra_payout_percentage",
		"extra_payout_value",
		"net_extra_payout",
		"shared_payout",
		"shared_payout_value",
		"net_shared_payout",
		"net_payout",
		"total_payout",
		"received_amt",
		"payout_status_id",
		"sourcing_emp_id",
		"closing_emp_id",
		"deal_status_id",
		"team_id",
		"shared_deals",
		"leadsource_id",
		"booking_id",
		"module",
		"BA1_amt_paid",
		"BA2_amt_paid",
		"registration_date",
		"leadreceived_date",
		"remark",
		"nos",
		"noc",
		"shared_deal_id",
		"inv_status",
		"updated_at",
		"created_at"
	];

	// syntax : 
	// belongsTo(model,'foreign_key_name col in current(child) model(Salesdetails)','primary_key_name col in parent model(Clientdetails))

	public function client(): BelongsTo
	{
		return $this->belongsTo(Clientdetails::class, 'client_id', 'client_id');
	}
	public function company(): BelongsTo
	{
		return $this->belongsTo(Debtorcompanydet::class);
	}
	public function project(): BelongsTo
	{
		return $this->belongsTo(Projects::class);
	}
	public function subproject(): BelongsTo
	{
		return $this->belongsTo(Subprojects::class);
	}
	public function channelPartner(): BelongsTo
	{
		return $this->belongsTo(Channelpartner::class);
	}
	public function teamLeader(): BelongsTo
	{
		return $this->belongsTo(Teamleaders::class);
	}
}
