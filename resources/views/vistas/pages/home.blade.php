@extends('vistas.layout.dash')
@section('styles')
@endsection
@section('content')
{{--    <div class="panel-header bg-primary-gradient">--}}
{{--        <div class="page-inner py-5">--}}
{{--            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">--}}
{{--                <div>--}}
{{--                    <h2 class="text-white pb-2 fw-bold">Panel de Inicio</h2>--}}
{{--                    <h5 class="text-white op-7 mb-2">Bienvenido a {{setting('site.title')}}</h5>--}}
{{--                </div>--}}
{{--                <div class="ml-md-auto py-2 py-md-0">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}
    <div class="page-inner">
        <?php
        if (starts_with(app('VoyagerAuth')->user()->avatar, 'http://') || starts_with(app('VoyagerAuth')->user()->avatar, 'https://')) {
            $user_avatar = app('VoyagerAuth')->user()->avatar;
        } else {
            $user_avatar = Voyager::image(app('VoyagerAuth')->user()->avatar);
        }
        ?>
    <h4 class="page-title">Bienvenido a {{setting('site.title')}}</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info card-annoucement card-round">
                <div class="card-body text-center">
                    <div class="card-opening">Bienvenido {{ucfirst(explode(" ", Auth::user()->name)[0])}},</div>
                    <div class="card-desc">
                        Cada dia esperamos puedas convertir tu negocio en algo que pueda ayudarte
                        a cumplir tus sueños.
                    </div>
                    <div class="card-detail">
                        <div class="btn btn-light btn-rounded">VOY A TENER UN DIA GENIAL HOY!</div>
                    </div>
                </div>
            </div>
            <div class="card card-round">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="{{$user_avatar}}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info-post ml-2">
                            <p class="username">{{ucfirst((new App\Company())->where('id',Auth::user()->company_id)->value('name_company'))}}</p>
                            <p class="date text-muted">Fecha de ingreso {{(new App\Company())->where('id',Auth::user()->company_id)->value('created_at')}}</p>
                        </div>
                    </div>
                    <div class="separator-solid"></div>
                    <h3 class="card-title">
                        <a href="#">
                            Datos de La empresa
                        </a>
                    </h3>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>RUC:</b>&nbsp;{{(new App\Company())->where('id',Auth::user()->company_id)->value('ruc')}}</li>
                            <li class="list-group-item"><b>DIRECCION:</b>&nbsp;{{(new App\Company())->where('id',Auth::user()->company_id)->value('direccion')}}</li>
                            <li class="list-group-item"><b>TIPO DE PLAN:</b>&nbsp;{{(new App\Company())->tipoplan()}}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="card card-post card-round">
                <img class="card-img-top" src="{{env('APP_URL').'/storage/'.(new App\Company())->where('id',Auth::user()->company_id)->value('logo')}}" alt="Card image cap">
            </div>
        </div>

    </div>
    </div>
@endsection
@section('script')

@endsection
