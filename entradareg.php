<?php include_once('header.php');

?>

<body>
  <?php include_once('menu.php'); ?>

  <div class="container">
    <h3 class="text-center">REGISTRO DE ENTRADA DE DOCUMENTACION</h3>
    <div id="carga" class="text-center" style="display:none;">
      <img src="./imagenes/cargando.gif" />
    </div>
    <div id="formulario" style="display:block">
      <form id="registrarentrada" method="post" enctype="multipart/form-data">
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
              <label for="nombre">Nº Hoja Ruta</label>
              <input type="number" style="text-transform: uppercase;" class="form-control" id="nhoja" name="nhoja" required data-toggle="popover" data-content="Este campo es requerido">
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
              <input type="number" style="text-transform: uppercase;" class="form-control" id="ndocumento" name="ndocumento" required data-toggle="popover" data-content="Este campo es requerido">
            </div>
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
              <label for="beneficiario">Beneficiario</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="beneficiario" name="beneficiario" rows="1" required data-toggle="popover" data-content="Este campo es requerido"></textarea>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="nfactura">Factura</label>
              <input type="text" style="text-transform: uppercase;" class="form-control" id="nfactura" name="nfactura">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="nrecibo">Recibo</label>
              <input type="text" style="text-transform: uppercase;" class="form-control" id="nrecibo" name="nrecibo">
            </div>

          </div>
          <div class="col">
            <div class="form-group">
              <label for="nhojas">Fojas</label>
              <input type="number" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas" required data-toggle="popover" data-content="Este campo es requerido">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="descripcion">Descripcion</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion" rows="3" required data-toggle="popover" data-content="Este campo es requerido" required></textarea>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="objeto">Objeto del Gasto</label>
              <textarea class="form-control" style="text-transform: uppercase;" id="objeto" name="objeto" rows="2" required data-toggle="popover" data-content="Este campo es requerido" required></textarea>
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
    var _0x2bcd=["\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x4F\x50\x45\x52\x41\x43\x49\x4F\x4E","\x4F\x4B","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61","\x73\x75\x63\x63\x65\x73\x73","\x72\x65\x73\x65\x74","\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x65\x6E\x74\x72\x61\x64\x61","\x66\x6F\x63\x75\x73","\x23\x67\x65\x73\x74\x69\x6F\x6E","\x45\x52\x52\x4F\x52","\x56\x65\x72\x69\x66\x69\x71\x75\x65\x20\x6C\x6F\x73\x20\x64\x61\x74\x6F\x73","\x77\x61\x72\x6E\x69\x6E\x67","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x5F\x65\x6E\x74\x72\x61\x64\x61\x2E\x70\x68\x70","\x62\x6C\x6F\x63\x6B","\x63\x73\x73","\x23\x63\x61\x72\x67\x61","\x6E\x6F\x6E\x65","\x23\x66\x6F\x72\x6D\x75\x6C\x61\x72\x69\x6F","\x64\x69\x73\x70\x6C\x61\x79","\x61\x6A\x61\x78","\x73\x75\x62\x6D\x69\x74","\x72\x65\x61\x64\x79"];$(document)[_0x2bcd[23]](function(){$(_0x2bcd[6])[_0x2bcd[22]](function(_0x465ex1){_0x465ex1[_0x2bcd[0]]();$[_0x2bcd[21]]({type:_0x2bcd[13],url:_0x2bcd[14],data: new FormData(this),contentType:false,cache:false,processData:false,beforeSend:function(_0x465ex3){$(_0x2bcd[17])[_0x2bcd[16]]({display:_0x2bcd[15]});$(_0x2bcd[19])[_0x2bcd[16]]({display:_0x2bcd[18]})},complete:function(){$(_0x2bcd[17])[_0x2bcd[16]](_0x2bcd[20],_0x2bcd[18]);$(_0x2bcd[19])[_0x2bcd[16]]({display:_0x2bcd[15]})}})[_0x2bcd[12]](function(_0x465ex2){if(_0x465ex2[_0x2bcd[1]]== _0x2bcd[2]){toastr[_0x2bcd[4]](_0x2bcd[3]);$(_0x2bcd[6])[0][_0x2bcd[5]]();$(_0x2bcd[8])[_0x2bcd[7]]()}else {if(_0x465ex2[_0x2bcd[1]]== _0x2bcd[9]){toastr[_0x2bcd[11]](_0x2bcd[10])}}})})})


    $(document)["ready"(function() {
      $("#registrarentrada")["submit"](function(dataAndEvents) {
        dataAndEvents["preventDefault"]();
        $["ajax"]({
          type : "POST",
          url : "operaciones/r_entrada.php",
          data : new FormData(this),
          contentType : false,
          cache : false,
          processData : false,
          beforeSend : function(xhr) {
            $("#carga")["css"]({
              display : "block"
            });
            $("#formulario")["css"]({
              display : "none"
            });
          },
          complete : function() {
            $("#carga")["css"]("display", "none");
            $("#formulario")["css"]({
              display : "block"
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
<footer>
<?php
include_once('footer.php');
?>
</footer>
</html>
