<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tlquarterlyincentive extends Model
{
    use HasFactory;
    
    protected $table = 'tl_quarterly_incentive';

    protected $primaryKey = 'ince_id';

    protected $fillable = [
      'teamleader_id',
      'team_id',
      'bussiness_value',
      'eligibility',
      'quarterly_inc',
      "from_date",
      "to_date",
      "paid_amt",
      "pending_amt",
      "m_remark",
      "ince_type"
    ];

    function getUser($ince_id)

    {
      $data=DB::table('tl_quarterly_incentive')->where('ince_id',$ince_id)->get();
      return $data;
    }
}
