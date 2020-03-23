<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HandledRequestResource extends JsonResource
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
            'request_id'=>$this->request->id,
            'blood_products_id'=>$this->products->id,
            'handled_by'=>$this->handledBy->user->first_name.' '.$this->handledBy->user->last_name,
            'created_at' => $this->created_at,


        ];
    }
}
