<!--
@author: tes
-->
@extends('layouts.main_layout')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Restablecer clave</div>

                <div class="panel-body">
                    <form class="form-horizontal" name="formNuevaClave" id="formNuevaClave"role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Ingrese su email</label>

                            <div class="col-md-6">
                                <input type="email" required class="form-control" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nueva clave</label>

                            <div class="col-md-6">
                                <input type="password" required class="form-control" id="password" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirmar clave</label>
                            <div class="col-md-6">
                                <input type="password" required class="form-control" id="password_confirmation"name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-primary" type="button" onClick="validar()">
                                    <i class="fa fa-btn fa-refresh"></i> Restablecer clave
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validar(){
		//Hacer las validaciones aquí y dependiendo si todo está bien se lanza el submit o no
		//y se retorna true o false
        var datosCorrectos = true;
        if(document.getElementById('password_confirmation').value != document.getElementById('password').value){
            alert('Las claves no coinciden');
            datosCorrectos = false;
            return false;
        }
        if(document.getElementById('password').length < 6){
            alert('Su nueva clave debe contener al menos 6 caracteres');
            datosCorrectos = false;
            return false;
        }
        if(datosCorrectos){
            document.formNuevaClave.submit();
    		return true;
        }
        return false;
	}

</script>
@endsection
