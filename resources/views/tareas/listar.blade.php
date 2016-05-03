<!--
@author: Konh
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
	<div class="container">

		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Gestion de Tareas</h2>
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
						@if(session('estado')=='registrada')
							<div class="alert alert-success alert-dismissable">
								<strong>¡Muy bien!</strong> La tarea ha sido registrada con exito.
							</div>
						@elseif(session('estado')=='modificada')
							<div class="alert alert-info">
								<strong>¡Muy Bien!</strong> La tarea ha sido modificada con exito.
							</div>						
						@elseif(session('estado')=='no-seleccionado')
							<div class="alert alert-info">
								<strong>Información:</strong>
								Usted no ha seleccionado ningún elemento para editar o modificar.
								Presione el boton eliminar o modificar de ún elemento para seleccionarlo
							</div>
						@elseif(session('estado')=='incidencia')
							<div class="alert alert-info">
								<strong>¡Muy Bien!</strong> La incidencia ha sido agregada con exito.
							</div>
						@elseif(session('estado')=='eliminada')
							<div class="alert alert-info">
								<strong>¡Muy Bien!</strong> La tarea ha sido eliminada con exito.
							</div>
						@else
							<div class="alert alert-danger alert-dismissable">
								<strong>¡Error!</strong> Ocurrió un error al registrar. Por favor intentelo de nuevo
							</div>
						@endif
					</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
				</div><!-- /.row-->
			@endif
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table id="thumbs" class="table table-striped">
					<tr>
						<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						<td align="center" class="lead"><strong>Registrar</strong></td>
						<td align="center">
							<button class="btn" id="createTarea" onClick="window.location='/tareas/registrar'">
								<i class="fa fa-plus" value="Registrar"></i>
							</button>
						</td>
					</tr>
					<tr>

						<td align="center"><strong>Titulo</strong></td>
						<td align="center"><strong>Fecha Estimada</strong></td>
						<td align="center"><strong>Detalle</strong></td>
						<td align="center"><strong>Prioridad</strong></td>
						<td align="center"><strong>Complejidad</strong></td>
						<td align="center"><strong>Estado</strong></td>
						<td align="center"><strong>Tipo</strong></td>
						<td align="center"><strong>Responsable</strong></td>
						<td align="center"><strong>Modificar</strong></td>
						<td align="center"><strong>Eliminar</strong></td>

					</tr>
					@foreach($tareas as $Otarea)
						<tr>
							<td align="center">
								<div style='width:120px; overflow:hidden;'>
									<a href="{{$Otarea->getURL()}}"> {{$Otarea->titulo}}</a>
								</div>
							</td>
							<td align="center">{{$Otarea->fecEst}}</td>
							<td align="center"><div style='width:100px; overflow:hidden;'>{{$Otarea->getDetalleAcortado()}}</div></td>
							@if ($Otarea->prioridad==1)
								<td align="center">Baja</td>
							@elseif ($Otarea->prioridad==2)
								<td align="center">Media</td>
							@elseif ($Otarea->prioridad==3)
								<td align="center">Alta</td>
							@endif
							@if ($Otarea->complejidad==1)
								<td align="center">Baja</td>
							@elseif ($Otarea->complejidad==2)
								<td align="center">Media</td>
							@elseif ($Otarea->complejidad==3)
								<td align="center">Alta</td>
							@endif
							<td align="center">{{$Otarea->estTar}}</td>
							<td align="center">{{$Otarea->tipTar}}</td>
							<td align="center">{{$Otarea->usuarioResponsable->getNombreCompleto()}}</td>
							<td align="center">
								<button id="modificarTarea" class="btn" onClick="window.location='/tareas/modificar/{{$Otarea->idTar}}'">
									<i class="fa fa-pencil" value="Modificar"></i>
								</button>
							</td>

							<form id="deleteTar" class="form" name="deleteTar" method="post" action="/tareas/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idTar" value="{{$Otarea->idTar}}" name="idTar">
								<td align="center">
									<button id="deleteTar" class="btn" onClick="confirmarEliminar('borrarTar');">
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
@endsection
