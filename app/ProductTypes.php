<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $fillable = [
        'name',
    ];

    public function request()
    {
        return $this->hasOne(Requests::class);
    }

    public function activity()
    {
        return $this->hasOne(DonorActivity::class);
    }

    public function product()
    {
        return $this->hasOne(BloodProducts::class);
    }

}
