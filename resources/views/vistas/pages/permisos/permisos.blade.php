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
                                    <li class="nav-item active">Clientes</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <div class="input-group mb-3">
							  <input type="text" class="form-control" placeholder="Buscar">
							  <div class="input-group-append">
								<button class="btn btn-outline-primary" type="button"><i class="icon-magnifier"></i> Buscar</button>
							  </div>
							</div>
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