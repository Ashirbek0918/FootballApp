<?php

namespace App\Http\Controllers\web;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Position\CreatePositionActionData;
use App\Http\Controllers\Controller;
use App\Services\Web\Position\PositionService;
use App\ViewModels\Position\PositionViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    function __construct(
        protected PositionService   $service,
    )
    {

    }

    public function index(Request $request): View
    {
        $filters = [];
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, PositionViewModel::class))->toView('admin.positions.index');
    }

    public function create(): View
    {
        return view('admin.positions.create');
    }


    public function store(Request  $request): RedirectResponse
    {
        $this->service->createPosition(CreatePositionActionData::createFromRequest($request));
        return redirect()->route('positions.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.positions.position')]),
        ]);
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id): View
    {
        $position = $this->service->edit($id);


        $viewModel = PositionViewModel::fromDataObject($position);

        return $viewModel->toView('admin.positions.edit');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->service->updatePosition(CreatePositionActionData::createFromRequest($request), $id);
        return redirect()->route('positions.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.positions.position')]),
        ]);
    }

    public function delete(int $id):RedirectResponse
    {
        if(!$this->service->deletePosition($id)){
            return redirect()->route('positions.index')->with('res', [
                'method' => 'error',
                'msg' => "O'chirish mumkin emas !",
            ]);
        }
        return redirect()->route('positions.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.positions.position')]),
        ]);
    }
}
