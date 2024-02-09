<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Usergroup extends Model
{
    use HasFactory;
    protected $table = "sharing_rule";

    protected $primaryKey = "id";
    protected $fillable = [
        //'slug',
        'data_group_id',
        'group_id',
		'user_id',
        'associated_user_id'
		
      ];
}
