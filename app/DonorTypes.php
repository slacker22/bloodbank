<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonorTypes extends Model
{
    // protected $guarded=[];
    protected $fillable = [
        'name',
    ];

    public function donors()
    {
        return $this->hasMany(Donors::class);
    }
}
