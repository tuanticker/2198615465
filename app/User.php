<?php

namespace App;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //use Notifiable;
    //use Authenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';


    protected $fillable = [
        'username', 'email', 'password','level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function product(){
        return $this->hasMany('App\Product');
    }
}
