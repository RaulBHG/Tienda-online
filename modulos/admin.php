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
if(isset($_SESSION['id'])){//con sesión iniciada
    ?>
        <a href="?p=agregar_productos">
            <button class="btn btn-submit&&btn btn-dark"><i class="fa fa-plus-circle" style="border-radius:50%;"></i> Add product</button>
        </a>
        <a href="?p=admin">
            <button class="btn btn-danger">Logout</button>
        </a>
    <?php

}else{//sin sesión iniciada 
    ?>
        <form method="post" action="">
            <div class="centrarlog">
                <label><h5><i class="fa fa-key"></i> Inicio de administradores</h5></label>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="User name" name="user"/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-submit&&btn btn-dark" name="enviar" type="submit"><i class="fas fa-sign-in-alt"> </i> Loggin</button>
                </div>
            </div>
        </form>
    <?php
}
?>