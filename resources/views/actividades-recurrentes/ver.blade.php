<!--
@author: Elias D. Peraza @tes1oner
-->
@extends('layouts.main_layout')
@section('contenido')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Información Sobre Actividad Recurrente</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="list-group">
					<a href="" class="list-group-item active text-center" onClick="return false;">
						<h3 style="color: white;">{{$OactiRecu->titulo}}
						</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="" class="list-group-item" onClick="return false;">
								<p class="text-center">
									{{$OactiRecu->detalle}}
								</p>
								<hr>
								<?php $P_BMA = ['Baja', 'Media', 'Alta']?>
								<p class="text-justify">
									<label for="" style="">Prioridad: </label>
									<span class="label label-default">{{$P_BMA[$OactiRecu->prioridad-1]}}</span>

									<label for="" style="margin-left: 10pt;">Complejidad: </label>
									<span class="label label-default">{{$P_BMA[$OactiRecu->complejidad-1]}}</span>

									<label for="" style="margin-left: 10pt;">Tipo de tarea: </label>
									<span class="label label-default">{{$OactiRecu->tipTar}}</span>

									<label for="" style="margin-left: 10pt;">Tipo de frecuencia: </label>
									<span class="label label-default">{{$OactiRecu->tipFrec}}</span>

									<label for="" style="margin-left: 10pt;">Tiempo de entrega: </label>
									<span class="label label-default">{{$OactiRecu->tieEnt}} días</span>

									<label for=""style="margin-left: 10pt;">Fecha de inicio: </label>
									<span class="label label-default">{{$OactiRecu->fecIni}}</span>
								</p>
								<hr>
							</a><!-- ./list-group-item -->
							<a href="" class="list-group-item active" onclick="return false;">
								<h4 style="color: white;">Usuarios asignados:</h4>
							</a>
							<div class="row">
								@foreach ($OactiRecu->usuariosAsignados as $oUsuario)
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<a href="{{$oUsuario->getURL()}}" class="list-group-item">
											{{$oUsuario->getNombreCompleto()}}
										</a>
									</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
								@endforeach
							</div><!-- /.row-->
							<hr>
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button type="button" class="btn btn-warning pull-left" style="margin-left: 3pt;" onclick="window.location='/actividades-recurrentes/modificar/{{$OactiRecu->idActRec}}'">
								Modificar <i class="fa fa-pencil"></i>
							</button>
							<form id="borrarActRec" class="form" name="borrarActRec" method="post" action="/actividades-recurrentes/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idActRec" value="{{$OactiRecu->idActRec}}" name="idActRec">
								<button id="borrarActRec" class="btn btn-danger pull-left" style="margin-left: 3pt;" onClick="confirmarEliminar('borrarActRec');">
									Eliminar <i class="fa fa-times" value="Eliminar"></i>
								</button>
							</form>
						</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
					</div><!-- /.row-->
				</div><!-- /.list-group-->
			</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
		</div><!-- /.row -->
	</div><!-- /.container-->
	</section><hr>
@endsection
