<!--
@author: Elias Peraza @tesoner
@important: Al realizar obras derivadas, no se debe cambiar nada en este archivo excepto:
* Enlaces de referencia a descargas
* Enlaces de referencia a licencias
* Enlaces de referencia a reporte de fallas
* Enlaces de referencia al repositorio del proyecto
-->
@extends("layouts.main_layout")
@section("contenido")
<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Acerca de Colmena -SGTH</h2>
			</div>
		</div>
	</div>
</section>
<section id="content">
<div class="container">
	<div class="about">
		<div class="row">
			<div class="col-md-12">
				<div class="about-logo">
					<h3>
						SISTEMA AUTOMATIZADO PARA LA GESTIÓN DEL TALENTO HUMANO DEL DEPARTAMENTO DE
						PROGRAMA NACIONAL DE FORMACION EN INFORMATICA EN LA UNIVERSIDAD POLITÉCNICA
						TERRITORIAL ANDRÉS ELOY BLANCO
						<span class="color"></span>
					</h3>
					<p>
						Un sistema de información que se encargua de la gestión del Talento Humano dentro del
						Programa Nacional de Formación en Informática el cual permite la gestión de las tareas asignadas a cada docente de manera
						computarizada, permitiendo mantener un seguimiento a las tareas de forma expedita y
						automatizada, mejorando de manera significativa el rendimiento en la cronología de las
						asignaciones.
					</p>

				</div>
				<a href="https://github.com/ColmenaDevTeam/colmena-sgth/blob/master/documentacion/informe.pdf" target="_blank"class="btn btn-color">Leer más</a>
			</div>
		</div><!-- /.row-->
		<hr>
		<div class="row">
			<div class="col-md-4">
				<!-- Heading and para -->
				<div class="block-heading-two">
					<h3><span>Por qué surge Colmena -SGTH</span></h3>
				</div>
				<p>
					Debido al constante desarrollo del Departamento del <span class="highlight">Programa Nacional de
					Formacion en Informatica (PNF-I)</span> de la Universidad Politécnica Territorial
					Andrés Eloy Blanco, cada vez se torna más complicada
					la gestión de los procesos que se llevan a cabo dentro del departamento, como
					por ejemplo la gerencia de las actividades pendientes por parte de cada comisión
					o profesor,	además del manejo de las eventualidades (conflictos profesorales,
					estudiantiles, académicos, educativos, entre otros).
				</p>
			</div>
			<div class="col-md-4">
				<div class="block-heading-two">
					<h3><span>La solución planteada</span></h3>
				</div>
				<p>
					Desarrollar un sistema que permita la gestión del Talento Humano en el Departamento del
					<span class="highlight">Programa Nacional de Formación en Informática (PNFI)</span> de la Universidad Politécnica Territorial
					Andrés Eloy Blanco. Para optimizar uno de los procesos mas sensibles de dicho departamento, apuntando a un mejoramiento en los
					resultados a obtener, ademas de brindar las herramientas necesarias para hacer un seguimiento claro del personal y de la
					eficiencia.
				</p>
			</div>
			<div class="col-md-4">
				<div class="block-heading-two">
					<h3><span>Acerca del PNF-I</span></h3>
				</div>
				<p>
					<span class="highlight">El Programa Nacional de Formación en Informática (PNFI)</span> permite consolidar la
					formación crítica productiva del profesional en Informática propiciando la formación
					humanista, sociopolítica, comprometido con los cambios económicos, sociales, políticos,
					culturales, tecnológicos del país.
				</p>
			</div>
		</div><!-- /.row -->
		<hr>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<!-- Heading and para -->
				<div class="block-heading-two">
					<h3><span>Registro de Cambios</span></h3>
				</div>
				<!-- Accordion starts -->
				<div class="panel-group" id="accordion-alt3">
					<?php $i = 0;?>
					@if(array_key_exists('changes', $json) && count($json['changes']) > 0)
						@foreach ($json['changes'] as $version)
							@if($i < 4)
								<!-- Panel. Use "panel-XXX" class for different colors. Replace "XXX" with color. -->
								<div class="panel">
									<!-- Panel heading -->
									<div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="{{'#collapse'.$i.'-alt3'}}">
											<i class="fa fa-angle-right"></i> {{$version['header']}}
										  </a>
										</h4>
								 	</div>
								 	<div id="{{'collapse'.$i.'-alt3'}}" class="panel-collapse collapse">
										<!-- Panel body -->
										<div class="panel-body">
											{{$version['description']}}
										</div>
								 	</div>
							 	</div><!-- /.panel-->
								<?php $i++; ?>
							@endif
						@endforeach
					@else
						<p class="lead text-danger">
							No disponible
						</p>
					@endif

				</div><!-- /.panel-group -->
				<!-- Accordion ends -->
			</div><!-- /.col-xs-12 col-sm-4 col-md-4 col-lg-4-->
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<!-- Heading and para -->
				<div class="block-heading-two">
					<h3><span>Más acerca del Proyecto</span></h3>
				</div>
				<p class="">
					<span class="highlight">Colmena -SGTH</span> es un sistema realizado bajo la filosofía del Software Libre, está
					licenciado con licencia Creative Commons Atribution Non Comercial 4.0.
				</p>
				<p>
					El sistema, de entorno web, está desarrollado en PHP, HTML5 y Javascript con la integración de los Frameworks Laravel,
					Bootstrap y JQuery<br>
					Si desea saber más acerca del desarrollo visite el
					<a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth#readme"><span class="highlight">repositorio central del royecto</span></a>
					o pongase en contacto con <a target="_blank" href="https://github.com/orgs/ColmenaDevTeam/people"><span class="highlight">el equípo de desarrollo.</span></a>
				</p>
			</div><!-- /.col-xs-12 col-sm-4 col-md-4 col-lg-4-->

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<!-- Heading and para -->
				<div class="block-heading-two">
					<h3><span>Enlaces de interes</span></h3>
				</div>
				<ul>
					<h3><li><a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth/wiki">Manual de Usuario (Wiki)</a></li></h3>
					<h3><li><a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth">Repositorio del Proyecto</a></li></h3>
					<h3><li><a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth/issues">Reportes fallas o incidencias</a></li></h3>
				</ul>
			</div><!-- /.col-xs-12 col-sm-4 col-md-4 col-lg-4-->
		</div><!-- /.row-->
		<!-- Our Team starts -->
		<!-- Heading -->
		<hr>
		<div class="block-heading-six">
			<h4 class="bg-color">El Equípo</h4>
		</div>
		<br>
		<!-- Our team starts -->
		<div class="team-six">
			<div class="row">
				<div class="col-md-3 col-sm-4">
					<!-- Team Member -->
					<div class="team-member">
						<!-- Image -->
						<img class="img-responsive img-rounded" src="/img/equipo/konh.jpg" alt="">
						<!-- Name -->
						<h4>Hidalgo Victor</h4>
						<a target="_blank"href="https://www.facebook.com/Krunnt">
							<i class="fa fa-facebook-square"></i>
							@konh
						</a><hr>
						<span class="deg">Analista, Programador, Diseñador</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<!-- Team Member -->
					<div class="team-member">
						<!-- Image -->
						<img class="img-responsive img-rounded" src="/img/equipo/tes1oner.jpg" alt="">
						<!-- Name -->
						<h4>Peraza Elias</h4>
						<a target="_blank"href="https://twitter.com/tes1oner">
							<i class="fa fa-twitter"></i>
							@tes1oner
						</a><hr>
						<span class="deg">Analista, Programador, Diseñador</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<!-- Team Member -->
					<div class="team-member">
						<!-- Image -->
						<img class="img-responsive img-rounded" src="/img/equipo/qsoto.jpg" alt="">
						<!-- Name -->
						<h4>Soto Quintin</h4>
						<a target="_blank"href="https://twitter.com/BlueQasv">
							<i class="fa fa-twitter"></i>
							@qsoto
						</a><hr>
						<span class="deg">Analista, Programador, Diseñador</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<!-- Team Member -->
					<div class="team-member">
						<!-- Image -->
						<img class="img-responsive img-rounded" src="/img/equipo/csoto.jpg" alt="">
						<!-- Name -->
						<h4>Soto Carlos</h4>
						<a href="#">
							<i class="fa fa-user-times"></i>
							N/D
						</a><hr>
						<span class="deg">Tutor Comunitario</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<!-- Team Member -->
					<div class="team-member">
						<!-- Image -->
						<!--<img class="img-responsive" src="img/team1.jpg" alt="">-->
						<!-- Name -->
						<h4>Rodríguez Noretsys</h4>
						<span class="deg">Tutora Academica</span>
					</div>
				</div>
			</div>
		</div>
		<!-- Our team ends -->
	</div><!-- /.about -->
</div><!-- /.container -->
</section>
@endsection
