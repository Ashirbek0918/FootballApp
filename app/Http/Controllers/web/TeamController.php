<?php

namespace App\Http\Controllers\Web;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Team\TeamActionData;
use App\Filters\Gamer\GamerFilter;
use App\Filters\Team\TeamFilter;
use App\Http\Controllers\Controller;
use App\Services\Web\Day\DayService;
use App\Services\Web\Gamer\GamerService;
use App\Services\Web\Position\PositionService;
use App\Services\Web\Team\TeamService;
use App\ViewModels\Gamer\GamerViewModel;
use App\ViewModels\Team\TeamViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    function __construct(
        protected TeamService $service,
        protected GamerService  $gamerService,
        protected PositionService  $positionService,
        protected DayService  $dayService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = TeamFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, TeamViewModel::class))->toView('admin.gamers.index');
    }

    /**
     * @return View
     */
    public function create(Request $request): View
    {
        $day = $this->dayService->getDay($request->get('day_id'));
        $filters[] = GamerFilter::getRequest($request);
        $gamers = $this->gamerService->paginate((int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        $positions = $this->positionService->getPositions();
        $viewModel = (new PaginationViewModel($gamers,GamerViewModel::class));
        return $viewModel->toView('admin.team.create',compact('positions','day'));
    }


    public function store(Request  $request): RedirectResponse
    {
        $day_id  = $request->get('day_id');
        $this->service->createTeam(TeamActionData::createFromRequest($request));
        return redirect()->route('days.show',['day_id' => $day_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.teams.team')]),
        ]);
    }

    public function show(int $id):View
    {
        $gamer = $this->service->edit($id);
        $viewModel = TeamViewModel::fromDataObject($gamer);
        return $viewModel->toView('admin.gamers.show');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(Request$request, int $id): View
    {
        $filters[] = GamerFilter::getRequest($request);
        $gamers = $this->gamerService->paginate((int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        $positions = $this->positionService->getPositions();
        $team = $this->service->edit($id);
        $viewModel = (new PaginationViewModel($gamers,GamerViewModel::class));
        return $viewModel->toView('admin.team.edit',compact('positions','team'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $this->service->updateTeam(TeamActionData::createFromRequest($request), $id);
        return redirect()->route('days.show',['day_id' => $data->day_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.teams.team')]),
        ]);
    }
    public function delete(int $id):RedirectResponse
    {
        $item = $this->service->getTeam($id);
        $action = $this->service->deleteTeam($id);
        if (! $action){
            return redirect()->route('days.show',['day_id' => $item->day_id])->with('res', [
                'method' => 'error',
                'msg' => "Bu jamoa o'yin o'tkazgani bois uni o'chirish mumkin emas !"
            ]);
        }
        return redirect()->route('days.show',['day_id' => $item->day_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.teams.team')]),
        ]);
    }

    public function detachGamer(int $id):RedirectResponse
    {
     $day_id  = $this->service->detachGamer( $id);
        return redirect()->route('days.show',['day_id' => $day_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.teams.team')]),
        ]);
    }
}
