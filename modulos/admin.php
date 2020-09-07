<?php

if(isset($enviar)){
    $user = clear($user);
    $password = clear($password);

    $q = mysqli_query($con, "SELECT * FROM admins WHERE user = '$user' AND password = '$password'");

    if(mysqli_num_rows($q)>0){
        $r = mysqli_fetch_array($q);
        $_SESSION['id'] = $r['id'];
        redir("?p=admin");
    }else{
        alert("Los datos introducidos no son válidos.");
        redir("?p=admin");
        
    }
}
if(isset($_SESSION['id'])){

}else{
    ?>
        <form method="post" action="">
            <div class="centrarlog">
                <label><h5><i class="fa fa-key"></i> Inicio de administradores</h5></label>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre de usuario" name="user"/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-submit&&btn btn-dark" name="enviar" type="submit"><i class="fas fa-sign-in-alt"> </i> Iniciar sesión</button>
                </div>
            </div>
        </form>
    <?php
}
?>