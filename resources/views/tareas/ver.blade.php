<!--
@author: Konh
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Información Sobre Tarea</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success hidden" id="contactSuccess">
					<strong>Completado!</strong> Tu tarea ha sido modificada.
				</div>
				<div class="alert alert-error hidden" id="contactError">
					<strong>Error!</strong> Ocurrió un problema al actualizar tu tarea.
				</div>
			</div><!-- /.col-md-1-->
		</div><!-- /..row-->
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label>Titulo:</label><br>
					<h4>{{$Otarea->titulo}}</h4>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label for="name">Prioridad:</label><br>
						@if ($Otarea->prioridad==1)
		   					<h4>Baja</h4>
						@elseif ($Otarea->prioridad==2)
		   					<h4>Media</h4>
						@elseif ($Otarea->prioridad==3)
		   					<h4>Alta</h4>
						@endif
					</select>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label for="name">Complejidad:</label><br>
						@if ($Otarea->complejidad==1)
		   					<h4>Baja</h4>
						@elseif ($Otarea->complejidad==2)
		   					<h4>Media</h4>
						@elseif ($Otarea->complejidad==3)
		   					<h4>Alta</h4>
						@endif
					</select>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label for="name">Responsable:</label>
						<h4>{{$Otarea->usuarioResponsable->getNombreCompleto()}}</h4>
					</select>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label for="birthdate">Fecha de Entrega:</label>
					<h4>{{$Otarea->fecEst}}</h4>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label for="name">Tipo de Tarea:</label><br>
						@if ($Otarea->tipTar=='Academico-Docente')
		   					<h4>Academico-Docente</h4>
						@elseif ($Otarea->tipTar=='Creacion intelectual')
		   					<h4>Creacion intelectual</h4>
						@elseif ($Otarea->tipTar=='Integracion Social')
		   					<h4>Integracion Social</h4>
						@elseif ($Otarea->tipTar=='Administrativo-Docente')
		   					<h4>Administrativo-Docente</h4>
						@elseif ($Otarea->tipTar=='Produccion')
		   					<h4>Produccion</h4>
						@elseif ($Otarea->tipTar=='Administrativas')
		   					<h4>Administrativas</h4>
						@endif
					</select>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-1 col-sm-4 col-md-4 col-lg-3">
				<div class="form-group has-feedback">
					<label for="firstname">Estado:</label>
					<h4>{{$Otarea->estTar}}</h4>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
		</div><!-- -/.row-->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group has-feedback">
					<label for="firstname">Detalles:</label>
					<p class="lead">{{$Otarea->detalle}}</p>
				</div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
		</div><!-- -/.row-->
		<hr>
		<div class"col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1>Bitácora</h1></div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="table-responsive">
					 <table class="table">
						<tr>
							<td><h5>Detalle:</h5></td>
						</tr>
						@foreach ($bitacora as $bita)
						<tr>
							<td>{{$bita->detalle}}</td>
						</tr>
						@endforeach
					</table> <!-- /.table -->
				</div> <!-- /.table-responsive-->
			<div class="pagination"> {{ $bitacora->links() }} </div>
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="" action="/tareas/bitacora" method="get">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="idTar" value="{{$Otarea->idTar}}">
					<input type="submit" value="Tramitar Tarea" class="btn btn-default">
				</form>

			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
		</div><!-- -/.row-->
	</div><!-- /.container-->

	</section>
@stop
