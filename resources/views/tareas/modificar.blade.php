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
		<div class="row">
			<div class="col-md-12">
				<p>Ingrese los datos de la nueva tarea:</p>
				<div class="alert alert-success hidden" id="contactSuccess">
					<strong>Completado!</strong> Tu tarea ha sido modificada.
				</div>
				<div class="alert alert-error hidden" id="contactError">
					<strong>Error!</strong> Ocurrió un problema al actualizar tu tarea.
				</div>
			</div><!-- /.col-md-1-->
		</div><!-- /..row-->


				<div class="row">
					<div class="modif-form">
						<form id="formTareas" role="form" method="post" action="/tareas/modificar" name="formTareas">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="idTar" value="{{$Otarea->idTar}}" name="idTar">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Titulo</label>
										<input type="text" class="form-control" id="title" name="title" value="{{$Otarea->titulo}}" required>
										<i class="fa fa-pencil form-control-feedback"></i>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Prioridad</label><br>
										<select name="priority" id="priority" class="form-control" required>
											@if ($Otarea->prioridad==1)
							   					<option selected="selected" value="1">Baja</option>
							   					<option value="2">Media</option>
							   					<option value="3">Alta</option>
											@elseif ($Otarea->prioridad==2)
							   					<option value="1">Baja</option>
							   					<option selected="selected" value="2">Media</option>
							   					<option value="3">Alta</option>
											@elseif ($Otarea->prioridad==3)
							   					<option value="1">Baja</option>
							   					<option value="2">Media</option>
							   					<option selected="selected" value="3">Alta</option>
											@endif
										</select>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Complejidad</label><br>
										<select name="complexity" id="complexity" class="form-control" required>
											@if ($Otarea->complejidad==1)
							   					<option selected="selected" value="1">Baja</option>
							   					<option value="2">Media</option>
							   					<option value="3">Alta</option>
											@elseif ($Otarea->complejidad==2)
							   					<option value="1">Baja</option>
							   					<option selected="selected" value="2">Media</option>
							   					<option value="3">Alta</option>
											@elseif ($Otarea->complejidad==3)
							   					<option value="1">Baja</option>
							   					<option value="2">Media</option>
							   					<option selected="selected" value="3">Alta</option>
											@endif
										</select>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Responsable</label>
										<select name="responsable" id="responsable" class="form-control">
											@foreach($Ousuarios as $Ousuario)
												@if ($Ousuario->idUsu == $Otarea->idUsu)
													<option selected="selected" value={{$Ousuario->idUsu}}>{{$Ousuario->nombres}} {{$Ousuario->apellidos}}</option>
												@else
													<option value="{{$Ousuario->idUsu}}">{{$Ousuario->nombres}} {{$Ousuario->apellidos}}</option>
												@endif
											@endforeach
										</select>
										<i class="fa fa-user form-control-feedback"></i>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="birthdate">Fecha de Entrega</label>
										<input type="date" class="form-control" id="deliverdate" name="deliverdate" value="{{$Otarea->fecEst}}" required>
										<i class="fa fa-calendar form-control-feedback"></i>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Tipo de Tarea</label><br>
										<select name="tipoTarea" id="tipoTarea" class="form-control" value="{{$Otarea->tipTar}}">
											@if ($Otarea->tipTar=='Academico-Docente')
							   					<option selected="selected" value="Academico-Docente">Academico-Docente</option>
							   					<option value="Creacion intelectual">Creacion intelectual</option>
							   					<option value="Integracion Social">Integracion Social</option>
							   					<option value="Administrativo-Docente">Administrativo-Docente</option>
							   					<option value="Produccion">Produccion</option>
							   					<option value="Administrativas">Administrativas</option>
											@elseif ($Otarea->tipTar=='Creacion intelectual')
							   					<option value="Academico-Docente">Academico-Docente</option>
							   					<option selected="selected" value="Creacion intelectual">Creacion intelectual</option>
							   					<option value="Integracion Social">Integracion Social</option>
							   					<option value="Administrativo-Docente">Administrativo-Docente</option>
							   					<option value="Produccion">Produccion</option>
							   					<option value="Administrativas">Administrativas</option>
											@elseif ($Otarea->tipTar=='Integracion Social')
							   					<option value="Academico-Docente">Academico-Docente</option>
							   					<option value="Creacion intelectual">Creacion intelectual</option>
							   					<option selected="selected" value="Integracion Social">Integracion Social</option>
							   					<option value="Administrativo-Docente">Administrativo-Docente</option>
							   					<option value="Produccion">Produccion</option>
							   					<option value="Administrativas">Administrativas</option>
											@elseif ($Otarea->tipTar=='Administrativo-Docente')
							   					<option value="Academico-Docente">Academico-Docente</option>
							   					<option value="Creacion intelectual">Creacion intelectual</option>
							   					<option value="Integracion Social">Integracion Social</option>
							   					<option selected="selected" value="Administrativo-Docente">Administrativo-Docente</option>
							   					<option value="Produccion">Produccion</option>
							   					<option value="Administrativas">Administrativas</option>
											@elseif ($Otarea->tipTar=='Produccion')
							   					<option value="Academico-Docente">Academico-Docente</option>
							   					<option value="Creacion intelectual">Creacion intelectual</option>
							   					<option value="Integracion Social">Integracion Social</option>
							   					<option value="Administrativo-Docente">Administrativo-Docente</option>
							   					<option selected="selected" value="Produccion">Produccion</option>
							   					<option value="Administrativas">Administrativas</option>
											@elseif ($Otarea->tipTar=='Administrativas')
							   					<option value="Academico-Docente">Academico-Docente</option>
							   					<option value="Creacion intelectual">Creacion intelectual</option>
							   					<option value="Integracion Social">Integracion Social</option>
							   					<option value="Administrativo-Docente">Administrativo-Docente</option>
							   					<option value="Produccion">Produccion</option>
							   					<option value="Administrativas">Administrativas</option>
											@endif
										</select>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							</div><!-- -/.row-->
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group has-feedback">
										<label for="firstname">Detalles</label>
										<textarea class="form-control" rows="4" id="details" name="details" required>{{$Otarea->detalle}}</textarea>
										<i class="fa fa-pencil-square-o form-control-feedback"></i>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="button" onClick="validar()" value="Modificar Tarea" class="btn btn-default">
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
