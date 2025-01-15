<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseAllocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole("COORDINATOR");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'courses' => ['required', 'array'],
            'courses.*' => ['required', 'exists:courses,id']
        ];
    }

    public function messages(): array
    {
        return [
            'courses.required' => 'The courses field is required.',
            'courses.array' => 'The courses must be an array.',
            'courses.*.exists' => 'One or more selected courses do not exist in the database.',
        ];
    }
}
