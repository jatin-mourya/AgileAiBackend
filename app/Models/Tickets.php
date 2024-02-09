<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    // use HasFactory;
    protected $table ='tickets';
    protected $primaryKey='ticket_id';
    protected $fillable=[
        'user_id',
        'task_name',
        'task_description',
        'task_due',
        'team_id',
        'client_id',
        'ticket_priority',
        'ticket_status',
        'ticket_category',
        'ticket_severity',
        'created_at',
        'updated_at'
    ];
    
}
