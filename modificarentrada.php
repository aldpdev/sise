<?php include_once('header.php');
include_once("./enlace.php");
?>

<body>
  <?php include_once('menu.php'); ?>

  <div class="container">
    <h3 class=" text-center">ACTUALIZAR REGISTRO DE ENTRADA DE DOCUMENTACION</h3>
    <div id="carga" class="text-center" style="display:none;">
      <img src="./imagenes/cargando.gif" />
    </div>
    <div id="formulario" style="display:block">

      <?php

      $sql = "SELECT * FROM controlentrada WHERE  idcontrolentrada='" . $_GET['id'] . "';";
      $resultuser = $conn->query($sql);
      while ($row = $resultuser->fetch_assoc()) {
      ?>
        <form id="actualizarentrada" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="gestion">GESTION</label>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" style="text-transform: uppercase;" class="form-control" id="identrada" name="identrada" required data-toggle="popover" data-content="Este campo es requerido">

                <input type="number" value="<?php echo $row['gestion_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="gestion" name="gestion" required data-toggle="popover" data-content="Este campo es requerido">

              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="nombre">Nº Hoja Ruta</label>
                <input type="number" value="<?php echo $row['hoja_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="nhoja" name="nhoja" required data-toggle="popover" data-content="Este campo es requerido">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="exampleSelect">Documento</label>
                <select class="form-control" id="tipodocumento" name="tipodocumento" required data-toggle="popover" data-content="Este campo es requerido">
                  <option></option>
                  <option value="PREVENTIVO">PREVENTIVO</option>
                  <option value="LEY">LEY</option>
                  <option value="RESOLUCION">RESOLUCION</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="ndocumento">Nro. Documento</label>
                <input type="number" value="<?php echo $row['numdoc_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="ndocumento" name="ndocumento" required data-toggle="popover" data-content="Este campo es requerido">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="fingreso">Fecha de Ingreso</label>
                <input type="date" value="<?php echo $row['fechafecha_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="fingreso" name="fingreso" required data-toggle="popover" data-content="Este campo es requerido">

              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="beneficiario">Beneficiario</label>
                <textarea class="form-control" style="text-transform: uppercase;" id="beneficiario" name="beneficiario" rows="1" required data-toggle="popover" data-content="Este campo es requerido"><?php echo utf8_encode($row['beneficiario_controlentrada']) ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="nfactura">Factura</label>
                <input type="text" value="<?php echo $row['factura_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="nfactura" name="nfactura">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="nrecibo">Recibo</label>
                <input type="text" value="<?php echo $row['recibo_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="nrecibo" name="nrecibo">
              </div>

            </div>
            <div class="col">
              <div class="form-group">
                <label for="nhojas">Fojas</label>
                <input type="number" value="<?php echo $row['fojas_controlentrada'] ?>" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas" required data-toggle="popover" data-content="Este campo es requerido">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion" rows="3" required data-toggle="popover" data-content="Este campo es requerido" required><?php echo utf8_encode($row['descripcion_controlentrada']) ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="objeto">Objeto del Gasto</label>
                <textarea class="form-control" style="text-transform: uppercase;" id="objeto" name="objeto" rows="2" required data-toggle="popover" data-content="Este campo es requerido" required><?php echo utf8_encode($row['gasto_controlentrada']) ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="observacion">Observacion</label>
                <textarea class="form-control" style="text-transform: uppercase;" id="observacion" name="observacion" rows="5"><?php echo utf8_encode($row['observacion_controlentrada']) ?></textarea>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="archivo" class="form-label">Archivo digitalizado</label>
                <input type="text" value="<?php echo $row['archivo'] ?>" class="form-control" id="archivoold" name="archivoold">
                <p class="text-light">Cargar nuevo archivo? <input type="checkbox" name="nuevoarchivo" id="nuevoarchivo">
                <p>
                  <input class="form-control" accept="application/pdf" type="file" id="archivo" name="archivo" required data-toggle="popover" data-content="Este campo es requerido" required disabled>
              </div>
            </div>
          </div>
        <?php
      }
        ?>

        <div class="form-row">
          <div class="col">
            <button type="button" onclick="$(location).attr('href','listaentradas')" class="btn btn-danger btn-block">Volver</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-success btn-block">Actualizar</button>
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


    var checkBox = document.querySelector('#nuevoarchivo');
    checkBox.addEventListener('change', verificarEstado, false);

    function verificarEstado(e) {
      if (e.target.checked) {
        document.querySelector('#archivo').disabled = false;
      } else {
        document.querySelector('#archivo').disabled = true;
      }
    }
  </script>

  <script>
    $(document).ready(function() {
      $("#actualizarentrada").submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: 'operaciones/a_entrada.php',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function(objeto) {
            $('#carga').css({
              display: 'block'
            });
            $('#formulario').css({
              display: 'none'
            });
          },
          complete: function() {
            $('#carga').css('display', 'none');
            $('#formulario').css({
              display: 'block'
            });
          }
        }).done(function(data) {
          if (data.OPERACION == "OK") {
            toastr["success"]("Actualizacion Correcta \n Redireccionando...");
            setTimeout(function() {
              $(location).attr('href', "./listaentradas");
            }, 1000);
          } else if (data.OPERACION == "ERROR") {
            toastr["warning"]("Error al realizar la actualizacion");
          }
        });
        //1f
      });
    });
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

<footer>
<?php
include_once('footer.php');
?>
</footer>
</html>