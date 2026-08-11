<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),

            'specialty' => $this->whenLoaded('specialty', function () {
                return [
                    'id' => $this->specialty->id,
                    'name' => $this->specialty->name,
                ];
            }),

            'license_number' => $this->license_number,
            'bio' => $this->bio,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}