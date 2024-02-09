<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_types extends Model
{
    use HasFactory;
    // public $timestamps = false;

    protected $table = 'invoice_types';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
    ];
}
