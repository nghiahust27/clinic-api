<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExaminationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'doctor'=> [
                'id' =>$this->appointment->doctor->id,
                'name'=>$this->appointment->doctor->user->name 
            ],
            'patient'=>[
                 'id' =>$this->appointment->patient->id,
                'name'=>$this->appointment->patient->full_name 
            ],
            'diagnosis'=>$this->diagnosis,
            'note'=>$this->note,
            'examinated_at'=>$this->examinated_at,
        ];
    }
}
