<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => [ 'sometimes', 'required','string','max:255'],

            'email' => ['sometimes', 'required', 'email','max:255',
                Rule::unique('users', 'email')->ignore($userId)],

            'role_id' => ['sometimes','required','integer',
                'exists:roles,id',

            'password'=>['nullable', 'string', 'min:8', 'confirmed']
            ],
        ];
    }
}