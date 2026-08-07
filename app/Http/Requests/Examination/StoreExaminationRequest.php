<?php

namespace App\Http\Requests\Examination;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_id' => ['required', 'integer',
                 'unique:examinations,appointment_id' ],
            'diagnosis' => ['required', 'string'],

            'note' => ['nullable', 'string']
    
        ];
    }
}
