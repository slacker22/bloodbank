<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodProducts extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'barcode','blood_group_id','product_type_id','storage_location_id','expire_on','donor_activity_id'
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
