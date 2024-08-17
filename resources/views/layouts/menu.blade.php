<div class="page-sidebar">
    <a class="logo-box" href="{{ route('organizations.index') }}">
        <span><img src="{{ asset('assets/images/logo-white.png')}}" alt=""></span>
        <i class="ion-aperture" id="fixed-sidebar-toggle-button"></i>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">

                <li @if(request()->routeIs('organizations.*')) class="active" @endif >
                    <a href="{{ route('organizations.index') }}"><i class="fa fa-bank"></i>
                        <span>{{__('form.dashboard')}}</span><span></span></a>
                </li>
                <li class="@if(request()->routeIs('categories.*','documents.*')) active open @endif">
                    <a href="javascript:void(0);"><i class="fa fa-book"></i>
                        <span>{{__('form.documents.documents')}}</span><i
                            class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu" style="display:block">
                        <li @if(request()->routeIs('categories.*')) class="active" @endif >
                            <a href="{{ route('categories.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.categories.categories')}}</span><span></span></a>
                        </li>
                        <li @if(request()->routeIs('documents.*')) class="active" @endif >
                            <a href="{{ route('documents.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.documents.documents')}}</span><span></span></a>
                        </li>
                    </ul>
                </li>
                <li class="@if(request()->routeIs('topics.*','questions.*', 'exams.*')) active open @endif">
                    <a href="javascript:void(0);"><i class="fa fa-book"></i>
                        <span>{{__('form.quiz.quiz')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu" style="display:block">
                        <li @if(request()->routeIs('topics.*', 'questions.*')) class="active" @endif >
                            <a href="{{ route('topics.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('quiz.topics.topics')}}</span><span></span></a>
                        </li>
                        <li @if(request()->routeIs('exams.*')) class="active" @endif >
                            <a href="{{ route('exams.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.quiz.quiz')}}</span><span></span></a>
                        </li>
                    </ul>
                </li>
                <li class="@if(request()->routeIs('medical.statuses.*','medical.orders.*')) active open @endif">
                    <a href="javascript:void(0);"><i class="fa fa-book"></i>
                        <span>{{__('form.medical.medical')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu" style="display:block">
                        <li @if(request()->routeIs('medical.statuses.*')) class="active" @endif >
                            <a href="{{ route('medical.statuses.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.medical.medical_status')}}</span><span></span></a>
                        </li>
                        <li @if(request()->routeIs('medical.orders.*')) class="active" @endif >
                            <a href="{{ route('medical.orders.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.medical_orders.medical_order')}}</span><span></span></a>
                        </li>
                    </ul>
                </li>
                <li class="@if(request()->routeIs('warehouse.warehousecategory.*','warehouse.*')) active open @endif">
                    <a href="javascript:void(0);"><i class="fa fa-book"></i>
                        <span>{{__('form.warehouse.warehouse')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu" style="display:block">
                        <li @if(request()->routeIs('warehouse.warehousecategory.*')) class="active" @endif >
                            <a href="{{ route('warehouse.warehousecategory.index') }}"><i class="fa fa-product-hunt"></i>
                                <span>{{__('form.warehouse.warehousecategory')}}</span><span></span></a>
                        </li>
                        <li @if(request()->routeIs('warehouse.*')) class="active" @endif >
                            <a href="{{ route('warehouse.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.warehouse.products')}}</span><span></span></a>
                        </li>
                    </ul>
                </li>
                <li class="@if(request()->routeIs('accident.accidenttype.*','accident.accidentrecord.*')) active open @endif">
                    <a href="javascript:void(0);"><i class="fa fa-book"></i>
                        <span>{{__('form.accident.accident')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu" style="display:block">
                        <li @if(request()->routeIs('accident.accidenttype.*')) class="active" @endif >
                            <a href="{{ route('accident.accidenttype.index') }}"><i class="fa fa-book"></i>
                                <span>{{__('form.accident.accidenttype')}}</span><span></span></a>
                        </li>
                        <li @if(request()->routeIs('accident.accidentrecord.*')) class="active" @endif >
                            <a href="{{ route('accident.accidentrecord.index') }}"><i class="fa fa-ambulance"></i>
                                <span>{{__('form.accident.accidentrecord')}}</span><span></span></a>
                        </li>
                    </ul>
                </li>
                <li @if(request()->routeIs('departments.*')) class="active" @endif >
                    <a href="{{ route('departments.index') }}"><i class="fa fa-object-group"></i>
                        <span>{{__('form.departments.departments')}}</span><span></span></a>
                </li>
                <li @if(request()->routeIs('positions.*')) class="active" @endif>
                    <a href="{{ route('positions.index') }}"><i class="fa fa-object-group"></i>
                        <span>{{__('form.positions.positions')}}</span><span></span></a>
                </li>
                <li @if(request()->routeIs('branches.*')) class="active" @endif >
                    <a href="{{ route('branches.index') }}"><i class="fa fa-object-group"></i>
                        <span>{{__('form.branches.branches')}}</span><span></span></a>
                </li>
                <li @if(request()->routeIs('employees.*')) class="active" @endif >
                    <a href="{{ route('employees.index') }}"><i class="fa fa-object-group"></i>
                        <span>{{__('form.employees.employees')}}</span><span></span></a>
                </li>

                <li class="@if(request()->routeIs('roles.*','permissions.*','users.*')) active open @endif">
                    <a href="javascript:void(0);"><i class="fa fa-cogs"></i>
                        <span>{{__('form.settings')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu" style="display:block">
                        <li @if(request()->routeIs('users.*')) class="active" @endif ><a
                                href="{{ route('users.index') }}">{{__('form.users.users')}}</a></li>
                        <li @if(request()->routeIs('roles.*')) class="active" @endif ><a
                                href="{{ route('roles.index') }}">{{__('form.roles.roles')}}</a></li>
                        <li @if(request()->routeIs('permissions.*')) class="active" @endif ><a
                                href="{{ route(('permissions.index')) }}">{{__('form.permissions.permissions')}}</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
        <!--================================-->
        <!-- Sidebar Information Summary -->
        <!--================================-->

    </div>
    <!--================================-->
    <!-- Sidebar Footer Start -->
    <!--================================-->
    <div class="sidebar-footer">
        <a class="pull-left" href="page-profile.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Profile">
            <i class="icon-user"></i></a>
        <a class="pull-left " href="mailbox.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Mailbox">
            <i class="icon-envelope"></i></a>
        <a class="pull-left" href="page-unlock.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Lockscreen">
            <i class="icon-lock"></i></a>
        <a class="pull-left" href="page-singin.html" data-toggle="tooltip" data-placement="top"
           data-original-title="{{__('auth.logOut')}}">
            <i class="icon-power"></i></a>
    </div>
    <!--/ Sidebar Footer End -->
</div>
