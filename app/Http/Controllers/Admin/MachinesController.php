<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMachineRequest;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Machine;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MachinesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('machine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $machines = Machine::with(['media'])->get();

        return view('admin.machines.index', compact('machines'));
    }

    public function create()
    {
        abort_if(Gate::denies('machine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.machines.create');
    }

    public function store(StoreMachineRequest $request)
    {
        $machine = Machine::create($request->all());

        if ($request->input('photo', false)) {
            $machine->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $machine->id]);
        }

        return redirect()->route('admin.machines.index');
    }

    public function edit(Machine $machine)
    {
        abort_if(Gate::denies('machine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.machines.edit', compact('machine'));
    }

    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        $machine->update($request->all());

        if ($request->input('photo', false)) {
            if (!$machine->photo || $request->input('photo') !== $machine->photo->file_name) {
                if ($machine->photo) {
                    $machine->photo->delete();
                }
                $machine->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($machine->photo) {
            $machine->photo->delete();
        }

        return redirect()->route('admin.machines.index');
    }

    public function show(Machine $machine)
    {
        abort_if(Gate::denies('machine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.machines.show', compact('machine'));
    }

    public function destroy(Machine $machine)
    {
        abort_if(Gate::denies('machine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $machine->delete();

        return back();
    }

    public function massDestroy(MassDestroyMachineRequest $request)
    {
        Machine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('machine_create') && Gate::denies('machine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Machine();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
