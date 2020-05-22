<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donors extends Model
{
    //protected $guarded=[];
    protected $fillable = [
        'ssn', 'user_id','blood_group_id','donor_type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function donorActivities()
    {
        return $this->hasMany(DonorActivity::class);
    }
    public function group()
    {
        return $this->belongsTo(BloodGroups::class,'blood_group_id');
    }

    public function type()
    {
        return $this->belongsTo(DonorTypes::class,'donor_type_id');
    }
}
