<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table= "emp_documents";
    protected $primaryKey='emp_doc_id';
    protected $fillable = [
        'user_id',
        'doc1', 
        'doc2', 
        'doc3', 
        'doc4', 
        'doc5', 
      
       ];
}
