<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'created_at', 
        'updated_at'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    } 
        /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
