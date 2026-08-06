<?php

namespace App\Http\Requests\Patient;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        $patient = $this->route('patient');

        return [
            'code'=> ['required', Rule::unique('patients', 'code')
            ->ignore($patient->id)],
            'full_name'=>['required', 'string', 'max:255'],
            'gender'=>['nullable', 'in:male,female,other'],
            'date_of_birth'=>['nullable', 'date'],
            'phone'=>['nullable', 'string'],
            'email'=>['nullable', 'email'],
            'address'=>['nullable', 'string']
        ];
    }
}
