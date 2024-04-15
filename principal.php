<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['rol'])) {
    header('Location: ./');
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
  <link rel="stylesheet" href="./lib/bootstrap.min.css">

  <style>
    body {
      background: #EAEAEA;
    }
  </style>
</head>

<body>
<?php include_once('menu.php'); ?>

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="text-center">
          <img src="./imagenes/logo.png" class="img img-responsive" width="35%" title="Asamblea Legislativa del departamento autónomo de Potosi" alt="Asamblea Legislativa del departamento autónomo de Potosi">
          <h3 class="text-black">Bienvenidos <br><small> Asamblea Legislativa Departamental<br> Potosi - Bolivia </small></h3>
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
