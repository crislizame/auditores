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
                        @php
                        $control=1;
                        @endphp
                            @foreach($areas as $area)
                            <li class="nav-item subm-item">
                                <a id="l-{{ $control++ }}" class="nav-link subm-a p-5" href="#" onclick="buscarSubAreas(this)">{{ $area->nombre }}</a>
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
<script>
    function buscarSubAreas(item){
        @php
        $control=1;
        @endphp
        @foreach($areas as $area)
        $('#l-{{ $control++ }}').removeClass('active');
        @endforeach
        $(item).addClass('active');
    }
</script>
@endsection