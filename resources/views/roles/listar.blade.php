<!--
@author: Elias D. Peraza @tesoner
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Gestion de Roles de Usuario</h2>
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
							<strong>¡Muy bien!</strong> El Rol ha sido registrado o modificado con exito.
						</div>
					@elseif(session('estado')=='no-seleccionado')
						<div class="alert alert-info">
							<strong>Información:</strong>
							Usted no ha seleccionado ningún elemento para eliminar o modificar.
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
					<tr>
						<td></td><td></td><td></td><td></td><td></td>
						<td align="center"><strong>Registrar</strong></td>
						<td align="center">
							<button class="btn" id="createRol" onClick="window.location='/roles/registrar'">
								<i class="fa fa-plus" value="Registrar"></i>
							</button>
						</td>
					</tr>
					<tr>

						<td align="center"><strong>Rol de Usuario</strong></td>
						<td align="center" colspan="4"><strong>Permisos</strong></td>

					</tr>
					@foreach($roles as $Orol)
						<tr>
							<td align="center">{{$Orol->nombre}}</td>
							<td align="center" colspan="4">
								@foreach ($Orol->acciones as $Oaccion)
									{{$Oaccion->getTitulo()}},
								@endforeach
							</td>
								<td align="center">
									<button class="btn" id="modificarRol" onClick="window.location='/roles/modificar/{{$Orol->idRol}}'">
										<i class="fa fa-pencil" value="Actualizar"></i>
									</button>
								</td>

							<form id="formEliminarRol" class="form" name="formEliminarRol" method="post" action="/roles/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idRol" value="{{$Orol->idRol}}">
								<td align="center">
									<button class="btn" id="deleteRol" onclick="confirmarEliminar('formEliminarRol')">
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
