<?php
require ('header.php');
?>
<div class="container-fluid px-4">
  <div class="container">

    <h3 class="text-center">Asamblea departamental de POTOSÍ</h3>

    <div id="formulario" style="display:block">
        <div class="form-row">
          <div class="col">
            <div class="form-group ">
              <div class="form-group row mb-3">
                <label for="origen" class="col-sm-2 col-form-label">Remitente</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="origen" name="origen" id="remitente">
                  <div id="error-remitente" class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="nhr" class="col-sm-2 col-form-label">Hoja Ruta</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="nhr" name="nhr"
                    id="hojaruta">
                    <div id="error-hojaruta" style="text-transform: uppercase;" class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="referencia" class="col-sm-2 col-form-label">Referencia</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="reference" name="referencia"
                    id="referencia">
                    <div id="error-referencia" class="invalid-feedback"></div>
                </div>
              </div>
              <!--<div class="form-group row mb-3">
                <label for="destinatario" class="col-sm-2 col-form-label">Destinatario</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="destinatario" name="destinatario"
                    id="destinatario">
                    <div id="error-destinatario" class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="instruccion" class="col-sm-2 col-form-label">Instrucción</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="instruccion" name="instruccion" id="instruccion">
                  <div id="error-instruccion" class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion"
                    rows="3"></textarea>
                </div>
              </div>-->
              <div class="form-group row mb-3">
                <label for="asunto" class="col-sm-2 col-form-label">Asunto</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="asunto" name="asunto" id="asunto">
                  <div id="error-asunto" class="invalid-feedback"></div>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="nhojas" class="col-sm-2 col-form-label">Número de hojas</label>
                <div class="col-sm-10">
                  <input type="number" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas" value='0'>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="nhojas" class="col-sm-2 col-form-label">Tipo De Documento</label>
                <div class="col-sm-10">
                  <select name="tipodocumento" style="text-transform: uppercase;" class="form-select" aria-label="Default select example">
                    <option value="0">Interno</option>
                    <option value="1">Externo</option>
                  </select>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="archivo" class="col-sm-2 col-form-labell">Adjuntar</label>
                <div class="col-sm-10">
                  <input class="form-control" accept="application/pdf" type="file" id="archivo" name="archivo">
                </div>
              </div>
              <div class="form-group row mb-3">

                <b><label for="" class="text-primary" data-bs-toggle="collapse" data-bs-target="#derivecollapse" aria-expanded="true" aria-controls="derivecollapse"><u>Derivar</u></label></b>

                <div id="derivecollapse" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="para">Para:</label>
                      <input type="text" class="form-control" id="para" aria-label="Para" aria-describedby="basic-addon1">
                      <label class="input-group-text" for="unidad">Unidad:</label>
                      <input type="text" class="form-control" id="unidad" aria-label="Unidad" aria-describedby="basic-addon1">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col d-flex justify-content-center">
            <button type="button" class="btn btn-primary btn-block" id="registerdocument_button">Registrar</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php
  require ('footer.php');
?>

<script>
$(document).ready(function () {
    $('#registerdocument_button').click(function(){
      var remitente = $('#remitente').val();
      var hojaruta = $('#hojaruta').val();
      var referencia = $('#referencia').val();
      var asunto= $('#asunto').val();


      if (remitente.trim() === '' || hojaruta.trim() === '' || referencia.trim() === '' || asunto.trim() === '') {

        if (remitente.trim() === '') {
          $('#remitente').addClass('is-invalid');
          $('#error-remitente').text('ERROR: Este campo es obligatorio');
        }else{
          $('#remitente').removeClass('is-invalid');
          $('#error-remitente').text('');
        }

        if (hojaruta.trim() === '') {
          $('#hojaruta').addClass('is-invalid');
          $('#error-hojaruta').text('ERROR: Este campo es obligatorio');
        }else{
          $('#hojaruta').removeClass('is-invalid');
          $('#error-hojaruta').text('');
        }

        if (referencia.trim() === '') {
          $('#referencia').addClass('is-invalid');
          $('#error-referencia').text('ERROR: Este campo es obligatorio');
        }else{
          $('#referencia').removeClass('is-invalid');
          $('#error-referencia').text('');
        }

        if (asunto.trim() === '') {
          $('#asunto').addClass('is-invalid');
          $('#error-asunto').text('ERROR: Este campo es obligatorio');
        }
        else{
          $('#asunto').removeClass('is-invalid');
          $('#error-asunto').text('');
        }

        $('#origen, #asunto').on('input', function() {
      // Verificar si el campo está vacío y actuar en consecuencia
          if ($(this).val().trim() === '') {
              $(this).addClass('is-invalid');
              $(this).next('.error-message').text('ERROR: Este campo es obligatorio');
          } else {
              $(this).removeClass('is-invalid');
              $(this).next('.error-message').text('');
          }
        });
      }else{
        var archivo = $('#archivo')[0].files[0];
        var formData = new FormData();
        formData.append('origen', $('#origen').val());
        formData.append('nhr', $('#nhr').val());
        //formData.append('destinatario', $('#destinatario').val());
        formData.append('referencia', $('#referencia').val());
        //formData.append('instruccion', $('#instruccion').val());
        formData.append('asunto', $('#asunto').val());
        //formData.append('descripcion', $('#descripcion').val());
        formData.append('nhojas', $('#nhojas').val());
        formData.append('tipodocumento', $('select[name=tipodocumento]').val());
        formData.append('archivo', archivo);
        $.ajax({
                type: "POST",  // o "GET", dependiendo del método que necesites
                url: "../operaciones/registerdocument.php",  // URL a la que enviar los datos
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    // Aquí puedes manejar la respuesta del servidor
                    if(response == 'yes'){
                        location.reload();
                    }
                },
                error: function() {
                    alert("Error en la petición AJAX");
                }
        });
      }
    });


});
</script>