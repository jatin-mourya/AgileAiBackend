<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class MonthlyIncentive extends Model
{
    use HasFactory;
    protected $table = 'tbl_monthly_incentive';

	protected $primaryKey = 'ince_id';
    
    protected $fillable = [
        'ince_id',
        'user_id',
        'ince_freq',
        'from_date',
        'to_date',
        'gi_no_of_sourcing',
        'gi_no_of_closing',
        'gi_sourcing_amt',
        'gi_closing_amt',
        'ai_sourcing_ince',
        'ai_closing_ince',
        'ai_sourcing_amt',
        'pi_sourcing_ince',
        'pi_closing_ince',
        'pi_sourcing_amt',
        'pi_closing_amt',
        'eligibility_ince',
        'eligibility_bonus',
        'YearMonth',
        'ince_status',
        'business_value'
      ];
}
