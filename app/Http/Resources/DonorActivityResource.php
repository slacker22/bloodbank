<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonorActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'donor_id'=>$this->donor->id,
            'full_name'=>$this->donor->user->first_name.' '.$this->donor->user->last_name,
            'product_type'=>$this->type->name,
            'temperature'=>$this->temperature,
            'weight'=>$this->weight,
            'height'=>$this->height,
            'status'=>$this->status,
            'comments'=>$this->comments,
            'created_at'=>$this->created_at,


        ];
    }
}
