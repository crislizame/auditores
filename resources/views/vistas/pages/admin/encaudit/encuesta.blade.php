
@extends('vistas.layout.dash')
@section('styles')
    <style>
        .pds-lista-item:hover{
            background: #e3e3e3;
        }
        .lmhorizontal li a{
        }
        .lmhorizontal li a:hover{
            color:white;
        }
        .lmhorizontal li:hover a{
            color:white;
        }
        .lmhorizontal li.active a{
            color:white;
        }
        .lmhorizontal li.active:hover a:hover{
            color:white;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row mt-3">
            <div class="col-12">
                <ul class="nav lmhorizontal">
                    <a href="{{route('encaudit')}}?cat=estado">
                        <li href="#" class="nav-item @if(request('cat') == "estado") active @endif">Estado</li>
                    </a>
                    <a href="{{route('encaudit')}}?cat=activos">
                        <li class="nav-item @if(request('cat') == "activos") active @endif">Activos</li>
                    </a>
                    <a href="{{route('encaudit')}}?cat=procesos">
                        <li class="nav-item @if(request('cat') == "procesos") active @endif">Procesos</li>
                    </a>
                    <a href="{{route('encaudit')}}?cat=perfil">
                        <li class="nav-item @if(request('cat') == "perfil") active @endif">Perfil</li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <ul class="nav thorizontal">
                    @php
                    $thorizontales = (new \App\Encaudit())->where('categoria',request('cat'))->get();
                    $ix2 = -1;
                    @endphp
                    @forelse($thorizontales as $th)
                    <li class="nav-item " style="border: 5px solid #f7f7ff;"><i class="fa fa-plus-square fa-lg p-1 nuevath" data-pos="{{$ix2 = 1 + $ix2}}" dat data-id="{{$th->idencaudit}}" style="cursor: pointer;"></i> {{$th->nombre_estado}}</li>

                        @empty
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="row " > <!-- Start Row principal -->

            <div class="col-lg-12 mt-0">
                <ul class="nav datoshorizontal">
                    <li class="nav-item ">
                        <ul class="nav datosvertical">
    {{--                            <li class="nav-item "><span class="als">Interior del PDS</span><i class="fa fa-trash fa-lg p-1" style="float: right;"></i><i class="fa fa-save fa-lg p-1" style="float: right;"></i></li>--}}
    {{--                            <li class="nav-item al"><span class="als">Interior del PDS</span><i class="fa fa-trash fa-lg p-1" style="float: right;"></i><i class="fa fa-save fa-lg p-1" style="float: right;"></i></li>--}}
    {{--                            <li class="nav-item "><input type="text" value="Percha metalica de 5 servicios" class="als w-75"><i class="fa fa-trash fa-lg p-1" style="float: right;"></i><i class="fa fa-save fa-lg p-1" style="float: right;"></i></li>--}}
    {{--                            <li class="nav-item al"><span class="als">Documentación</span><i class="fa fa-trash fa-lg p-1" style="float: right;"></i><i class="fa fa-save fa-lg p-1" style="float: right;"></i></li>--}}
    {{--                            <li class="nav-item "><span class="als">Otros</span><i class="fa fa-trash fa-lg p-1" style="float: right;"></i><i class="fa fa-save fa-lg p-1" style="float: right;"></i></li>--}}
                        </ul>

                    </li>
                    <li class="nav-item ">
                        <ul class="nav datosvertical">
                        </ul></li>
                    <li class="nav-item ">
                        <ul class="nav datosvertical">
                        </ul></li>
                    <li class="nav-item "><ul class="nav datosvertical">

                        </ul></li>
                    <li class="nav-item ">
                        <ul class="nav datosvertical">
                        </ul></li>
                </ul>
            </div>
        </div>
        <!-- End Submenu -->
        <!--Start Dashboard Content-->



        <!--End Dashboard Content-->
    </div><!-- End Row principal -->
    <div class="modal fade modal-crear" tabindex="-1" role="dialog" aria-labelledby="modal-crear" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="modal-crear">Crear item nuevo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <h5 class="titulos-grandes text-center">Ingrese nombre del item nuevo</h5>
                            <div class="">
                                <input type="text" data-id="" class="form-control" id="nameth">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <button class="btn btn-primary btn-crearn w-100">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

    <script>
        $(document).ready(function () {
            $('.nuevath').click(function () {
                var id = $(this).attr('data-id');
                var pos = $(this).attr('data-pos');
                $('.modal-crear').modal('show');
                $('#nameth').attr('data-id',id);
                $('#nameth').attr('data-pos',pos);
                $('#nameth').val("");
            });
            $('.btn-crearn').click(function () {
                var id = $('#nameth').attr('data-id');
                var pos = $('#nameth').attr('data-pos');

                $.ajax({
                    url: "{{url('api/v1/getencaudit')}}",
                    method: "post",
                    dataType: 'text',
                    data: {tipo:'n',id:id,name:$('#nameth').val()},
                    beforeSend: function () {

                    }
                }).done(function (done) {
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        title:"¡Listo!",
                        continueDelayOnInactiveTab: false,
                        position: 'top center',
                        icon: 'fa fa-check-circle',
                        msg: 'Guardado correcto'
                    });
                });
                cargardatos(id,pos);
                $('.modal-crear').modal('hide');
            });
            @php
                $thorizontales = (new \App\Encaudit())->where('categoria',request('cat'))->get();
                $ix = -1;
            @endphp
            @forelse($thorizontales as $th)
                cargardatos("{{$th->idencaudit}}","{{$ix = 1 + $ix}}");
            @empty
            @endforelse
            function delsave(){
                $('.delvalue').click(function () {
                    var id = $($(this).parent()).attr('data-id');
                    var idli = $(this).attr('data-id');
                    var pos = $(this).attr('data-pos');

                    $.ajax({
                        url: "{{url('api/v1/getencaudit')}}",
                        method: "post",
                        dataType: 'text',
                        data: {tipo:'d',idli:idli},
                        beforeSend: function () {

                        }
                    }).done(function (done) {
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            title:"¡Listo!",
                            continueDelayOnInactiveTab: false,
                            position: 'top center',
                            icon: 'fa fa-check-circle',
                            msg: 'Guardado correcto'
                        });
                        cargardatos(id,pos);
                    });

                });
                $('.savevalue').click(function () {
                    var id = $($(this).parent()).attr('data-id');
                    var idli = $(this).attr('data-id');
                    var pos = $(this).attr('data-pos');
                    var name = $($(this).parent().find('.datanamevalue')).val();
                    $.ajax({
                        url: "{{url('api/v1/getencaudit')}}",
                        method: "post",
                        dataType: 'text',
                        data: {tipo:'s',idli:idli,'name':name,id:id},
                        beforeSend: function () {

                        }
                    }).done(function (done) {
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            title:"¡Listo!",
                            continueDelayOnInactiveTab: false,
                            position: 'top center',
                            icon: 'fa fa-check-circle',
                            msg: 'Guardado correcto'
                        });
                        cargardatos(id,pos);
                    });

                });
            }
            function cargas(){

                $('.datosvertical li').click(function () {
                    var datali = $(this);

                    var datan = $($(this).find('.datanamevalue')).attr('data-name');
                    var datapos = $(this).attr('data-pos');
                    var dataid = $($(this).find('.datanamevalue')).attr('data-id');
                    if(datali.attr('data-editando')==="0") {
                        datali.html("<input data-name=\""+datan+"\" data-id=\""+dataid+"\" type=\"text\" value=\"" + datan + "\" class=\"als w-75 datanamevalue\"><i class=\"fa fa-trash delvalue fa-lg p-1\" data-pos=\"" + datapos + "\" data-id=\"" + dataid + "\" data-name=\""+datan+"\" style=\"float: right;cursor:pointer;\"></i><i data-id=\"" + dataid + "\" data-pos=\"" + datapos + "\" data-name=\""+datan+"\" class=\"fa fa-save savevalue fa-lg p-1\" style=\"float: right;cursor:pointer;\"></i>");
                        delsave();
                    }

                    $('.datosvertical li').attr('data-editando',0);
                    datali.attr('data-editando',1);

                    var data0 = $('.datosvertical li[data-editando="0"]');

                    data0.each(function (i,e) {

                        var ex = $($(e).find('.datanamevalue'));
                       var ulx = "<span class='datanamevalue' data-name=\""+ex.attr('data-name')+"\" data-id=\""+ex.attr('data-id')+"\" >"+ex.attr('data-name')+"</span>";
                        $(e).html(ulx);
                    });
                });
            }
            function cargardatos(id,pos){
        $.ajax({
            url: "{{url('api/v1/getencaudit')}}/"+id,
            method: "get",
            dataType: 'json',
            data: {},
            beforeSend: function () {

            }
        }).done(function (done) {
            //alert(done);
            //var ulx = " <li class=\"nav-item \">\n" +
                //"                        <ul class=\"nav datosvertical\">\n";
               // var temp ="<i class=\"fa fa-trash delvalue fa-lg p-1\" data-id=\""+element.id+"\" style=\"float: right;\"></i><i data-id=\""+element.id+"\" class=\"fa fa-save savevalue fa-lg p-1\" style=\"float: right;\"></i>";
                var ulx = "";
            $.each(done,function( index, element ) {
                var al = index%2;
                var ax = "";
                if(al === 1){
                    ax= "al";
                }
                ulx += "<li data-editando=\"0\" data-id=\""+id+"\" data-pos=\""+pos+"\"  class=\"nav-item pl-4 "+ax+"\"><span class='datanamevalue' data-name=\""+element.nombre+"\" data-id=\""+element.id+"\" >"+element.nombre+"</span></li>";
            });
             // ulx += "</ul>\n" +
             //    "\n" +
             //    "                    </li>";
            $($('.datoshorizontal').find('ul.datosvertical')[pos]).html(ulx);
            cargas();

        });
            }
        });
    </script>
@endsection
