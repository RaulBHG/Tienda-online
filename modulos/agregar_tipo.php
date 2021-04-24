<?php
check_admin();
?>

<form method="post" action="" id="formAdd" enctype="multipart/form-data">
    <div class="centrarlog">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name of the type" required>
        </div>

        <label>Inserta foto</label>
        <div class="form-group">
            <input type="file" class="form-control-file" id="imagen" name="imagen" title="Portada del tipo"
                placeholder="Image" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Add product</button>
        </div>
    </div>
</form>
<script>
$("#formAdd").submit(function(event) {

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    var formData = new FormData(this);

    formData.append('action', 'añadir_tipo');

    $.ajax({
        url: "configs/manejar_bbdd.php",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#formAdd").trigger("reset");
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            });
        },
    });

});
</script>