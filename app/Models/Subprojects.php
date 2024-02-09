<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB   
use Illuminate\Support\Facades\DB;;

class Subprojects extends Model
{
    protected $table = 'subprojects';

	  protected $primaryKey = 'subproject_id';

    protected $fillable = [
        'project_id',
        'subproject_name',
        'rera'

      ];

      /** dependency dropdown code start**/
      function getState($project_id)
    {
     $data=DB::table('subprojects')->where('project_id',$project_id)->get();
     return $data;
    }

    /** dependency dropdown code end**/

    public function Project(){
      return $this->belongsTo(Projects::class,'project_id');
    }

}
