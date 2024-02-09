<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientpaymentschedule extends Model
{
    use HasFactory;

	protected $table = 'client_payment_schedule';

	protected $primaryKey = 'client_payment_schedule_id';
    
    protected $fillable = [
        //'slug',
        'sales_id',
		'BA1_amt_paid',
		'BA2_amt_paid',
		'registration_date',
		'updated_by'
      ];
}
