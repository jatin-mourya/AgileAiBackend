<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsultancyFess extends Model
{
    use HasFactory;
    
    protected $table = 'consultancyfees';

    protected $primaryKey = 'cf_id';

    protected $fillable = [
      'sales_id',
      // 'booking_date',
      // 'booking_status',
      // 'project_name',
      // 'client_name',
      // 'cv_value',
      // 'payout_value',
      // 'lead_source',
      'consultancy_fees'
    ];

    function getUser($cf_id)

    {
      $data=DB::table('consultancyfees')->where('cf_id',$cf_id)->get();
      return $data;
    }
}
