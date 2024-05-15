<?php
require('header.php');
?>
<div class="container-fluid px-4">
  <div class="row">
    <div class="col-12">
      <h3 class="text-center">Asamblea Departamental de Potosí</h3>




      <form id="registrarentrada" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-12">
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







</div>
<?php
require('footer.php');
?>
