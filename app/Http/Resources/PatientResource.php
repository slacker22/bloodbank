<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'full_name'=>$this->first_name.' '.$this->last_name,
            'ssn'=>$this->ssn,
            'gender'=>intval($this->gender),
            'blood_group_id'=>$this->group->id,
            'blood_group'=>$this->group->name,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'created_at' => $this->created_at,


        ];
    }
}
