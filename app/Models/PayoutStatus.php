<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutStatus extends Model
{
    use HasFactory;

    protected $table= "payout_status";
    protected $primaryKey='payout_status_id';

    protected $fillable = [
        'status'
      
       ];
}
