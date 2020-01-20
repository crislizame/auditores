<!doctype html>
@if(count($childs) == 0)

    Lo sentimos no has selecionado un curso.
    @else

    <html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>Lista</title>
        <style>
            .page-break {
                page-break-after: always;
            }

        </style>
    </head>
    <body>
    @forelse($childs as $child)
        @php
            $dch = (new \App\Models\Child())->where(['idchilds'=>$child->childs_id])->first();
            $pch = (new \App\Models\PerfilChild())->where(['childs_id'=>$child->childs_id])->first();

        @endphp
    <img src="{{(new \App\Models\Attachment())->where('idattach',$dch->imgchilds)->value('urlimg')}}" width="100" style="float:right;display:inline;padding: 0" alt="">

    <div class="row">

        <div class="col-sm">
            <center style="margin-left: 70px"><h4>Ficha Estudiante<br> {{ucwords(strtolower($dch->nombres))}} {{ucwords(strtolower($dch->apellidos))}}</h4></center>
            <br>
            <p><b>Representante: </b>{{strtoupper((new \App\User())->where('id',$dch->representante)->value('nombres'))}} {{strtoupper((new \App\User())->where('id',$dch->representante)->value('apellidos'))}}</p>
            <hr>
            <span><b>Lugar de Nacimiento: </b>{{$pch->lnacimiento}}</span><br>
            <span><b>Fecha de Nacimiento: </b>{{(new \Carbon\Carbon())->parse($pch->dnacimiento)->toDateString()}}</span><br>
            <span><b>Edad Ingreso: </b>{{$pch->edadingreso}}</span>
            <br>
            <span><b>Direccion: </b>{{$pch->direccion}}</span><br>
            <span><b>Discapacidad: </b>{{$pch->discapacidad == "1" ? "SI" : "NO" }}</span> <br><span><b>Porcentaje de Discapacidad: </b>{{$pch->pdiscapacidad}}</span><br>
            <span><b>Mano Dominante: </b>{{$pch->mano}}</span> <br><span><b>Temor: </b>{{$pch->temor}}</span><br>
            <span><b>Alergias: </b>{{$pch->alergias}}</span> <br><span><b>Estado de Padres: </b>{{$pch->estadopadres}}</span><br>
            <span><b>Vive con: </b>{{$pch->vivechild}}</span> <br><span><b>Cuidados Especiales: </b>{{$pch->cespeciales == '2'? "NO":"SI"}}</span><br>
            <span><b>Tratamientos Especiales: </b>{{$pch->tespeciales}}</span> <br><span><b>Inicio de Tratamiento: </b>{{(new \Carbon\Carbon())->parse($pch->dateespeciales)->toDateString()}}</span><br>
            <span><b>Medicamentos Especiales: </b>{{$pch->medespeciales}}</span> <br><span><b>Dificultades: </b>{{$pch->dificultades}}</span><br>
            <span><b>Observaciones: </b>{{$pch->observaciones}}</span> <br><span><b>Informes: </b>{{$pch->informes}}</span><br>
        </div>

    </div>
        @if(count($childs) !== 1)
    <div class="page-break"></div>
    @endif
    @empty
    @endforelse
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>
@endif
