<?php
require ('header.php');

$usr = DBAllUserInfo();
$conf=globalconf();
?>
<script>
  window.onload = function () {
    var pass1 = document.getElementById('passn1');
    var pass2 = document.getElementById('passn2');
    var errorDiv = document.getElementById('error');

    var pass1Check = document.getElementById('pass1Check');
    var pass2Check = document.getElementById('pass2Check');

    pass1.addEventListener('input', function () {
      if (pass1.value !== pass2.value) {
        errorDiv.textContent = 'Las contraseñas no coinciden';
        pass1Check.style.display = 'none';
        pass2Check.style.display = 'none';

      }
      else if (pass1.value.trim() === '' || pass2.value.trim() === '') {
        errorDiv.textContent = 'No dejes ningún campo en blanco';
        pass1Check.style.display = 'none';
        pass2Check.style.display = 'none';
      }
      else if (pass1.value.includes(' ')) {
        errorDiv.textContent = 'La contraseña no puede contener espacios en blanco';
        pass1Check.style.display = 'none';
        pass2Check.style.display = 'none';
      }
      else {
        errorDiv.textContent = '';
        pass1Check.style.display = 'inline';
        pass2Check.style.display = 'inline';
      }
    });

    pass2.addEventListener('input', function () {
      if (pass1.value !== pass2.value) {
        errorDiv.textContent = 'Las contraseñas no coinciden';
        pass1Check.style.display = 'none';
        pass2Check.style.display = 'none';
      }
      else if (pass1.value.trim() === '' || pass2.value.trim() === '') {
        errorDiv.textContent = 'No dejes ningún campo en blanco';
        pass1Check.style.display = 'none';
        pass2Check.style.display = 'none';
      }

      else if (pass2.value.includes(' ')) {
        errorDiv.textContent = 'La contraseña no puede contener espacios en blanco';
        pass1Check.style.display = 'none';
        pass2Check.style.display = 'none';
      }

      else {
        errorDiv.textContent = '';
        pass1Check.style.display = 'inline';
        pass2Check.style.display = 'inline';
      }
    });
  };
</script>





<div class="container-fluid px-4">
  <br>
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#usernewmodal"
    data-bs-whatever="@mdo">Crear Usuario</button>
  <br>
  <div class="modal fade" id="usernewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!--<form name="form3" id="form3" method="post">-->
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3 row">
            <!--<label for="usernumber" class="col-sm-4 col-form-label">Usuario Id:</label>-->
            <div class="col-sm-8">
              <input type="hidden" name="usernumber_r" id="usernumber_r" class="form-control" value="" maxlength="20" />
            </div>
          </div>
          <div class="input-group mb-2">


               <span for="userci_r" class="input-group-text" id="inputGroup-sizing-default">Usuario CI:</span>
              <!--validar que sea numero -->
              <input type="text" name="userci_r" id="userci_r" class="form-control" value="" maxlength="20"
                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />

          </div>
            <div class="input-group mb-2">
              <span for="username_r" class="input-group-text" id="inputGroup-sizing-default">Usuario Nombre:</span>
                <input type="text" name="username_r" id="username_r" class="form-control" value="" maxlength="200" />
                </div>
                <div class="col-sm-8">
                <div id="error-username_r" class="invalid-feedback"></div>
              </div>



          <!--ICPC ID-->

          <div class="input-group mb-2">
            <label for="usertype" class="input-group-text">Tipo:</label>
                <select name="usertype_r" id="usertype_r" class="form-select" aria-label="Default select example">
                    <option value="secretary">Secretaria</option>
                    <option value="admin">Administrador</option>
                </select>
          </div>
<script>
    // Function to toggle visibility of unit based on selected user type
    function toggleUnitVisibility() {
        var userType = document.getElementById("usertype_r").value;
        var unidadRow = document.getElementById("unidad_row");

        userType === "admin"?unidadRow.style.display = "none":unidadRow.style.display = "";

    }

    // Attach onchange event listener to usertype_r select element
    document.getElementById("usertype_r").onchange = toggleUnitVisibility;

    // Call toggleUnitVisibility initially to set initial visibility state
    toggleUnitVisibility();
