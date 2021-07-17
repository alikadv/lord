@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.operator.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.operators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.id') }}
                        </th>
                        <td>
                            {{ $operator->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $operator->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.name') }}
                        </th>
                        <td>
                            {{ $operator->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.description') }}
                        </th>
                        <td>
                            {!! $operator->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.photo') }}
                        </th>
                        <td>
                            @if($operator->photo)
                                <a href="{{ $operator->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $operator->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.operators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#operator_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="operator_orders">
            @includeIf('admin.operators.relationships.operatorOrders', ['orders' => $operator->operatorOrders])
        </div>
    </div>
</div>

@endsection