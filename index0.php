<?php
session_start();
if (isset($_SESSION['nombre']) && isset($_SESSION['rol'])) {
  header('Location: ./principal');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALDP</title>

  <link rel="stylesheet" href="./lib/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
  body{
    background-color: #353541;
  }
</style>
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
              Los credenciales de acceso no lo comparta con nadie.</div>

            <form id="forminiciarsesion">
              <div class="form-group">
                <label for="usernameInput">Usuario</label>
                <input type="text" class="form-control" id="usuario" aria-describedby="usernameHelp" placeholder="Ingresa tu nombre de usuario" required>
              </div>
              <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
              </div>
              <button type="submit" class="btn btn-light" style="float:right;">Iniciar Sesion</button>
            </form>
          </div>
          <div class="alert alert-danger" id="mensaje" role="alert">
              Verifique datos de los credenciales.
            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="./lib/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <script>
    var _0x4d59=["\x68\x69\x64\x65","\x23\x6D\x65\x6E\x73\x61\x6A\x65","\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x76\x61\x6C","\x23\x75\x73\x75\x61\x72\x69\x6F","\x23\x70\x61\x73\x73\x77\x6F\x72\x64","\x4E\x4F\x4D\x42\x52\x45","","\x73\x68\x6F\x77","\x68\x72\x65\x66","\x2E\x2F\x70\x72\x69\x6E\x63\x69\x70\x61\x6C","\x70\x72\x6F\x70","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x62\x5F\x75\x73\x65\x72\x2E\x70\x68\x70","\x6A\x73\x6F\x6E","\x61\x6A\x61\x78","\x73\x75\x62\x6D\x69\x74","\x23\x66\x6F\x72\x6D\x69\x6E\x69\x63\x69\x61\x72\x73\x65\x73\x69\x6F\x6E","\x72\x65\x61\x64\x79"];$(document)[_0x4d59[19]](function(){$(_0x4d59[1])[_0x4d59[0]]();$(_0x4d59[18])[_0x4d59[17]](function(_0xb9fax1){_0xb9fax1[_0x4d59[2]]();var _0xb9fax2={'\x75\x73\x75\x61\x72\x69\x6F':$(_0x4d59[4])[_0x4d59[3]](),'\x70\x61\x73\x73\x77\x6F\x72\x64':$(_0x4d59[5])[_0x4d59[3]]()};$[_0x4d59[16]]({type:_0x4d59[13],url:_0x4d59[14],data:_0xb9fax2,dataType:_0x4d59[15]})[_0x4d59[12]](function(_0xb9fax3){if(_0xb9fax3[_0x4d59[6]]== _0x4d59[7]){$(_0x4d59[1])[_0x4d59[8]](1000);setTimeout(function(){$(_0x4d59[1])[_0x4d59[0]](1000)},4000)}else {$(location)[_0x4d59[11]](_0x4d59[9],_0x4d59[10]);$(_0x4d59[1])[_0x4d59[0]](1000)}})})})
  </script>
</body>
</html>
