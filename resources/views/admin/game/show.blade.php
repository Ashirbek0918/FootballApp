@extends('dashboard.home')
@section('content')

    <div class="row mt-5">
        <!--================================-->
        <!-- Today Purchases Start -->
        <!--================================-->
        <div class="text-center col-md-12">
            <p class="tx-20 text-black-50 mg-0">{{ __('form.game.game_stat') }}</p>
        </div>
        @dd($item)
        <div class="col-md-6 mt-4">
            <div class="card mg-b-30 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ $item->homeTeam->name }}
                    </h4>
                    <div class="card-header-btn">
                            {{ $item->home_team_score }}
                    </div>
                </div>
                <div class="table-responsive collapse show" id="collapse3">
                    <table class="table card-table">
                        <thead>
                        <tr>
                            <th>Clients</th>
                            <th>Item Details</th>
                            <th>Sold</th>
                            <th>Gain</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user1.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">The Dothraki</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-danger mg-r-5 rounded-circle"></span> 20 remaining</span>
                            </td>
                            <td class="valign-middle tx-right">$3,345</td>
                            <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>33.34%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-success">Progresses</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user2.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Westeros Sneaker</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                            </td>
                            <td class="valign-middle tx-right">$320</td>
                            <td class="valign-middle"><span class="tx-danger"><i class="icon ion-android-arrow-down mg-r-5"></i>21.20%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-danger">Progresses</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user3.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Westeros Sneaker</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                            </td>
                            <td class="valign-middle tx-right">$150</td>
                            <td class="valign-middle"><span class="tx-danger"><i class="icon ion-android-arrow-down mg-r-5"></i>21.20%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-danger">Damages</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user4.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Selonian Hand</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                            </td>
                            <td class="valign-middle tx-right">$1,845</td>
                            <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>23.34%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-success">Progresses</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user5.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Kel Dor Sunglass</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-warning mg-r-5 rounded-circle"></span> 45 remaining</span>
                            </td>
                            <td class="valign-middle tx-right">$1,355</td>
                            <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>28.78%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-success">Progresses</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Today Purchases End -->
        <!--================================-->
        <!-- Top Purchases Start -->
        <!--================================-->
        <div class="col-md-6 mt-4">
            <div class="card mg-b-30 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Top Purchases
                    </h4>
                    <div class="card-header-btn">

                    </div>
                </div>
                <div class="table-responsive collapse show" id="collapse3">
                    <table class="table card-table">
                        <thead>
                        <tr>
                            <th>Clients</th>
                            <th>Item Details</th>
                            <th>Sold</th>
                            <th>Gain</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user1.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">The Dothraki</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-danger mg-r-5 rounded-circle"></span> 20 remaining</span>
                            </td>
                            <td class="valign-middle tx-right">$3,345</td>
                            <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>33.34%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-success">Progresses</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user2.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Westeros Sneaker</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                            </td>
                            <td class="valign-middle tx-right">$320</td>
                            <td class="valign-middle"><span class="tx-danger"><i class="icon ion-android-arrow-down mg-r-5"></i>21.20%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-danger">Progresses</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user3.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Westeros Sneaker</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                            </td>
                            <td class="valign-middle tx-right">$150</td>
                            <td class="valign-middle"><span class="tx-danger"><i class="icon ion-android-arrow-down mg-r-5"></i>21.20%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-danger">Damages</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user4.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Selonian Hand</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                            </td>
                            <td class="valign-middle tx-right">$1,845</td>
                            <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>23.34%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-success">Progresses</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-l-20">
                                <a href="javascript:void(0)"><img class="wd-35 rounded-circle img-fluid" src="assets/images/user/user5.png" alt=""></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="d-block">Kel Dor Sunglass</a>
                                <span class="tx-11 d-block"><span class="square-8 bg-warning mg-r-5 rounded-circle"></span> 45 remaining</span>
                            </td>
                            <td class="valign-middle tx-right">$1,355</td>
                            <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>28.78%</span> last week</td>
                            <td class="valign-middle">
                                <span class="badge-success">Progresses</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Top Purchases End -->
    </div>

@endsection
