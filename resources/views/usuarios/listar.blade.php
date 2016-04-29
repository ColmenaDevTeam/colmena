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
							Usted no ha seleccionado ningún elemento para editar o modificar.
							Presione el boton editar o modificar de ún elemento para seleccionarlo
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
				<table id="thumbs" class="table table-striped">
					<tr >
						<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						<td align="center"><strong>Registrar</strong></td>
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
						<?php
						$mostrar = true;
						if($Ousuario->username == env('APP_DEV_USERNAME') && Auth::user()->username != env('APP_DEV_USERNAME'))
							$mostrar = false;
						?>
						@if($mostrar)
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
						@endif
					@endforeach
				</table>
				</div>
			</div>
		</div>
	</section>

@stop
