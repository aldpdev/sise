<?php
session_start();
if (isset($_SESSION['nombre']) && isset($_SESSION['rol'])) {
  header('Location: ./principal');
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ALDP</title>
    
    <link rel="stylesheet" href="./lib/bootstrap.min.css">

  </head>
  <body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card">

            <div class="card-header">
              <h4 class="text-center">Iniciar Sesión</h4>
            </div>
            <div class="card-body">
              <div class="alert alert-warning" role="alert">
                Los credenciales de acceso no lo comparta con nadie.
              </div>
                <div class="form-group">
                  <label for="usernameInput">Usuario</label>
                  <input type="text" class="form-control" id="usuario" aria-describedby="usernameHelp" placeholder="Ingresa tu nombre de usuario" required>
                </div>
                <div class="form-group">
                  <label for="passwordInput">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <div class="form-group mt-2" align="center">
                  <button type="button" class="btn btn-outline-primary" id="submit">Iniciar Sesion</button>
                </div>
                <!--<button type="submit" class="btn btn-light" style="float:right;">Iniciar Sesion</button>-->



            </div>
            <div class="alert alert-danger" id="mensaje" role="alert">
                Verifique datos de los credenciales.
            </div>
          </div>
        </div>
      </div>
    </div>



    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/popper.min.js">
    </script>
    <script src="./lib/bootstrap.min.js">
    </script>
  </body>
</html>

<script>

$(document).ready(function(){
  $('#mensaje').hide();

  $('#submit').click(function(){

    var loginVals = {
      "usuario":$('#usuario').val(),
      "password":$('#password').val(),
    };
    if($('#usuario').val()==""){
      $('#mensaje').show();
    }else{
      $.ajax({
        type : "POST",
        url:"operaciones/b_user.php",
        data:loginVals,
      }).done(function(resultado){
			     location.href="./principal";
		  });

    }



  });


});
</script>