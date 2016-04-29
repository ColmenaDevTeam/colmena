<!--
@author: tesoner
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
<link href="/css/jcarousel.css" rel="stylesheet" />
<link href="/css/flexslider.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/styletimeliner.css" media="screen" />
<link href="/css/style.css" rel="stylesheet" />
<style>
    .dropdown-menu{
        background-color: #2FADDE;
    }
    .list-group-item span{
        font-weight: bold;
    }
    .list-group-item:hover{
        color: rgb(199, 36, 143);
    }
    .list-group .active{
        font-weight: bold;
    }
    .list-group-item-fecha:hover{
        color: black;
        text-decoration: inherit;
    }
    .badge-menu-bar{
        background-color: black;
    }
</style>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

</head>
<body>
@include("layouts.main_menu_layout")


@yield('contenido')


@include("layouts.footer")

</body>
</html>
