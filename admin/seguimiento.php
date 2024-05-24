<?php require ('header.php');

?>



    <h2 class="text-center">SEGUIMIENTO DE DOCUMENTACION</h2>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p><b>ORIGIN DEL DOCUMENTO</b></p>
                <br>
                <div class="border border-primary p-3">
                    asldfkjasldkjflsdakfj
                    <div class="row">
                        <div class="col-4">
                            <img src="../imagenes/perfil.jpg" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="col-8">
                            descripcion
                        </div>
                    </div>
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
                    <div class="col-2"><img src="../imagenes/perfil.jpg" style="max-width: 50%; height: auto;"></div>
                    <div class="col-4">fechas</div>
                    <div class="col-6">estado</div>
                    <div ">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#007bff" class="bi bi-chevron-double-up" viewBox="0 0 16 16" style="margin-left:40px;">
                         <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                        </svg>
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

    


    <?php
    include_once ('footer.php');
    ?>
