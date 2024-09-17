<div class="page-header">
    <div class="search-form">
        <form action="#" method="GET">
            <div class="input-group">
                <input class="form-control search-input" name="search" placeholder="Type something..." type="text"/>
                <span class="input-group-btn"><span id="close-search"><i class="ion-ios-close-empty"></i></span></span>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-default">
        <!--================================-->
        <!-- Brand and Logo Start -->
        <!--================================-->
        <div class="navbar-header">
            <div class="navbar-brand">
                <ul class="list-inline">
                    <!-- Mobile Toggle and Logo -->
                    <li class="list-inline-item"><a class="hidden-md hidden-lg" href="javascript:void(0)" id="sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                    <!-- PC Toggle and Logo -->
                    <li class="list-inline-item"><a class="text-muted hidden-xs hidden-sm" href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                    <li class="list-inline-item mg-l-10"><a class="text-muted" href="javascript:void(0)" id="search-button"><i class="ion-ios-search-strong tx-20"></i></a></li>
                </ul>
            </div>
        </div>
        <!--/ Brand and Logo End -->
        <!--================================-->
        <!-- Header Right Start -->
        <!--================================-->
        <div class="header-right pull-right">
            <ul class="list-inline justify-content-end">
                <!--================================-->
                <!-- Languages Dropdown Start -->
                <!--================================-->
{{--                <li class="list-inline-item dropdown hidden-xs hidden-sm">--}}
{{--                    <a class="text-muted" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <img src="{{  asset('assets/images/flags/'.app()->getLocale().'.png') }}" class="mg-b-5 wd-20 img-fluid" alt="">--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu languages-dropdown shadow-2">--}}
{{--                        @foreach(config('app.languages') as $lang)--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('dashboard.changeLang',$lang) }}" data-lang="en"><img src="{{ asset('assets/images/flags/'.$lang.'.png') }}" class="img-fluid wd-20" alt=""> <span>{{ $lang }}</span></a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <!--/ Languages Dropdown End -->
                <!--================================-->
                <!-- Notifications Dropdown Start -->
                <!--================================-->


                <!--/ Messages Dropdown End -->
                <!--================================-->
                <!-- Profile Dropdown Start -->
                <!--================================-->
                <li class="list-inline-item dropdown">
                    <a class="text-muted" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="select-profile">Salom!</span>
{{--                        <img src="assets/images/avatar/avatar.png" class="mg-b-10 img-fluid wd-30" alt="">--}}
                    </a>
                    <ul class="dropdown-menu profile-dropdown shadow-2">
                        <li>
                            <a href="page-profile.html"><i class="icon-user"></i><span>My Profile</span></a>
                        </li>

                        <li>
                            <a href="{{ route('auth.logout') }}"><i class="icon-lock"></i><span>Chiqish</span></a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{ route('auth.logout') }}"><i class="icon-logout"></i><span>Sing Out</span></a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <!-- Profile Dropdown End -->
            </ul>
        </div>
        <!--/ Header Right End -->
    </nav>
</div>
