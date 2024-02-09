<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tlincentivestructure extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_tl_incentives_structure';

    protected $primaryKey = 'id';

    protected $fillable = [
      'ince_type',
      'ince_freq',
      'condition1',
      'condition2',
      'condition3',
      'incentive',
      "from_date",
      "to_date",
    ];

    function getUser($id)

    {
      $data=DB::table('tbl_tl_incentives_structure')->where('id',$id)->get();
      return $data;
    }
}
