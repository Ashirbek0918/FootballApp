<?php

namespace App\Http\Controllers\web;

use Akbarali\ActionData\ActionDataException;
use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Gamers\CreateGamerActionData;
use App\ActionData\Gamers\UpdateGamerActionData;
use App\Http\Controllers\Controller;
use App\Services\Web\Gamer\GamerService;
use App\Services\Web\Position\PositionService;
use App\ViewModels\Gamer\GamerViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class GamerController extends Controller
{
    function __construct(
        protected PositionService   $positionService,
        protected GamerService     $service
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
        return (new PaginationViewModel($collection, GamerViewModel::class))->toView('admin.gamers.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $positions = $this->positionService->getPositions();
        return view('admin.gamers.create',compact('positions'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function store(Request  $request): RedirectResponse
    {
//        $action = CreateGamerActionData::createFromRequest($request);
//        dd($action->all());
        $this->service->createGamer(CreateGamerActionData::createFromRequest($request));
        return redirect()->route('gamers.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.gamers.gamer')]),
        ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id):View
    {
        $gamer = $this->service->edit($id);
        $viewModel = GamerViewModel::fromDataObject($gamer);
        return $viewModel->toView('admin.gamers.show');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $positions = $this->positionService->getPositions();
        $gamer = $this->service->edit($id);
        $viewModel = GamerViewModel::fromDataObject($gamer);

        return $viewModel->toView('admin.gamers.edit',compact('positions'));
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
        $this->service->updateGamer(UpdateGamerActionData::createFromRequest($request), $id);
        return redirect()->route('gamers.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.gamers.gamer')]),
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id):RedirectResponse
    {
        $this->service->deleteGamer($id);
        return redirect()->route('gamers.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.gamers.gamer')]),
        ]);
    }
}
