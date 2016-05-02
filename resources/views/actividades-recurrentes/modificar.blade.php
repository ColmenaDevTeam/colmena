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
					<h2 class="pageTitle">Modificacar Actividad Recurrente</h2>
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
					<form id="formModificarActiRecu" role="form" method="post" action="/actividades-recurrentes/modificar" name="formModificarActiRecu">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="idActRec" id="idActRec" value="{{$OactiRecu->idActRec}}">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Titulo</label>
									<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la actividad" value="{{$OactiRecu->titulo}}"required>
									<i class="fa fa-pencil form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Prioridad</label><br>
									<select name="prioridad" id="prioridad" class="form-control" required>
										@if ($OactiRecu->prioridad==1)
											<option selected="selected" value="1">Baja</option>
											<option value="2">Media</option>
											<option value="3">Alta</option>
										@elseif ($OactiRecu->prioridad==2)
											<option value="1">Baja</option>
											<option selected="selected" value="2">Media</option>
											<option value="3">Alta</option>
										@elseif ($OactiRecu->prioridad==3)
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
									<select name="complejidad" id="complejidad" class="form-control" required>
										@if ($OactiRecu->complejidad==1)
											<option selected="selected" value="1">Baja</option>
											<option value="2">Media</option>
											<option value="3">Alta</option>
										@elseif ($OactiRecu->complejidad==2)
											<option value="1">Baja</option>
											<option selected="selected" value="2">Media</option>
											<option value="3">Alta</option>
										@elseif ($OactiRecu->complejidad==3)
											<option value="1">Baja</option>
											<option value="2">Media</option>
											<option selected="selected" value="3">Alta</option>
										@endif
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Tipo de Actividad</label>
									<select name="tipTar" id="tipTar" class="form-control" value="{{$OactiRecu->tipTar}}">
										@if ($OactiRecu->tipTar=='Academico-Docente')
											<option selected="selected" value="Academico-Docente">Academico-Docente</option>
											<option value="Creacion intelectual">Creacion intelectual</option>
											<option value="Integracion Social">Integracion Social</option>
											<option value="Administrativo-Docente">Administrativo-Docente</option>
											<option value="Produccion">Produccion</option>
											<option value="Administrativas">Administrativas</option>
										@elseif ($OactiRecu->tipTar=='Creacion intelectual')
											<option value="Academico-Docente">Academico-Docente</option>
											<option selected="selected" value="Creacion intelectual">Creacion intelectual</option>
											<option value="Integracion Social">Integracion Social</option>
											<option value="Administrativo-Docente">Administrativo-Docente</option>
											<option value="Produccion">Produccion</option>
											<option value="Administrativas">Administrativas</option>
										@elseif ($OactiRecu->tipTar=='Integracion Social')
											<option value="Academico-Docente">Academico-Docente</option>
											<option value="Creacion intelectual">Creacion intelectual</option>
											<option selected="selected" value="Integracion Social">Integracion Social</option>
											<option value="Administrativo-Docente">Administrativo-Docente</option>
											<option value="Produccion">Produccion</option>
											<option value="Administrativas">Administrativas</option>
										@elseif ($OactiRecu->tipTar=='Administrativo-Docente')
											<option value="Academico-Docente">Academico-Docente</option>
											<option value="Creacion intelectual">Creacion intelectual</option>
											<option value="Integracion Social">Integracion Social</option>
											<option selected="selected" value="Administrativo-Docente">Administrativo-Docente</option>
											<option value="Produccion">Produccion</option>
											<option value="Administrativas">Administrativas</option>
										@elseif ($OactiRecu->tipTar=='Produccion')
											<option value="Academico-Docente">Academico-Docente</option>
											<option value="Creacion intelectual">Creacion intelectual</option>
											<option value="Integracion Social">Integracion Social</option>
											<option value="Administrativo-Docente">Administrativo-Docente</option>
											<option selected="selected" value="Produccion">Produccion</option>
											<option value="Administrativas">Administrativas</option>
										@elseif ($OactiRecu->tipTar=='Administrativas')
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
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Tipo de frecuencia</label>
									<select name="tipFrec" id="tipFrec" class="form-control">
						   				<option value="Semanal" {{($OactiRecu->tipFrec == "Semanal") ? 'selected':''}}>Semanal</option>
						   				<option value="Mensual" {{($OactiRecu->tipFrec == "Mensual") ? 'selected':''}}>Mensual</option>
						   				<option value="Bimensual" {{($OactiRecu->tipFrec == "Bimensual") ? 'selected':''}}>Bimensual</option>
						   				<option value="Trimestral" {{($OactiRecu->tipFrec == "Trimestral") ? 'selected':''}}>Trimestral</option>
						   				<option value="Semestral" {{($OactiRecu->tipFrec == "Semestral") ? 'selected':''}}>Semestral</option>
									</select>
									<span class="block-info">
										Frecuencia con la que se crea la tarea
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Tiempo de entrega</label>
									<input type="number" min="1" max="365" class="form-control" id="tieEnt" name="tieEnt" placeholder="" required value="{{$OactiRecu->tieEnt}}">
									<i class="fa fa-pencil form-control-feedback"></i>
									<span class="block-info">
										Días de fecha estimada de la tarea una vez creada
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<?= $sinLanzar = ($OactiRecu->ultLan == '0000-00-00' || $OactiRecu->ultLan == '' || $OactiRecu->ultLan == null || $OactiRecu->ultLan == NULL)?>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Fecha de nuevo lanzamiento</label>
									<input type="date" class="form-control" {{($sinLanzar) ? '':'readonly="readonly"'}}id="fecIni" name="fecIni" required value="{{$OactiRecu->fecIni}}">
									<i class="fa fa-pencil form-control-feedback"></i>
									<span class="block-info">
										@if($sinLanzar)
											Si no se desea una nueva fecha de primer lanzamiento, se debe dejar la mismas.
										@else
											Si la actividad ya fue lanzada por primera vez, no puede modificarse la fecha de lanzamiento
										@endif
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="firstname">Detalles</label>
									<textarea class="form-control" rows="6" id="detalle" name="detalle" placeholder="" required minlength="50" id="detalle">{{$OactiRecu->detalle}}</textarea>
									<i class="fa fa-pencil-square-o form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="list-group">
									<a href="" class="list-group-item active">Listado de usuarios</a>
									<div class="row">

										@foreach ($usuarios as $Ousuario)
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
												<a href="#{{$Ousuario->idUsu}}" class="list-group-item" onClick="setCheck('{{$Ousuario->idUsu}}')">
													<input type="checkbox" id="{{$Ousuario->idUsu}}" {{($OactiRecu->usuariosAsignados->contains($Ousuario)) ? 'checked="true"' : ''}}onClick="setCheck('{{$Ousuario->idUsu}}')" name="usuarios[]" value="{{$Ousuario->idUsu}}">
														{{$Ousuario->getNombreCompleto()}}
													</input>
													<span class="label label-info pull-right" title="Grádo de ocupación de {{$Ousuario->getNombreCompleto()}}">
														{{$Ousuario->getGradoOcupacion()}}
													</span>
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
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="button" value="Aplicar cambios" class="btn btn-default" onClick="validar()"/>
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
			alert("Esta intentando registrar una actividad recurrente sin ningún usuario seleccionado.\n"+
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
		//validar tiempo de entrega
		var tiempoEntrega = document.getElementById("tieEnt");
		if(tiempoEntrega.value < 1 || tiempoEntrega.value > 365){
			alert('El tiempo de entrega debe ser un número entre 1 y 365 días');
			return false;
		}
		document.formModificarActiRecu.submit();
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
