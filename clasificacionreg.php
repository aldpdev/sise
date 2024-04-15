<?php include_once('header.php');
?>

<body>
  <?php include_once('menu.php'); ?>

  <div class="container">
    <h3 class="text-light text-center">REGISTRO DE AREA, UNIDAD FUNCIONAL O COMISION DE LA ALDP</h3>
    <form id="registrararea">
      <div class="form-group">
        <label for="nombre">Nombre Area</label>
        <input type="text" style="text-transform: uppercase;" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del area" required data-toggle="popover" data-content="Este campo es requerido">
      </div>
      <div class="form-group">
        <label for="sigla">Sigla</label>
        <input type="text" style="text-transform: uppercase;" class="form-control" id="sigla" name="sigla" placeholder="Ingrese la sigla" required data-toggle="popover" data-content="Este campo es requerido">
      </div>
      <div class="form-group">
        <label for="codigo">Código</label>
        <input type="text" style="text-transform: uppercase;" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el código" data-toggle="popover">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Registrar</button>

      <div id="mensaje" class="mt-3"></div>
    </form>
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
        placement: 'right',
        trigger: 'hover'
      })
    })
  </script>

  <script>
    var _0x557b=["\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x73\x65\x72\x69\x61\x6C\x69\x7A\x65","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x72\x72\x6F\x72","\x65\x72\x72\x6F\x72","\x66\x61\x69\x6C","\x2E\x2F\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x65\x67\x5F\x61\x72\x65\x61\x2E\x70\x68\x70","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E","\x6F\x6B\x65\x79","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61","\x73\x75\x63\x63\x65\x73\x73","\x56\x65\x72\x69\x66\x69\x71\x75\x65\x20\x6C\x6F\x73\x20\x64\x61\x74\x6F\x73","\x77\x61\x72\x6E\x69\x6E\x67","\x72\x65\x73\x65\x74","\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x61\x72\x65\x61","\x66\x6F\x63\x75\x73","\x23\x6E\x6F\x6D\x62\x72\x65","\x6A\x73\x6F\x6E","\x70\x6F\x73\x74","\x73\x75\x62\x6D\x69\x74"];$(function(){$(_0x557b[13])[_0x557b[18]](function(_0x6131x1){_0x6131x1[_0x557b[0]]();var _0x6131x2=$(this)[_0x557b[1]]();$[_0x557b[17]](_0x557b[5],_0x6131x2,function(_0x6131x6){if(_0x6131x6[_0x557b[6]]== _0x557b[7]){toastr[_0x557b[9]](_0x557b[8])}else {toastr[_0x557b[11]](_0x557b[10])};$(_0x557b[13])[0][_0x557b[12]]();$(_0x557b[15])[_0x557b[14]]()},_0x557b[16])[_0x557b[4]](function(_0x6131x3,_0x6131x4,_0x6131x5){toastr[_0x557b[3]](_0x557b[2])})})})
  </script>




</body>

</html>