<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    protected $table = 'designations';

	  protected $primaryKey = 'designation_id';

    protected $fillable = [
        'designation'
      ];
}
