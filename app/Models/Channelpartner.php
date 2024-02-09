<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channelpartner extends Model
{
    use HasFactory;

	protected $table = 'channelpartner';

	protected $primaryKey = 'cp_id';
	
    protected $fillable = [
        //'slug',
        'cp_name',
        'mobile1',
        'mobile2',
        'email1',
        'email2',
        'date_of_birth',
        'catrgory_id',
        'occupation_id',
        'address',
        'channelpan'
      ];
}
