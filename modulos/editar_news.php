<?php
$q = mysqli_query($con, "SELECT * FROM news");
check_admin();
?>
<script>

$(document).ready(function() {    

    $("#formEdit").submit(function(event) {
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        var formData = new FormData(this);

		let id = $("div#transEdit input[name='idEdit']").val();

        formData.append('action', 'editar_news');
        formData.append('id', id);

        $.ajax({
            url: "configs/manejar_bbdd.php",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
				var edit = $("#transEdit");
				edit.css("height", "0");
				
        		$url = $("div#transEdit input[name='url']").val();
				$imagen = $("div#transEdit input[name='imagen']").val().split('\\').pop();

				($imagen != "") ? $('tr#tr_' + id + " img").attr('src', "productos/"+$imagen) : "";
				$('tr#tr_' + id + " p").html($url);
					
                $("#formEdit").trigger("reset");
				
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
});

function deleteNew(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire(
                'Deleted!',
                'Your type has been deleted.',
                'success'
            ).then(function() {
                $.post("configs/manejar_bbdd.php", {
                        id: id,
                        action: "eliminar_news"
                    })
                    .done(function() {
                        $("#tr_" + id).remove();
                    });
            });
        }
    })
}

function editNew(id) {
    $.post("configs/manejar_bbdd.php", {
        id: id,
        action: "mostrarEdit_news"
    }, function(data) {

        var edit = $("#transEdit");
        edit.css("display", "block");
        edit.css("height", "320px");

        $("div#transEdit input[name='idEdit']").val(id);
        $("div#transEdit input[name='url']").val(data);

        $('html, body').animate({
            scrollTop: 0
        }, 500);

    });
}

</script>


<form method="post" action="" id="formEdit" enctype="multipart/form-data" style="padding-top: 20px; ">
    <div class="centrarlog" id="transEdit" style="padding:0; display: none;">
	<input type="hidden" id="idEdit" name="idEdit" value = "" style="display:none;" readonly>
        <div class="form-group">
            <input type="text" class="form-control" name="url" placeholder="Url of the new" value="" required>
        </div>

        <label>Cambiar portada</label>
        <div class="form-group">
            <input type="file" class="form-control-file" name="imagen" title="Portada del new" placeholder="Image">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success" name="editar">Update product</button>
        </div>
    </div>
</form>

<table>
    <thead>
        <tr class="mainTR">
            <th>Image</th>
            <th>Url</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>

    <?php while ($r = mysqli_fetch_array($q)) { ?>
    <tr id="tr_<?= $r['id'] ?>">
        <td>
            <img class="img_edit" src="productos/<?= $r['imagen'] ?>"/>
        </td>
        <td><p style="width: 230px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><?php echo $r['url']; ?></p></td>
        <td>
            <a onclick="editNew('<?= $r['id']; ?>')" class="btn btn-success">Edit</a>
        </td>
        <td>
            <a onclick="deleteNew('<?= $r['id']; ?>')" class="btn btn-danger">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>