<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tabs extends Model
{
    use HasFactory;

	protected $table = 'modules_tab';
    protected $primaryKey = 'tab_id';
    protected $fillable = [
        //'slug',
        'tab_name',
        'status'
      ];
}
