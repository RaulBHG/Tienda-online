<?php
include "configs/config.php";
include "configs/funciones.php";

if (!isset($p)) {
    $p = "inicio";
} else {
    $p = $p;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    
    <script type="text/javascript" src="js/jquery.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/8ae4b535da.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="css/style.css" />
    
    <title>Tienda online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="cabecera">
        <div class="header"> <span style="font-size:20px;cursor:pointer;" id="abrirMenu"
                onclick="openNav()">&#9776;</span>
            <a id="headertext" href="?p=inicio">Tienda online</a>
        </div>
        <div style="height: 54px;">
            <nav id="menu">
                <ul>
                    <li><a href="?p=inicio">Inicio</a></li>
                    <li><a href="?p=shop">Shop</a></li>
                    <li><a href="?p=about">About</a></li>
                    <li><a href="?p=contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        var stickyNavTop = $('#menu').offset().top;

        var stickyNav = function() {
            var scrollTop = $(window).scrollTop(); // our current vertical position from the top

            if (scrollTop > stickyNavTop) {
                $('#menu').addClass('sticky');
            } else {
                $('#menu').removeClass('sticky');
            }
        };

        stickyNav();
        $(window).scroll(function() {
            stickyNav();
        });
    });
    </script>
    <!--Nuevo menu-->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <li><a href="?p=inicio">Inicio</a></li>
        <a href="?p=shop">Shop</a>
        <a href="?p=about">About</a>
        <a href="?p=contact">Contact</a>
    </div>
    <script>
    function openNav() {
        $("#mySidenav").css("width", "100%");
    }

    function closeNav() {
        $("#mySidenav").css("width", "0%");
    }
    </script>
    <!--Nuevo menu-->

    <div class="cuerpo">
        <div class="container">
            <?php
        if (file_exists("modulos/" . $p . ".php")) {
            include "modulos/" . $p . ".php";
        } else {
            echo "<i>No se ha encontrado <b>" . $p . ".</b></i>";
        }
        ?>
        </div>
    </div>

    <div class="footer">
        Copyright RaulBlazquez &copy; <?= date("Y") ?>
        |
        <a id="administrador" class="pull-right" href="?p=admin">Administrador</a>
    </div>

</body>

</html>