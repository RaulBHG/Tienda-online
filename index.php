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
    <link rel="stylesheet" href="dist/notice.min.css">
    <script src="dist//notice.min.js"></script>

    <script type="text/javascript" src="js/jquery.js"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/8ae4b535da.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <title>Tienda online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
    <div id="cabecera">
        <div class="header"> <span style="font-size:20px;cursor:pointer;" id="abrirMenu"
                onclick="openNav()">&#9776;</span>
            <a id="headertext" href="?p=inicio">Tienda online</a>
        </div>
        <div style="height: 54px;">
            <nav id="menu">
                <ul class="button">
                    <li><a href="?p=inicio">Inicio</a></li>
                    <li><a href="?p=shop">Shop</a></li>
                    <li><a href="?p=about">About</a></li>
                    <li><a href="?p=contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script>
    function toast(texto) {
        $(".toast-body").html(texto);
        $('.toast').toast('show');

    }
    function loadingOn(){
        const notice = new Notice();
        notice.showLoading({
            type: 'dots'  // default：'line'
        });
    }
    function loadingOf(){
        const notice = new Notice();
        notice.hideLoading()
    }
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
        <a href="?p=inicio">Inicio</a>
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

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="position: absolute; bottom: 2rem; right: 0.5rem;">
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
    </div>

    <div class="footer">
        Copyright RaulBlazquez &copy; <?= date("Y") ?>
        |
        <a id="administrador" class="pull-right" href="?p=admin">Administrador</a>
    </div>

</body>

</html>