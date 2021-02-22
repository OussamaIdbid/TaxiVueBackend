<?php

namespace App;

use App\Notifications\VerifyNotification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\ReservationConfirmation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
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

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }  

    public function userTypes()
    {
        return $this->belongsTo('App\UserType');
    } 
     public function sendEmailVerificationNotification()
     {
            $this->notify(new VerifyNotification());
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function sendReservationConfirmation($reservation, $name)
    {
        $this->notify(new ReservationConfirmation($reservation, $name));
    }
}
