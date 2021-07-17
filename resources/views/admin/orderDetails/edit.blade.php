@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orderDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-details.update", [$orderDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="materials_id">{{ trans('cruds.orderDetail.fields.materials') }}</label>
                <select class="form-control select2 {{ $errors->has('materials') ? 'is-invalid' : '' }}" name="materials_id" id="materials_id" required>
                    @foreach($materials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('materials_id') ? old('materials_id') : $orderDetail->materials->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('materials'))
                    <div class="invalid-feedback">
                        {{ $errors->first('materials') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.materials_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="material_capacity">{{ trans('cruds.orderDetail.fields.material_capacity') }}</label>
                <input class="form-control {{ $errors->has('material_capacity') ? 'is-invalid' : '' }}" type="number" name="material_capacity" id="material_capacity" value="{{ old('material_capacity', $orderDetail->material_capacity) }}" step="0.0001" required>
                @if($errors->has('material_capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('material_capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.material_capacity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product">{{ trans('cruds.orderDetail.fields.product') }}</label>
                <input class="form-control {{ $errors->has('product') ? 'is-invalid' : '' }}" type="number" name="product" id="product" value="{{ old('product', $orderDetail->product) }}" step="1" required>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.orderDetail.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $orderDetail->quantity) }}" step="0.0001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="feature_1">{{ trans('cruds.orderDetail.fields.feature_1') }}</label>
                <input class="form-control {{ $errors->has('feature_1') ? 'is-invalid' : '' }}" type="number" name="feature_1" id="feature_1" value="{{ old('feature_1', $orderDetail->feature_1) }}" step="0.0001" required>
                @if($errors->has('feature_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('feature_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.feature_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="feature_2">{{ trans('cruds.orderDetail.fields.feature_2') }}</label>
                <input class="form-control {{ $errors->has('feature_2') ? 'is-invalid' : '' }}" type="number" name="feature_2" id="feature_2" value="{{ old('feature_2', $orderDetail->feature_2) }}" step="0.01" required>
                @if($errors->has('feature_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('feature_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.feature_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.orderDetail.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $orderDetail->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="linetotal">{{ trans('cruds.orderDetail.fields.linetotal') }}</label>
                <input class="form-control {{ $errors->has('linetotal') ? 'is-invalid' : '' }}" type="number" name="linetotal" id="linetotal" value="{{ old('linetotal', $orderDetail->linetotal) }}" step="0.01">
                @if($errors->has('linetotal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('linetotal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.linetotal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.orderDetail.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" name="order" id="order" value="{{ old('order', $orderDetail->order) }}" step="1" required>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.orderDetail.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number" name="number" id="number" value="{{ old('number', $orderDetail->number) }}" step="1" required>
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderDetail.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.order-details.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $orderDetail->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection