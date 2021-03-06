<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;
    //protected $guarded=[];
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
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
