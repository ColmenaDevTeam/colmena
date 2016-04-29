<!--
@author: tesoner
EJ:
template.blade.php:
<html>
<body>
    @ include ('header')
    @ yield ('content')
    @ include ('footer')
</body>
</html>

header.blade.php
<header>
    bla bla bla
    @ include ('menu')
</header>

menu.blade.php
<ul>
    <li>asdf</li>
</ul>

footer.blade.php
<footer>
    bla bla bla
</footer>

-->
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Colmena - Sistema de Gestión de Talento Humano</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- css -->

<link href="/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="/css/flexslider.css" rel="stylesheet" />
<link href="/css/style.css" rel="stylesheet" />
<!--Estos archivos no existen en el template original
<link href="css/jcarousel.css" rel="stylesheet" />

<link href="/js/owl-carousel/owl.carousel.css" rel="stylesheet">
-->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style>
    .dropdown-menu{
        background-color: #2FADDE;
    }
    .highlight{
        font-weight: bold;
    }
    .panel-heading span{
        font-size: 30px;
        font-weight: bold;
        color: #656565;
    }
    .badge-menu-bar{
        background-color: black;
    }
</style>
</head>
<body>
<div id="wrapper">
@include("layouts.main_menu_layout")


@yield('contenido')


</div><!-- ./wrapper -->
@include("layouts.footer")

</body>
</html>
