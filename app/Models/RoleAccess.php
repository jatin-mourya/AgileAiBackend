<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    use HasFactory;
    protected $table = 'permission_access';

	protected $primaryKey = 'id';
    
    // protected $fillable = [
    //     'designation',
    //     'tab_id', 
    //     'haveedit', 
    //     'haveadd', 
    //     'havedelete',
    //     'haveview'
    // ];
    protected $fillable = ['designation', 'tab_id', 'haveedit', 'haveadd', 'havedelete', 'haveview'];
}
