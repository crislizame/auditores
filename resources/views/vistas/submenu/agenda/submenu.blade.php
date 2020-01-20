<div class="col-md-4 col-lg-2 submdiv pl-0 bg-white pr-0"><!-- Start Submenu -->
    <ul class="nav  subm flex-column">
        <li class="nav-item subm-item">
            <a class="nav-link subm-a p-0 {{$activar[0]}}" href="{{route('agenda/crear-agenda')}}">Generar Agenda</a>
        </li>
        <li class="nav-item subm-item">
            <a class="nav-link subm-a p-0 {{$activar[1]}}" href="{{route('agenda/ver-agenda')}}">Ver Agenda</a>
        </li>
        <li class="nav-item subm-item">
            <a class="nav-link subm-a p-0 {{$activar[2]}}"href="{{route('agenda/reportes')}}?cat=todos">Reporte</a>
        </li>
    </ul>
</div>