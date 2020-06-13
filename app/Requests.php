<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
    use SoftDeletes;
    //protected $guarded=[];
    protected $fillable = [
        'patient_id','blood_group_id','product_type_id','quantity','priority','required_date', 'submitted_by', 'handled_by','status',
    ];



    public function submittedBy()
    {
        return $this->belongsTo(Staff::class,'submitted_by');
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class,'patient_id');
    }

    public function group()
    {
        return $this->belongsTo(BloodGroups::class,'blood_group_id');
    }
    public function type()
    {
        return $this->belongsTo(ProductTypes::class,'product_type_id');
    }

    public function bloodProducts()
    {
        return $this->belongsToMany(BloodProducts::class,'handled_requests')->withTimestamps();
    }

    public function handledRequests()
    {
        return $this->hasMany(HandledRequests::class);
    }

    public function scopeStatus($query, $value)
    {
        return $query->where('status','=',$value);
    }
}
