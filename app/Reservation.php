<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;



class Reservation extends Model
{

    use Notifiable;

    protected $fillable = [
        'start_address',
        'end_address',
        'start_address_geo',
        'end_address_geo',
        'amount_of_people',
        'pickup_date',
        'fare_price',
        'distance',
        'travel_time',
        'order_id',
        'payment_id',
        'status',
        'user_id',
        'refundIsAsked',
        'orderIsComplete',
        'refundIsAskedDate',
        'refundIsConfirmed',
        'refundIsDenied',
        'created_at',
        'updated_at'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