</script>



          <div class="input-group mb-2" id="unidad_row">
            <label for="" class="input-group-text">Unidad:</label>

                <?php
                $unit = DBAllUnitInfo();
                $msg = '<select name="userunit_r" id="userunit_r"  class="form-select" aria-label="Default select example">';
                $msg .= '<option value="" selected>--</option>\n';
                for ($i=0; $i < count($unit) ; $i++) {
                    $msg.= '
                        <option value="'.$unit[$i]['unitnumber'].'">'.$unit[$i]['unitdesc'].'</option>\n
                    ';
                }
                $msg.='</select>';
                echo $msg;
                ?>

          </div>



          <div class="input-group mb-2">
            <label for=""class ="input-group-text">Activo:</label>
              <select name="userenabled_r" class="form-select" aria-label="Default select example">
                <option value="t">Yes</option>
                <option value="f">No</option>
              </select>

          </div>
          <!--MultiLogins (los equipos locales deben establecerse en <b> No </b>):-->
          <div class="input-group mb-2">
            <label for="" class ="input-group-text">Loguearse multiples Veces:</label>

              <select name="usermultilogin_r" class="form-select" aria-label="Default select example">
                <option value="t">Yes</option>
                <option value="f">No</option>
              </select>
          </div>
          <div class="input-group mb-2">
            <label for="userfullname_r" class="input-group-text" id="inputGroup-sizing-default">Nombre Completo del Usuario:</label>
              <input type="text" name="userfullname_r" id="userfullname_r" class="form-control" value=""
                maxlength="200" />
              <div id="error-userfullname_r" class="invalid-feedback"></div>
          </div>

          <div class="input-group mb-2">
            <label for="userdesc_r" class="input-group-text">Descripcion Usuario:</label>

              <input type="text" name="userdesc_r" id="userdesc_r" class="form-control" value="" maxlength="300" />

          </div>
          <div class="input-group mb-2">
            <label for="userip_r" class="input-group-text">IP Usuario:</label>
             <input type="text" name="userip_r" id="userip_r" class="form-control" value="" size="20" maxlength="20" />
          </div>
          <div class="input-group mb-2">
            <label for="passn1" class="input-group-text">Contraseña:</label>
                <input type="password" name="passn1" id="passn1" class="form-control" value="" size="20"maxlength="200" />
                </div>
                <div class="col-sm-8">

                <span class="input-group-text" id="pass1Check" style="display: none;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-all" viewBox="0 0 16 16">
                    <path
                      d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75
                   0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z" />
                  </svg>
                </span>
          </div>
          <div class="input-group mb-2">
            <label for="passn2" class="input-group-text">Repitir Contraseña:</label>
              <input type="password" name="passn2" id="passn2" class="form-control" value="" size="20" maxlength="200" />
              </div>
              <div class="col-sm-8">

                <span class="input-group-text" id="pass2Check" style="display: none;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-all" viewBox="0 0 16 16">
                    <path
                      d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75
                   0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z" />
                  </svg>
                </span>
            <div id="error" style="color: red;"></div>
          </div>
          <div class="input-group mb-2">
            <label for="" class="input-group-text">Permitir cambio de Contraseña:</label>
             <select name="changepass_r" class="form-select" aria-label="Default select example">
                <option value="t">Yes</option>
                <option value="f">No</option>
              </select>
          </div>


          <div class="input-group mb-2">
            <label for="passo" class="input-group-text">Contraseña del admin:</label>
            <input type="password" name="passo" id="passo" class="form-control" value="" size="20" maxlength="200" />
          </div>
          <div class="mb-2 row justify-content-center">

            <div class="col-7 border border-primary py-1 mx-3">
              <div class="text-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Foto de Perfil</h1><br/>
                <div style="display: inline-block; vertical-align: middle;">
                  <div class="image-container">
                      <img src="../imagenes/perfil.jpg" style="max-width: 100%; height: auto;" alt="avatar" id="profiledisplay" />
                  </div>
                </div>
                <div style="display: inline-block; vertical-align: middle;">
                  <div class="image-info" style="text-align: center;">
                    <p style="margin-top: 0; margin-bottom: 0;">Dimensiones<br> recomendadas:<br> 300px x 300px</p>
                  </div>
                </div>
                <br/>
                <input type="file" name="profile" id="profile" accept="image/*" />
              </div>
            </div>
          </div>
        </div>

          <style>
            .image-container {
              width: 150px;
              height: 150px;
              overflow: hidden;
              display: flex;
              justify-content: center; /* Centra horizontalmente */
              align-items: center; /* Centra verticalmente */
              border: 1px solid #CFCFCF; /* Añade un borde para ver el marco */
            }

            .image-container img {
              width: auto; /* Cambia el ancho a automático */
              height: auto; /* Cambia la altura a automático */
              max-width: 100%; /* Establece un ancho máximo para evitar que la imagen se desborde */
              max-height: 100%; /* Establece una altura máxima para evitar que la imagen se desborde */
            }
          </style>

          </style>

        <div class="modal-footer">
          <!--<input type="submit" class="btn btn-primary"name="Submit" value="Send" onClick="conf3()">
          <input type="submit" class="btn btn-primary"name="Cancel" value="Cancel" onClick="conf5()">-->



          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success" id="register_button">Registrar</button>
        </div>
        <!--</form>-->
      </div>
    </div>
  </div>




  <div class="table-responsive">
    <table class="table table-sm table-hover" id="table_users" style="width:100%">
      <thead>
        <tr>
          <th scope="col">ID #</th>
          <th scope="col">Usuario</th>
          <th scope="col">Tipo</th>
          <th scope="col">IP</th>
          <th scope="col">UltimoLogin</th>
          <th scope="col">UltimoLogout</th>
          <th scope="col">Activa</th>
          <th scope="col">Multi</th>
          <th scope="col">Nombre Completo</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $conf = globalconf();
        for ($i = 0; $i < count($usr); $i++) {
          echo " <tr>\n";
          echo "<td>\n";
          if(isset($usr[$i]['userimg'])&& $usr[$i]['userimg']!=""){
            $data=decryptData($usr[$i]['userimg'], $conf["key"]);
            
            echo '<img src="'."data:image/png;base64," . base64_encode($data).'" class="img-fluid rounded-circle" style="max-width: 8%; height: auto;" alt="Perfil">';

          }

          if ($usr[$i]["usernumber"] != 0){
            echo "  <a href=\"user.php?user=" .
              $usr[$i]["usernumber"] . "\">" . $usr[$i]["usernumber"] . "</a>";
          }else{
            echo $usr[$i]["usernumber"];//para el admin
            if ($usr[$i]['userenabled'] != 1 && $usr[$i]['userlastlogin'] < 1)
              echo "(inactive)";
          }
          echo "</td>\n";

          //echo "  <td>" . $usr[$i]["usersitenumber"] . "</td>\n";
          echo "  <td>" . $usr[$i]["username"] . "&nbsp;</td>\n";

          echo "  <td>" . $usr[$i]["usertype"] . "&nbsp;</td>\n";
          if ($usr[$i]["userpermitip"] != "")
            echo "  <td>" . $usr[$i]["userpermitip"] . "*&nbsp;</td>\n";
          else
            echo "  <td>" . $usr[$i]["userip"] . "&nbsp;</td>\n";
          if ($usr[$i]["userlastlogin"] < 1)
            echo "  <td>never</td>\n";
          else
            echo "  <td>" . dateconv($usr[$i]["userlastlogin"]) . "</td>\n";
          if ($usr[$i]["usersession"] != "")
            echo "  <td><a href=\"javascript: conf2('user.php?logout=1&user=" .
              $usr[$i]["usernumber"] . "')\">Force Logout</a></td>\n";
          else {
            if ($usr[$i]["userlastlogout"] < 1)
              echo "  <td>never</td>\n";
            else//dateconv date — Dar formato a la fecha/hora del parametro pasado
              echo "  <td>" . dateconv($usr[$i]["userlastlogout"]) . "</td>\n";
          }
          if ($usr[$i]["userenabled"] == 1)
            echo "  <td>Yes</td>\n";
          else
            echo "  <td>No</td>\n";
          if ($usr[$i]["usermultilogin"] == 1)
            echo "  <td>Yes</td>\n";
          else
            echo "  <td>No</td>\n";
          echo "  <td>" . $usr[$i]["userfullname"] . "&nbsp;</td>\n";
          echo "  <td>" . $usr[$i]["userdesc"] . "&nbsp;</td>\n";

          if ($usr[$i]["usernumber"] != 0) {

            if ($usr[$i]['userenabled'] != 1 && $usr[$i]['userlastlogin'] < 1) {
              echo " <td><div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\"><a onClick=\"conf7(" . $usr[$i]["usernumber"] . ")\"" .
                "')\" class=\"btn btn-warning btn-sm\">Activar</a>";
              echo "<a class=\"btn btn-secondary btn-sm\" name=\"\" style=\"pointer-events: none; cursor: default; \">Actualizar</a></div>";
            } else {
              echo " <td><div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\"><a " .
                "')\" class=\"btn btn-danger btn-sm\" onClick=\"conf4(" . $usr[$i]["usernumber"] . ")\">Eliminar</a>";
              echo "<a href=\"user.php?user=" .
                $usr[$i]["usernumber"] . "#form_user\" class=\"btn btn-primary btn-sm\" name=\"\" >Actualizar</a></div>";
            }

            echo "<script language=\"javascript\">    function conf7(user) {\n";
            echo "      if (confirm('ESTAS SEGURO DE ACTIVAR USUARIO?')) {\n";
            //echo "            document.location='https://www.google.com/?hl=es'\n";
            echo "            document.location='user.php?usernumber='+user+'&confirmation=active';\n";
            echo "      }\n";
            echo "    }</script>\n";
            //echo "  <td><a href=\"user.php?site=" . $usr[$i]["usersitenumber"] . "&user=" .
            //$usr[$i]["usernumber"] . "#form_user\">" . "ACTUALIZAR" . "</a>";

          } else {
            echo "  <td>" . $usr[$i]["usernumber"];//para el admin
          }
          //f($usr[$i]['userenabled'] != 't' && $usr[$i]['userlastlogin'] < 1) echo "(inactive)";
          echo "</td>\n";

          echo "</tr>";
        }
        echo "</tbody></table>\n";

        ?>
  </div>
