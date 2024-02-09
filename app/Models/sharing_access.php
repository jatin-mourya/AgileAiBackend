<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sharing_access extends Model
{
    use HasFactory;

    protected $table = 'sharing_access';

	protected $primaryKey = 'id';
    
    protected $fillable = [
        //'slug',
        'contacts',
        'Can_be_accessed',
       
    ];
 
}
