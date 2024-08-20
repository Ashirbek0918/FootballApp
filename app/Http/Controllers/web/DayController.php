<?php

namespace App\Http\Controllers\web;

use Akbarali\ActionData\ActionDataException;
use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Day\DayActionData;
use App\Http\Controllers\Controller;
use App\Services\Web\Day\DayService;
use App\ViewModels\Day\DayViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DayController extends Controller
{
    function __construct(
        protected DayService   $service,
    )
    {

    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters = [];
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, DayViewModel::class))->toView('admin.days.index');
    }

    public function create(): View
    {
        return view('admin.days.create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function store(Request  $request): RedirectResponse
    {
        $this->service->createDay(DayActionData::createFromRequest($request));
        return redirect()->route('days.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('validation.attributes.day')]),
        ]);
    }

    public function show(int $id)
    {
        //
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $day = $this->service->edit($id);
        $viewModel = DayViewModel::fromDataObject($day);
        return $viewModel->toView('admin.days.edit');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->service->updateDay(DayActionData::createFromRequest($request), $id);
        return redirect()->route('days.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('validation.attributes.day')]),
        ]);
    }
    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id):RedirectResponse
    {
        if(!$this->service->deleteDay($id)){
            return redirect()->route('days.index')->with('res', [
                'method' => 'error',
                'msg' => "O'chirish mumkin emas !",
            ]);
        }
        return redirect()->route('days.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('validation.attributes.day')]),
        ]);
    }
}
