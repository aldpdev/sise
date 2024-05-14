<head>
  <?php require ('header.php');
  ?>
</head>

<body>
  <div class="container">
    <h3 class="text-center">Asamblea departamental de POTOSI</h3>
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
                  <textarea class="form-control" style="text-transform: uppercase;" id="origen" name="origen" rows="1"
                    required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="destinatario" class="col-sm-2 col-form-label">destinatario</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="destinatario"
                    name="destinatario" rows="1" required data-toggle="popover"
                    data-content="Este campo es requerido"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="instruccion" class="col-sm-2 col-form-label">instruccion</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="instruccion" name="instruccion"
                    rows="1" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="asunto" class="col-sm-2 col-form-label">asunto</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="asunto" name="asunto" rows="1"
                    required data-toggle="popover" data-content="Este campo es requerido"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion"
                    rows="3" required data-toggle="popover" data-content="Este campo es requerido" required></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="nhojas" class="col-sm-2 col-form-label">numero de hojas</label>
                <div class="col-sm-10">
                  <input type="number" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas"
                    required data-toggle="popover" data-content="Este campo es requerido">
                </div>
              </div>
              <div class="form-group row">
                <label for="archivo" class="col-sm-2 col-form-labell">Adjuntar</label>
                <div class="col-sm-10">
                  <input class="form-control" accept="application/pdf" type="file" id="archivo" name="archivo" required
                    data-toggle="popover" data-content="Este campo es requerido" required>
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
    $(document).ready(function () {
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
    $(function () {
      $('[data-toggle="popover"]').popover({
        placement: 'right',
        trigger: 'hover'
      })
    })
  </script>

  <script>

    $(document)["ready"(function () {
      $("#registrarentrada")["submit"](function (dataAndEvents) {
        dataAndEvents["preventDefault"]();
        $["ajax"]({
          type: "POST",
          url: "operaciones/r_entrada.php",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function (xhr) {
            $("#carga")["css"]({
              display: "block"
            });
            $("#formulario")["css"]({
              display: "none"
            });
          },
          complete: function () {
            $("#carga")["css"]("display", "none");
            $("#formulario")["css"]({
              display: "block"
            });
          }
        })["done"](function (dataAndEvents) {
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
    $(document).ready(function () {
      $('#draggable').draggable();

      $('form').droppable({
        drop: function (event, ui) {
          ui.draggable.appendTo($(this));
        }
      });
    });
  </script>




</body>
<footer>
  <?php
  include_once ('footer.php');
  ?>
</footer>

</html>