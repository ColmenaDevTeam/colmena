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
					<form id="formTareas" role="form" method="post" action="" name="formTareas">
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
									<label for="name">Responsable</label>
									<select name="responsable" id="responsable" class="form-control">
										@foreach($Ousuarios as $Ousuario)
										<option value={{$Ousuario->idUsu}}>{{$Ousuario->nombres}} {{$Ousuario->apellidos}}</option>
										@endforeach
									</select> 
									<i class="fa fa-user form-control-feedback"></i>
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
									<textarea class="form-control" rows="4" id="details" name="details" placeholder="" required minlength="50" id="details"></textarea>
									<i class="fa fa-pencil-square-o form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="button" value="Registrar Tarea" onClick="validar()"class="btn btn-default">
							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						</div><!-- -/.row-->
					</form>
				</div><!-- /.contact-form -->
			</div><!-- /.row -->
		</div><!-- /.container-->
	</section>
<script language="JavaScript">
	function validar(){
		//Validar el nombre
		var campoTitulo= document.getElementById("title");
		var campoDetalles=document.getElementById('details');
		if(campoTitulo.value.length < 10){
			alert("El título de la tarea debe contener al menos 10 caracteres");
			campoTitulo.focus();
			return false;
		}
		if(campoDetalles.value.length < 50){
			alert("El detalle de la tarea debe contener al menos 50 caracteres");
			campoNombre.focus();
			return false;
		}
		document.formTareas.submit();
		return true;
	}		
</script>
@endsection