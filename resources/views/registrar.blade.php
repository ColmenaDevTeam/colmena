<!--
@author: Qsoto
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Registro de Roles de Usuarios</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<p> </p>
				<div class="alert alert-success hidden" id="contactSuccess">
					<strong>Success!</strong> Your message has been sent to us.
				</div>
				<div class="alert alert-error hidden" id="contactError">
					<strong>Error!</strong> There was an error sending your message.
				</div>
			</div><!-- /.col-md-1-->
		</div><!-- /..row-->







		<div class="row">
			<div class="contact-form">
				<form id="contact-form" role="form" method="post">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="ci">Cedula</label>
								<input type="text" class="form-control" id="ci" name="ci" placeholder="23850459">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="username">Nombre de Usuario</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="SBolivar200">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="firstname">Nombres</label>
								<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Simon Jose">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="lastname">Apellidos</label>
								<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Bolivar Palacios">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="name">Tipo de Usuario</label><br>
								<select name="tipUsu" id="tipUsu" class="form-control">
								   <option value="Docente">Docente</option>
								   <option value="Administrativo">Administrativo</option>
								   <option value="Mantenimiento">Mantenimiento</option>
								</select>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="email">Correo Electronico</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="ElLiber@Latam.com">
								<i class="fa fa-envelope form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="password">Contraseña</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="password">Repita la Contraseña</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="phone">Numero de Telefono</label>
								<input type="tel" class="form-control" id="phone" name="phone" placeholder="04265529587">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="birthdate">Fecha de nacimiento</label>
								<input type="date" class="form-control" id="birthdate" name="birthdate">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="name">Sexo</label><br>
								<pre>Masculino <input type="radio" name="gender" value="1"> Femenino <input type="radio" name="gender" value="0"></pre>
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input type="submit" value="Registrar Usuario	" class="btn btn-default">
						</div> <!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
					</div><!-- -/.row-->
				</form>
			</div><!-- /.contact-form -->
		</div><!-- /.row -->






	</div><!-- /.container-->

	</section>
@stop
