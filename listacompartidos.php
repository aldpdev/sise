<?php
session_start();
include_once("./enlace.php");
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
    <link rel="stylesheet" href="./lib/bootstrap.min.css" />
        <link  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./tm/toastr.scss" rel="stylesheet" />
    <style>
    body {
        background: #EAEAEA;
        color: #fff;
    }
    </style>
</head>

<body>
    <?php include_once('menu.php'); ?>

    <h2 class="text-center">REGISTRO DE DOCUMENTOS COMPARTIDOS</h2>

    <div class="row">
        <div class="col-lg-12">
            <table id="tablacompartidos"
                class="table text-sm table-sm table-striped table-bordered table-condensed table-dark table-hover"
                style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th>id</th>
                        <th>NOMBRE SOLICITANTE</th>
                        <th>UNIDAD</th>
                        <th>DETALLE</th>
                        <th>ID DOCUMENTO</th>
                        <th>H.R</th>
                        <th>NUM DOC</th>
                        <th>CATEGORIA</th>
                        <th>FECHA PRESTAMO</th>
                        <th>FECHA LIMITE</th>
                        <th>MOTIVO DESTINO</th>
                        <th>OBSERVACION</th>
                        <th>FECHA DEVOLUCION</th>
                        <th>ARCHIVO</th>
                        <th style="width: 100px;">OPERACIONES</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="visualizardocumentomodal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
    <script src="./lib/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="./lib/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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
  var _0x8ccc=["\x2E\x2F\x6C\x69\x62\x2F\x53\x70\x61\x6E\x69\x73\x68\x2E\x6A\x73\x6F\x6E","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x46\x46\x30\x30\x30\x30","\x63\x73\x73","\x74\x64","\x66\x69\x6E\x64","\x65\x6E\x2D\x55\x53","\x74\x6F\x4C\x6F\x63\x61\x6C\x65\x53\x74\x72\x69\x6E\x67","\x70\x61\x72\x73\x65","\x53\x65\x72\x76\x65\x72\x53\x69\x64\x65\x2F\x64\x74\x6C\x69\x73\x74\x61\x63\x6F\x6D\x70\x61\x72\x74\x69\x64\x6F\x73\x2E\x70\x68\x70","\x72\x6F\x77","","\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x22\x20\x74\x69\x74\x6C\x65\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x20\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x22\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x69\x6E\x66\x6F\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x20\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x73\x20\x66\x61\x2D\x65\x79\x65\x22\x20\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E\x20","\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x64\x65\x76\x6F\x6C\x75\x63\x69\x6F\x6E\x22\x20\x74\x69\x74\x6C\x65\x3D\x22\x52\x65\x67\x69\x73\x74\x72\x61\x72\x20\x44\x65\x76\x6F\x6C\x75\x63\x69\x6F\x6E\x22\x20\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x77\x61\x72\x6E\x69\x6E\x67\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x72\x65\x70\x6C\x79\x2D\x61\x6C\x6C\x22\x20\x61\x72\x69\x61\x2D\x68\x69\x64\x64\x65\x6E\x3D\x22\x74\x72\x75\x65\x22\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x62\x75\x74\x74\x6F\x6E\x20\x69\x64\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x22\x20\x74\x69\x74\x6C\x65\x3D\x22\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x20\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x22\x20\x63\x6C\x61\x73\x73\x3D\x27\x62\x74\x6E\x20\x62\x74\x6E\x2D\x69\x6E\x66\x6F\x20\x62\x74\x6E\x2D\x63\x69\x72\x63\x6C\x65\x27\x20\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x73\x20\x66\x61\x2D\x65\x79\x65\x22\x20\x3E\x3C\x2F\x69\x3E\x0D\x0A\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x3C\x2F\x62\x75\x74\x74\x6F\x6E\x3E","\x23\x74\x61\x62\x6C\x61\x63\x6F\x6D\x70\x61\x72\x74\x69\x64\x6F\x73","\x63\x6C\x69\x63\x6B","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63","\x64\x61\x74\x61","\x70\x61\x72\x65\x6E\x74\x73","\x73\x72\x63","\x2E\x2F\x64\x69\x67\x69\x74\x61\x6C\x69\x7A\x61\x64\x6F\x73\x2F","\x61\x74\x74\x72","\x23\x70\x64\x66\x76\x69\x73\x6F\x72","\x73\x68\x6F\x77","\x6D\x6F\x64\x61\x6C","\x23\x76\x69\x73\x75\x61\x6C\x69\x7A\x61\x72\x64\x6F\x63\x75\x6D\x65\x6E\x74\x6F\x6D\x6F\x64\x61\x6C","\x6F\x6E","\x23\x74\x61\x62\x6C\x61\x63\x6F\x6D\x70\x61\x72\x74\x69\x64\x6F\x73\x20\x74\x62\x6F\x64\x79","\x23\x64\x65\x76\x6F\x6C\x75\x63\x69\x6F\x6E","\x4F\x50\x45\x52\x41\x43\x49\x4F\x4E","\x4F\x4B","\x72\x65\x6C\x6F\x61\x64","\x61\x6A\x61\x78","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x78\x69\x74\x6F\x73\x61","\x73\x75\x63\x63\x65\x73\x73","\x4F\x70\x65\x72\x61\x63\x69\x6F\x6E\x20\x65\x72\x72\x6F\x72","\x65\x72\x72\x6F\x72","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x5F\x64\x65\x76\x6F\x6C\x75\x63\x69\x6F\x6E\x2E\x70\x68\x70","\x6A\x73\x6F\x6E","\x72\x65\x61\x64\x79","\x72\x65\x73\x65\x74","\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x63\x6F\x6D\x70\x61\x72\x74\x69\x72","\x23\x63\x61\x6E\x63\x65\x6C\x61\x72"];$(document)[_0x8ccc[41]](function(){var _0x16bdx1=$(_0x8ccc[14]).DataTable({"\x6C\x61\x6E\x67\x75\x61\x67\x65":{"\x75\x72\x6C":_0x8ccc[0]},rowCallback:function(_0x16bdx2,_0x16bdx3){if(_0x16bdx3[12]== null){$($(_0x16bdx2)[_0x8ccc[5]](_0x8ccc[4])[10])[_0x8ccc[3]](_0x8ccc[1],_0x8ccc[2])};var _0x16bdx4= new Date();var _0x16bdx5=_0x16bdx4[_0x8ccc[7]](_0x8ccc[6]);if(Date[_0x8ccc[8]](_0x16bdx5)> Date[_0x8ccc[8]](_0x16bdx3[9])){if(_0x16bdx3[12]== null){$($(_0x16bdx2)[_0x8ccc[5]](_0x8ccc[4])[7])[_0x8ccc[3]](_0x8ccc[1],_0x8ccc[2])}}},"\x70\x72\x6F\x63\x65\x73\x73\x69\x6E\x67":true,"\x73\x65\x72\x76\x65\x72\x53\x69\x64\x65":true,"\x73\x41\x6A\x61\x78\x53\x6F\x75\x72\x63\x65":_0x8ccc[9],"\x63\x6F\x6C\x75\x6D\x6E\x44\x65\x66\x73":[{targets:0,visible:false,searchable:false},{targets:4,visible:false,searchable:false},{targets:13,visible:false,searchable:false},{targets:-1,orderable:false,data:null,render:function(_0x16bdx3,_0x16bdx6,_0x16bdx2,_0x16bdx7){let _0x16bdx8=_0x16bdx7[_0x8ccc[10]];let _0x16bdx9=_0x8ccc[11];if(_0x16bdx3[12]!= null){_0x16bdx9= `${_0x8ccc[12]}`}else {_0x16bdx9= `${_0x8ccc[13]}`};return _0x16bdx9}}],"\x62\x44\x65\x73\x74\x72\x6F\x79":true});$(_0x8ccc[27])[_0x8ccc[26]](_0x8ccc[15],_0x8ccc[16],function(){var _0x16bdx3=_0x16bdx1[_0x8ccc[10]]($(this)[_0x8ccc[18]]())[_0x8ccc[17]]();$(_0x8ccc[22])[_0x8ccc[21]](_0x8ccc[19],_0x8ccc[20]+ _0x16bdx3[13]);$(_0x8ccc[25])[_0x8ccc[24]](_0x8ccc[23])});$(_0x8ccc[27])[_0x8ccc[26]](_0x8ccc[15],_0x8ccc[28],function(){var _0x16bdx3=_0x16bdx1[_0x8ccc[10]]($(this)[_0x8ccc[18]]())[_0x8ccc[17]]();var _0x16bdxa={'\x69\x64\x5F\x63\x6F\x6D\x70\x61\x72\x74\x69\x64\x6F':_0x16bdx3[0],'\x69\x64\x5F\x65\x6E\x74\x72\x61\x64\x61':_0x16bdx3[4]};$[_0x8ccc[32]]({type:_0x8ccc[38],url:_0x8ccc[39],data:_0x16bdxa,dataType:_0x8ccc[40]})[_0x8ccc[37]](function(_0x16bdx3){if(_0x16bdx3[_0x8ccc[29]]== _0x8ccc[30]){$(_0x8ccc[14]).DataTable()[_0x8ccc[32]][_0x8ccc[31]]();toastr[_0x8ccc[34]](_0x8ccc[33])}else {toastr[_0x8ccc[36]](_0x8ccc[35])}})})});$(document)[_0x8ccc[41]](function(){$(_0x8ccc[44])[_0x8ccc[15]](function(){$(_0x8ccc[43])[0][_0x8ccc[42]]()})})
    </script>
</body>

</html>