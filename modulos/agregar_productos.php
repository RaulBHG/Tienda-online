<?php
check_admin();

if (isset($enviar)){
    $name = clear($name);
    $price = clear($price);

    $imagen = "";

    if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $imagen = $name.rand(0,1000).".png";
        move_uploaded_file($_FILES['imagen']['tmp_name'], "productos/".$imagen);
    }

    mysqli_query($con, "INSERT INTO productos (name, price, imagen) VALUES ('$name', '$price', '$imagen')");
    alert("Producto añadido con éxito.");
    redir("?p=agregar_productos");
}

?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="centrarlog">
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name of the product">
    </div>

    <div class="form-group">
        <input type="number" class="form-control" name="price" placeholder="Price">
    </div>

    <label>Inserta foto</label>
    <div class="form-group">
        <input type="file" class="form-control" style="max-width: 50%;" name="imagen" title="Imagen del producto" placeholder="Image">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" name="enviar">Add product</button>
    </div>
    </div>
</form>


