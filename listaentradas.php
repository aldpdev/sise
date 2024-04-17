<?php include_once('header.php');
include_once("./enlace.php");
?>
<body>
  <?php include_once('menu.php'); ?>

  <h2 class="text-center">DOCUMENTOS DE ENTRADA REGISTRADOS</h2>

  <div class="row">
    <div class="table-responsive text-justify">
      <div class="col-lg-12 "  >

        <table id="tablaareas" class="table table-sm table-striped table-bordered table-condensed table-secondary table-hover" data-target="#grandparentContent" data-toggle="collapse" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>id</th>
              <th>H.R.</th>
              <th>CATEGORIA</th>
              <th>N° DOC</th>
              <th>GESTION <BR>
              <select name="tablaareas_length" aria-controls="tablaareas" class="custom-select custom-secondary custom-select-sm form-control form-control-sm">
                <option value="2023">2023</option><option value="2022">2022</option><option value="2021">2021</option></select></th>
              <th>FECHA INGRESO</th>
              <th>BENEFICIARIO</th>
              <th>FACTURA</th>
              <th>RECIBO</th>
              <th>FOJAS</th>
              <th>DESCRIPCION</th>
              <th>OBJETO DE GASTO</th>
              <th>OBSERVACION</th>
              <th>ARCHIVO</th>
              <th>ESTADO</th>
              <th style="width: 50px;">OPERACIONES</th>
            </tr>
          </thead>
        </table>
      </div>
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


            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="hr" name="hr" required>
            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="categoria" name="categoria" required>
            <input type="hidden" style="text-transform: uppercase;" class="form-control" id="num_doc" name="num_doc" required>

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
  <script src="./lib/popper.min.js">
  </script>
  <script src="./lib/bootstrap.min.js">
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
    $(document).ready(function() {
      var table = $("#tablaareas").DataTable({
        "language": {
          "url": "./lib/Spanish.json"
        },
        rowCallback: function(row, data) {
          if (data[14] == "ARCHIVADO") {
            $($(row).find("td")[12]).css("background-color", "#00870C");
          } else {
            $($(row).find("td")[12]).css("background-color", "#FF0000");
          }
        },
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "ServerSide/dtlistaentradas.php",
        "columnDefs": [{
            targets: 0,
            visible: false
          }, {
            targets: 13,
            visible: false,
          }, {
            targets: [0, 2, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15],
            searchable: false
          },
          {
            targets: -1,
            orderable: false,
            data: null,
            render: function(data, type, row, meta) {
              let fila = meta.row;
              let botones = "";
              if (data[14] != "ARCHIVADO") {
                botones = `
                        <button id="visualizardoc" title="visualizar documento" class='btn btn-info btn-circle' >
                        <i class="fas fa-eye" ></i>
                        </button> `;
              } else {
                botones = `
                        <button id="modificar" title="modificar entrada" class='btn btn-warning btn-circle' >
                        <i class="fas fa-edit" ></i>
                        </button><BR>
                        <button id="visualizardoc" title="visualizar documento" class='btn btn-info btn-circle' >
                        <i class="fas fa-eye" ></i>
                        </button><BR>
                        <button id="compartir" title="compartir documento" class='btn btn-success btn-circle'>
                        <i class="fa-solid fa-share-from-square"></i>
                        </button>`;

              }

              return botones;
            }
          }
        ],
        "bDestroy": true
      });

      $('#tablaareas tbody').on('click', '#visualizardoc', function() {
        var data = table.row($(this).parents()).data();
        $("#pdfvisor").attr("src", "./digitalizados/" + data[13]);
        $("#visualizardocumentomodal").modal("show");
      });

      $('#tablaareas tbody').on('click', '#modificar', function() {
        var data = table.row($(this).parents()).data();
        $(location).attr('href', "./modificarentrada?id=" + data[0]);
      });

      $('#tablaareas tbody').on('click', '#compartir', function() {
        var data = table.row($(this).parents()).data();
        $("#compartirarchivo").modal("show");
        $("#documentodetalle").val(data[10]);
        $("#documentodetalle1").val(data[10]);
        $("#id_documento").val(data[0]);
        $("#archivo").val(data[13]);
        $("#hr").val(data[1]);
        $("#categoria").val(data[2]);
        $("#num_doc").val(data[3]);
      });
    });

    $(document).ready(function() {
      $("#cancelar").click(function() {
        $("#registrarcompartir")[0].reset()
      });

      $(document).on('change', '#unidad', function(event) {
        $('#unidadtext').val($("#unidad option:selected").text());
      });

    });
  </script>


  <script>
    $(document).ready(function() {
      $("#registrarcompartir").submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: 'operaciones/r_compartir.php',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function(objeto) {
            $('#carga').css({
              display: 'block'
            });
            $('#registrarcompartir').css({
              display: 'none'
            });
          },
          complete: function() {
            $('#carga').css('display', 'none');
            $('#registrarcompartir').css({
              display: 'block'
            });
          }
        }).done(function(data) {
          if (data.OPERACION == "OK") {
            toastr["success"]("Operacion exitosa");
            $('#registrarcompartir')[0].reset();
            $("#compartirarchivo").modal("hide");
            $('#tablaareas').DataTable().ajax.reload();
            $("#userinvitado").modal("show");
            $("#invitadouser").text("USUARIO: " + data.USUARIO);
            $("#invitadopassword").text("CONTRASEÑA: " + data.PASSWORD);
          } else {
            toastr["warning"]("Verifique los datos");
          }
        });
        //1f
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