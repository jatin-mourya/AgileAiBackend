<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtorcompanydet extends Model
{
    use HasFactory;

	protected $table = 'debtor_company_det';

	protected $primaryKey = 'debtor_company_det_id';
	
    protected $fillable = [
        //'slug',
        'cname',
        'cpan',
        'gst_no',
        'registered_address',
        'billing_address',
        'contact1',
        'contact2',
        'email1',
        'email2',
        'profile_score'
      ];
}
