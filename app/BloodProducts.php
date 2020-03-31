<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodProducts extends Model
{
    protected $fillable = [
        'barcode','blood_group_id','product_type_id','storage_location_id','expire_on','availability','donor_activity_id'
    ];

    public function group()
    {
        return $this->belongsTo(BloodGroups::class,'blood_group_id');
    }

    public function type()
    {
        return $this->belongsTo(ProductTypes::class,'product_type_id');
    }

    public function location()
    {
        return $this->belongsTo(StorageLocation::class,'storage_location_id');
    }

    public function requests()
    {
        return $this->belongsToMany(Requests::class,'handled_requests')->withTimestamps();
    }

    public function handledRequests()
    {
        return $this->hasMany(HandledRequests::class);
    }

    public function activity()
    {
        return $this->belongsTo(DonorActivity::class,'donor_activity_id');
    }
}
