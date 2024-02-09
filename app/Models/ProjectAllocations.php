<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAllocations extends Model
{
	
    use HasFactory;
	
	protected $table = 'projectallocations';

    protected $primaryKey = 'projectallocation_id';

    protected $fillable = [
        'user_id',
        'project_id',
        'subproject_id'
      ];
}
