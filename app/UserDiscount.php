<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDiscount extends Model
{
    protected $fillable = [
        'user_id',
        'discount_id',
    ];
}
