@extends('layouts.admin')
@section('content')
@can('machine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.machines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.machine.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.machine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Machine">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.machine.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.machine.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.machine.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.machine.fields.productivity') }}
                        </th>
                        <th>
                            {{ trans('cruds.machine.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.machine.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($machines as $key => $machine)
                        <tr data-entry-id="{{ $machine->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $machine->id ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $machine->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $machine->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $machine->name ?? '' }}
                            </td>
                            <td>
                                {{ $machine->productivity ?? '' }}
                            </td>
                            <td>
                                {{ $machine->group ?? '' }}
                            </td>
                            <td>
                                @if($machine->photo)
                                    <a href="{{ $machine->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $machine->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('machine_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.machines.show', $machine->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('machine_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.machines.edit', $machine->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('machine_delete')
                                    <form action="{{ route('admin.machines.destroy', $machine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('machine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.machines.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 3, 'asc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Machine:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection