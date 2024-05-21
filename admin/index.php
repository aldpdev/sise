
<?php
require('header.php');
?>

<link rel="stylesheet" href="../assets/css/indes.css">
<div class="contenedor">
        <div class="imagen-con-onda "></div>
        <div class="typing-text" style="width: 800px">
            <h1 class="row1" style="width: 800px">Bienvenidos</h3>
            <h3 class="row2"><small>Asamblea Legislativa Departamental</small></h3>
            <h3 class="row3"><small>Potosi - Bolivia</small></h3>
        </div>
    </div>


    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/popper.min.js">
    </script>
    <script src="./lib/bootstrap.min.js">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function restartAnimation() {
                var elements = document.querySelectorAll('.row1, .row2, .row3');
                elements.forEach(function(element) {
                    element.style.animation = 'none';
                    void element.offsetWidth;
                    element.style.animation = null;
                });
            }

            setInterval(restartAnimation, 6000);
        });
    </script>


<?php
    include_once('footer.php');
?>