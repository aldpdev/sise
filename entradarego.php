<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['rol'])) {
  header('Location: ./');
  exit;
}
if ($_SESSION['rol'] != "ADMINISTRADOR") {
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
  <link rel="stylesheet" href="./lib/bootstrap.min.css" >
  <link href="./tm/toastr.scss" rel="stylesheet" />
  <style>
    body {
      background: #123;
    }

    .container {
      max-width: 60%;
      margin-top: 0px;
    }

    .form-control {
      background-color: #343a40;
      border: none;
      border-radius: 0;
      color: #fff;
    }

    .form-control:focus {
      background-color: #495057;
      border-color: #fff;
      box-shadow: none;
      color: #fff;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 0;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #0069d9;
      border: none;
      border-radius: 0;
    }

    label {
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <?php include_once('menu.php'); ?>

  <div class="container">
    <h3 class="text-light text-center">REGISTRO DE ENTRADA OTRA DOCUMENTACION</h3>
    <div id="carga" class="text-center" style="display:none;">
      <img src="./imagenes/cargando.gif" />
    </div>
    <div id="formulario" style="display:block">
      <form id="registrarentrada" method="post" enctype="multipart/form-data">
        <div class="form-row">

          <div class="col">
            <div class="form-group">
              <label for="grupo">GRUPO</label>
              <select class="form-control" id="grupo" name="grupo" required data-toggle="popover" data-content="Este campo es requerido">
                <option></option>
                <option value="JEFATURA ADMINISTRATIVA">JEFATURA ADMINISTRATIVA</option>
                <option value="AUDITORIA INTERNA">AUDITORIA INTERNA</option>
                <option value="BANCADA">BANCADA</option>
                <option value="COMISIONES">COMISIONES</option>
                <option value="DAF">DAF</option>
                <option value="DIRECTIVA">DIRECTIVA</option>
                <option value="FINANCIERA">FINANCIERA</option>
                <option value="PRESIDENCIA">PRESIDENCIA</option>
              </select>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="unidad">UNIDAD</label>
              <select class="form-control" id="unidad" name="unidad" required data-toggle="popover" data-content="Este campo es requerido">
                <option></option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="descripcion">Descripcion</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion" rows="5" required data-toggle="popover" data-content="Este campo es requerido" required></textarea>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="gestion">GESTION</label>
              <select class="form-control" id="gestion" name="gestion" required data-toggle="popover" data-content="Este campo es requerido">
                <option></option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
              </select>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="nhojas">Fojas</label>
              <input type="number" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas" required data-toggle="popover" data-content="Este campo es requerido">
            </div>
          </div>

          <div class="form-group">
            <label for="tipoarchivo">TIPO ARCHIVO</label>
            <select class="form-control" id="tipoarchivo" name="tipoarchivo" required data-toggle="popover" data-content="Este campo es requerido">
              <option></option>
              <option value="ARCHIVADOR">ARCHIVADOR</option>
              <option value="CAJAS">CAJAS</option>
              <option value="FOLDER">FOLDER</option>
            </select>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="fingreso">Fecha de Ingreso</label>
              <input type="date" style="text-transform: uppercase;" class="form-control" id="fingreso" name="fingreso" required data-toggle="popover" data-content="Este campo es requerido">
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="observacion">Observacion</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="observacion" name="observacion" rows="2"></textarea>
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="archivo" class="form-label">Archivo digitalizado</label>
              <input class="form-control" accept="application/pdf" type="file" id="archivo" name="archivo" required data-toggle="popover" data-content="Este campo es requerido" required>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <button type="reset" class="btn btn-danger btn-block">Limpiar</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="./lib/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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

  <script>
    $(function() {
      $('[data-toggle="popover"]').popover({
        placement: 'right',
        trigger: 'hover'
      })
    })
  </script>

  <script>
   var _0x3c41=["\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x4F\x50\x45\x52\x41\x43\x49\x4F\x4E","\x4F\x4B","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61","\x73\x75\x63\x63\x65\x73\x73","\x72\x65\x73\x65\x74","\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x65\x6E\x74\x72\x61\x64\x61","\x66\x6F\x63\x75\x73","\x23\x67\x65\x73\x74\x69\x6F\x6E","\x45\x52\x52\x4F\x52","\x56\x65\x72\x69\x66\x69\x71\x75\x65\x20\x6C\x6F\x73\x20\x64\x61\x74\x6F\x73","\x77\x61\x72\x6E\x69\x6E\x67","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x5F\x65\x6E\x74\x72\x61\x64\x61\x6F\x2E\x70\x68\x70","\x62\x6C\x6F\x63\x6B","\x63\x73\x73","\x23\x63\x61\x72\x67\x61","\x6E\x6F\x6E\x65","\x23\x66\x6F\x72\x6D\x75\x6C\x61\x72\x69\x6F","\x64\x69\x73\x70\x6C\x61\x79","\x61\x6A\x61\x78","\x73\x75\x62\x6D\x69\x74","\x72\x65\x61\x64\x79","\x63\x68\x61\x6E\x67\x65","\x23\x67\x72\x75\x70\x6F","\x65\x6D\x70\x74\x79","\x23\x75\x6E\x69\x64\x61\x64","\x76\x61\x6C","","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x22\x3E\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x61\x70\x70\x65\x6E\x64","\x4A\x45\x46\x41\x54\x55\x52\x41\x20\x41\x44\x4D\x49\x4E\x49\x53\x54\x52\x41\x54\x49\x56\x41","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x52\x52\x48\x48\x22\x3E\x52\x48\x48\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x44\x49\x52\x45\x43\x54\x4F\x52\x20\x41\x44\x4D\x49\x4E\x49\x53\x54\x52\x41\x54\x49\x56\x4F\x22\x3E\x44\x49\x52\x45\x43\x54\x4F\x52\x20\x41\x44\x4D\x49\x4E\x49\x53\x54\x52\x41\x54\x49\x56\x4F\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x52\x50\x41\x22\x3E\x52\x50\x41\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x41\x55\x44\x49\x54\x4F\x52\x49\x41\x20\x49\x4E\x54\x45\x52\x4E\x41","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x41\x55\x44\x49\x54\x4F\x52\x49\x41\x20\x49\x4E\x54\x45\x52\x4E\x41\x22\x3E\x41\x55\x44\x49\x54\x4F\x52\x49\x41\x20\x49\x4E\x54\x45\x52\x4E\x41\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x42\x41\x4E\x43\x41\x44\x41","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x42\x41\x4E\x43\x41\x44\x41\x22\x3E\x42\x41\x4E\x43\x41\x44\x41\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x45\x53","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x31\x20\x2D\x20\x43\x4F\x4E\x53\x54\x49\x54\x55\x43\x49\x4F\x4E\x20\x4C\x45\x47\x49\x53\x4C\x41\x43\x49\x4F\x4E\x20\x59\x20\x53\x49\x53\x54\x45\x4D\x41\x20\x45\x4C\x45\x43\x54\x4F\x52\x41\x4C\x22\x3E\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x31\x20\x2D\x20\x43\x4F\x4E\x53\x54\x49\x54\x55\x43\x49\x4F\x4E\x20\x4C\x45\x47\x49\x53\x4C\x41\x43\x49\x4F\x4E\x20\x59\x20\x53\x49\x53\x54\x45\x4D\x41\x20\x45\x4C\x45\x43\x54\x4F\x52\x41\x4C\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x32\x20\x2D\x20\x44\x45\x53\x41\x52\x52\x4F\x4C\x4C\x4F\x20\x50\x52\x4F\x44\x55\x43\x54\x49\x56\x4F\x22\x3E\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x32\x20\x2D\x20\x44\x45\x53\x41\x52\x52\x4F\x4C\x4C\x4F\x20\x50\x52\x4F\x44\x55\x43\x54\x49\x56\x4F\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x33\x20\x2D\x20\x44\x45\x53\x41\x52\x52\x4F\x4C\x4C\x4F\x20\x45\x43\x4F\x4E\x4F\x4D\x49\x43\x4F\x22\x3E\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x33\x20\x2D\x20\x44\x45\x53\x41\x52\x52\x4F\x4C\x4C\x4F\x20\x45\x43\x4F\x4E\x4F\x4D\x49\x43\x4F\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x34\x20\x2D\x20\x4F\x52\x47\x41\x4E\x49\x5A\x41\x43\x49\x4F\x4E\x20\x54\x45\x52\x52\x49\x54\x4F\x52\x49\x41\x4C\x2C\x20\x41\x55\x54\x4F\x4E\x4F\x4D\x49\x41\x53\x20\x59\x20\x50\x55\x45\x42\x4C\x4F\x53\x20\x49\x4E\x44\x49\x47\x45\x4E\x41\x20\x4F\x52\x49\x47\x49\x4E\x41\x52\x49\x4F\x20\x43\x41\x4D\x50\x45\x53\x49\x4E\x4F\x22\x3E\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x34\x20\x2D\x20\x4F\x52\x47\x41\x4E\x49\x5A\x41\x43\x49\x4F\x4E\x20\x54\x45\x52\x52\x49\x54\x4F\x52\x49\x41\x4C\x2C\x20\x41\x55\x54\x4F\x4E\x4F\x4D\x49\x41\x53\x20\x59\x20\x50\x55\x45\x42\x4C\x4F\x53\x20\x49\x4E\x44\x49\x47\x45\x4E\x41\x20\x4F\x52\x49\x47\x49\x4E\x41\x52\x49\x4F\x20\x43\x41\x4D\x50\x45\x53\x49\x4E\x4F\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x35\x20\x2D\x20\x44\x45\x52\x45\x43\x48\x4F\x53\x20\x48\x55\x4D\x41\x4E\x4F\x53\x20\x59\x20\x44\x45\x53\x41\x52\x52\x4F\x4C\x4C\x4F\x20\x53\x4F\x43\x49\x41\x4C\x22\x3E\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x35\x20\x2D\x20\x44\x45\x52\x45\x43\x48\x4F\x53\x20\x48\x55\x4D\x41\x4E\x4F\x53\x20\x59\x20\x44\x45\x53\x41\x52\x52\x4F\x4C\x4C\x4F\x20\x53\x4F\x43\x49\x41\x4C\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x36\x20\x2D\x20\x4D\x49\x4E\x45\x52\x49\x41\x2C\x20\x49\x4E\x44\x55\x53\x54\x52\x49\x41\x4C\x49\x5A\x41\x43\x49\x4F\x4E\x20\x59\x20\x4D\x45\x44\x49\x4F\x20\x41\x4D\x42\x49\x45\x4E\x54\x45\x22\x3E\x43\x4F\x4D\x49\x53\x49\x4F\x4E\x20\x36\x20\x2D\x20\x4D\x49\x4E\x45\x52\x49\x41\x2C\x20\x49\x4E\x44\x55\x53\x54\x52\x49\x41\x4C\x49\x5A\x41\x43\x49\x4F\x4E\x20\x59\x20\x4D\x45\x44\x49\x4F\x20\x41\x4D\x42\x49\x45\x4E\x54\x45\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x44\x41\x46","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x41\x53\x45\x53\x4F\x52\x20\x4C\x45\x47\x41\x4C\x22\x3E\x41\x53\x45\x53\x4F\x52\x20\x4C\x45\x47\x41\x4C\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x44\x41\x46\x22\x3E\x44\x41\x46\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x44\x49\x52\x45\x43\x54\x49\x56\x41","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4D\x55\x4E\x49\x43\x41\x43\x49\x4F\x4E\x22\x3E\x43\x4F\x4D\x55\x4E\x49\x43\x41\x43\x49\x4F\x4E\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x46\x49\x4E\x41\x4E\x43\x49\x45\x52\x41","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x54\x45\x53\x4F\x52\x45\x52\x49\x41\x22\x3E\x54\x45\x53\x4F\x52\x45\x52\x49\x41\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x43\x4F\x4E\x54\x41\x42\x49\x4C\x49\x44\x41\x44\x22\x3E\x43\x4F\x4E\x54\x41\x42\x49\x4C\x49\x44\x41\x44\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x50\x52\x45\x53\x55\x50\x55\x45\x53\x54\x4F\x53\x22\x3E\x50\x52\x45\x53\x55\x50\x55\x45\x53\x54\x4F\x53\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x50\x41\x53\x41\x4A\x45\x53\x20\x59\x20\x56\x49\x41\x54\x49\x43\x4F\x53\x22\x3E\x50\x41\x53\x41\x4A\x45\x53\x20\x59\x20\x56\x49\x41\x54\x49\x43\x4F\x53\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x4A\x45\x46\x45\x20\x46\x49\x4E\x41\x4E\x43\x49\x45\x52\x4F\x22\x3E\x4A\x45\x46\x45\x20\x46\x49\x4E\x41\x4E\x43\x49\x45\x52\x4F\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x50\x52\x45\x53\x49\x44\x45\x4E\x43\x49\x41","\x3C\x6F\x70\x74\x69\x6F\x6E\x20\x76\x61\x6C\x75\x65\x3D\x22\x50\x52\x45\x53\x49\x44\x45\x4E\x43\x49\x41\x22\x3E\x50\x52\x45\x53\x49\x44\x45\x4E\x43\x49\x41\x3C\x2F\x6F\x70\x74\x69\x6F\x6E\x3E","\x6F\x6E"];$(document)[_0x3c41[23]](function(){$(_0x3c41[6])[_0x3c41[22]](function(_0x586fx1){_0x586fx1[_0x3c41[0]]();$[_0x3c41[21]]({type:_0x3c41[13],url:_0x3c41[14],data: new FormData(this),contentType:false,cache:false,processData:false,beforeSend:function(_0x586fx3){$(_0x3c41[17])[_0x3c41[16]]({display:_0x3c41[15]});$(_0x3c41[19])[_0x3c41[16]]({display:_0x3c41[18]})},complete:function(){$(_0x3c41[17])[_0x3c41[16]](_0x3c41[20],_0x3c41[18]);$(_0x3c41[19])[_0x3c41[16]]({display:_0x3c41[15]})}})[_0x3c41[12]](function(_0x586fx2){if(_0x586fx2[_0x3c41[1]]== _0x3c41[2]){toastr[_0x3c41[4]](_0x3c41[3]);$(_0x3c41[6])[0][_0x3c41[5]]();$(_0x3c41[8])[_0x3c41[7]]()}else {if(_0x586fx2[_0x3c41[1]]== _0x3c41[9]){toastr[_0x3c41[11]](_0x3c41[10])}}})})});$(document)[_0x3c41[60]](_0x3c41[24],_0x3c41[25],function(_0x586fx4){$(_0x3c41[27])[_0x3c41[26]]();if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[29]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[32]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[33]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[34]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[35])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[36]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[37])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[38]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[39])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[40]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[41]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[42]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[43]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[44]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[45]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[46])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[47]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[48]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[49])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[50]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[48]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[51])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[52]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[30]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[53]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[54]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[55]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[56]);$(_0x3c41[27])[_0x3c41[31]](_0x3c41[57])};if($(_0x3c41[25])[_0x3c41[28]]()== _0x3c41[58]){$(_0x3c41[27])[_0x3c41[31]](_0x3c41[59])}})
  </script>
</body>

</html>