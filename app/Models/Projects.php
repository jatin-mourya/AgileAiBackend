<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

	  protected $primaryKey = 'project_id';

    protected $fillable = [
        //'project_id',
        'project_name',
        'rera',
        'builder_group_id',
        'location',
        'region_id',
        'subregion_id',
        'company_id',
        'ads_status',
        'outdoor_presence',
        'aop_taken',
        'project_status',
        'profile_score',
        'focused'
      ];

    public function Subproject(){
        return $this->hasMany(Subprojects::class,'project_id');
    }
}
