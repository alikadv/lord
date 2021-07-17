<?php

namespace App\Http\Requests;

use App\Models\Machine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMachineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('machine_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:machines,name,' . request()->route('machine')->id,
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
