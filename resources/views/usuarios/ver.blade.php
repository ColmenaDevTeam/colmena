<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Ver Perfil</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
		<div class="container">
			<div class="row">
				<div class="ver-form">
					<div class="row">

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="nombres">Nombres</label>
								<br>{{$Ousuario->nombres}}
							</div>
						</div>

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">	
							<div class="form-group has-feedback">
								<label for="apellidos">Apellidos</label>
								<br>{{$Ousuario->apellidos}}
							</div>
						</div>

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="birthdate">Fecha de Nacimiento</label>
								<br>{{$Ousuario->fecNac}}
							</div>
						</div>

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="gender">Sexo</label>
								@if($Ousuario->sexo==TRUE)
									<br>Masculino
								@else
									<br>Femenino
								@endif
							</div>						
						</div>		

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="usertype">Tipo de Usuario</label>
								<br>{{$Ousuario->tipUsu}}
							</div>
						</div>

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="email">Correo Electronico</label>
								<br>{{$Ousuario->email}}
							</div>
						</div>

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="phone">Telefono</label>
								<br>{{$Ousuario->telefono}}
							</div>
						</div>

					</div><!-- /.row -->				
				</div><!-- /.ver-form -->
			</div><!-- /.row -->
		</div><!-- /.container-->
	</section>
@stop