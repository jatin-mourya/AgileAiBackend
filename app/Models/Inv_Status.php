<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Status extends Model
{
    use HasFactory;


    protected $table = 'inv_status';

	protected $primaryKey = 'inv_status_id';
    
    protected $fillable = [
        //'slug',
        'status',
      ];
}
