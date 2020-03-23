<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viruses extends Model
{
    //protected $guarded=[];
    protected $fillable = [
        'name',
    ];
    public function donorActivities()
    {
        return $this->belongsToMany(DonorActivity::class)->withTimestamps();
    }
}
