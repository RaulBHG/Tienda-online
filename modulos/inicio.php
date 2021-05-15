<?php
$q = mysqli_query($con, "SELECT * FROM news ORDER BY id DESC");
?>
    
    <div class="container">
        <div class="row">
            <!--Slider-->
            <div id="carouselExampleIndicators" class="carousel slide col-md-12" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php
                    for ($i = 1; $i < mysqli_num_rows($q); $i++) {
                        $posi = strval($i);
                    ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to=<?= $posi ?>></li>
                    <?php
                    }
                    ?>
                </ol>
                <div class="carousel-inner border10">
                    <?php
                    $count = 0;
                    while ($r = mysqli_fetch_array($q)) {
                    ?>
                        <div class="carousel-item <?=($count == 0) ? "active": ""?>">
                            <img src="productos/<?= $r["imagen"] ?>" class="d-block w-100 img-news pointer" alt="..." onclick="window.location='<?= $r["url"] ?>'" >
                        </div>
                    <?php
                    $count++;
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
        </div>
    </div>

</body>
<script>

</script>