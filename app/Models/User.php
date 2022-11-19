<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use  HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable...
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'nic',
        'image',
        'description',
        'organization',
        'organization_name',
        'address_1',
        'address_2',
        'country_code',
        'is_super_admin',
        'group_id',
        'fire_base_token',
        'is_verified',
        'status',
        'city',
        'social_account_id',
        'social_account',
        'access_token',
        'coordinates',
        'multi_login',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getName()
    {
        return $this->name;
    }
}
