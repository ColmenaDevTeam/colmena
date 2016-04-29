<!--
@author: Elias D. Peraza @tes1oner
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Gestion de Actividades Recurrentes</h2>
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
								<strong>¡Muy bien!</strong> La actividad recurrente ha sido ha sido registrada o modificada con exito.
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
								<strong>¡Error!</strong> Ocurrió un error al registrar/modificar. Por favor intentelo de nuevo
							</div>
						@endif
					</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
				</div><!-- /.row-->
			@endif
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table id="thumbs" class="table table-striped">
					<tr>
						<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						<td align="center" class="lead"><strong>Registrar</strong></td>
						<td align="center">
							<button class="btn" id="crearActRec" onClick="window.location='/actividades-recurrentes/registrar'">
								<i class="fa fa-plus" value="Registrar"></i>
							</button>
						</td>
					</tr>
					<tr>
						<td align="center"><strong>Título</strong></td>
						<td align="center"><strong>Fecha de inicio</strong></td>
						<td align="center"><strong>Tiempo de entrega</strong></td>
						<td align="center"><strong>Detalle</strong></td>
						<td align="center"><strong>Prioridad</strong></td>
						<td align="center"><strong>Complejidad</strong></td>
						<td align="center"><strong>Tipo</strong></td>
						<td align="center"><strong>Modificar</strong></td>
						<td align="center"><strong>Eliminar</strong></td>

					</tr>
					@foreach($actiRecus as $OactiRecu)
						<tr>
							<td align="center">
								<div style='width:120px; overflow:hidden;'>
									<a href="{{$OactiRecu->getURL()}}"> {{$OactiRecu->titulo}}</a>
								</div>
							</td>
							<td align="center">{{$OactiRecu->fecIni}}</td>
							<td align="center">{{$OactiRecu->tieEnt}} días</td>
							<td align="center"><div style='width:100px; overflow:hidden;'>{{$OactiRecu->getDetalleAcortado()}}</div></td>
							@if ($OactiRecu->prioridad==1)
								<td align="center">Baja</td>
							@elseif ($OactiRecu->prioridad==2)
								<td align="center">Media</td>
							@elseif ($OactiRecu->prioridad==3)
								<td align="center">Alta</td>
							@endif
							@if ($OactiRecu->complejidad==1)
								<td align="center">Baja</td>
							@elseif ($OactiRecu->complejidad==2)
								<td align="center">Media</td>
							@elseif ($OactiRecu->complejidad==3)
								<td align="center">Alta</td>
							@endif
							<td align="center">{{$OactiRecu->tipTar}}</td>
							<td align="center">
								<button id="modificarActRecu" class="btn" onClick="window.location='/actividades-recurrentes/modificar/{{$OactiRecu->idActRec}}'">
									<i class="fa fa-pencil" value="Modificar"></i>
								</button>
							</td>
							<form id="formBorrarActRec" class="form" name="formBorrarActRec" method="post" action="/actividades-recurrentes/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idActRec" value="{{$OactiRecu->idActRec}}" name="idActRec">
								<td align="center">
									<button id="borrarActRec" class="btn" onClick="confirmarEliminar('formBorrarActRec');">
										<i class="fa fa-times" value="Eliminar"></i>
									</button>
								</td>
							</form>
						</tr>
					@endforeach
				</table>
				</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><hr>
@endsection
