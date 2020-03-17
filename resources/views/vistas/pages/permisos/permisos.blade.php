@extends('vistas.layout.mantenimiento')

@section('content')

<div class="container-fluid ">
    <div class="row ">

        <div class="col-lg-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <ul class="nav lmhorizontal mb-4" style="grid-template-columns: repeat(1, 1fr);">
                                <a href="#">
                                    <li class="nav-item">Clientes</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <form class="search-bar">
                                <input type="text" class="form-control" placeholder="Buscar">
                                <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                            </form>
                        </thead>
                        <tbody>
                            @foreach($pds as $row)
                            <tr>
                                <td>{{ $row->pds_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
@section('script')

@endsection