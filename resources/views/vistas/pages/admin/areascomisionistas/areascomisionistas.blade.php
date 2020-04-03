@extends('vistas.layout.dash')

@section('content')
<div class="container-fluid ">
    <div class="row">
        <div class="col-6 row">
            <div class="col-6">
                <span class="titulos text-info bold">Areas</span>
                <div class="card">
                    <div class="card-body">
                        <ul class="nav subm flex-column" data-toggle="buttons">
                            @foreach($areas as $area)
                            <li class="nav-item subm-item" data-toggle="button" aria-pressed="false">
                                <a class="nav-link subm-a p-5" href="#" onclick="buscarSubAreas(this)" data="{{ $area->idareas }}">{{ $area->nombre }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <span class="titulos text-info bold">SubAreas</span>
                <div class="card">
                    <div class="card-body" id="subareas">
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
    function buscarSubAreas(item) {
        @php
        $control = 1;
        @endphp
        @foreach($areas as $area)
        $('#l').removeClass('active');
        @endforeach
        $(item).addClass('active');

        $.ajax({
            url: "{{ url('comisionista/subareas') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': $(item).attr('data')
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Subareas",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            $('#subareas').html(done);
            $('#ls-1').click();
        });
    }
</script>
@endsection
