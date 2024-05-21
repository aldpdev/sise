<?php include_once('header.php');

?>

<body>
    <?php include_once('menu.php'); ?>
    <h2 class="text-center">GESTION DE USUARIO</h2>

    <div class="container">
        <div class="card-deck">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
            <div class="card">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Info card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p><b>SEGUIMIENTO DEL DOCUMENTO</b></p>
                    <br>
                    <?php
                    $repeticiones = 9;
                    for ($i = 0; $i < $repeticiones; $i++) {
                        echo '<div class="row">
            <div class="col-12">
                Beneficiario
                <div class="row">                
                    <div class="col-2"><img src="imagenes/perfil.jpg" style="max-width: 50%; height: auto;"></div>
                    <div class="col-4">fechas</div>
                    <div class="col-6">estado</div>
                    <div style="text-align: center;">
                  </div>

                    
                    </div>
                
            </div>
        </div>';
                    }
                    ?>

                </div>
            </div>
            <hr>
        </div>

        <script src="./lib/jquery.min.js"></script>
        <script src="./lib/popper.min.js">
        </script>
        <script src="./lib/bootstrap.min.js">
        </script>
        <script src="./tm/toastr.js"></script>
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            });
        </script>

</body>
<footer>
    <?php
    include_once('footer.php');
    ?>
</footer>
</hml>