<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'user_id'=>$this->user->id,
            'first_name'=>$this->user->first_name,
            'last_name'=>$this->user->last_name,
            'full_name'=>$this->user->first_name.' '.$this->user->last_name,
            'gender'=>intval($this->user->gender),
            'phone'=>$this->user->phone,
            'email'=>$this->user->email,
            'user_name'=>$this->user->user_name,
            'user_type'=>$this->user->type->id,
            'created_at' => $this->user->created_at,


        ];
    }
}
