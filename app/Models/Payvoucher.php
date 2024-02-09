<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payvoucher extends Model
{
    use HasFactory;
    
    protected $table = 'payvoucher';

    protected $primaryKey = 'id';

    protected $fillable = [
      'user_id',
      'incentive',
      'paid_amt',
      'pending_amt',
      'pay_status',
      'inc_type',
      'year',
    ];

    function getUser($id)

    {
      $data=DB::table('payvoucher')->where('id',$id)->get();
      return $data;
    }
}
