<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medicine_id' => $this->medicine_id,
            'medicine' => new MedicineResource(
                $this->whenLoaded('medicine')
            ),
            'dousage' => $this->dousage,
            'usage_instruction' => $this->usage_instruction
        ];
    }
}
