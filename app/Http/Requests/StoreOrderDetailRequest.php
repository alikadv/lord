<?php

namespace App\Http\Requests;

use App\Models\OrderDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_detail_create');
    }

    public function rules()
    {
        return [
            'materials_id' => [
                'required',
                'integer',
            ],
            'material_capacity' => [
                'numeric',
                'required',
            ],
            'product' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'feature_1' => [
                'numeric',
                'required',
            ],
            'feature_2' => [
                'numeric',
                'required',
            ],
            'linetotal' => [
                'numeric',
            ],
            'order' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
