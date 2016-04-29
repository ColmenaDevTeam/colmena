<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('contenido')
<section id="inner-headline">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="pageTitle">Modificar Permisos y Reposos</h2>
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
				<form id="updatePerRep" role="form" method="post" action="../permisos-y-reposos/modificar">
					<div class="row">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="idPerRep" value="{{$OperRep->idPerRep}}" name="idPerRep">
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="name">Tipo de Ausencia</label>
								<select name="perRep" id="perRep" class="form-control" required>
									@if($OperRep->perRep==TRUE)
								    	<option value="1" selected>Permiso</option>
								    	<option value="0">Reposo</option>
								    @else
								    	<option value="1">Permiso</option>
								    	<option value="0" selected>Reposo</option>
								    @endif
								</select> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="subject">Persona</label>
								<select name="idUsu" id="idUsu" class="form-control" required>
									@foreach($usuarios as $usuario)
										@if($usuario->idUsu==$OperRep->idUsu)
											<option selected value={{$usuario->idUsu}}>{{$usuario->nombres}} {{$usuario->apellidos}}</option>
										@else
											<option value={{$usuario->idUsu}}>{{$usuario->nombres}} {{$usuario->apellidos}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="startdate">Fecha Inicio</label>
								<input type="date" class="form-control" id="startdate" name="startdate" required min={{date('dmY')}} onKeyUp = "this.value=formateafecha(this.value);" value="{{$OperRep->fecIni}}">
								<i class="fa fa-navicon form-control-feedback"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="enddate">Fecha Fin</label>
								<input type="date" class="form-control" id="enddate" name="enddate" required min={{date('dmY')}} onKeyUp = "this.value=formateafecha(this.value);" value="{{$OperRep->fecFin}}">
								<i class="fa fa-navicon form-control-feedback"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="form-group has-feedback">
								<label for="details">Detalles</label>
								<textarea class="form-control" rows="6" id="details" name="details" style="resize:none" required>{{$OperRep->detalle}}</textarea>
								<i class="fa fa-pencil form-control-feedback"></i>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="Modificar" class="btn btn-default">
							</div>
						</div><!-- /.row -->
					</div><!-- /.row -->
				</form>
			</div><!-- /.contact-form -->
		</div><!-- /.row -->
	</div><!-- /.container-->
</section>
<script type="text/javascript">
	
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
