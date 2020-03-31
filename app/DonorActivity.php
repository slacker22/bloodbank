<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonorActivity extends Model
{
    protected $fillable = [
        'donor_id','product_type_id','temperature','weight','height','status','comments',
    ];

    public function donor()
    {
        return $this->belongsTo(Donors::class,'donor_id');
    }

    public function viruses()
    {
        return $this->belongsToMany(Viruses::class)->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(ProductTypes::class,'product_type_id');
    }

    public function products()
    {
        return $this->hasMany(BloodProducts::class);
    }

}
