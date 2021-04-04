<!-- Top content -->
<div class="top-content">
    <div class="container-fluid">
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner row w-100 mx-auto" role="listbox">
                <?php
                    $q = mysqli_query($con, "SELECT * FROM productos WHERE portada=1");
                    $i = 0;
                    while ($r = mysqli_fetch_array($q)) {
                        $activo = "";
                        if ($i == 0) {
                            $activo = "active";
                        }                   
                    ?>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 <?=$activo?> producto hover-shadow"
                    onclick="togglePopup('<?= $r['id'] ?>')">
                    <img class="img_producto" src="productos/<?= $r['imagen'] ?>" />
                    <div class="name_producto"><?= $r['name'] ?></div>
                </div>
                <?php
                    $i++;
                    }
                    ?>
            </div>
            <!--<a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>-->
            <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                        <i class="fas fa-chevron-circle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
            <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                <i class="fas fa-chevron-circle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
            <!--
            <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
                -->
        </div>
    </div>
</div>

<script>
/*
    Carousel
*/
$('#carousel-example').on('slide.bs.carousel', function(e) {

    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 5;
    var totalItems = $('.carousel-item').length;

    if (idx >= totalItems - (itemsPerSlide - 1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i = 0; i < it; i++) {
            // append slides to end
            if (e.direction == "left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            } else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});

function togglePopup(id) {
            if (id != undefined) {
                window.location = "?p=producto&see=" + id;
                //localStorage.clear();
            } else {
                window.location = "?p=shop";
            }
        }
</script>