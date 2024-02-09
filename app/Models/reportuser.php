<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportuser extends Model
{
    use HasFactory;
    protected $table = 'user_group';

	protected $primaryKey = 'id';
    
    protected $fillable = [
        //'slug',
        'group_name',
        'team_id',
        'user_id'
    ];
   
}
