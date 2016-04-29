<!--
@author: Elias D. Peraza @tesoner
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Registro de Roles de Usuarios</h2>
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
							<strong>¡Muy bien!</strong> El Rol ha sido registrado con exito.
						</div>
					@else
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>¡Error!</strong> Ocurrió un error al registrar. Por favor intentelo de nuevo
						</div>
					@endif
				</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
			</div><!-- /.row-->
		@endif
		<div class="row">
			<div class="contact-form">
				<form id="contact-form" role="form" method="post" name="formularioRegistroRoles" action="/roles/registrar">
					{!! csrf_field() !!}
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="ci">Nombre o Título del Rol</label>
								<input type="text" class="form-control" id="nombreRol"name="nombreRol" maxlength="20" placeholder="Ej. Docente" required>
								<i class="fa fa-users form-control-feedback"></i>
								<span class="help-block">
									<p class="" style="font-weight: bold;">
										Al registrar un Rol de Usuario, puede seleccionarse un conjunto de
										una o más acciones. Estas acciones representan la permisología que tendrá
										un usuario que posea este Rol.
									</p>
									<p style="font-weight: bold;">
										Si es seleccionada ninguna acción disponible para un rol,
										puede seleccionarlas despues en la sección de modificar Roles.
									</p>
								</span>

							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
							<div class="list-group">
								<a href="" class="list-group-item active">Acciones disponibles</a>
								<div class="row">
									@foreach ($acciones as $oAccion)
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
											<a href="#{{$oAccion->idAcc}}" class="list-group-item" onClick="setCheck('{{$oAccion->nombre}}')">
												<input type="checkbox" id="{{$oAccion->nombre}}" onClick="setCheck('{{$oAccion->nombre}}')" name="acciones[]" value="{{$oAccion->idAcc}}">
													{{$oAccion->getTitulo()}}
												</input>
											</a>
										</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
									@endforeach
								</div><!-- /.row-->
							</div><!-- /.list-group-->
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input type="button" value="Registrar Rol de Usuario" class="btn btn-default" onClick="validar()">
						</div> <!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
					</div><!-- -/.row-->
				</form>
			</div><!-- /.contact-form -->
		</div><!-- /.row -->
	</div><!-- /.container-->
	</section>
	<script type="text/javascript">
		function setCheck(item){
			if(document.getElementById(item).checked)
				document.getElementById(item).checked = false;
			else
				document.getElementById(item).checked = true;
		}
		function validar(){
			//Validar el nombre
			var campoNombre = document.getElementById("nombreRol");
			if(campoNombre.value.length < 4){
				alert("El nombre del Rol debe contener al menos 4 caracteres");
				campoNombre.focus();
				return false;
			}
			//Validar los campos de acciones por rol
			var acciones = document.getElementsByName("acciones[]");
			var contieneAcciones = false;
			var i;
			for(i = 0; i < acciones.length; i++){
				//alert("dentro dle for"); Si existe alguna accion "checkeada", digamos qque
				//contiene acciones y rompemos el ciclo
				if(acciones[i].checked == true){
					contieneAcciones = true;
					break;
				}
			}
			//Si no fue seleccionada ninguna accion
			if(!contieneAcciones){
				//Lanzar dialogo de confirmación para saber si desea registrarlo así
				//y revisar la respuesta en un if
				if(confirm("Esta intentando registrar un Rol sin ninguna permisología,"+
						" ¿Desea continuar? (Puede ser editado posteriormente)")){
					document.formularioRegistroRoles.submit();
					//Si la respuesta es si, lanzar el metodo submit y retornar true
					return true;
				}
					return false;//Si no dijo que sí, retrnar false;
			}
			//Si pasó todas las validaciones, hacer el submit y retornar true
			document.formularioRegistroRoles.submit();
			return true;
		}
	</script>
@stop
