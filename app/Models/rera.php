<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rera extends Model
{
    use HasFactory;
    protected $table = 'rera';

    protected $primaryKey = 'id';

  protected $fillable = [
      //'project_id',
      'project_id',
      'subproject_id',
      'rera'
    ];
}
