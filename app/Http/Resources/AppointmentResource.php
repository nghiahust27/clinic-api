<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'patient'=> [
                'id'=>$this->patient->id,
                'name'=>$this->patient->full_name
            ],
            'doctor'=> [
                'id'=>$this->doctor->id,
                'name'=>$this->doctor->user->name
            ],
            'scheduled_at'=>$this->scheduled_at,
            'status'=>$this->status,
            'reason'=>$this->reason
        ];
    }
}
