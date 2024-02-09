<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
  protected $primaryKey = 'region_id'; 

    protected $fillable = [
        //'region_id',
        'region_name'
      ];
}
