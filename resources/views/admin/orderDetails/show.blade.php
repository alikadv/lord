@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $orderDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.materials') }}
                        </th>
                        <td>
                            {{ $orderDetail->materials->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.material_capacity') }}
                        </th>
                        <td>
                            {{ $orderDetail->material_capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.product') }}
                        </th>
                        <td>
                            {{ $orderDetail->product }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.quantity') }}
                        </th>
                        <td>
                            {{ $orderDetail->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.feature_1') }}
                        </th>
                        <td>
                            {{ $orderDetail->feature_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.feature_2') }}
                        </th>
                        <td>
                            {{ $orderDetail->feature_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.description') }}
                        </th>
                        <td>
                            {!! $orderDetail->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.linetotal') }}
                        </th>
                        <td>
                            {{ $orderDetail->linetotal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.order') }}
                        </th>
                        <td>
                            {{ $orderDetail->order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderDetail.fields.number') }}
                        </th>
                        <td>
                            {{ $orderDetail->number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection