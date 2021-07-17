@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.machine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.machines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.id') }}
                        </th>
                        <td>
                            {{ $machine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $machine->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.name') }}
                        </th>
                        <td>
                            {{ $machine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.productivity') }}
                        </th>
                        <td>
                            {{ $machine->productivity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.group') }}
                        </th>
                        <td>
                            {{ $machine->group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.comment') }}
                        </th>
                        <td>
                            {!! $machine->comment !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.machine.fields.photo') }}
                        </th>
                        <td>
                            @if($machine->photo)
                                <a href="{{ $machine->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $machine->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.machines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection