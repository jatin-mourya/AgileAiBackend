<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PayvoucherDetails extends Model
{
    use HasFactory;
    
    protected $table = 'payvoucher_details';

    protected $primaryKey = 'id';

    protected $fillable = [
      'pv_id',
      'user_id',
      'inc_type',
      'incentive',
      'paid',
      'pending',
      'status',
      'remark',
      'from_date',
      'to_date'
    ];

    function getUser($id)

    {
      $data=DB::table('payvoucher_details')->where('id',$id)->get();
      return $data;
    }
}
