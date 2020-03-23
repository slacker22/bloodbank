<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //protected $guarded=[];
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Requests::class);
    }

    public function handledRequests()
    {
        return $this->hasMany(HandledRequests::class);
    }
}
