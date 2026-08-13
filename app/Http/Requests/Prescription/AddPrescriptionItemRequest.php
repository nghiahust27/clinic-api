<?php

namespace App\Http\Requests\Prescription;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddPrescriptionItemRequest extends FormRequest
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
            'medicine_id' => ['required', 'integer',
            'exists:medicines,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'dousage' => ['required', 'string'],
            'usage_instruction' =>['required', 'string']
        ];
    }
}
