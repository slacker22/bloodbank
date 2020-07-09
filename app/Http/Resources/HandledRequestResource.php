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
            //'blood_product_id'=>$this->products,
            'handled_by'=>$this->handledBy->user->first_name.' '.$this->handledBy->user->last_name,

            'patient_id'=>$this->request->patient->id,
            'first_name'=>$this->request->patient->first_name,
            'last_name'=>$this->request->patient->last_name,
            'full_name'=>$this->request->patient->first_name.' '.$this->request->patient->last_name,
            'blood_group_id'=>$this->request->group->id,
            'blood_group'=>$this->request->group->name,
            'product_type_id'=>$this->request->type->id,
            'product_type'=>$this->request->type->name,
            'quantity'=>intval($this->request->quantity),
            'priority'=>intval($this->request->priority),
            'required_date'=>$this->request->required_date,
            'submitted_by'=>$this->request->submittedBy->user->first_name.' '.$this->request->submittedBy->user->last_name,
            'status'=>intval($this->request->status),
            'created_at' => $this->created_at,




        ];
    }
}
