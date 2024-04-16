<?php include_once('header.php');

?>
<body>
    <?php include_once('menu.php'); ?>
    

    <div class="container">
        <h3 class=" text-center">REPORTE POR INTERVALO</h3>
        <form id="registrararea">
            <div class="form-group">
                <label for="fechainicio">Fecha Inicio</label>
                <input type="date" style="text-transform: uppercase;" class="form-control" id="fechainicio"
                    name="fechainicio" required data-toggle="popover" data-content="Este campo es requerido">
            </div>
            <div class="form-group">
                <label for="fechafinal">Fecha Final</label>
                <input type="date" style="text-transform: uppercase;" class="form-control" id="fechafinal"
                    name="fechafinal" required data-toggle="popover" data-content="Este campo es requerido">
            </div>

            <div class="form-group">
              <label for="exampleSelect">CATEGORIA</label>
              <select class="form-control" id="categoria" name="categoria" required data-toggle="popover" data-content="Este campo es requerido">
                <option value="GENERAL">GENERAL</option>
                <option value="PREVENTIVO">PREVENTIVO</option>
                <option value="LEY">LEY</option>
                <option value="RESOLUCION">RESOLUCION</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Generar reporte</button>

        </form>
    </div>
    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="./lib/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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
   var _0x63d2=["\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x76\x61\x6C","\x23\x66\x65\x63\x68\x61\x69\x6E\x69\x63\x69\x6F","\x23\x66\x65\x63\x68\x61\x66\x69\x6E\x61\x6C","\x23\x63\x61\x74\x65\x67\x6F\x72\x69\x61","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x6A\x61\x76\x61\x73\x63\x72\x69\x70\x74\x3A\x70\x6F\x70\x55\x70\x28\x27\x2E\x2F\x6F\x70\x65\x72\x61\x63\x69\x6F\x6E\x65\x73\x2F\x72\x65\x70\x6F\x72\x74\x65\x2E\x70\x68\x70\x3F\x66\x69\x3D","\x26\x66\x66\x3D","\x26\x63\x61\x74\x3D","\x27\x29","\x73\x75\x62\x6D\x69\x74","\x23\x72\x65\x67\x69\x73\x74\x72\x61\x72\x61\x72\x65\x61"];$(function(){$(_0x63d2[12])[_0x63d2[11]](function(_0x71dfx1){_0x71dfx1[_0x63d2[0]]();let _0x71dfx2=$(_0x63d2[2])[_0x63d2[1]]();let _0x71dfx3=$(_0x63d2[3])[_0x63d2[1]]();let _0x71dfx4=$(_0x63d2[4])[_0x63d2[1]]();window[_0x63d2[6]][_0x63d2[5]]= _0x63d2[7]+ _0x71dfx2+ _0x63d2[8]+ _0x71dfx3+ _0x63d2[9]+ _0x71dfx4+ _0x63d2[10]})})
    </script>




</body>
<footer>
<?php
include_once('footer.php');
?>
</footer>
</html>