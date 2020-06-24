<?php

namespace App\Http\Resources;

use App\BloodProducts;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BloodProductResource extends JsonResource
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
            'barcode'=>$this->barcode,
            'blood_group'=>$this->group->name,
            'blood_group_id'=>$this->group->id,
            'product_type'=>$this->type->name,
            'product_type_id'=>$this->type->id,
            'storage_location'=>$this->location->name,
            'storage_location_id'=>$this->location->id,
            'created_at' => $this->created_at,
            'expire_on'=>$this->expire_on,
            'donor_activity_id'=>intval($this->donor_activity_id),


        ];
    }
}
