<?php
// this file and whole code is Created By Jatin

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentHistoryEach extends Model
{
    use HasFactory;

    // public $timestamps = false;

    protected $table = 'payment_history_each';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pay_id',
        'ince_type',
        'table_id',
        'user_type',
        'incentive',
        'total_paid_amt',
        'curr_paid_amt',
        'pending_amt',
        'from_date',
        'to_date',
    ];
}
