@extends('vistas.layout.dash')

@section('content')
<div class="container-fluid ">
    <div class="row ">
        <div class="col-6">
            <div class="col-6">

                <span class="titulos text-info bold">Areas</span>
                <div class="card">
                    <div class="card-body">
                        <ul class="nav  subm flex-column">
                            @foreach($areas as $area)
                            <li class="nav-item subm-item">
                                <a class="nav-link subm-a p-0" href="#">{{ $area->nombre }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-6">

                <span class="titulos text-info bold">SubAreas</span>
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-6">

            <span class="titulos text-info bold">Problemas</span>
            <div class="card">
                <div class="card-body">
                </div>
            </div>

        </div>
    </div>
</div>
@endsection