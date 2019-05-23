<?php

namespace App;

use App\Models\Roles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_login_at','last_login_ip', 'profile_image', 'contact_number', 'address',  'role_id', 'hook_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->belongsToMany(Role::class);
    }



    public function getStatusAttribute($value)
    {
        return $value == 1?'active':'in-active';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'active'?1:0;
    }




}
