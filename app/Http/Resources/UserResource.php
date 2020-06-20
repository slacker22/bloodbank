<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            //'full_name'=>$this->first_name.' '.$this->last_name,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'user_name'=>$this->user_name,
            'gender'=>$this->gender,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'user_type_id'=>$this->type->id,
            'created_at' => $this->created_at,

        ];
    }
}
