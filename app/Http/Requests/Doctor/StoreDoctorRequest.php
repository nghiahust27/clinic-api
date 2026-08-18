<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer','exists:users,id',
                'unique:doctors,user_id'],

            'specialty_id' => ['required', 'integer',
                'exists:specialties,id' ],

            'license_number' => ['required','string','max:255',
                'unique:doctors,license_number',],

            'bio' => ['nullable','string'],
        ];
    }
}