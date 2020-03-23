<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodGroups extends Model
{
    //protected $guarded=[];
    protected $fillable = [
        'name',
    ];

    public function request()
    {
        return $this->hasOne(Requests::class);
    }
    public function donor()
    {
        return $this->hasOne(Donors::class);
    }
    public function patient()
    {
        return $this->hasOne(Patients::class);
    }
    public function product()
    {
        return $this->hasOne(BloodProducts::class);
    }


}
