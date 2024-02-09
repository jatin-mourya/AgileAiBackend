<?php
// this file and whole code is Created By Jatin

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentHistory extends Model
{
    use HasFactory;

    // public $timestamps = false;

    protected $table = 'payment_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'paid_amt',
        'remark',
    ];
}
