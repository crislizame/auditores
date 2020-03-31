<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" class="gradient-forest-ligth text-white" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo   text-center">
        <a href="index.html">
            <img src="https://via.placeholder.com/200x100" width="90px" class="" alt="user avatar">

            {{--            <img src="{{asset("assets/images/user_icon.png")}}" class="logo-icon m-0" alt="logo icon">--}}
            {{--            <h5 class="logo-text text-white">AD<span class="text-info">MIN</span></h5>--}}
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li @if(strpos (url()->current(), 'agenda')!==false) class="active" @endif>
            <a href="{{route('agenda/crear-agenda')}}" class="waves-effect">
                <i class="icon-calendar"></i> <span>Agenda</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'encaudit')!==false) class="active" @endif>
            <a href="{{route('encaudit')}}?cat=estado" class="waves-effect">
                <i class="icon-list"></i> <span>Encuestas de Auditoría</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'comisionista')!==false) class="active" @endif>
            <a href="{{route('comisionista/listas')}}" class="waves-effect">
                <i class="icon-people"></i> <span>Comisionistas</span>
            </a>
        </li>

        <li @if(strpos (url()->current(), 'pds')!==false) class="active" @endif>
            <a href="{{route('pds')}}" class="waves-effect">
                <i class="icon-home"></i> <span>PDS</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'auditores')!==false) class="active" @endif>
            <a href="{{route('auditores')}}" class="waves-effect">
                <i class="icon-user"></i> <span>Auditores</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'proveedores')!==false) class="active" @endif>
            <a href="{{ url('proveedores') }}" class="waves-effect">
                <i class="icon-user"></i> <span>Proveedores</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'indicadores')!==false) class="active" @endif>
            <a href="{{route('indicadores')}}?cat=auditoria" class="waves-effect">
                <i class="icon-pie-chart"></i> <span>Indicadores</span>
            </a>
        </li>
    </ul>
</div>
<!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top bg-white">
        <ul class="navbar-nav mr-auto align-items-center">
            <!--
            <li class="nav-item iconodelmenu">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="fa fa-chevron-left iconodelmenu2 menu-icon" data-id="1"></i>
                </a>
            </li>
        -->
        </ul>
        <ul class="navbar-nav align-items-center right-nav-link">


            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#" aria-expanded="false">
                    {{-- <span class=""><img src="{{ asset('assets/images/a.png') }}" width="70px" class="" alt="user avatar"></span>--}}

                    <span class="">
                                    <img src="{{asset("assets/images/user_icon.png")}}" class="logo-icon m-0 border-info rounded" style="border: solid 2px " alt="logo icon">
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                {{-- <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>--}}
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">{{auth()->user()->name}}</h6>
                                    <p class="user-subtitle">{{auth()->user()->email}}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-item"><a href="{{route("logout")}}"><i class="icon-power mr-2"></i> Cerrar Sesion</a></li>
                </ul>
            </li>
        </ul>

    </nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
