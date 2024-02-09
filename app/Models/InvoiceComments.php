<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceComments extends Model
{
    use HasFactory;

    protected $table= "invoice_comments";
    protected $primaryKey='invoice_comment_id';
    protected $fillable = [
        'user_id',
        'invoice_multi_id',
        'comments',
        'updated_by'
      
       ];
}

