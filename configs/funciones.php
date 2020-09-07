<?php

    $con = mysqli_connect($host_mysql, $user_mysql, $pass_mysql)  or die("Error al conectar al servidor de la BBDD");
    mysqli_select_db($con, $db_mysql) or die("Error al conectar a la base de datos");

    function clear($var){
        htmlspecialchars($var);

        return $var;
    }

    function redir($var){
        ?>
        <script>
            window.location="<?=$var?>";
        </script>
        <?php
        die();
    }

    function alert($var){
        ?>
        <script>
            alert("<?=$var?>");
        </script>
        <?php
    }

?>