<?php
require ('header.php');
?>
<div class="container-fluid px-4">
  <div class="container">
    <h3 class="text-center">Asamblea departamental de POTOSÍ</h3>

    <div id="carga" class="text-center" style="display:none;">
      <img src="./imagenes/cargando.gif" />
    </div>
    <div id="formulario" style="display:block">
      <form id="registrarentrada" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col">
            <div class="form-group ">
              <div class="form-group row mb-3">
                <label for="origen" class="col-sm-2 col-form-label">Origen</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="origen" name="origen" id="origen"
                    aria-describedby="basic-addon1" required data-toggle="popover"
                    data-content="Este campo es requerido">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="destinatario" class="col-sm-2 col-form-label">Destinatario</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="destinatario" name="destinatario"
                    id="destinatario" aria-describedby="basic-addon1" required data-toggle="popover"
                    data-content="Este campo es requeinstruccionrido">

                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="instruccion" class="col-sm-2 col-form-label">Instrucción</label>
                <div class="col-sm-10">

                  <input type="text" class="form-control" aria-label="instruccion" name="instruccion" id="instruccion"
                    aria-describedby="basic-addon1" required data-toggle="popover"
                    data-content="Este campo es requerido">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="asunto" class="col-sm-2 col-form-label">Asunto</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" aria-label="asunto" name="asunto" id="asunto"
                    aria-describedby="basic-addon1" required data-toggle="popover"
                    data-content="Este campo es requerido">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion"
                    rows="3" required data-toggle="popover" data-content="Este campo es requerido" required></textarea>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="nhojas" class="col-sm-2 col-form-label">Número de hojas</label>
                <div class="col-sm-10">
                  <input type="number" style="text-transform: uppercase;" class="form-control" id="nhojas" name="nhojas"
                    required data-toggle="popover" data-content="Este campo es requerido">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="archivo" class="col-sm-2 col-form-labell">Adjuntar</label>
                <div class="col-sm-10">
                  <input class="form-control" accept="application/pdf" type="file" id="archivo" name="archivo" required
                    data-toggle="popover" data-content="Este campo es requerido" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>

      </form>

    </div>
  </div>







</div>
<?php
require ('footer.php');
?>
