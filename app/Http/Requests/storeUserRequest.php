<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole(['ADMIN', 'REGISTRAR']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:4', 'max:255'],
            'middle_name' => ['required', 'string', 'min:4', 'max:255'],
            'last_name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],

        ];
    }
}
