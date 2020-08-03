<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPasswordNotification;
class User extends Authenticatable implements MustVerifyEmail
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

    public function hasAnyRole( $roles ){
        if($this->roles()->whereIn('name', $roles)->first())  return true;
        return false;
    }

    public function hasRole( $role ){
        if($this->roles()->where('name', $role)->first())  return true;
        return false;
    }
    
    public function hasDept( $dept ){
        if($this->departments()->where('name', $role)->first())  return true;
        return false;
    }

    public function roles(){
      return $this->belongsToMany('App\Role');
    }


    public function departments(){
      return $this->belongsToMany('App\Department');
    }

    public function doctor(){
      return $this->hasOne('App\Doctor');
    }



    public function patient(){
      return $this->hasOne('App\Patient');
    }



    public function payments(){
      return $this->belongsToMany('App\Payment');
    }



    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

}