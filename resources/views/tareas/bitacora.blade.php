<!--
@author: Konh
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Tramite de Tarea</h2>
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
									<strong>¡Muy bien!</strong> La información se ha agregado a la bitacora.
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
						<form id="contact-form" role="form" method="post" action="/tareas/bitacora">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="idTar" value="{{$Otarea->idTar}}" name="idTar">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="form-group has-feedback">
										<label for="name">Tarea</label>
										<input type="text" class="form-control" id="title" name="title" value="{{$Otarea->titulo}}" disabled>
										<i class="fa fa-pencil form-control-feedback"></i>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								@if(Auth::user()->tieneRolPorNombre('Jefe de Departamento'))
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="name">Actualizar Estado</label><br>
											<select name="status" id="status" class="form-control" required>
								   				@foreach($arrEstados as $estado)
								   					@if($Otarea->estTar!=$estado)
								   						<option value="{{$estado}}">{{$estado}}</option>
								   					@else
								   						<option value="{{$estado}}" selected="selected">{{$estado}}</option>
								   					@endif
								   				@endforeach
											</select>
										</div>
									</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								@elseif(Auth::user()->idUsu==$Otarea->idUsu)
									<input type="hidden" name="status" value="Revision" name="status" id="status">
								@endif
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group has-feedback">
										<label for="firstname">Incidencia</label>
										<textarea class="form-control" rows="4" id="incidencia" name="incidencia"required></textarea>
										<i class="fa fa-pencil-square-o form-control-feedback"></i>
									</div>
								</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<input type="submit" value="Generar" class="btn btn-default">
								</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
							</div><!-- -/.row-->
						</form>
					</div><!-- /.contact-form -->
				</div><!-- /.row -->
	</div><!-- /.container-->
	</section>
@stop
