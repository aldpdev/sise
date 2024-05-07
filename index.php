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
    <link rel="stylesheet" href="./operaciones/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      body {
        background-image: url('./imagenes/potos2.jpg');
        background-size: cover; /* Para cubrir todo el fondo */
        background-position: center; /* Para centrar la imagen */
      }

      /* Estilo para quitar el borde de enfoque */
      button:focus {
        outline: none;
      }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <div class="login">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h4 class="text-center">Iniciar Sesión</h4>
            </div>
            <div class="card-body">
              <form id="loginForm">
                <div class="group">      
                  <input type="text" id="usuario" name="usuario" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label for="usuario">Usuario</label>
                </div>
                <div class="group">      
                  <input type="password" id="password" name="password" required>
                  <span class="highlight"></span>
                  <span class="bar"></span> 
                  <label for="password">Password</label>
                  <span>
                    <button id="eye" type="button"><i id="eye-icon" class="far fa-eye"></i></button>
                  </span> 
                </div>
                <div class="form-group mt-2" align="center">
                  <button type="button" class="btn btn-outline-primary" id="submit">Iniciar Sesión</button>
                </div>
              </form>
              <div class="alert alert-danger" id="mensaje" role="alert" style="display:none;">
                Verifique datos de los credenciales.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/popper.min.js"></script>
    <script src="./lib/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#mensaje').hide();

        $('#submit').click(function(){
          var loginVals = $('#loginForm').serialize();
          $.ajax({
            type : "POST",
            url:"operaciones/b_user.php",
            data: loginVals,
          }).done(function(resultado){
            location.href="./principal";
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#mensaje').show().text("Error: " + errorThrown);
          });
        });

        function show() {
          $('#password').attr('type', 'text');
          $('#eye-icon').removeClass('fa-eye').addClass('fa-eye-slash');
        }

        function hide() {
          $('#password').attr('type', 'password');
          $('#eye-icon').removeClass('fa-eye-slash').addClass('fa-eye');
        }

        var pwShown = false;

        $('#eye').click(function() {
          if (pwShown) {
            hide();
            pwShown = false;
          } else {
            show();
            pwShown = true;
          }
        });
      });
    </script>
  </body>
</html>

