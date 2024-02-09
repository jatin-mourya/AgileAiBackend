<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Walkindeals extends Model
{
    protected $table = 'walkin_deals';

    protected $primaryKey = 'id';

  protected $fillable = [
      'id',
      'date',
      'client_name',
      'project_id',
      'sourcing_emp_id',
      'closing_emp_id',
      'team_id',
      'team_leader_id',
      'revisit',
      'videopresentation',
      'leadsource_id',
      'remark',
      'presentwithclient',
      'closingtisite'
    ];
}
