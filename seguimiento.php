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
  <link rel="stylesheet" href="./lib/bootstrap.min.css">
  <link href="./tm/toastr.scss" rel="stylesheet" />
  <style>
    body {
      background: #EAEAEA;
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
    <h3 class="text-light text-center">SEGUIMIENTO DOCUMENTACION ALDP</h3>
    <div id="carga" class="text-center" style="display:none;">
      <img src="./imagenes/cargando.gif" />
    </div>
    <div id="formulario" style="display:block">
      <form id="registrarentrada" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <div class="form-group row">
                <label for="origen" class="col-sm-2 col-form-label">origen</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="origen" name="origen" rows="1" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                </div>
              </div>
              <div class="form-group row">
                  <label for="destinatario" class="col-sm-2 col-form-label">destinatario</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" style="text-transform: uppercase;" id="destinatario" name="destinatario" rows="1" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="instruccion" class="col-sm-2 col-form-label">instruccion</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="text-transform: uppercase;" id="instruccion" name="instruccion" rows="1" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                    </div>
              </div>
              <div class="form-group row">
                  <label for="asunto" class="col-sm-2 col-form-label">asunto</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="text-transform: uppercase;" id="asunto" name="asunto" rows="1" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                    </div>
              </div>
              <div class="form-group row">
                  <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion" rows="3" required data-toggle="popover" data-content="Este campo es requerido" required></textarea>
                    </div>
              </div>
              <div class="form-group row">
                  <label for="nhojas" class="col-sm-2 col-form-label">numero de hojas</label>
                    <div class="col-sm-10">
                      <input type="number" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas" required data-toggle="popover" data-content="Este campo es requerido">
                    </div>
              </div>
              <div class="form-group row">
                  <label for="archivo" class="col-sm-2 col-form-labell">Adjuntar</label>
                    <div class="col-sm-10">  
                    <input class="form-control" accept="application/pdf" type="file" id="archivo" name="archivo" required data-toggle="popover" data-content="Este campo es requerido" required>
                    </div>
              </div>
                  </div>
                </div>
              </div>
                <div class="form-row">
                  <div class="col">
                    <button type="submit" class="btn btn-primary   btn-block">Registrar</button>
                  </div>
                </div>
      </form>
    </div>
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

  <script>
    $(function() {
      $('[data-toggle="popover"]').popover({
        placement: 'right',
        trigger: 'hover'
      })
    })
  </script>

  <script>
    var _0x2bcd = ["\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74", "\x4F\x50\x45\x52\x41\x43\x49\x4F\x4E", "\x4F\x4B", "\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61", "\x73\x75\x63\x63\x65\x73\x73", "\x72\x65\x73\x65\x74", "\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x65\x6E\x74\x72\x61\x64\x61", "\x66\x6F\x63\x75\x73", "\x23\x67\x65\x73\x74\x69\x6F\x6E", "\x45\x52\x52\x4F\x52", "\x56\x65\x72\x69\x66\x69\x71\x75\x65\x20\x6C\x6F\x73\x20\x64\x61\x74\x6F\x73", "\x77\x61\x72\x6E\x69\x6E\x67", "\x64\x6F\x6E\x65", "\x50\x4F\x53\x54", "\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x5F\x65\x6E\x74\x72\x61\x64\x61\x2E\x70\x68\x70", "\x62\x6C\x6F\x63\x6B", "\x63\x73\x73", "\x23\x63\x61\x72\x67\x61", "\x6E\x6F\x6E\x65", "\x23\x66\x6F\x72\x6D\x75\x6C\x61\x72\x69\x6F", "\x64\x69\x73\x70\x6C\x61\x79", "\x61\x6A\x61\x78", "\x73\x75\x62\x6D\x69\x74", "\x72\x65\x61\x64\x79"];
    $(document)[_0x2bcd[23]](function() {
      $(_0x2bcd[6])[_0x2bcd[22]](function(_0x465ex1) {
        _0x465ex1[_0x2bcd[0]]();
        $[_0x2bcd[21]]({
          type: _0x2bcd[13],
          url: _0x2bcd[14],
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function(_0x465ex3) {
            $(_0x2bcd[17])[_0x2bcd[16]]({
              display: _0x2bcd[15]
            });
            $(_0x2bcd[19])[_0x2bcd[16]]({
              display: _0x2bcd[18]
            })
          },
          complete: function() {
            $(_0x2bcd[17])[_0x2bcd[16]](_0x2bcd[20], _0x2bcd[18]);
            $(_0x2bcd[19])[_0x2bcd[16]]({
              display: _0x2bcd[15]
            })
          }
        })[_0x2bcd[12]](function(_0x465ex2) {
          if (_0x465ex2[_0x2bcd[1]] == _0x2bcd[2]) {
            toastr[_0x2bcd[4]](_0x2bcd[3]);
            $(_0x2bcd[6])[0][_0x2bcd[5]]();
            $(_0x2bcd[8])[_0x2bcd[7]]()
          } else {
            if (_0x465ex2[_0x2bcd[1]] == _0x2bcd[9]) {
              toastr[_0x2bcd[11]](_0x2bcd[10])
            }
          }
        })
      })
    })


    $(document)["ready"(function() {
      $("#registrarentrada")["submit"](function(dataAndEvents) {
        dataAndEvents["preventDefault"]();
        $["ajax"]({
          type: "POST",
          url: "operaciones/r_entrada.php",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function(xhr) {
            $("#carga")["css"]({
              display: "block"
            });
            $("#formulario")["css"]({
              display: "none"
            });
          },
          complete: function() {
            $("#carga")["css"]("display", "none");
            $("#formulario")["css"]({
              display: "block"
            });
          }
        })["done"](function(dataAndEvents) {
          if (dataAndEvents["OPERACION"] == "OK") {
            toastr["success"]("Operacion exitosa");
            $("#registrarentrada")[0]["reset"]();
            $("#gestion")["focus"]();
          } else {
            if (dataAndEvents["OPERACION"] == "ERROR") {
              toastr["warning"]("Verifique los datos");
            }
          }
        });
      });
    })];
  </script>

  <script>
    $(document).ready(function() {
      $('#draggable').draggable();

      $('form').droppable({
        drop: function(event, ui) {
          ui.draggable.appendTo($(this));
        }
      });
    });
  </script>




</body>

</html>