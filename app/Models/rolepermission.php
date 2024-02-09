<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolepermission extends Model
{
    use HasFactory;
    protected $table = 'permission';

	protected $primaryKey = 'permission_id';
    
    protected $fillable = [
       'designation_id',
       'tabs'
    ];
}
