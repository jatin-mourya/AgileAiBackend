<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weeklyleads extends Model
{
    use HasFactory;
    protected $table= 'weekly_leads';
    protected $primaryKey='id';

    protected $fillable = [
        'id',
        'team_id',
        'emp_id',
        'week_count',
        'week_date',
        'to_date',
        'weekly_lead_count',
        'yearly_week_count',
        'weekly_lead_count_valid'
       ];
}
