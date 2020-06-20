<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonorResource extends JsonResource
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
            'ssn'=>$this->ssn,
            'gender'=>intval($this->user->gender),
            'phone'=>$this->user->phone,
            'email'=>$this->user->email,
            'user_name'=>$this->user->user_name,
            'user_type_id'=>$this->user->type->id,
            'blood_group_id'=>$this->group->id,
            'donor_type_id'=>$this->type->id,
            'created_at' => $this->created_at,


        ];
    }
}
