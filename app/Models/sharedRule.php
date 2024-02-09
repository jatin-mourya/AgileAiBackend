<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sharedRule extends Model
{
    protected $table = "sharing_rule";

    protected $primaryKey = "id";
    protected $fillable = [
        //'slug',
        'group_id',
		'user_id',
        'associated_user_id'
		
      ];
}
