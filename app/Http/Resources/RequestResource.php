<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'patient_id'=>$this->patient->id,
            'patient_full_name'=>$this->patient->first_name.' '.$this->patient->last_name,
            'blood_group'=>$this->group->name,
            'product_type'=>$this->type->name,
            'quantity'=>$this->quantity,
            'priority'=>$this->priority,
            'required_date'=>$this->required_date,
            'submitted_by'=>$this->submittedBy->user->first_name.' '.$this->submittedBy->user->last_name,
            'status'=>$this->status,
            'created_at' => $this->created_at,


        ];
    }
}
