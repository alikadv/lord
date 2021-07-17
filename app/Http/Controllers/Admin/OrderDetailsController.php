<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrderDetailRequest;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderDetail::with(['materials'])->select(sprintf('%s.*', (new OrderDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_detail_show';
                $editGate = 'order_detail_edit';
                $deleteGate = 'order_detail_delete';
                $crudRoutePart = 'order-details';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('materials_name', function ($row) {
                return $row->materials ? $row->materials->name : '';
            });

            $table->editColumn('material_capacity', function ($row) {
                return $row->material_capacity ? $row->material_capacity : '';
            });
            $table->editColumn('product', function ($row) {
                return $row->product ? $row->product : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('feature_1', function ($row) {
                return $row->feature_1 ? $row->feature_1 : '';
            });
            $table->editColumn('linetotal', function ($row) {
                return $row->linetotal ? $row->linetotal : '';
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'materials']);

            return $table->make(true);
        }

        $products = Product::get();

        return view('admin.orderDetails.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materials = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orderDetails.create', compact('materials'));
    }

    public function store(StoreOrderDetailRequest $request)
    {
        $orderDetail = OrderDetail::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $orderDetail->id]);
        }

        return redirect()->route('admin.order-details.index');
    }

    public function edit(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materials = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderDetail->load('materials');

        return view('admin.orderDetails.edit', compact('materials', 'orderDetail'));
    }

    public function update(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->all());

        return redirect()->route('admin.order-details.index');
    }

    public function show(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderDetail->load('materials');

        return view('admin.orderDetails.show', compact('orderDetail'));
    }

    public function destroy(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderDetailRequest $request)
    {
        OrderDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('order_detail_create') && Gate::denies('order_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OrderDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
