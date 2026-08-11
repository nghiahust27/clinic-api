<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $doctorId = $this->route('doctor')->id;

        return [
            'user_id' => ['sometimes','required','integer',
                'exists:users,id',
                Rule::unique('doctors', 'user_id')
                    ->ignore($doctorId)],

            'specialty_id' => ['sometimes','required',
                'integer','exists:specialties,id'],

            'license_number' => ['sometimes', 'required',
                'string', 'max:255',
                Rule::unique('doctors', 'license_number')
                    ->ignore($doctorId)],

            'bio' => ['sometimes', 'nullable','string'],
        ];
    }
}