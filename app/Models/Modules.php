<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;

    protected $table = 'modules';

	protected $primaryKey = 'module_id';
    
    protected $fillable = [
        //'slug',
        //'module',
        'module_name'
      ];

   
}
