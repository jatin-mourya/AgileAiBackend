<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activitylogs extends Model
{
    protected $table = 'activitylogs';

    protected $primaryKey = 'id';


    protected $fillable = [
      'user_id',
      'username',
      'modelname',
      'action',
      'previous',
      'current'
      ];
}
