<?php

namespace App\Http\Requests\Prescription;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            'examination_id'=>['required', 'integer',
            'exists:examinations,id', 'exists:examinations,id'],
            
            'note'=>['nullable', 'string'],
            'item' => ['nullable', 'array'],
            'item.*.medicine_id' => ['required', 'integer'],
            'item.*.quantity' => ['required', 'integer', 'min:1'],
            'item.*.dousage' => ['required', 'string'],
            'item.*.usage_instruction' => 
            ['required', 'string'],
        ];
    }
}
