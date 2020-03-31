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
            'product_type'=>$this->type->name,
            'storage_location'=>$this->location->name,
            'created_at' => $this->created_at,
            'expire_on'=>$this->expire_on,
            'availability'=>$this->availability,
            'donor_activity_id'=>$this->donor_activity_id,


            //Carbon::now()->addMonths(3)->format();



            //BloodProducts::all()->filter(function($product){
            //            if( Carbon::now()->diff($product->expire_on)<2)
            //            return  $product;
            //        });
        ];
    }
}
