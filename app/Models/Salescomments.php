<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salescomments extends Model
{
    use HasFactory;

	protected $table = 'sales_comments';

	protected $primaryKey = 'sales_comment_id';
    
    protected $fillable = [
        'user_id',
        'sales_id',
        'comment',
		    'updated_by'
      ];
}



 