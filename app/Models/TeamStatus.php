<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamStatus extends Model
{
    use HasFactory;

    protected $table= "team_status";
   
    protected $fillable = [
       
        'teamstatus'
     
    ];
}
