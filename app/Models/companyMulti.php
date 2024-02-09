<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companyMulti extends Model
{
    use HasFactory;
    protected $table = 'projectmulticompanies';

    protected $primaryKey = 'id';

  protected $fillable = [
      //'project_id',
      'project_id',
      'debtor_company_det_id'
    ];
}
