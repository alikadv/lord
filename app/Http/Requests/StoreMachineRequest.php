<?php

namespace App\Http\Requests;

use App\Models\Machine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMachineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('machine_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:machines',
            ],
            'productivity' => [
                'numeric',
                'required',
                'min:0',
            ],
            'group' => [
                'string',
                'nullable',
            ],
        ];
    }
}
