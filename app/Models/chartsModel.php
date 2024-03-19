<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chartsModel extends Model
{
    use HasFactory;

    protected $table = 'charts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'json_obj',
        "created_at",
        "updated_at",
    ];
}
