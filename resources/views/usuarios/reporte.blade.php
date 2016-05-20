<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Reporte SGTH-I</title>
		<!-- css -->
		<style type="text/css">
			
		</style>
	</head>
<body>
	<div id="wrapper">

		@foreach($usuarios as $Ousuario)
			<div class="clearfix">
				<div id="nombre">
					<h1>{{$Ousuario->getNombreCompleto()}}</h1>
					<div class="date"> Rango de fecha: {{$startdate}} - {{$enddate}}</div>
					<p>{{$descripcion}}</p>
				</div>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Nombre completo</th>
						<th>Cedula</th>
						<th>Tipo de Usuario</th>
						<th>Grado de ocupacion</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$Ousuario->getNombreCompleto()}}</td>
						<td>{{$Ousuario->cedula}}</td>
						<td>{{$Ousuario->tipUsu}}</td>
						<td>{{$Ousuario->getGradoOcupacion()}}</td>
					</tr>
				</tbody>
			</table>
			<br>

			@if(!is_null($perRepos[$Ousuario->idUsu]))
				<table class="table">
					<thead>
						<tr>
							<th>Tipo de Ausencia</th>
							<th>Fecha inicio</th>
							<th>Fecha fin</th>
						</tr>
					</thead>
					<tbody>
						@foreach($perRepos[$Ousuario->idUsu] as $OperRepo)
							<tr>
								<td>{{$OperRepo->getNombreAusencia()}}</td>
								<td>{{$OperRepo->fecIni}}</td>
								<td>{{$OperRepo->fecFin}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
			
			@if(!is_null($tareas[$Ousuario->idUsu]))
				<table class="table">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Prioridad</th>
							<th>Complejidad</th>
							<th>Tipo de tarea</th>
							<th>Estado de tarea</th>
							<th>Fecha estimada</th>
							<th>Fecha  de entrega</th>
						</tr>
					</thead>
					<tbody>
					@foreach($tareas[$Ousuario->idUsu] as $Otarea)
						<tr>
							<td>{{$Otarea->titulo}}</td>
							<td>{{$Otarea->prioridad}}</td>
							<td>{{$Otarea->complejidad}}</td>
							<td>{{$Otarea->tipTar}}</td>
							<td>{{$Otarea->estTar}}</td>
							<td>{{$Otarea->fecEst}}</td>
							<td>{{$Otarea->fecEnt}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@endif

		@endforeach
	</div><!-- ./wrapper -->
</body>
</html>