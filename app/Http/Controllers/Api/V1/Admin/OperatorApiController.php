<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Http\Resources\Admin\OperatorResource;
use App\Models\Operator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OperatorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('operator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OperatorResource(Operator::all());
    }

    public function store(StoreOperatorRequest $request)
    {
        $operator = Operator::create($request->all());

        if ($request->input('photo', false)) {
            $operator->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new OperatorResource($operator))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Operator $operator)
    {
        abort_if(Gate::denies('operator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OperatorResource($operator);
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

        return (new OperatorResource($operator))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Operator $operator)
    {
        abort_if(Gate::denies('operator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operator->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
