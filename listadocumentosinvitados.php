<?php include_once('header.php');
include_once("./enlace.php");
?>

<body>
  <?php include_once('menu.php'); ?>
  <h2 class="text-center">LISTA DE DOCUMENTOS</h2>
  <div class="row">
    <div class="col-lg-12">
      <table id="tablaareas" class="table table-sm table-hover table-bordered">
        <thead class="text-center">
          <tr>
            <th style="background-color:#fff;color:#000">Nro</th>
            <th style="background-color:#fff;color:#000">H.R.</th>
            <th style="background-color:#fff;color:#000">CATEGORIA</th>
            <th style="background-color:#fff;color:#000">N° DOC</th>
            <th style="background-color:#fff;color:#000">GESTION</th>
            <th style="background-color:#fff;color:#000">FECHA INGRESO</th>
            <th style="background-color:#fff;color:#000">BENEFICIARIO</th>
            <th style="background-color:#fff;color:#000">FACTURA</th>
            <th style="background-color:#fff;color:#000">RECIBO</th>
            <th style="background-color:#fff;color:#000">FOJAS</th>
            <th style="background-color:#fff;color:#000">DESCRIPCION</th>
            <th style="background-color:#fff;color:#000">OBJETO DE GASTO</th>
            <th style="background-color:#fff;color:#000">OBSERVACION</th>
            <th hidden>ARCHIVO</th>
            <th style="width: 100px; background-color:#fff; color:#000">OPERACIONES</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM controlentrada INNER JOIN formulario ON controlentrada.idcontrolentrada = formulario.id_documento_formulario  WHERE controlentrada.estado_controlentrada ='COMPARTIDO' AND formulario.sigla_formulario='" . $_SESSION['usuario'] . "'  AND formulario.fecha_devolucion_formulario IS NULL";
          $resultconsult = $conn->query($sql);
          $numero = 0;
          while ($row = $resultconsult->fetch_assoc()) {

            $limite = new DateTime($row['fecha_limite_formulario']);
            $actual = new DateTime(date('Y-m-d'));

            if ($limite >= $actual) {
              $numero += 1;
              echo '<tr>
              <td style="background-color:#fff;color:#000">' . $numero . '</td>
              <td>' . $row['hoja_controlentrada'] . '</td>
              <td>' . $row['categoria_controlentrada'] . '</td>
              <td>' . $row['numdoc_controlentrada'] . '</td>            
              <td>' . $row['gestion_controlentrada'] . '</td>
              <td>' . $row['fechafecha_controlentrada'] . '</td>
              <td>' . $row['beneficiario_controlentrada'] . '</td>
              <td>' . $row['factura_controlentrada'] . '</td>
              <td>' . $row['recibo_controlentrada'] . '</td>
              <td>' . $row['fojas_controlentrada'] . '</td>
              <td>' . $row['descripcion_controlentrada'] . '</td>
              <td>' . $row['gasto_controlentrada'] . '</td>
              <td>' . $row['observacion_controlentrada'] . '</td>
              <td hidden>' . $row['archivo'] . '</td>
              <td> <button id="visualizardoc" title="visualizar documento" class="btn btn-info btn-circle">
              <i class="fas fa-eye" ></i>
              </button></td>
              </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <h2 class="text-center">LISTA DE OTROS DOCUMENTOS</h2>
  <div class="row">
    <div class="col-lg-12">
      <table id="tablaareas1" class="table table-sm table-hover table-bordered">
        <thead class="text-center">
          <tr>
            <th style="background-color:#fff;color:#000">Nro</th>
            <th style="background-color:#fff;color:#000">GRUPO</th>
            <th style="background-color:#fff;color:#000">UNIDAD</th>            
            <th style="background-color:#fff;color:#000">GESTION</th>
            <th style="background-color:#fff;color:#000">FECHA INGRESO</th>
            <th style="background-color:#fff;color:#000">FOJAS</th>
            <th style="background-color:#fff;color:#000">TIPOR ARCHIVO</th>
            <th style="background-color:#fff;color:#000">DESCRIPCION</th>
            <th style="background-color:#fff;color:#000">OBSERVACION</th>
            <th hidden>ARCHIVO</th>
            <th style="width: 100px; background-color:#fff; color:#000">OPERACIONES</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM controlentradao INNER JOIN formularioo ON controlentradao.idcontrolentradao = formularioo.id_documento_formularioo  WHERE controlentradao.estado_controlentradao ='COMPARTIDO' AND formularioo.sigla_formularioo='" . $_SESSION['usuario'] . "'  AND formularioo.fecha_devolucion_formularioo IS NULL";
          $resultconsult = $conn->query($sql);
          $numero = 0;
          while ($row = $resultconsult->fetch_assoc()) {

            $limite = new DateTime($row['fecha_limite_formularioo']);
            $actual = new DateTime(date('Y-m-d'));

            if ($limite >= $actual) {
              $numero += 1;
              echo '<tr>
              <td style="background-color:#fff;color:#000">' . $numero . '</td>    
              <td>' . $row['grupo_controlentradao'] . '</td>
              <td>' . $row['unidad_controlentradao'] . '</td>
              <td>' . $row['gestion_controlentradao'] . '</td>
              <td>' . $row['fecha_formularioo'] . '</td>
              <td>' . $row['fojas_controlentradao'] . '</td>
              <td>' . $row['tipo_controlentradao'] . '</td>
              <td>' . $row['descripcion_controlentradao'] . '</td>
              <td>' . $row['observacion_controlentradao'] . '</td>
              <td hidden>' . $row['archivo_controlentrada'] . '</td>
              <td> <button id="visualizardoc1" title="visualizar documento" class="btn btn-info btn-circle">
              <i class="fas fa-eye" ></i>
              </button></td>
              </tr>';
            }
          }
          $conn->close();
          ?>
        </tbody>
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
        "hideDuration": "1fff",
        "timeOut": "2fff",
        "extendedTimeOut": "1fff",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    });
  </script>

  <script>
    var _0x4745=["\x63\x6C\x69\x63\x6B","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63","","\x68\x74\x6D\x6C","\x7C","\x65\x61\x63\x68","\x74\x64","\x66\x69\x6E\x64","\x74\x72","\x70\x61\x72\x65\x6E\x74\x73","\x73\x70\x6C\x69\x74","\x73\x72\x63","\x2E\x2F\x64\x69\x67\x69\x74\x61\x6C\x69\x7A\x61\x64\x6F\x73\x2F","\x61\x74\x74\x72","\x23\x70\x64\x66\x76\x69\x73\x6F\x72","\x73\x68\x6F\x77","\x6D\x6F\x64\x61\x6C","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x6D\x6F\x64\x61\x6C","\x6F\x6E","\x23\x74\x61\x62\x6C\x61\x61\x72\x65\x61\x73\x20\x74\x62\x6F\x64\x79","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x31","\x23\x74\x61\x62\x6C\x61\x61\x72\x65\x61\x73\x31\x20\x74\x62\x6F\x64\x79","\x72\x65\x61\x64\x79"];$(document)[_0x4745[22]](function(){$(_0x4745[19])[_0x4745[18]](_0x4745[0],_0x4745[1],function(){var _0xd248x1=_0x4745[2];$(this)[_0x4745[9]](_0x4745[8])[_0x4745[7]](_0x4745[6])[_0x4745[5]](function(){_0xd248x1+= $(this)[_0x4745[3]]()+ _0x4745[4]});var _0xd248x2=_0xd248x1[_0x4745[10]](_0x4745[4]);$(_0x4745[14])[_0x4745[13]](_0x4745[11],_0x4745[12]+ _0xd248x2[13]);$(_0x4745[17])[_0x4745[16]](_0x4745[15])});$(_0x4745[21])[_0x4745[18]](_0x4745[0],_0x4745[20],function(){var _0xd248x1=_0x4745[2];$(this)[_0x4745[9]](_0x4745[8])[_0x4745[7]](_0x4745[6])[_0x4745[5]](function(){_0xd248x1+= $(this)[_0x4745[3]]()+ _0x4745[4]});var _0xd248x2=_0xd248x1[_0x4745[10]](_0x4745[4]);$(_0x4745[14])[_0x4745[13]](_0x4745[11],_0x4745[12]+ _0xd248x2[9]);$(_0x4745[17])[_0x4745[16]](_0x4745[15])})})
  </script>
</body>

</html>