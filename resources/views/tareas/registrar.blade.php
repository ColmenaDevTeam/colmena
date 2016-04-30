<!--
@author: Konh
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Registro de Tareas</h2>
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
								<strong>Muy Bien!</strong> La tarea se ha registrado con exito!.
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
					<form id="formTareas" role="form" method="post" action="/tareas/registrar" name="formTareas">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Titulo</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="" required>
									<i class="fa fa-pencil form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Prioridad</label><br>
									<select name="priority" id="priority" class="form-control" required>
						   				<option value="1">Baja</option>
						   				<option value="2">Media</option>
						   				<option value="3">Alta</option>
									</select> 
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Complejidad</label><br>
									<select name="complexity" id="complexity" class="form-control" required>
						   				<option value="1">Baja</option>
						   				<option value="2">Media</option>
						   				<option value="3">Alta</option>
									</select> 
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">													
								<div class="form-group has-feedback">
									<label for="birthdate">Fecha de Entrega</label>
									<input type="date" class="form-control" id="deliverdate" name="deliverdate" required>
									<i class="fa fa-calendar form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Tipo de Tarea</label><br>
									<select name="tipoTarea" id="tipoTarea" class="form-control">
						   				<option value="Academico-Docente">Academico-Docente</option>
						   				<option value="Creacion intelectual">Creacion intelectual</option>
						   				<option value="Integracion Social">Integracion Social</option>
						   				<option value="Administrativo-Docente">Administrativo-Docente</option>
						   				<option value="Produccion">Produccion</option>
						   				<option value="Administrativas">Administrativas</option>
									</select> 
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="firstname">Detalles</label>
									<textarea class="form-control" rows="4" id="details" name="details" placeholder="" required minlength="10" id="details"></textarea>
									<i class="fa fa-pencil-square-o form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
							<div class="list-group">
								<a class="list-group-item active">* Listado de usuarios</a>
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
									</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
									@endforeach
								</div><!-- /.row-->
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<input type="button" value="Seleccionar todos" class="btn btn-default" onClick="setCheck('*')"/>
										<input type="button" value="Limpiar" class="btn btn-warning" onClick="setCheck('!')"/>
									</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
								</div><!-- /.row-->
							</div><!-- /.list-group-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="button" value="Registrar Tarea" onClick="validar()" class="btn btn-default">
							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						</div><!-- /.row-->
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
		if(campoDetalles.value.length < 10){
			alert("El detalle debe contener al menos 10 caracteres");
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
			alert("Esta intentando registrar una tarea sin ningún usuario seleccionado.\n"+
						"Seleccione al menos un usuario de la lista de usuarios");
			//Lanzar dialogo de confirmación para saber si desea registrarlo así
			//y revisar la respuesta en un if
			//if(confirm("Esta intentando registrar una actividad recurrente sin ningún usuario seleccionado."+
			//			"Seleccione al menos un usuario de la lista de usuarios")){
				//Si la respuesta es si, lanzar el metodo submit y retornar true
				//document.formActiRecu.submit();
				//return true;
			//}
			return false;//Si no dijo que sí, retrnar false;
		}
		document.formTareas.submit();
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
		setFocus(item);
	}
</script>
@endsection