@extends('layouts.app')

@section('content')
    <div class="card-title text-uppercase text-center py-3 text-dark">Ingreso al Sistema</div>
    <form  method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="position-relative has-icon-right">
                <label for="email" class="sr-only">Correo</label>
                <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control form-control-rounded" placeholder="Correo">
                <div class="form-control-position">
                    <i class="icon-user"></i>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="position-relative has-icon-right">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="form-control form-control-rounded" placeholder="Contraseña">
                <div class="form-control-position">
                    <i class="icon-lock"></i>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Ingresar</button>
    </form>


@endsection
