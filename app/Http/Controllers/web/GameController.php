<?php

namespace App\Http\Controllers\web;

use Akbarali\ActionData\ActionDataException;
use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Game\GameActionData;
use App\Filters\Game\GameFilter;
use App\Http\Controllers\Controller;
use App\Services\Web\Day\DayService;
use App\Services\Web\Game\GameService;
use App\Services\Web\Team\TeamService;
use App\ViewModels\Game\GameViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class GameController extends Controller
{
    function __construct(
        protected GameService $service,
        protected DayService  $dayService,
        protected TeamService $teamService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if (!$request->has('day_id')) {
            $day = $this->dayService->getLastDay();
            $request->merge(['day_id' => $day->id]);
        } else {
            $day = $this->dayService->getDay((int)$request->get('day_id'));
        }
        $filters[] = GameFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        $days = $this->dayService->getDays();
        return (new PaginationViewModel($collection, GameViewModel::class))->toView('admin.game.index', compact('day','days'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $actionData = GameActionData::fromRequest($request);
//        dd($actionData->all());
        $result = $this->service->createGame($actionData);
        if (!$result) {
            return redirect()->route('days.show',['day_id' => $actionData->day_id])->with('res', [
                'method' => 'success',
                'msg' => trans('form.success_create', ['attribute' => trans('form.game.game')]),
            ]);
        }
        return redirect()->route('days.show',['day_id' => $actionData->day_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.game.game')]),
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $game = $this->service->show($id);
        $viewModel = GameViewModel::fromDataObject($game);
        return $viewModel->toView('admin.game.show');
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $data = $this->service->updateGame(GameActionData::createFromRequest($request), $id);
        return redirect()->route('days.show', ['day_id' => $data->day_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.teams.team')]),
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $action = $this->service->deleteGame($id);
        return redirect()->route('days.show')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.teams.team')]),
        ]);
    }
}
