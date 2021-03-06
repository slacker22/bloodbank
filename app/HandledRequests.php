<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HandledRequests extends Model
{
    use SoftDeletes;
    //protected $guarded=[];
    protected $fillable = [
        'request_id', 'blood_product_id', 'handled_by',
    ];


    public function request()
    {
        return $this->belongsTo(Requests::class,'request_id');
    }

    public function products()
    {
        return $this->belongsTo(BloodProducts::class,'blood_product_id');
    }


    public function handledBy()
    {
        return $this->belongsTo(Staff::class,'handled_by');
    }




}
