<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leadsource extends Model
{
    use HasFactory;

    protected $table= "leadsource";
    protected $primaryKey='leadsource_id';

    protected $fillable = [
        'leadsource'
      
       ];
}
