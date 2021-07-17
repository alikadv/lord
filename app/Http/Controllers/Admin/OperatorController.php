<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOperatorRequest;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Models\Operator;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OperatorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('operator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operators = Operator::with(['media'])->get();

        return view('admin.operators.index', compact('operators'));
    }

    public function create()
    {
        abort_if(Gate::denies('operator_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.operators.create');
    }

    public function store(StoreOperatorRequest $request)
    {
        $operator = Operator::create($request->all());

        if ($request->input('photo', false)) {
            $operator->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $operator->id]);
        }

        return redirect()->route('admin.operators.index');
    }

    public function edit(Operator $operator)
    {
        abort_if(Gate::denies('operator_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.operators.edit', compact('operator'));
    }

    public function update(UpdateOperatorRequest $request, Operator $operator)
    {
        $operator->update($request->all());

        if ($request->input('photo', false)) {
            if (!$operator->photo || $request->input('photo') !== $operator->photo->file_name) {
                if ($operator->photo) {
                    $operator->photo->delete();
                }
                $operator->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($operator->photo) {
            $operator->photo->delete();
        }

        return redirect()->route('admin.operators.index');
    }

    public function show(Operator $operator)
    {
        abort_if(Gate::denies('operator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operator->load('operatorOrders');

        return view('admin.operators.show', compact('operator'));
    }

    public function destroy(Operator $operator)
    {
        abort_if(Gate::denies('operator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operator->delete();

        return back();
    }

    public function massDestroy(MassDestroyOperatorRequest $request)
    {
        Operator::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('operator_create') && Gate::denies('operator_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Operator();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
