<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCompositeKey;

class StoreBatchRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->hasRole(['ADMIN', 'REGISTRAR']);
    }


    public function rules(): array
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'name' => [
                'required',
                'string',
                new UniqueCompositeKey('batches', [
                    'name' => $this->name,
                    'department_id' => $this->department_id,

                ])
            ],


        ];
    }
}
