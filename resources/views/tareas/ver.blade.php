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
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="list-group">
					<a href="" class="list-group-item active text-center" onClick="return false;">
						<h3 style="color: white;">{{$Otarea->titulo}}
						</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="" class="list-group-item" onClick="return false;">
								<p class="text-center">
									{{$Otarea->detalle}}
								</p>
								<hr>
								<?php $P_BMA = ['Baja', 'Media', 'Alta']?>
								<p class="text-justify">
									<label for="" style="">Prioridad: </label>
									<span class="label label-default">{{$P_BMA[$Otarea->prioridad-1]}}</span>

									<label for="" style="margin-left: 10pt;">Complejidad: </label>
									<span class="label label-default">{{$P_BMA[$Otarea->complejidad-1]}}</span>

									<label for="" style="margin-left: 10pt;">Tipo de tarea: </label>
									<span class="label label-default">{{$Otarea->tipTar}}</span>

									<label for="" style="margin-left: 10pt;">Fecha de entrega: </label>
									<span class="label label-default">{{$Otarea->fecEst}}</span>
								</p>
								<hr>
							</a><!-- ./list-group-item -->
							<a href="{{$Otarea->usuarioresponsable->getURL()}}" class="list-group-item active text-center">
								<h4 style="color: white;">{{$Otarea->usuarioresponsable->getNombreCompleto()}}</h4>
							</a>
							<hr>
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button type="button" class="btn btn-warning pull-left" style="margin-left: 3pt;" onclick="window.location='/tareas/modificar/{{$Otarea->idTar}}'">
								Modificar <i class="fa fa-pencil"></i>
							</button>
							<form id="borrarTarea" class="form" name="borrarTarea" method="post" action="/tareas/eliminar">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="idTar" value="{{$Otarea->idTar}}" name="idTar">
								<button id="borrarTar" class="btn btn-danger pull-left" style="margin-left: 3pt;" onClick="confirmarEliminar('borrarTar');">
									Eliminar <i class="fa fa-times" value="Eliminar"></i>
								</button>
							</form>
						</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<hr>
							<a href="" class="list-group-item active text-center" onClick="return false;">
								<h3 style="color: white;">Bitácora
								</h3>
							</a>
								<div class="table-responsive">
					 				<a href="" class="list-group-item" onClick="return false;">
					 					<p class="text-center">
						 					<hr>	
											@foreach ($bitacora as $bita)
												<span class="label label-default">{{$bita->fecInc}}</span> Por: <span class="label label-default">{{$bita->nombreUsu}}</span> Estado: <span class="label label-default">{{$bita->estado}}</span> <br>{{$bita->detalle}}
												<hr>
											@endforeach
										</p>
									</a>
								</div> <!-- /.table-responsive-->
								<div class="pagination"> {{ $bitacora->links() }} </div>
								<form class="" action="/tareas/bitacora" method="get">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="idTar" value="{{$Otarea->idTar}}">
									<input type="submit" value="Tramitar Tarea" class="btn btn-default">
								</form>
							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						</div><!-- -/.row-->
					</div><!-- -/.row-->
				</div><!-- -/.list-group-->
			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
		</div><!-- -/.row-->
	</div><!-- /.container-->

	</section>
@stop