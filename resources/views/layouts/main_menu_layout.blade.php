<!--
  @author: Elias P. @tesoner
-->
<!-- start header -->
<header>
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            @if (Auth::check())
                <?php
                $notificaciones = [];
                $tareas = Auth::user()->tareas;
                foreach ($tareas as $Otarea){
                    if(!$Otarea->visto)
                        $notificaciones[] = $Otarea;
                }
                ?>
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{Auth::user()->getNombreCompleto()}}
                        @if(count($notificaciones) > 0)
                            <span class="badge badge-menu-bar"> <i class="fa fa-flag"></i> {{count($notificaciones)}}</span>
                        @endif

                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                            <li><a href="/usuarios/perfil"> <i class="fa fa-btn fa-user"> </i> Mi Perfil </a> </li>
                            <li class="divider"></li>
                            @foreach ($notificaciones as $notificacion)
                                <li>
                                    <a class="" href="{{$notificacion->getUrl()}}">
                                        <i class="fa fa-btn fa-flag"> </i>
                                        {{(strlen($notificacion->titulo) <= 23) ? '  '.$notificacion->titulo : '  '.substr($notificacion->titulo,0,20).'...'}}
                                    </a>
                                </li>
                            @endforeach
                            @if(count($notificaciones) > 0)
                                <li class="divider"></li>
                            @endif

                            <li><a href="{{ url('logout') }}"><i class="fa fa-btn fa-sign-out"></i> Cerrar sesión </a></li>
                    </ul>
                </li>
                <li><a href="/usuarios/perfil"></a></li>

            @else
                <li><a href="{{url('login')}}"><i class="fa fa-btn fa-sign-in"> </i> Ingresar</a></li>
                <li>
                    <a href="/acerca-de" class="pull-right">
                        <i class="fa fa-btn fa-info-circle"> </i> Acerca de
                    </a>
                </li>

            @endif
        </ul>
        <a class="navbar-brand" href="/acerca-de"><img src="/img/logo/logo-rectangle-inverse.png" alt="logo"/></a>
        @if (Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <!-- AQUI LAS OPCIONES DE USUARIO NORMAL-->
                <li><a href="/cartelera">Cartelera</a></li>
                <!-- AQUI LAS OPCIONES DE MODULOS DISPONIBLES-->
                {{--*/ @author /*--}}
                <?php $modulosAgregados = []; ?>
                @foreach(Auth::user()->roles as $rol)
                    @foreach($rol->getModulosDisponibles() as $moduloDisponible)
                        @if(!in_array($moduloDisponible, $modulosAgregados))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {{str_replace("_", " ",$moduloDisponible)}}<b class="caret caret-black"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($rol->getAccionesDispPorModulo($moduloDisponible) as $Oaccion)
                                        @if ($Oaccion->navegacion == true)
                                            <li>
                                                <a href="{{$Oaccion->getUrl()}}">
                                                    {{$Oaccion->getTitulo()}}
                                                </a>
                                            </li>
                                        @endif

                                    @endforeach
                                    <li class="divider"></li>
                                </ul>
                            </li>
                            <?php $modulosAgregados[] = $moduloDisponible ?>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        @endif
    </div><!-- /.navbar-collapse -->
</nav>
</header><!-- end header -->
