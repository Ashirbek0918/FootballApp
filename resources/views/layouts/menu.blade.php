<div class="page-sidebar">
    <a class="logo-box" href="">
        <span><img src="{{ asset('assets/images/logo-white.png')}}" alt=""></span>
        <i class="ion-aperture" id="fixed-sidebar-toggle-button"></i>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">

                <li @if(request()->routeIs('positions.*')) class="active" @endif >
                    <a href="{{ route('positions.index') }}"><i class="fa fa-bank"></i>
                        <span>{{__('form.positions.positions')}}</span><span></span></a>
                </li>
                <li @if(request()->routeIs('gamers.*')) class="active" @endif >
                    <a href="{{ route('gamers.index') }}"><i class="fa fa-group"></i>
                        <span>{{__('form.gamers.gamers')}}</span><span></span></a>
                </li>
                <li @if(request()->routeIs('days.*')) class="active" @endif >
                    <a href="{{ route('days.index') }}"><i class="fa fa-group"></i>
                        <span>{{__('form.days.match_days')}}</span><span></span></a>
                </li>
                <li @if(request()->routeIs('games.*')) class="active" @endif >
                    <a href="{{ route('games.index') }}"><i class="fa fa-group"></i>
                        <span>{{__('form.game.games')}}</span><span></span></a>
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
