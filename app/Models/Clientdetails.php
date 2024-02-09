<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdetails extends Model
{
    use HasFactory;

	protected $table = 'clientdetails';

	protected $primaryKey = 'client_id';
	
    protected $fillable = [
        //'slug',
        'name',
        'mobile1',
        'mobile2',
        'email1',
        'email2',
        'date_of_birth',
        'catrgory_id',
        'occupation_id',
        'address'
      ];
}
