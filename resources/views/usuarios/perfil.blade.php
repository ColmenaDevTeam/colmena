<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Ajustes de Perfil</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
		<div class="container">
		@if(session()->has('estado'))
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p> </p>
					@if(session('estado')=="realizado")
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Muy Bien!</strong> Su perfil se ha actualizado con exito!.
						</div>
					@else
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>¡Error!</strong> Ocurrió un error al actualizar. Por favor intentelo de nuevo
						</div>
					@endif
				</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
			</div><!-- /.row-->
		@endif



			<div class="row">
				<div class="perfil-form">
					<form id="formPerfil" role="form" method="post" action="/usuarios/actualizar-perfil" name="formPerfil">
						<div class="row">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="nombres">Nombres</label>
									<br>{{Auth::user()->nombres}}
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">	
								<div class="form-group has-feedback">
									<label for="apellidos">Apellidos</label>
									<br>{{Auth::user()->apellidos}}
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="birthdate">Fecha de Nacimiento</label>
									<br>{{Auth::user()->fecNac}}
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="gender">Sexo</label>
									@if(Auth::user()->sexo==TRUE)
										<br>Masculino
									@else
										<br>Femenino
									@endif
								</div>						
							</div>							
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="usertype">Tipo de Usuario</label>
									<br>{{Auth::user()->tipUsu}}
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="email">Correo Electronico</label>
									<input required type="email" class="form-control" id="email" name="email" autocomplete="off"
									 value={{Auth::user()->email}}>
									<i class="fa fa-envelope form-control-feedback"></i>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="phone">Telefono</label>
									<input required type="tel" class="form-control" id="phone" name="phone" onKeyPress="return checknum(event)"
									 autocomplete="off" value={{Auth::user()->telefono}}>
									<i class="fa fa-navicon form-control-feedback"></i>
								</div>
							</div>
						</div><!-- /.row -->
						<div class="row">
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<input type="submit" value="Cambiar datos" class="btn btn-default">
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<input type="button" value="Cambiar Contraseña" class="btn btn-default" onclick="muestraCambio()">
							</div>
						</div><!-- /.row -->
					</form>
						
				</div><!-- /.perfil-form -->
			</div><!-- /.row -->







			<div class="row">
				<div class="cambioclave-form" style="display:none;" id="cambioClave">
					<form id="formCambioClave" role="form" method="post" action="/usuarios/actualizar-clave" 
					name="formCambioClave" onsubmit="validar_clave()">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="password">Contraseña Actual</label>
								<input required type="password" class="form-control" id="oldpassword" name="oldpassword">
								<i class="fa fa-navicon form-control-feedback"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="npassword">Nueva Contraseña</label>
								<input required type="password" class="form-control" id="npassword" name="npassword">
								<i class="fa fa-navicon form-control-feedback"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="npassword2">Repita la contraseña</label>
								<input required type="password" class="form-control" id="npassword2" name="npassword2">
								<i class="fa fa-navicon form-control-feedback"></i>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<input type="button" value="Actualizar Contraseña" class="btn btn-default" onclick="validar_clave()">
							</div>
						</div>																	
					</form>
				</div><!-- /.cambioclave-form -->
			</div><!-- /.row -->
		</div><!-- /.container-->
	</section>

	<script language="JavaScript">
	function checknum(evt) {
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		    status = "Este Campo solo acepta Numeros."
		    return false
		}
		status = ""
		return true
	}

	function muestraCambio(){
		document.getElementById('cambioClave').style.display='block';
	}
	function validar_clave() {
		
		var caract_invalido = " ";
		var caract_longitud = 6;
		var cla1 = document.formCambioClave.npassword.value;
		var cla2 = document.formCambioClave.npassword2.value;

		if (document.formCambioClave.npassword.value.length < caract_longitud) {
			alert('Tu clave debe constar de ' + caract_longitud + ' caracteres minimo.');
			return false;
		}
		if (document.formCambioClave.npassword.value.indexOf(caract_invalido) > -1) {
			alert("Las claves no pueden contener espacios");
			return false;
		}
		else {
			if (cla1 != cla2) {
				alert ("Las claves introducidas no son iguales");
				return false;
			}
			else {
				document.formCambioClave.submit();
				return true;
		    }
		}
	}
	</script>
@stop
