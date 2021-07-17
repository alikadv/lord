<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'group' => [
                'string',
                'required',
            ],
            'category' => [
                'string',
                'nullable',
            ],
            'feature_1' => [
                'numeric',
                'required',
            ],
            'feature_2' => [
                'numeric',
                'required',
            ],
        ];
    }
}
