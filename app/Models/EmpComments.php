<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpComments extends Model
{
    use HasFactory;

    protected $table= "emp_comments";
    protected $primaryKey='user_id';
    protected $fillable = [
        'user_id',
        'comment'
      
       ];
}
