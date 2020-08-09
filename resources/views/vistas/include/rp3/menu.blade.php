<div id="sidebar-wrapper" class="gradient-forest-ligth text-white" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo   text-center">
        <a href="index.html">
            <img src="{{ asset('img/logo.png') }}" width="90px" class="" alt="user avatar">
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li @if(strpos (url()->current(), 'problemas')!==false) class="active" @endif>
            <a href="{{url('rp3/problemas')}}?cat=urgente" class="waves-effect">
                <i class="icon-calendar"></i> <span>Solucionar problemas</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'ordenes')!==false) class="active" @endif>
            <a href="{{url('rp3/ordenes')}}?cat=urgente" class="waves-effect">
                <i class="icon-list"></i> <span>Registro de órdenes</span>
            </a>
        </li>
        <li @if(strpos (url()->current(), 'perfil')!==false) class="active" @endif>
            <a href="{{url('rp3/perfil')}}" class="waves-effect">
                <i class="icon-home"></i> <span>Perfil</span>
            </a>
        </li>
    </ul>
</div>
<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top bg-white">
        <ul class="navbar-nav mr-auto align-items-center">
        </ul>
        <ul class="navbar-nav align-items-center right-nav-link">
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="">
                        <img src="{{asset("assets/images/user_icon.png")}}" class="logo-icon m-0 border-info rounded" style="border: solid 2px " alt="logo icon">
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
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
<div class="clearfix"></div>
