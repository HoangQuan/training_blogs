<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 1 user - cos nhieu Posts
    public function posts() {
        // return $this->hasMany('App\Models\Post', 'foreign_key', 'local_key');
        return $this->hasMany('App\Models\Post');
    }

    public function isAdmin()    {        
        return $this->type === self::ADMIN_TYPE;    
    }
}
