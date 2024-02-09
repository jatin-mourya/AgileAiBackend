<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class Subregions extends Model
{
    protected $table = 'subregions';

    protected $primaryKey = 'subregion_id';

    protected $fillable = [
        'region_id',
        'subregion_name'
      ];

      /** dependency dropdown code start**/

      function getSubregion($region_id)
    {
        $data=DB::table('subregions')->where('region_id',$region_id)->get();
        return $data;
    }

    /** dependency dropdown code end**/
	  
}
