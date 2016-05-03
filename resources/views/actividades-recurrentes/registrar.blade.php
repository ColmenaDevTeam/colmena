<!--
@author: Elias D. Peraza @tes1oner
-->
@extends('layouts.main_layout')
@section('contenido')
	<style media="screen">
		.user-col{
			margin-left: 2px;
			margin-right: 2px;
		}
	</style>
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Registro de Actividades Recurrentes</h2>
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
								<strong>Muy Bien!</strong> La actividad recurrente se ha registrado con exito!.
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
					<form id="formActiRecu" role="form" method="post" action="/actividades-recurrentes/registrar" name="formActiRecu">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Titulo</label>
									<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la actividad" required>
									<i class="fa fa-pencil form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Prioridad</label><br>
									<select name="prioridad" id="prioridad" class="form-control" required>
						   				<option value="1">Baja</option>
						   				<option value="2">Media</option>
						   				<option value="3">Alta</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Complejidad</label><br>
									<select name="complejidad" id="complejidad" class="form-control" required>
						   				<option value="1">Baja</option>
						   				<option value="2">Media</option>
						   				<option value="3">Alta</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Tipo de Actividad</label>
									<select name="tipTar" id="" class="form-control">
						   				<option value="Academico-Docente">Academico-Docente</option>
						   				<option value="Creacion intelectual">Creacion intelectual</option>
						   				<option value="Integracion Social">Integracion Social</option>
						   				<option value="Administrativo-Docente">Administrativo-Docente</option>
						   				<option value="Produccion">Produccion</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Tipo de frecuencia</label>
									<select name="tipFrec" id="" class="form-control">
						   				<option value="Semanal">Semanal</option>
						   				<option value="Mensual">Mensual</option>
						   				<option value="Bimensual">Bimensual</option>
						   				<option value="Trimestral">Trimestral</option>
						   				<option value="Semestral">Semestral</option>
									</select>
									<span class="block-info">
										Frecuencia con la que se creará la tarea
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Tiempo de entrega</label>
									<input type="number" min="1" max="365" class="form-control" id="tieEnt" name="tieEnt" placeholder="" required>
									<i class="fa fa-pencil form-control-feedback"></i>
									<span class="block-info">
										Debe expresarse en días
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Fecha de primer lanzamiento</label>
									<input type="date" class="form-control" id="fecIni" name="fecIni" placeholder="" required value="">
									<i class="fa fa-pencil form-control-feedback"></i>
									<span class="block-info">
										Fecha del primer lanzamiento de la actividad recurrente
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="firstname">* Detalles</label>
									<textarea class="form-control" rows="4" id="detalle" name="detalle" placeholder="" required minlength="50" id="detalle"></textarea>
									<i class="fa fa-pencil-square-o form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="list-group">
									<a href="" class="list-group-item active">* Listado de usuarios</a>
									<div class="row">
										@foreach ($usuarios as $Ousuario)
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
												<a href="#{{$Ousuario->idUsu}}" class="list-group-item" onClick="setCheck('{{$Ousuario->idUsu}}')">
													<input type="checkbox" style=""id="{{$Ousuario->idUsu}}" onClick="setCheck('{{$Ousuario->idUsu}}')" name="usuarios[]" value="{{$Ousuario->idUsu}}">
														{{$Ousuario->getNombreCompleto()}}
														<span class="label label-info pull-right" title="Grádo de ocupación de {{$Ousuario->getNombreCompleto()}}">
															{{$Ousuario->getGradoOcupacion()}}
														</span>
													</input>
												</a>
											</div><!-- /.col-xs-12 col-sm-4 col-md-3 col-lg-3-->
										@endforeach

									</div><!-- /.row-->
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	  										<input type="button" value="Seleccionar todos" class="btn btn-default" onClick="setCheck('*')"/>
	  										<input type="button" value="Limpiar" class="btn btn-warning" onClick="setCheck('!')"/>
										</div><!-- /.col-xs-12 col-sm-4 col-md-3 col-lg-3-->
									</div>
								</div><!-- /.list-group-->
							</div>
							<span class="block-info">
								Los campos identificados con * son obligatorios
							</span>
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="button" value="Registrar Actividad Recurrente" class="btn btn-default" onClick="validar()"/>
							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->

						</div><!-- -/.row-->
					</form>
				</div><!-- /.contact-form -->
			</div><!-- /.row -->
		</div><!-- /.container-->
	</section>
<script language="JavaScript" type="text/javascript">
	function validar(){
		//Validar el nombre
		var campoTitulo = document.getElementById("titulo");
		var campoDetalles = document.getElementById('detalle');
		if(campoTitulo.value.length < 10){
			alert("El título debe contener al menos 10 caracteres");
			campoTitulo.focus();
			return false;
		}
		else if(campoTitulo.value.length >= 45){
			alert("El título debe contener menos de 45 caracteres");
			campoTitulo.focus();
			return false;
		}
		if(campoDetalles.value.length < 50){
			alert("El detalle debe contener al menos 50 caracteres");
			campoDetalles.focus();
			return false;
		}
		//Validar que hayan usuarios seleccionados
		var usuarios = document.getElementsByName("usuarios[]");
		var usuariosSeleccionados = false;
		var i;
		for(i = 0; i < usuarios.length; i++){
			//alert("dentro dle for"); Si existe alguna accion "checkeada", digamos qque
			//contiene acciones y rompemos el ciclo
			if(usuarios[i].checked == true){
				usuariosSeleccionados = true;
				break;
			}
		}
		//Si no fue seleccionada ninguna accion
		if(!usuariosSeleccionados){
			alert("Seleccione al menos un usuario de la lista de usuarios");
			return false;
		}
		//validar tiempo de entrega
		var tiempoEntrega = document.getElementById("tieEnt");
		if(tiempoEntrega.value < 1 || tiempoEntrega.value > 365){
			alert('El tiempo de entrega debe ser un número entre 1 y 365 días');
			return false;
		}
		var fechaIni = document.getElementById('fecIni');
		if(!validarFecha(fechaIni.value, 'Fecha de primer lanzamiento')){
			return false;
		}
		document.formActiRecu.submit();
		//return true;
	}
	function setCheck(item){
		if(item == '*'){
			var usuarios = document.getElementsByName('usuarios[]');
			var i;
			for(i = 0; i < usuarios.length; i++)
				usuarios[i].checked = true;
			return true;
		}else if(item == "!"){
			var usuarios = document.getElementsByName('usuarios[]');
			var i;
			for(i = 0; i < usuarios.length; i++)
				usuarios[i].checked = false;
			return true;
		}
	    if(document.getElementById(item).checked)
	        document.getElementById(item).checked = false;
	    else
	        document.getElementById(item).checked = true;
		//setFocus(item);
		item.focus;
	}
</script>
@endsection
