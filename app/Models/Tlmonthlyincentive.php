<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tlmonthlyincentive extends Model
{
    use HasFactory;
    
    protected $table = 'tl_monthly_incentive';

    protected $primaryKey = 'ince_id';

    protected $fillable = [
      'teamleader_id',
      'team_id',
      'no_tm',
      'no_active_tm',
      'total_sales',
      "performance",
      "tl_eligibility_ince",
      "tmi_gpi_ti",
      "tmi_ai_ti",
      "tmi_pi_ti",
      "tli_mgpi_tl",
      "tli_ai_tl",
      "tli_pi_tl",
      "mp_incentives",
      "mpd_incentives",
      "mp_eligibility",
      "ince_feq",
      "remark",
      "quater",
      "YearMonth",
      "from_date",
      "to_date",
      "paid_amt",
      "pending_amt",
      "m_remark",
      "ince_type"
    ];

    function getUser($ince_id)

    {
      $data=DB::table('tl_monthly_incentive')->where('ince_id',$ince_id)->get();
      return $data;
    }
}
