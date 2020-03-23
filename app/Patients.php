<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //protected $guarded=[];
    protected $fillable = [
        'first_name','last_name','ssn','gender','blood_group_id','phone', 'address',
    ];

    public function requests()
    {
        return $this->hasMany(Requests::class);
    }
    public function group()
    {
        return $this->belongsTo(BloodGroups::class,'blood_group_id');
    }
}
