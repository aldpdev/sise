<?php include_once('header.php');
include_once("./enlace.php");
?>
<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALDP</title>
  <link rel="stylesheet" href="./lib/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="./tm/toastr.scss" rel="stylesheet" />
  <style>
    body {
      background: #EAEAEA;
      color: #fff;
    }
  </style>
</head>
=======
>>>>>>> 584bc83b5f0f7151375c34307486e53fd8637b16

<body>
  <?php include_once('menu.php'); ?>

  <h2 class="text-center">OTROS DOCUMENTOS DE ENTRADA REGISTRADOS</h2>

  <div class="row">
    <div class="col-lg-12">
      <table id="tablaareas" class="table table-sm table-striped table-bordered table-condensed table-dark table-hover" style="width:100%">
        <thead class="text-center">
          <tr>
            <th>id</th>
            <th>GRUPO</th>
            <th>UNIDAD</th>
            <th>DESCRIPCION</th>
            <th>GESTION</th>
            <th>FOJAS</th>
            <th>TIPO ARCHIVO</th>
            <th>FECHA INGRESO</th>
            <th>OBSERVACION</th>
            <th>ARCHIVO</th>
            <th>ESTADO</th>
            <th style="width: 100px;">OPERACIONES</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>


  <div class="modal fade modal-fullscreen" id="visualizardocumentomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Visualizando el documento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="divisiondocumento" style="height: 100vh;">
          <embed id="pdfvisor" width="100%" height="100%" src="" class="maximo" type="application/pdf" />
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade modal-fullscreen" id="userinvitado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content text-dark">
        <div class="modal-header">
          <h5 class="modal-title ">Credenciales de ingreso como invitado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5 id="invitadouser"></h5>
          <h5 id="invitadopassword"></h5>
        </div>
      </div>
    </div>
  </div>



  <!--modals show!-->
  <div class="modal fade text-dark" id="compartirarchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Compartir Documento</h5>

        </div>
        <div class="modal-body">
          <div id="carga" class="text-center" style="display:none;">
            <img src="./imagenes/cargando.gif" />
          </div>

          <form id="registrarcompartir" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="gestion" name="gestion" required>
            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="fojas" name="fojas" required>
            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="tipo_archivo" name="tipo_archivo" required>
            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>

            <div class="form-group">
              <label for="nombresolicitante">NOMBRE SOLICITANTE</label>
              <input type="text" style="text-transform: uppercase;" class="form-control" id="nombresolicitante" name="nombresolicitante" required data-toggle="popover" data-content="Este campo es requerido">
            </div>

            <div class="form-group">
              <label for="unidad">UNIDAD</label>
              <select class="form-control" id="unidad" name="unidad" required data-toggle="popover" data-content="Este campo es requerido">
                <option></option>
                <?php
                $sql = "SELECT * FROM clasificacion ORDER BY nombrearea_clasificacion";
                $resultconsult = $conn->query($sql);
                while ($row = $resultconsult->fetch_assoc()) {
                  echo '<option value="' . $row['idclasificacion'] . '">' . $row['nombrearea_clasificacion'] . '</option>';
                }
                $conn->close();
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="documentodetalle">DETALLE</label>
              <textarea class="form-control" hidden style="text-transform: uppercase;" id="documentodetalle" name="documentodetalle" rows="2" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
              <textarea class="form-control" disabled style="text-transform: uppercase;" id="documentodetalle1" name="documentodetalle1" rows="2" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
              <input type="hidden" style="text-transform: uppercase;" class="form-control" id="id_documento" name="id_documento" required>

            </div>

            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="fechaprestamo">FECHA PRESTAMO</label>
                  <input type="date" style="text-transform: uppercase;" class="form-control" id="fechaprestamo" name="fechaprestamo" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="fechalimite">FECHA LIMITE</label>
                  <input type="date" style="text-transform: uppercase;" class="form-control" id="fechalimite" name="fechalimite" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="motivo">MOTIVO - DESTINO</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="motivo" name="motivo" rows="2" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
            </div>

            <div class="form-group">
              <label for="observacion">OBSERVACION</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="observacion" name="observacion" rows="2" data-toggle="popover" data-content="Este campo es requerido"></textarea>
            </div>
            <div>
              <input type="hidden" style="text-transform: uppercase;" class="form-control" id="unidadtext" name="unidadtext" required>
              <input type="hidden" class="form-control" id="archivo" name="archivo" required>
            </div>

            <div class="form-row">
              <div class="col">
                <button type="button" id="cancelar" class="btn btn-warning btn-block" data-dismiss="modal" aria-label="Close">
                  CANCELAR
                </button>
              </div>
              <div class="col">
                <button type="submit" id="botonregistrarcompartir" class="btn btn-primary btn-block">REGISTRAR</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="./lib/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="./lib/datatables.min.js"></script>
  <script src="./tm/toastr.js"></script>
  <script>
    $(document).ready(function() {
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
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
        placement: 'top',
        trigger: 'hover'
      })
    })
  </script>
  <script>
   var _0x66d8=["\x2E\x2F\x6C\x69\x62\x2F\x53\x70\x61\x6E\x69\x73\x68\x2E\x6A\x73\x6F\x6E","\x41\x52\x43\x48\x49\x56\x41\x44\x4F","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x30\x30\x38\x37\x30\x43","\x63\x73\x73","\x74\x64","\x66\x69\x6E\x64","\x23\x46\x46\x30\x30\x30\x30","\x53\x65\x72\x76\x65\x72\x53\x69\x64\x65\x2F\x64\x74\x6C\x69\x73\x74\x61\x65\x6E\x74\x72\x61\x64\x61\x73\x6F\x2E\x70\x68\x70","\x72\x6F\x77","","\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x22\x20\x74\x69\x74\x6C\x65\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x20\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x22\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x69\x6E\x66\x6F\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x20\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x73\x20\x66\x61\x2D\x65\x79\x65\x22\x20\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E\x20","\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x22\x20\x74\x69\x74\x6C\x65\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x20\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x22\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x69\x6E\x66\x6F\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x20\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x73\x20\x66\x61\x2D\x65\x79\x65\x22\x20\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x63\x6F\x6D\x70\x61\x72\x74\x69\x72\x22\x20\x74\x69\x74\x6C\x65\x3D\x22\x63\x6F\x6D\x70\x61\x72\x74\x69\x72\x20\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x22\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x73\x75\x63\x63\x65\x73\x73\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x2D\x73\x6F\x6C\x69\x64\x20\x66\x61\x2D\x73\x68\x61\x72\x65\x2D\x66\x72\x6F\x6D\x2D\x73\x71\x75\x61\x72\x65\x22\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E","\x23\x74\x61\x62\x6C\x61\x61\x72\x65\x61\x73","\x63\x6C\x69\x63\x6B","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63","\x64\x61\x74\x61","\x70\x61\x72\x65\x6E\x74\x73","\x73\x72\x63","\x2E\x2F\x64\x69\x67\x69\x74\x61\x6C\x69\x7A\x61\x64\x6F\x73\x2F","\x61\x74\x74\x72","\x23\x70\x64\x66\x76\x69\x73\x6F\x72","\x73\x68\x6F\x77","\x6D\x6F\x64\x61\x6C","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x6D\x6F\x64\x61\x6C","\x6F\x6E","\x23\x74\x61\x62\x6C\x61\x61\x72\x65\x61\x73\x20\x74\x62\x6F\x64\x79","\x23\x63\x6F\x6D\x70\x61\x72\x74\x69\x72","\x23\x63\x6F\x6D\x70\x61\x72\x74\x69\x72\x61\x72\x63\x68\x69\x76\x6F","\x76\x61\x6C","\x23\x67\x65\x73\x74\x69\x6F\x6E","\x23\x66\x6F\x6A\x61\x73","\x23\x74\x69\x70\x6F\x5F\x61\x72\x63\x68\x69\x76\x6F","\x23\x66\x65\x63\x68\x61\x5F\x69\x6E\x67\x72\x65\x73\x6F","\x23\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x64\x65\x74\x61\x6C\x6C\x65","\x23\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x64\x65\x74\x61\x6C\x6C\x65\x31","\x23\x69\x64\x5F\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F","\x23\x61\x72\x63\x68\x69\x76\x6F","\x72\x65\x61\x64\x79","\x72\x65\x73\x65\x74","\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x63\x6F\x6D\x70\x61\x72\x74\x69\x72","\x23\x63\x61\x6E\x63\x65\x6C\x61\x72","\x63\x68\x61\x6E\x67\x65","\x23\x75\x6E\x69\x64\x61\x64","\x74\x65\x78\x74","\x23\x75\x6E\x69\x64\x61\x64\x20\x6F\x70\x74\x69\x6F\x6E\x3A\x73\x65\x6C\x65\x63\x74\x65\x64","\x23\x75\x6E\x69\x64\x61\x64\x74\x65\x78\x74","\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x4F\x50\x45\x52\x41\x43\x49\x4F\x4E","\x4F\x4B","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61","\x73\x75\x63\x63\x65\x73\x73","\x68\x69\x64\x65","\x72\x65\x6C\x6F\x61\x64","\x61\x6A\x61\x78","\x23\x75\x73\x65\x72\x69\x6E\x76\x69\x74\x61\x64\x6F","\x55\x53\x55\x41\x52\x49\x4F\x3A\x20","\x55\x53\x55\x41\x52\x49\x4F","\x23\x69\x6E\x76\x69\x74\x61\x64\x6F\x75\x73\x65\x72","\x43\x4F\x4E\x54\x52\x41\x53\x45\xD1\x41\x3A\x20","\x50\x41\x53\x53\x57\x4F\x52\x44","\x23\x69\x6E\x76\x69\x74\x61\x64\x6F\x70\x61\x73\x73\x77\x6F\x72\x64","\x56\x65\x72\x69\x66\x69\x71\x75\x65\x20\x6C\x6F\x73\x20\x64\x61\x74\x6F\x73","\x77\x61\x72\x6E\x69\x6E\x67","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x5F\x63\x6F\x6D\x70\x61\x72\x74\x69\x72\x6F\x2E\x70\x68\x70","\x62\x6C\x6F\x63\x6B","\x23\x63\x61\x72\x67\x61","\x6E\x6F\x6E\x65","\x64\x69\x73\x70\x6C\x61\x79","\x73\x75\x62\x6D\x69\x74"];$(document)[_0x66d8[38]](function(){var _0xda9bx1=$(_0x66d8[13]).DataTable({"\x6C\x61\x6E\x67\x75\x61\x67\x65":{"\x75\x72\x6C":_0x66d8[0]},rowCallback:function(_0xda9bx2,_0xda9bx3){if(_0xda9bx3[10]== _0x66d8[1]){$($(_0xda9bx2)[_0x66d8[6]](_0x66d8[5])[8])[_0x66d8[4]](_0x66d8[2],_0x66d8[3])}else {$($(_0xda9bx2)[_0x66d8[6]](_0x66d8[5])[8])[_0x66d8[4]](_0x66d8[2],_0x66d8[7])}},"\x70\x72\x6F\x63\x65\x73\x73\x69\x6E\x67":true,"\x73\x65\x72\x76\x65\x72\x53\x69\x64\x65":true,"\x73\x41\x6A\x61\x78\x53\x6F\x75\x72\x63\x65":_0x66d8[8],"\x63\x6F\x6C\x75\x6D\x6E\x44\x65\x66\x73":[{targets:0,visible:false},{targets:9,visible:false},{targets:[0,1,,2,4,5,6,7,8,9],searchable:false},{targets:-1,orderable:false,data:null,render:function(_0xda9bx3,_0xda9bx4,_0xda9bx2,_0xda9bx5){let _0xda9bx6=_0xda9bx5[_0x66d8[9]];let _0xda9bx7=_0x66d8[10];if(_0xda9bx3[10]!= _0x66d8[1]){_0xda9bx7= `${_0x66d8[11]}`}else {_0xda9bx7= `${_0x66d8[12]}`};return _0xda9bx7}}],"\x62\x44\x65\x73\x74\x72\x6F\x79":true});$(_0x66d8[26])[_0x66d8[25]](_0x66d8[14],_0x66d8[15],function(){var _0xda9bx3=_0xda9bx1[_0x66d8[9]]($(this)[_0x66d8[17]]())[_0x66d8[16]]();$(_0x66d8[21])[_0x66d8[20]](_0x66d8[18],_0x66d8[19]+ _0xda9bx3[9]);$(_0x66d8[24])[_0x66d8[23]](_0x66d8[22])});$(_0x66d8[26])[_0x66d8[25]](_0x66d8[14],_0x66d8[27],function(){var _0xda9bx3=_0xda9bx1[_0x66d8[9]]($(this)[_0x66d8[17]]())[_0x66d8[16]]();$(_0x66d8[28])[_0x66d8[23]](_0x66d8[22]);$(_0x66d8[30])[_0x66d8[29]](_0xda9bx3[4]);$(_0x66d8[31])[_0x66d8[29]](_0xda9bx3[5]);$(_0x66d8[32])[_0x66d8[29]](_0xda9bx3[6]);$(_0x66d8[33])[_0x66d8[29]](_0xda9bx3[7]);$(_0x66d8[34])[_0x66d8[29]](_0xda9bx3[3]);$(_0x66d8[35])[_0x66d8[29]](_0xda9bx3[3]);$(_0x66d8[36])[_0x66d8[29]](_0xda9bx3[0]);$(_0x66d8[37])[_0x66d8[29]](_0xda9bx3[9])})});$(document)[_0x66d8[38]](function(){$(_0x66d8[41])[_0x66d8[14]](function(){$(_0x66d8[40])[0][_0x66d8[39]]()});$(document)[_0x66d8[25]](_0x66d8[42],_0x66d8[43],function(_0xda9bx8){$(_0x66d8[46])[_0x66d8[29]]($(_0x66d8[45])[_0x66d8[44]]())})});$(document)[_0x66d8[38]](function(){$(_0x66d8[40])[_0x66d8[71]](function(_0xda9bx9){_0xda9bx9[_0x66d8[47]]();$[_0x66d8[54]]({type:_0x66d8[65],url:_0x66d8[66],data: new FormData(this),contentType:false,cache:false,processData:false,beforeSend:function(_0xda9bxa){$(_0x66d8[68])[_0x66d8[4]]({display:_0x66d8[67]});$(_0x66d8[40])[_0x66d8[4]]({display:_0x66d8[69]})},complete:function(){$(_0x66d8[68])[_0x66d8[4]](_0x66d8[70],_0x66d8[69]);$(_0x66d8[40])[_0x66d8[4]]({display:_0x66d8[67]})}})[_0x66d8[64]](function(_0xda9bx3){if(_0xda9bx3[_0x66d8[48]]== _0x66d8[49]){toastr[_0x66d8[51]](_0x66d8[50]);$(_0x66d8[40])[0][_0x66d8[39]]();$(_0x66d8[28])[_0x66d8[23]](_0x66d8[52]);$(_0x66d8[13]).DataTable()[_0x66d8[54]][_0x66d8[53]]();$(_0x66d8[55])[_0x66d8[23]](_0x66d8[22]);$(_0x66d8[58])[_0x66d8[44]](_0x66d8[56]+ _0xda9bx3[_0x66d8[57]]);$(_0x66d8[61])[_0x66d8[44]](_0x66d8[59]+ _0xda9bx3[_0x66d8[60]])}else {toastr[_0x66d8[63]](_0x66d8[62])}})})})
  </script>

</body>
<footer>
<?php
include_once('footer.php');
?>
</footer>
</html>