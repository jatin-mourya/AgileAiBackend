<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class builderGroup extends Model
{
    use HasFactory;
    protected $table = 'builders_group';

    protected $primaryKey = 'builder_group_id';

  protected $fillable = [
      //'project_id',
      'name',
      'profile_score',
      'status'
    ];
}
