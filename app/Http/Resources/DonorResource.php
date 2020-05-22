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
            'first_name'=>$this->user->first_name,
            'last_name'=>$this->user->last_name,
            'full_name'=>$this->user->first_name.' '.$this->user->last_name,
            'ssn'=>$this->ssn,
            'gender'=>$this->user->gender,
            'phone'=>$this->user->phone,
            'email'=>$this->user->email,
            'user_name'=>$this->user->user_name,
            'user_type'=>$this->user->type->name,
            'blood_group'=>$this->group->name,
            'donor_type'=>$this->type->name,
            'created_at' => $this->created_at,


        ];
    }
}
