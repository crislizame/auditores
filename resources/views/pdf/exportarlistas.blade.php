@if($slectivos == 0)
    Lo sentimos no has selecionado un curso.
    @else
<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Lista</title>
</head>
<body>
<img src="{{asset('assets/img/clogo.png')}}" width="100" style="float:right;display:inline;padding: 0" alt="">
@php
$datoss = (new \App\Models\SubAlectivo())->where(['idslectivos'=>$slectivos])->first();
$subcurson = (new \App\Models\Subcurso())->where('idsubcursos',$datoss->subcursos_id)->value("name");
$cursoid = (new \App\Models\Subcurso())->where('idsubcursos',$datoss->subcursos_id)->value("cursos_id");
$curson = (new \App\Models\Curso())->where('idcursos',$cursoid)->value("name");
$alectivox = (new \App\Models\Alectivo())->where('idalectivos',$datoss->alectivos_id)->value("desde").' - '.(new \App\Models\Alectivo())->where('idalectivos',$datoss->alectivos_id)->value("hasta");
@endphp
    <div class="row">

        <div class="col-sm">
            <center style="margin-left: 70px"><h4>Listas Estudiantes<br>{{$curson}} - {{$subcurson}}</h4></center>
            <div class="col-sm">
                <p><b>Docente:</b> {{(new \App\User())->where('id',$datoss->users_id)->value('nombres')}} {{(new \App\User())->where('id',$datoss->users_id)->value('apellidos')}}</p>
                <p><b>Año Lectivo: </b> {{$alectivox}}</p>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ESTUDIANTES</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php
                $achilds = new \App\Models\AlsChild();
                $childs = $achilds->where('slectivos_id',$slectivos)->join('childs', 'childs.idchilds', '=', 'als_childs.childs_id')->where('childs.active','1')->orderBy('nombres','asc')->get();
                @endphp
                @forelse($childs as $child)
                <tr>
                    <td>{{strtoupper($child->nombres.' '.$child->apellidos)}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>

</div>

    <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
@endif
