<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leadsgiven extends Model
{
    use HasFactory;

    protected $table= 'leads_given';
    protected $primaryKey='leads_given_id';

    protected $fillable = [
        'leads_given_id',
        'team_id',
        // 'emp_code',
        'emp_id',
        'month',
        'to_date',
        'leads_given_to',
        'valid_lead_count'
       ];
}
