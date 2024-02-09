<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payvouchertl extends Model
{
    use HasFactory;
    
    protected $table = 'payvouchertl';

    protected $primaryKey = 'id';

    protected $fillable = [
      'tl_id',
      'incentive',
      'paid_amt',
      'pending_amt',
      'pay_status',
      'inc_type',
      'year',
    ];

    function getUser($id)

    {
      $data=DB::table('payvouchertl')->where('id',$id)->get();
      return $data;
    }
}
