<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// For Table Relationship 
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// For Table Relationship 

class Clientdetails extends Model
{
    use HasFactory;

    protected $table = 'clientdetails';

    protected $primaryKey = 'client_id';

    protected $fillable = [
        "client_id",
        "name",
        "mobile1",
        "mobile2",
        "email1",
        "email2",
        "date_of_birth",
        "catrgory_id",
        "occupation_id",
        "address",
        "module",
        "created_at",
        "updated_at"
    ];
    // syntax : 
    // hasMany(model,'foreign_key_name in child model(Salesdetails)','primary_key_name in current(parent) model(Clientdetails))
    public function sales(): HasMany
    {
        return $this->hasMany(Salesdetails::class, 'client_id', 'client_id');
    }
}
