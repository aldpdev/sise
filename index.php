<?php

ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
session_start();

$_SESSION["loc"] = dirname($_SERVER['PHP_SELF']);
if($_SESSION["loc"]=="/") $_SESSION["loc"] = "";
$_SESSION["locr"] = dirname(__FILE__);
if($_SESSION["locr"]=="/") $_SESSION["locr"] = "";

require_once("globals.php");
require_once("db.php");

if (!isset($_GET["name"])) {

	//para la validacion de login yes
	if (ValidSession())
	  	DBLogOut($_SESSION["usertable"]["usernumber"], $_SESSION["usertable"]["username"]=='admin');

	session_unset();
	session_destroy();
	session_start();
	$_SESSION["loc"] = dirname($_SERVER['PHP_SELF']);
	if($_SESSION["loc"]=="/") $_SESSION["loc"] = "";
	$_SESSION["locr"] = dirname(__FILE__);
	if($_SESSION["locr"]=="/") $_SESSION["locr"] = "";

}
if(isset($_GET["getsessionid"])) {
	echo session_id();
	exit;
}
ob_end_flush();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ALDP - Login</title>
    
    <link rel="stylesheet" href="./lib/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/stylesindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script language="JavaScript" src="sha256.js"></script>
    <script language="JavaScript">
        function computeHASH()
        {
          var userHASH, passHASH;
          userHASH = document.form1.name.value;
          passHASH = js_myhash(js_myhash(document.form1.password.value)+'<?php echo session_id(); ?>');
          document.form1.name.value = '';
          document.form1.password.value = '                                                                                 ';
          document.location = 'index.php?name='+userHASH+'&password='+passHASH;
        }
    </script>
<?php
if(function_exists("globalconf") && function_exists("sanitizeVariables")) {

  if(isset($_GET["name"]) && $_GET["name"] != "" ) {

    	$name = $_GET["name"];
    	$password = $_GET["password"];
			//para login ... log....
    	$usertable = DBLogIn($name, $password);

			if(!$usertable) {
    		ForceLoad("index.php");
    	}else {
      			echo "<script language=\"JavaScript\">\n";
      			echo "document.location='" . $_SESSION["usertable"]["usertype"] . "/index.php';\n";
      			echo "</script>\n";
      }
      exit;
  }
} else {
  echo "<script language=\"JavaScript\">\n";
  echo "alert('No se pueden cargar los archivos de configuración. Posible problema de permisos de archivos en el directorio SIHCO.');\n";
  echo "</script>\n";
}

?>


   <style>   
     body {
          background-image: url('./imagenes/potos2.jpg');
          background-size: cover; /* Para cubrir todo el fondo */
          background-position: center center; /* Para centrar la imagen horizontal y verticalmente */
          }

      /* Estilo para quitar el borde de enfoque */
      button:focus {
        outline: none;
      }
    </style>
  </head>
  <body onload="document.form1.name.focus()">
    <div class="container mt-5">
      <div class="login">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h4 class="text-center">Iniciar Sesión</h4>
            </div>
            <div class="card-body">
              <form name="form1" action="javascript:computeHASH()">
                <div class="group">      
                  <input type="text" id="name" name="name" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label for="name">Usuario</label>
                </div>
                <div class="group">      
                  <input type="password" id="password" name="password" required>
                  <span class="highlight"></span>
                  <span class="bar"></span> 
                  <label for="password">Password</label>
                  <span>
                    <button id="eye" type="button"><i id="eye-icon" class="far fa-eye-slash"></i></i></button>
                  </span> 
                </div>
                <div class="form-group mt-2" align="center">
                  <input type="submit" class="btn btn-outline-primary" name="Submit" value="Iniciar Session">
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
                

       function show() {
        $('#password').attr('type', 'text');
        $('#eye-icon').removeClass('fa-eye-slash').addClass('fa-eye');
                      }

       function hide() {
        $('#password').attr('type', 'password');
        $('#eye-icon').removeClass('fa-eye').addClass('fa-eye-slash');
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

