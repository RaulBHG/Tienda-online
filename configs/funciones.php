<?php

    $con = mysqli_connect($host_mysql, $user_mysql, $pass_mysql)  or die("Error al conectar al servidor de la BBDD");
    mysqli_select_db($con, $db_mysql) or die("Error al conectar a la base de datos");

    function clear($var){
        htmlspecialchars($var);

        return $var;
    }

    function check_admin(){
        if(!isset($_SESSION['id'])){
            redir("./");
        }
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

    function addCest($cant, $id){
        $add = array(
            'ID'=>$id,
            'CANT'=>$cant
        );
        if (!isset($_SESSION['CARRITO'])) {
            session_destroy();
            session_start();
            $_SESSION['CARRITO'][0] = $add;
        } else {
            for ($i = 0; $i < $cant; $i++) {
                $numeroProductos = count($_SESSION['CARRITO']);
                $_SESSION['CARRITO'][$numeroProductos] = $add;
            }
        }
    }

    //Generar combo, la primera columna es el val, el otro el texto
    function combo($sql, $name, $con) {
        $result = "<select class='form-control' name='".$name."' required>";
        $q = mysqli_query($con, $sql);
        while ($r = mysqli_fetch_row($q)) {
            $result .= "<option value='".$r[0]."'>".$r[1]."</option>";
        }
        $result .= "</select>";
        mysqli_close($con);
        return $result;
    }

?>