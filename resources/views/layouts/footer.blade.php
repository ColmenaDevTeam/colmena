<!--
@author Elias D. Peraza @tesoner
-->

<footer>
<div class="container fixed-bottom">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <h5 class="widgetheading">
                    Sistema Automatizado Para La Gestión Del
                    Talento Humano Del Programa Nacional de
                    Formación En Informática En La Universidad
                    Politécnica Territorial Andrés Eloy Blanco
                </h5><hr>
                <strong>
                    Colmena -Sistema de Gestión del Talento Humano
                </strong>
                Ha sido desarrollado como Proyecto Socio-tecnológico.<br>
                <a href="/acerca-de" data-placement="top" title="Acerca De Colmena -SGTH">
                    Más acerca de Colmena -SGTH
                </a>
                <br>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="copyright">
                    <p>
                        <strong><i class="fa fa-creative-commons"></i></strong>
                        Colmena -SGTH es Software Libre y está licenciado bajo
                        <a href="http://creativecommons.org/licenses/by-nc/4.0/" target="_blank">Licencia Creative Commons 4.0</a>
                        <!--<span>&copy;  </span><a href="#" target="_blank">no cliquear</a>-->
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="social-network">
                    <li>
                        <a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth" data-placement="top" title="Repositorio del Proyecto en GitHub">
                            <i class="fa fa-github-alt"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth/wiki" data-placement="top" title="Manual de Usuario: Wiki">
                            <i class="fa fa-file-text"></i>
                        </a>
                    </li>
                    <li>
                        <a target="" href="https://raw.githubusercontent.com/ColmenaDevTeam/colmena-sgth/master/documentacion/Manual-de-usuario-Colmena-SGTH.pdf" data-placement="top" title="Manual de Usuario: PDF">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    </li><!--
                    <li>
                        <a target="_blank" href="#" data-placement="top" title="Descargas">
                            <i class="fa fa-download"></i>
                        </a>
                    </li>-->
                    <li>
                        <a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth/issues?utf8=%E2%9C%93&q=is%3Aopen" data-placement="top" title="Reportar fallas o incidencias">
                            <i class="fa fa-bug"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/ColmenaDevTeam/colmena-sgth/stargazers" data-placement="top" title="Calificar Colmena -SGTH con una estrella">
                            <i class="fa fa-star-half-full"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/acerca-de" data-placement="top" title="Acerca De Colmena -SGTH">
                            <i class="fa fa-info-circle"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</footer>
<!-- </div> Este div no sé que hacía aqui-->
@if(Request::is('/') || Request::is('cartelera') || Request::is('home') || Request::is('inicio'))
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="/js/jquery.js"></script>


    <!-- timelinr-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.timelinr-0.9.6.js"></script>
    <script>
        $(function(){
            $().timelinr({
                autoPlay:           'true',
                autoPlayDirection:  'forward',
                datesDiv: 			'#dates',
                autoPlayPause: 		3000,//3 segundos
            })
        });
    </script>
    <!-- end timelinr-->


    <script src="/js/jquery.easing.1.3.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.fancybox.pack.js"></script>
    <script src="/js/jquery.fancybox-media.js"></script>
    <script src="/js/portfolio/jquery.quicksand.js"></script>
    <script src="/js/portfolio/setting.js"></script>
    <script src="/js/jquery.flexslider.js"></script>
    <script src="/js/animate.js"></script>
    <script src="/js/custom.js"></script>

@else
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.easing.1.3.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.fancybox.pack.js"></script>
    <script src="/js/jquery.fancybox-media.js"></script>
    <script src="/js/portfolio/jquery.quicksand.js"></script>
    <script src="/js/portfolio/setting.js"></script>
    <script src="/js/jquery.flexslider.js"></script>
    <script src="/js/animate.js"></script>
    <script src="/js/custom.js"></script>
    <!--Archivo faltante en el template original
    <script src="/js/owl-carousel/owl.carousel.js"></script>
    -->
@endif
<script src="/js/main.js"></script>
