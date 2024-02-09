<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesdocuments extends Model
{
    use HasFactory;

	protected $table = 'sales_documents';

	protected $primaryKey = 'sales_doc_id';
    
    protected $fillable = [
        'sales_id',
        'doc1',
		'doc2',
		'doc3',
		'doc4',
		'doc5'
      ];
}
