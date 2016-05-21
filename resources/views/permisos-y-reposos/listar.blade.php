<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Gestion de Permisos y Reposos</h2>
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
							<strong>¡Muy bien!</strong> La accion se ha completado con exito.
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
							<strong>¡Error!</strong> Ocurrió un error al accionar. Por favor intentelo de nuevo
						</div>
					@endif
				</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
			</div><!-- /.row-->
		@endif




			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table id="thumbs" class="table table-striped">
					<tr >
						<td colspan="5"></td>
						<td align="center"><strong>Registrar</strong></td>
						<td align="center">
							<form class="form" id="registrarPerRep" method="get" action="../permisos-y-reposos/registrar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn" id="createPerRep" onclick="submit()">
									<i class="fa fa-plus" value="Registrar"></i>
								</button>
							</form>
						</td>
					</tr>
					<tr>

						<td align="center"><strong>Tipo de Ausencia</strong></td>
						<td align="center"><strong>Persona</strong></td>
						<td align="center"><strong>Fecha Inicio</strong></td>
						<td align="center"><strong>Fecha Fin</strong></td>
						<td align="center"><strong>Detalle</strong></td>
						<td align="center"><strong>Modificar</strong></td>
						<td align="center"><strong>Eliminar</strong></td>

					</tr>
					@foreach($OperReps as $OperRep)
						<tr>
							@if($OperRep->perRep==1)
								<td align="center">Permiso</td>
							@else
								<td align="center">Reposo</td>
							@endif

							<td align="center">{{$OperRep->usuarioImplicado->nombres}} {{$OperRep->usuarioImplicado->apellidos}}</td>
							<td align="center">{{$OperRep->fecIni}}</td>
							<td align="center">{{$OperRep->fecFin}}</td>
							<td align="center">{{$OperRep->getDetalleAcortado()}}</td>

							<form id="updatePerRep" class="form" name="updatePerRep" method="get" action="/permisos-y-reposos/modificar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idPerRep" value="{{$OperRep->idPerRep}}" name="idPerRep" id="idPerRep">
								<td align="center">
									<button class="btn" id="updatePerRep" onclick="submit()">
										<i class="fa fa-pencil" value="Actualizar"></i>
									</button>
								</td>
							</form>

							<form id="deletePerRep" class="form" name="deletePerRep" method="get" action="/permisos-y-reposos/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idPerRep" value="{{$OperRep->idPerRep}}" name="idPerRep">
								<td align="center">
									<button class="btn" id="deletePerRep" onclick="confirmarEliminar('deletePerRep')">
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
