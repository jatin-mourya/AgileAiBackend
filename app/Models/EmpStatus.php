<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpStatus extends Model
{
    use HasFactory;

    protected $table= "emp_status";
    protected $primaryKey='emp_status_id';
    protected $fillable = [
        'empstatus'
      
       ];
}
