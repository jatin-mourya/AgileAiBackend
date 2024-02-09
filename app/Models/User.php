<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
	 
	 protected $table = "users";

    protected $primaryKey = "user_id";
	
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'mobile_no',
        'email',
        'emp_code',
        //'name',
        'nickname',
        'password',
        'password_confirmation',
        'date_of_birth',
        'pan_no',
        'qualification',
        'marital_status',
        'joining_date',
        'experience_in_year',
        'last_package',
        'designation',
        'remember_token',
        'permanant_address',
        'current_address',
        'home_contactno',
        'resignation_date',
        'status_id',
        'experience_in_months',
        'privious_company_contactname',
        'privious_company_contact',
        'source',
        'source_by',
        'remark_by_HR'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
         $this->attributes['password'] = bcrypt($value);
    }
	
}
