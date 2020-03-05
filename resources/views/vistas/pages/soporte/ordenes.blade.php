@extends('vistas.layout.soporte')

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <ul class="nav lmhorizontal mb-4" style="grid-template-columns: repeat(2, 1fr);">
                                <a href="{{url('soporte/ordenes')}}?cat=loteria">
                                    <li class="nav-item @if($cat == 'loteria') active @endif">Loteria</li>
                                </a>
                                <a href="{{url('soporte/ordenes')}}?cat=proveedores">
                                    <li href="#" class="nav-item @if($cat == 'proveedores') active @endif">Proveedores</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    @if($cat == "loteria")
                    <table class="table" id="list_problemas">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>N. de Orden</th>
                                <th>Area</th>
                                <th>Sub Area</th>
                                <th>Problema</th>
                                <th>Cliente</th>
                                <th>Fecha reportado</th>
                                <th>Tiempo para resolver</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody class="TablaProblemas">
                        </tbody>
                    </table>
                    @elseif($cat == "proveedores")
                    <table class="table" id="list_problemas">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>N. de Orden</th>
                                <th>Entidad</th>
                                <th>Sub Area</th>
                                <th>Problema</th>
                                <th>Cliente</th>
                                <th>Fecha reportado</th>
                                <th>Tiempo para resolver</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody class="TablaProblemas">
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-asignar" tabindex="-1" role="dialog" aria-labelledby="modal-asignar" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="col-6">
                    <h4 class="modal-title text-white">Orden de Requerimiento</h4>
                </div>
                <div class="col-4">
                    <h4 class="modal-title text-white">Orden de Trabajo</h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-asignarOrden" method="POST" autocomplate="off" action="{{url('soporte/problemas/orden/asignar')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    <label>No. de Orden</label>
                                </div>
                                <div class="col-8">
                                    <h3 id="req_num_orden"></h3>
                                    <input type="hidden" name="req_num_orden">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>WTC</label>
                                </div>
                                <div class="col-4">
                                    <label>Area</label>
                                </div>
                                <div class="col-4">
                                    <label>Sub Area</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h5 id="req_cliente"></h5>
                                </div>
                                <div class="col-4">
                                    <h5 id="req_area"></h5>
                                </div>
                                <div class="col-4">
                                    <h5 id="req_subarea"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Problema</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 id="req_problema"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>Fecha Inicio</label>
                                </div>
                                <div class="col-4">
                                    <label>Fecha Fin</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h5 id="req_rfinicio"></h5>
                                </div>
                                <div class="col-4">
                                    <h5 id="req_rffin"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Comentario</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 id="req_comentario" style="height: 80px;"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Imágenes</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!--IMAGENES-->
                                    <div class="col-8 offset-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="req_imagenes" class="carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                    </ol>
                                                    <div class="carousel-inner">
                                                    </div>
                                                    <a class="carousel-control-prev" href="#req_imagenes" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#req_imagenes" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--IMAGENES-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Observación de encargado de soporte</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea class="form-control" name="req_observacion" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <label>Proveedor</label>
                                </div>
                                <div class="col-6">
                                    <label>Estado</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <select name="ot_proveedor">
                                        @forelse ((new \App\Proveedor())->get() as $proveedor)
                                        <option value="{{$proveedor->idproveedores}}">{{$proveedor->nombre}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ot_estado" id="r1" value="U" checked="">
                                                <label class="form-check-label" for="r1">
                                                    Urgente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ot_estado" id="r2" value="S">
                                                <label class="form-check-label" for="r2">
                                                    Seguimiento
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Fecha Inicio</label>
                                </div>
                                <div class="col-6">
                                    <label>Fecha Fin</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 id="ot_finicio"></h5>
                                </div>
                                <div class="col-6">
                                    <h5 id="ot_ffin"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Presupuesto</label>
                                </div>
                                <div class="col-6">
                                    <label>Garantía</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="ot_presupuesto" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="ot_garantia" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Encargado</label>
                                </div>
                                <div class="col-6">
                                    <label>Tiempo para resolver</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="ot_encargado" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="time" id="time" name="ot_tiempo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 offset-6">
                                    <label>Extra</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 offset-6">
                                    <input type="text" name="ot_extra" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Comentario</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea class="form-control" name="ot_comentario" rows="4" placeholder="Incluir # de orden de compra"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6" id="cc">
                                    <label>Cotización <i class="fa fa-upload"></i> Cargar imagen</label>
                                    <input type="file" class="form-control-file border" name="ot_ccotizacion">
                                </div>
                                <div class="col-6" id="cv" style="display: none;">
                                    <label>Cotización <i class="fa fa-eye"></i><a href="#" id="cvl"> Ver</a></label>
                                </div>
                                <div class="col-6" id="gc">
                                    <label>Garantía <i class="fa fa-upload"></i> Cargar imagen</label>
                                    <input type="file" class="form-control-file border" name="ot_cgarantia">
                                </div>
                                <div class="col-6" id="gv" style="display: none;">
                                    <label>Garantía <i class="fa fa-eye"></i><a href="#" id="gvl"> Ver</a></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary float-right">Completado</button>
                            <button type="submit" class="btn btn-primary float-right mr-3" id="benviar">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-va" tabindex="-1" role="dialog" aria-labelledby="modal-va" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="vat"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-2">
                <img class="img-responsive" id="vai">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection