    <div class="row">
        <?php
        $q = mysqli_query($con, "SELECT * FROM productos ORDER BY id DESC");
        while ($r = mysqli_fetch_array($q)) {
        ?>
        <div class="producto col-md-3 hover-shadow" onclick="togglePopup('<?= $r['id'] ?>')">
            <img class="img_producto" src="productos/<?= $r['imagen'] ?>" />
            <div class="name_producto"><?= $r['name'] ?></div>
        </div>

        <?php
        }
        mysqli_close($con);
        ?>
        <script>
        function togglePopup(id) {
            if (id != undefined) {
                window.location = "?p=producto&see=" + id;
                //localStorage.clear();
            } else {
                window.location = "?p=shop";
            }
        }
        </script>
    </div>