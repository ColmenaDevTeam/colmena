<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Gestion de Usuarios</h2>
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
					@if(session('estado')=='realizado')
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>¡Muy bien!</strong> La accion se ha realizado con exito.
						</div>
					@elseif(session('estado')=='no-seleccionado')
						<div class="alert alert-info">
							<strong>Información:</strong>
							Usted no ha seleccionado ningún elemento para eliminar o modificar.
							Presione el boton eliminar o modificar de ún elemento para seleccionarlo
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
		        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    		<p>
			              <button class="btn" name="reportar" onClick="activarReporte()" type="button">
			                  Reportar
			              </button>
			            </p>
		            </div>


	            <div id="divreporte" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" hidden>
	                <div class="alert alert-info alert-dismissable">
	                    
	                    <button type="button" class="close" data-dismiss="alert">&times;</button>
	                    <strong>¡Atención!</strong> *Seleccione los filtros para realizar su reporte.
                        
                        <form id="formReporteUsu" class="form" name="formReporteUsu" method="get" action="/usuarios/reportar" role="form">
							{!! csrf_field() !!}
							<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="subject">Persona</label>
									<select name="idUsu" id="idUsu" class="form-control" required>
										@foreach($Ousuarios as $Ousuario)
										<option value="{{$Ousuario->idUsu}}" id="usuario" name="usuario">{{$Ousuario->getNombreCompleto()}}</option>
										@endforeach
									</select>
									<input type="checkbox" id="todosusuarios"name="todosusuarios" value="1">
										Todos los usuarios
									</input>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="subject">Fecha Inicio</label>
										<input type="date" class="form-control" id="startdate" name="startdate">
									</div>
								</div>
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="subject">Fecha Fin</label>
										<input type="date" class="form-control" id="enddate" name="enddate">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="subject">Ausencia</label>
										<select name="ausencia" id="ausencia" class="form-control">
											<option hidden="">-</option>
											<option value=1>Permiso</option>
											<option value=0>Reposo</option>
										</select>
										<input type="checkbox" id="todasausencias"name="todasausencias" value="1">
											Todas las ausencias
										</input>
									</div>
								</div>
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="subject">Tareas</label><br>
											<input type="checkbox" id="todastareas"name="todastareas" value="1">
												Todas las tareas
											</input>
									</div>
								</div>
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="subject">Estado de Tarea</label>
										<select name="estadoTarea" id="estadoTarea" class="form-control" selected="">
											<option hidden="">-</option>
											<option value="Asignada">Asignada</option>
											<option value="Revision">Revision</option>
											<option value="Cumplida">Cumplida</option>
											<option value="Cancelada">Cancelada</option>
											<option value="Diferida">Diferida</option>
											<option value="Retrasada">Retrasada</option>
										</select>
										<input type="checkbox" id="todosestados"name="todosestados" value="1">
											Todos los estados
										</input>
									</div>
								</div>
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Tipo de Tarea</label><br>
										<select name="tipoTarea" id="tipoTarea" class="form-control">
											<option hidden="" value="">-</option>
							   				<option value="Academico-Docente">Academico-Docente</option>
							   				<option value="Creacion intelectual">Creacion intelectual</option>
							   				<option value="Integracion Social">Integracion Social</option>
							   				<option value="Administrativo-Docente">Administrativo-Docente</option>
							   				<option value="Produccion">Produccion</option>
							   				<option value="Administrativas">Administrativas</option>
										</select>
										<input type="checkbox" id="todostipos"name="todostipos" value="1">
											Todos los tipos
										</input>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group has-feedback">
									<button type="submit" class="btn">
										Generar
									</button>
								</div>
							</div>
						</form>
	                </div>
	            </div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table id="thumbs" class="table table-striped">
					<tr >
						<td colspan="8"></td>
						<td align="center" ><strong>Registrar</strong></td>
						<td align="center">
							<form class="form" id="registrarUsu" method="get" action="../usuarios/registrar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn" id="createUsu" onclick="submit()">
									<i class="fa fa-plus" value="Registrar"></i>
								</button>
							</form>
						</td>
					</tr>
					<tr>

						<td align="center"><strong>Cedula</strong></td>
						<td align="center"><strong>Nombres</strong></td>
						<td align="center"><strong>Apellidos</strong></td>
						<td align="center"><strong>Fecha de Nacimiento</strong></td>
						<td align="center"><strong>Sexo</strong></td>
						<td align="center"><strong>Tipo de Usuario</strong></td>
						<td align="center"><strong>Correo Electronico</strong></td>
						<td align="center"><strong>Telefono</strong></td>
						<td align="center"><strong>Modificar</strong></td>
						<td align="center"><strong>Eliminar</strong></td>

					</tr>
					@foreach($Ousuarios as $Ousuario)
						<tr>
							<td align="center">{{$Ousuario->cedula}}</td>
							<td align="center">{{$Ousuario->nombres}}</td>
							<td align="center">{{$Ousuario->apellidos}}</td>
							<td align="center">{{$Ousuario->fecNac}}</td>

							@if($Ousuario->sexo==1)
								<td align="center">Masculino</td>
							@else
								<td align="center">Femenino</td>
							@endif

							<td align="center">{{$Ousuario->tipUsu}}</td>
							<td align="center">{{$Ousuario->email}}</td>
							<td align="center">{{$Ousuario->telefono}}</td>

							<form id="updateUsu" class="form" name="updateUsu" method="post" action="/usuarios/modificar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idUsu" value="{{$Ousuario->idUsu}}" name="idUsu">
								<td align="center">
									<button class="btn" id="updateUsu" onclick="submit()">
										<i class="fa fa-pencil" value="Actualizar"></i>
									</button>
								</td>
							</form>

							<form id="deleteUsu" class="form" name="deleteUsu" method="post" action="/usuarios/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idUsu" value="{{$Ousuario->idUsu}}" name="idUsu">
								<td align="center">
									<button class="btn" id="deleteUsu" onclick="submit()">
										<i class="fa fa-times" value="Eliminar"></i>
									</button>
								</td>
							</form>
						</tr>
					@endforeach
				</table>
				</div>
			</div>
		</div>
	</section>

@stop
<script type="text/javascript">
	function activarReporte(){
		document.getElementById("divreporte").hidden = false;
	}
</script>