<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Http\Resources\Admin\MachineResource;
use App\Models\Machine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MachinesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('machine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MachineResource(Machine::all());
    }

    public function store(StoreMachineRequest $request)
    {
        $machine = Machine::create($request->all());

        if ($request->input('photo', false)) {
            $machine->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new MachineResource($machine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Machine $machine)
    {
        abort_if(Gate::denies('machine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MachineResource($machine);
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

        return (new MachineResource($machine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Machine $machine)
    {
        abort_if(Gate::denies('machine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $machine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
