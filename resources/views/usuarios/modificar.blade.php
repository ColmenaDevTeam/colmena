<!--
@author: Qsoto
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Registro de Usuarios</h2>
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
					@if(session('estado')=="realizado")
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Muy Bien!</strong> El Usuario se ha registrado con exito!.
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
					<form id="formUsuarioModificar" role="form" name="formUsuarioModificar" method="post" action="/usuarios/usuario-modificar" onSubmit="validar_clave()">
						<div class="row">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="idUsu" value="{{$Ousuario->idUsu}}" name="idUsu">

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="ci">Cedula</label>
									<input type="text" class="form-control" id="ci" name="ci" placeholder="Ej. 23850459" 
									required onKeyPress="return checknum(event)" autocomplete="off" value="{{$Ousuario->cedula}}">
									<i class="fa fa-user form-control-feedback"></i>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="firstname">Nombres</label>
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Ej. Simon Jose"
									 required onKeyPress="return checkalpha(event)" autocomplete="off" value="{{$Ousuario->nombres}}">
									<i class="fa fa-user form-control-feedback"></i>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="lastname">Apellidos</label>
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ej. Bolivar Palacios"
									 required onKeyPress="return checkalpha(event)" autocomplete="off"  value="{{$Ousuario->apellidos}}">
									<i class="fa fa-user form-control-feedback"></i>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="birthdate">Fecha de nacimiento</label>
									<input type="date" class="form-control" id="birthdate" name="birthdate" required 
									onKeyUp = "this.value=formateafecha(this.value);" value="{{$Ousuario->fecNac}}">
									<i class="fa fa-user form-control-feedback"></i>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Sexo</label><br>
									@if($Ousuario->sexo==True)
										Masculino <input type="radio" name="gender" value="1" checked> Femenino <input type="radio" name="gender" value="0" >
									@else
										Masculino <input type="radio" name="gender" value="1"> Femenino <input type="radio" name="gender" value="0" checked>
									@endif
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="phone">Numero de Telefono</label>
									<input type="tel" class="form-control" id="phone" name="phone" placeholder="Ej. 04265529587"
									 required  onKeyPress="return checknum(event)" autocomplete="off" value="{{$Ousuario->telefono}}">
									<i class="fa fa-user form-control-feedback"></i>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">												
								<div class="form-group has-feedback">
									<label for="email">Correo Electronico</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Ej. Simon@Latam.com" required  value="{{$Ousuario->email}}">
									<i class="fa fa-envelope form-control-feedback"></i>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Tipo de Usuario</label><br>
									<select name="tipUsu" id="tipUsu" class="form-control" required>
										   <option value="Docente">Docente</option>
										   <option value="Administrativo">Administrativo</option>
										   <option value="Mantenimiento">Mantenimiento</option>
									</select> 
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">Roles de Usuario</label><br>
										@foreach($roles as $rol)
											<a href="#" class="list-group-item" onClick="setCheck('{{$rol->nombre}}')">
												<input type="checkbox" id="{{$rol->nombre}}" @if($Ousuario->tieneRol($rol)) checked @endif 
												onClick="setCheck('{{$rol->nombre}}')" name="roles[]" value="{{$rol->idRol}}">
													{{$rol->nombre}}
												</input>
											</a>
										@endforeach
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="button" value="Modificar Usuario" class="btn btn-default" onclick="submit()">
							</div>

						</div><!-- /.row -->
					</form>
				</div><!-- /.contact-form -->
			</div><!-- /.row -->
		</div><!-- /.container-->
	</section>
<script language="JavaScript">
	function checknum(evt) {
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		    status = "Este Campo solo acepta Numeros."
		    return false
		}
		status = ""
		return true
	}
	function checkalpha(evt){
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
		if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) &&(charCode!=32)){
		    status = "Este Campo solo acepta Letras."
		    return false
		}
		status = ""
		return true
	}
	function checkalphanum(evt){
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
		if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 48 || charCode > 57)) {
		    status = "Este Campo solo acepta valores Alfanumericos."
		    return false
		}
		status = ""
		return true			
	}
	function IsNumeric(valor) { 
		var log=valor.length; var sw="S"; 
		for (x=0; x<log; x++){
			v1=valor.substr(x,1); 
			v2 = parseInt(v1); 
		//Compruebo si es un valor numérico 
			if (isNaN(v2)) { sw= "N";} 
		} 
		if (sw=="S") {return true;} 
		else {return false; } 
		} 
	
	var primerslap=false; 
	var segundoslap=false; 
	function formateafecha(fecha) { 
		var long = fecha.length; 
		var dia; 
		var mes; 
		var ano; 
		if ((long>=2) && (primerslap==false)) { 
			dia=fecha.substr(0,2); 
			if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { 
				fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; } 
				else { fecha=""; primerslap=false;} 
		} 
		else{ 
			dia=fecha.substr(0,1); 
			if (IsNumeric(dia)==false){
				fecha="";} 
			if ((long<=2) && (primerslap=true)){
				fecha=fecha.substr(0,1); primerslap=false; 
			} 
		} 
		if ((long>=5) && (segundoslap==false)){
			mes=fecha.substr(3,2); 
			if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")){
				fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true;
			} 
			else{
				fecha=fecha.substr(0,3);; segundoslap=false;
			} 
		} 
		else{
			if ((long<=5) && (segundoslap=true)){
				fecha=fecha.substr(0,4); segundoslap=false;
			}
		} 
		if (long>=7){
			ano=fecha.substr(6,4); 
			if (IsNumeric(ano)==false){
				fecha=fecha.substr(0,6);
			} 
			else{
				if (long==10){
					if ((ano==0) || (ano<1900) || (ano>2100)){
					fecha=fecha.substr(0,6);
					}
				}
			}
		} 
		if (long>=10){ 
			fecha=fecha.substr(0,10); 
			dia=fecha.substr(0,2); 
			mes=fecha.substr(3,2); 
			ano=fecha.substr(6,4); 
			// Año no viciesto y es febrero y el dia es mayor a 28 
			if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ){
				fecha=fecha.substr(0,2)+"/";
			} 
		} 
		return (fecha); 
		}
</script>
@stop