</div>

<?php
require ('footer.php');
?>


<script>


$(document).ready(function () {

    $('#profile').change(function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#profiledisplay').attr('src', e.target.result);
            $('#profiledisplay').show();
        }
        reader.readAsDataURL(event.target.files[0]);
    });

    $('#register_button').click(function () {
      var username_r = $('#username_r').val();
      var userfullname_r = $('#userfullname_r').val();

      if (username_r.trim() === '' || userfullname_r.trim() === '') {

        if (username_r.trim() === '') {
          $('#username_r').addClass('is-invalid');
          $('#error-username_r').text('ERROR: Este campo es obligatorio');
        }
        else {
          $('#username_r').removeClass('is-invalid');
          $('#error-username_r').text('');
        }
        if (userfullname_r.trim() === '') {
          $('#userfullname_r').addClass('is-invalid');
          $('#error-userfullname_r').text('ERROR: Este campo es obligatorio');
        }
        else {
          $('#userfullname_r').removeClass('is-invalid');
          $('#error-userfullname_r').text('');
        }

        $('#username_r, #userfullname_r').on('input', function () {
          // Verificar si el campo está vacío y actuar en consecuencia
          if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid');
            $(this).next('.error-message').text('ERROR: Este campo es obligatorio');
          } else {
            $(this).removeClass('is-invalid');
            $(this).next('.error-message').text('');
          }
        });
      }
      else {
        var passwordn1 = $('#passn1').val();
        var passwordn2 = $('#passn2').val();
        var passwordo = $('#passo').val();

        passwordn1 = bighexsoma(js_myhash(passwordn1), js_myhash(passwordo));
        passwordn2 = bighexsoma(js_myhash(passwordn2), js_myhash(passwordo));

        passwordo = js_myhash(js_myhash(passwordo) + '<?php echo session_id(); ?>');
        //var profile = $('#fotos')[0].files[0];

        var formData = new FormData();
        formData.append('usernumber', $('#usernumber_r').val());
        formData.append('userci', $('#userci_r').val());
        formData.append('username', $('#username_r').val());
        formData.append('usertype', $('select[name=usertype_r]').val());
        formData.append('userunit', $('select[name=userunit_r]').val());
        formData.append('userenabled', $('select[name=userenabled_r]').val());
        formData.append('usermultilogin', $('select[name=usermultilogin_r]').val());
        formData.append('userfullname', $('#userfullname_r').val());
        formData.append('userdesc', $('#userdesc_r').val());
        formData.append('userip', $('#userip_r').val());
        formData.append('passwordn1', passwordn1);
        formData.append('passwordn2', passwordn2);
        formData.append('changepass', $('select[name=changepass_r]').val());
        formData.append('passwordo', passwordo);

        var profile = $('#profile')[0];
        //if (profile.files.length === 0) {
        //    alert('Por favor selecciona una imagen');
        //    return;
        //}
        formData.append('profile', profile.files[0]);
        $.ajax({
            type: 'POST',
            url: '../operaciones/registeruser.php',
            data: formData,
            processData: false,  // Evita que jQuery intente procesar el FormData
            contentType: false,  // Evita que jQuery establezca un tipo de contenido
            success: function (response) {
                if (response === 'yes') {
                    alert('se registró el usuario');
                    location.reload();
                } else {
                    alert(response);
                }
            },
            error: function () {
                alert('Error en la petición AJAX');
            }
        });
      }

      $('#username_r, #userfullname_r').on('input', function () {
        // Verificar si el campo está vacío y actuar en consecuencia
        if ($(this).val().trim() === '') {
          $(this).addClass('is-invalid');
          $(this).next('.error-message').text('ERROR: Este campo es obligatorio');
        } else {
          $(this).removeClass('is-invalid');
          $(this).next('.error-message').text('');
        }
      });
    });

  });
</script>
