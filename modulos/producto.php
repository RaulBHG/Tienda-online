<div>
    <script>
        function error($mensaje) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: $mensaje,
                footer: '<a href="?p=cart">Ir a la cesta.</a>'
            })
        }

        function success() {
            Swal.fire({
                icon: 'success',
                title: 'Perfecto',
                text: 'Ha añadido el producto a la cesta.',
                footer: '<a href="?p=cart">Ir a la cesta.</a>'
            })
        }
    </script>

    <?php

    if (isset($see)) {
        $q = mysqli_query($con, "SELECT * FROM productos WHERE id = '$see'");
        $r = mysqli_fetch_array($q);

        $stringImages = $r['imagenes'];
        $arrayImages = explode(",", $stringImages);
    ?>
        <div class="container">
            <div class="row">
                <!--Slider-->
                <div id="carouselExampleIndicators" class="carousel slide product-img col-md-6" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <?php
                        for ($i = 1; $i < count($arrayImages); $i++) {
                            $posi = strval($i);
                        ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to=<?= $posi ?>></li>
                        <?php
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="productos/<?= $arrayImages[0] ?>" class="d-block w-100 img" alt="...">
                        </div>
                        <?php
                        for ($i = 1; $i < count($arrayImages); $i++) {
                        ?>
                            <div class="carousel-item">
                                <img src="productos/<?= $arrayImages[$i] ?>" class="d-block w-100 img" alt="...">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!--Slider-->
                <div class="product-info col-md-6">
                    <div class="product-text">
                        <h1><?= $r['name'] ?></h1>
                        <h2>por Lidia Hernán</h2>
                        <p><?= $r['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>