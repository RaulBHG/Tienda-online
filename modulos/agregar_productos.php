<?php
check_admin();
?>
<form method="post" action="">
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


