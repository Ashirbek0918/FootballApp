@extends('dashboard.home')
@section('content')

    <div class="page-inner">
        <!--================================-->
        <!-- Main Wrapper Start -->
        <!--================================-->
        <div id="main-wrapper">
            <!--================================-->
            <!-- Breadcrumb Start -->
            <!--================================-->
            <div class="pageheader pd-y-25">
                <div class="pd-t-5 pd-b-5">
                    <h1 class="pd-0 mg-0 tx-20 text-overflow">User Profile</h1>
                </div>
            </div>
            <!--/ Breadcrumb End -->
            <!--================================-->
            <!-- User Profile Start -->
            <!--================================-->
            <div class="row  mg-b-25">
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body pd-b-0">
                            <div class="mt-4 tx-center">
                                @if(!empty($item->file) && isset($item->file['path']))
                                    <img src="{{ Storage::url($item->file['path']) }}" class="rounded-circle" width="150" alt="{{ $item->name }}">
                                @else
                                    <img src="{{ asset('assets/images/avatar/avatar.png') }}" class="rounded-circle" width="150" alt="Default Avatar">
                                @endif

                                <h4 class="card-title mt-2">{{ $item->name.' '.$item->surname }}</h4>
                                <h6 class="card-subtitle tx-gray-500 tx-14 pd-y-10">{{ $item->position->name }}</h6>
                                <p class="tx-gray-500">ID: {{ $item->id }}</p>
                                <div class="row no-gutters text-center justify-content-md-center pd-20">
                                    <div class="col-3"><a href="javascript:void(0)" class="link"><i class="icon-game-controller"></i> <span class="tx-12">854</span></a></div>
                                    <div class="col-3"><a href="javascript:void(0)" class="link"><i class="ion-ios-football"></i> <span class="tx-12">557</span></a></div>
                                    <div class="col-3"><a href="javascript:void(0)" class="link"><i class="fa fa-"></i> <span class="tx-12">241</span></a></div>
                                    <div class="col-3"><a href="javascript:void(0)" class="link"><i class="icon-like"></i> <span class="tx-12">741</span></a></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-header-title">
                                    About Me
                                </h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-responsive-sm">
                                    <tbody><tr>
                                        <td><strong>{{ __('validation.attributes.username') }}:</strong></td>
                                        <td>{{ $item->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('validation.attributes.surname') }}:</strong></td>
                                        <td>{{ $item->surname }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('form.positions.position') }}:</strong></td>
                                        <td>{{ $item->position->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('validation.attributes.age') }}:</strong></td>
                                        <td>{{ $item->age }} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('validation.attributes.weight') }}:</strong></td>
                                        <td>{{ $item->weight }}kg</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('validation.attributes.height') }}:</strong></td>
                                        <td>{{ $item->height }} cm</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Qo'shilgan vaqti:</strong></td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>

                                    </tbody></table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab" href="#my-profile" role="tab" aria-controls="my-profile" aria-selected="false">Profile</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#my-contact" role="tab" aria-controls="my-contact" aria-selected="false">Contact</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="my-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-12">Full Name</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Johnathan Doe" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" placeholder="johnathan@admin.com" class="form-control" name="example-email" id="example-email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input type="password" value="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Password again</label>
                                            <div class="col-md-12">
                                                <input type="password" value="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone No</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="123 456 7890" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">About</label>
                                            <div class="col-md-12">
                                                <textarea rows="5" class="form-control form-control-line"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-12">Select Country</label>
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-line">
                                                    <option>Uk</option>
                                                    <option>Germany</option>
                                                    <option>Italy</option>
                                                    <option>Natherland</option>
                                                    <option>Australia</option>
                                                    <option>India</option>
                                                    <option>Usa</option>
                                                    <option>Canada</option>
                                                    <option>France</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-info">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="my-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Name: <span class="tx-danger">*</span></label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" placeholder="Enter Your Name">
                                            </div>
                                        </div>
                                        <div class="row mg-t-20">
                                            <label class="col-sm-4 form-control-label">Email: <span class="tx-danger">*</span></label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" placeholder="Enter Your Email">
                                            </div>
                                        </div>
                                        <div class="row mg-t-20">
                                            <label class="col-sm-4 form-control-label">Messates: <span class="tx-danger">*</span></label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <textarea rows="5" class="form-control" placeholder="Enter Your Messages"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mg-t-20">
                                            <div class="col-sm-12">
                                                <button class="btn btn-info btn-block">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Profile End -->
        </div>
        <!--/ Main Wrapper End -->
    </div>

@endsection
