<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PayvouchertlDetails extends Model
{
    use HasFactory;
    
    protected $table = 'payvouchertl_details';

    protected $primaryKey = 'id';

    protected $fillable = [
      'pvtl_id',
      'tl_id',
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
      $data=DB::table('payvouchertl_details')->where('id',$id)->get();
      return $data;
    }
}
