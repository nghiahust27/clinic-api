<?php

namespace App\Http\Requests\Examination;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExaminationRequest extends FormRequest
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
            'diagnosis'=>['sometimes', 'string'],
            'examination_fee' => ['nullable', 'decimal:0,2'],
            'note' => ['nullable', 'string']
        ];
    }
}
