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
  <link rel="stylesheet" href="./lib/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="./tm/toastr.scss" rel="stylesheet" />
  <style>
    body {
      background: #123;
      color: #fff;
    }

    table.dataTable thead {
      background: linear-gradient(to right, #aaaaaa, #aaaaaa, #aaaaaa);
      color: #000;
    }
  </style>
</head>

<body>
  <?php include_once('menu.php'); ?>

  <h2 class="text-center">Tabla de Clasificacion Documental Asamblea Legislativa Departamental de Potosi</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <table id="tablaareas" class="table table-striped table-bordered table-condensed table-dark" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>id</th>
              <th>Area-Unidad Funcional o Comision</th>
              <th>Sigla</th>
              <th>Codigo</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
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
var _0x26eb=["\x2E\x2F\x6C\x69\x62\x2F\x53\x70\x61\x6E\x69\x73\x68\x2E\x6A\x73\x6F\x6E","\x53\x65\x72\x76\x65\x72\x53\x69\x64\x65\x2F\x64\x74\x6C\x69\x73\x74\x61\x63\x6C\x61\x73\x69\x66\x69\x63\x61\x63\x69\x6F\x6E\x2E\x70\x68\x70","\x72\x6F\x77","\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x65\x6C\x69\x6D\x69\x6E\x61\x72\x22\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x64\x61\x6E\x67\x65\x72\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x74\x72\x61\x73\x68\x22\x20\x61\x72\x69\x61\x2D\x68\x69\x64\x64\x65\x6E\x3D\x22\x74\x72\x75\x65\x22\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E","\x23\x74\x61\x62\x6C\x61\x61\x72\x65\x61\x73","\x63\x6C\x69\x63\x6B","\x23\x65\x6C\x69\x6D\x69\x6E\x61\x72","\x64\x61\x74\x61","\x70\x61\x72\x65\x6E\x74\x73","\x4F\x50\x45\x52\x41\x43\x49\x4F\x4E","\x4F\x4B","\x72\x65\x6C\x6F\x61\x64","\x61\x6A\x61\x78","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61","\x73\x75\x63\x63\x65\x73\x73","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x72\x72\x6F\x72","\x65\x72\x72\x6F\x72","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x65\x5F\x63\x61\x74\x65\x67\x6F\x72\x69\x61\x2E\x70\x68\x70","\x6A\x73\x6F\x6E","\x6F\x6E","\x23\x74\x61\x62\x6C\x61\x61\x72\x65\x61\x73\x20\x74\x62\x6F\x64\x79","\x72\x65\x61\x64\x79"];$(document)[_0x26eb[23]](function(){var _0x14f9x1=$(_0x26eb[4]).DataTable({"\x6C\x61\x6E\x67\x75\x61\x67\x65":{"\x75\x72\x6C":_0x26eb[0]},"\x70\x72\x6F\x63\x65\x73\x73\x69\x6E\x67":true,"\x73\x65\x72\x76\x65\x72\x53\x69\x64\x65":true,"\x73\x41\x6A\x61\x78\x53\x6F\x75\x72\x63\x65":_0x26eb[1],"\x63\x6F\x6C\x75\x6D\x6E\x44\x65\x66\x73":[{},{targets:0,visible:false,searchable:false},{targets:-1,orderable:false,data:null,render:function(_0x14f9x2,_0x14f9x3,_0x14f9x4,_0x14f9x5){let _0x14f9x6=_0x14f9x5[_0x26eb[2]];let _0x14f9x7=`${_0x26eb[3]}`;return _0x14f9x7}}],"\x62\x44\x65\x73\x74\x72\x6F\x79":true});$(_0x26eb[22])[_0x26eb[21]](_0x26eb[5],_0x26eb[6],function(){var _0x14f9x2=_0x14f9x1[_0x26eb[2]]($(this)[_0x26eb[8]]())[_0x26eb[7]]();var _0x14f9x8={'\x69\x64\x5F\x63\x6C\x61\x73\x69\x66\x69\x63\x61\x63\x69\x6F\x6E':_0x14f9x2[0]};$[_0x26eb[12]]({type:_0x26eb[18],url:_0x26eb[19],data:_0x14f9x8,dataType:_0x26eb[20]})[_0x26eb[17]](function(_0x14f9x2){if(_0x14f9x2[_0x26eb[9]]== _0x26eb[10]){$(_0x26eb[4]).DataTable()[_0x26eb[12]][_0x26eb[11]]();toastr[_0x26eb[14]](_0x26eb[13])}else {toastr[_0x26eb[16]](_0x26eb[15])}})})})
  </script>

</body>

</html>