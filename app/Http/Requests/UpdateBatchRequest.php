<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCompositeKey;

class UpdateBatchRequest extends FormRequest
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
            'department_id' => ['required', 'exists:departments,id'],
            'name' => [
                'required',
                'string',
                new UniqueCompositeKey(
                    'batches',
                    [
                        'name' => $this->name,
                        'department_id' => $this->department_id
                    ],
                    $this->route('batch')->id
                )
            ]
        ];
    }
}
