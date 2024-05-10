<?php
require('header.php');

$usr = DBAllUserInfo();

?>

<div class="container-fluid px-4">
  <br>
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#usernewmodal" data-bs-whatever="@mdo">Crear Usuario</button>
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
                    <input type="hidden" name="usernumber" id="usernumber" class="form-control" value="" maxlength="20" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="userci" class="col-sm-4 col-form-label">Usuario CI:</label>
                <div class="col-sm-8">
                    <input type="text" name="userci" id="userci" class="form-control" value="" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="username" class="col-sm-4 col-form-label">Usuario Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" name="username" id="username" class="form-control" value="" maxlength="20" />
                </div>
            </div>
            <!--ICPC ID-->
            <div class="mb-3 row">
                <label for="usertype" class="col-sm-4 col-form-label">Tipo:</label>
                <div class="col-sm-4">
                  <select name="usertype" class="form-select" aria-label="Default select example">
                		<option value="admin">Administrador</option>
                		<option value="secretary">Secretary</option>
                	</select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-4 col-form-label">Activo:</label>
                <div class="col-sm-2">
                <select name="userenabled" class="form-select" aria-label="Default select example">
            		  <option value="t">Yes</option>
            		  <option value="f">No</option>
            		</select>
              </div>
            </div>
            <!--MultiLogins (los equipos locales deben establecerse en <b> No </b>):-->
            <div class="mb-3 row">
                <label for="" class="col-sm-4 col-form-label">MultiLogins (Loguearse multiples Veces):</label>
                <div class="col-sm-2">
                    <select name="usermultilogin" class="form-select" aria-label="Default select example">
            		<option value="t">Yes</option>
            		<option value="f">No</option>
            		</select>
              </div>
            </div>
            <div class="mb-3 row">
                <label for="userfullname" class="col-sm-4 col-form-label">Nombre Completo del Usuario:</label>
                <div class="col-sm-8">
                    <input type="text" name="userfullname" id="userfullname" class="form-control" value="" maxlength="200" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="userdesc" class="col-sm-4 col-form-label">Descripcion Usuario:</label>
                <div class="col-sm-8">
                    <input type="text" name="userdesc" id="userdesc" class="form-control" value="" maxlength="300" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="userip" class="col-sm-4 col-form-label">IP Usuario:</label>
                <div class="col-sm-8">
                    <input type="text" name="userip" id="userip" class="form-control" value="" size="20" maxlength="20" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="passwordn1" class="col-sm-4 col-form-label">Contraseña:</label>
                <div class="col-sm-8">
                    <input type="password" name="passwordn1" id="passwordn1" class="form-control" value="" size="20" maxlength="200" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="passwordn2" class="col-sm-4 col-form-label">Repitir Contraseña:</label>
                <div class="col-sm-8">
                    <input type="password" name="passwordn2" id="passwordn2" class="form-control" value="" size="20" maxlength="200" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-4 col-form-label">Permitir cambio de Contraseña:</label>
                <div class="col-sm-2">
                  <select name="changepass" class="form-select" aria-label="Default select example">
            		      <option value="t">Yes</option>
            		      <option value="f">No</option>
            		  </select>
              </div>
            </div>
            <div class="mb-3 row">
                <label for="passwordo" class="col-sm-4 col-form-label">Contraseña del admin:</label>
                <div class="col-sm-8">
                    <input type="password" name="passwordo" id="passwordo" class="form-control" value="" size="20" maxlength="200" />
              </div>
            </div>

        </div>
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
    for ($i=0; $i < count($usr); $i++) {
          echo " <tr>\n";
          if($usr[$i]["usernumber"] != 0)
    	      echo "  <td><a href=\"user.php?user=" .
    		  $usr[$i]["usernumber"] . "\">" . $usr[$i]["usernumber"] . "</a>";
          else
    	     echo "  <td>" . $usr[$i]["usernumber"];//para el admin
          if($usr[$i]['userenabled'] != 1 && $usr[$i]['userlastlogin'] < 1) echo "(inactive)";
          echo "</td>\n";

          //echo "  <td>" . $usr[$i]["usersitenumber"] . "</td>\n";
          echo "  <td>" . $usr[$i]["username"] . "&nbsp;</td>\n";

          echo "  <td>" . $usr[$i]["usertype"] . "&nbsp;</td>\n";
          if ($usr[$i]["userpermitip"]!="")
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

           if($usr[$i]["usernumber"] !=0 ){

                if($usr[$i]['userenabled'] != 1 && $usr[$i]['userlastlogin'] < 1){
                     echo " <td><div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\"><a onClick=\"conf7(".$usr[$i]["usernumber"].")\"" .
                           "')\" class=\"btn btn-warning btn-sm\">Activar</a>";
                     echo "<a class=\"btn btn-secondary btn-sm\" name=\"\" style=\"pointer-events: none; cursor: default; \">Actualizar</a></div>";
                }else{
                     echo " <td><div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\"><a " .
                         "')\" class=\"btn btn-danger btn-sm\" onClick=\"conf4(".$usr[$i]["usernumber"].")\">Eliminar</a>";
                     echo "<a href=\"user.php?user=" .
            		  $usr[$i]["usernumber"] . "#form_user\" class=\"btn btn-primary btn-sm\" name=\"\" >Actualizar</a></div>";
                }
                echo "<script language=\"javascript\">    function conf4(user) {\n";
                echo "      if (confirm('ADVERTENCIA: eliminar un usuario eliminará por completo TODO lo relacionado con él (incluidas las ejecuciones, aclaraciones, etc.).?')) {\n";
                //echo "            document.location='https://www.google.com/?hl=es'\n";
                echo "            document.location='user.php?usernumber='+user+'&confirmation=delete';\n";
                echo "      }\n";
                echo "    }</script>\n";
                echo "<script language=\"javascript\">    function conf7(user) {\n";
                echo "      if (confirm('ESTAS SEGURO DE ACTIVAR USUARIO?')) {\n";
                //echo "            document.location='https://www.google.com/?hl=es'\n";
                echo "            document.location='user.php?usernumber='+user+'&confirmation=active';\n";
                echo "      }\n";
                echo "    }</script>\n";
              //echo "  <td><a href=\"user.php?site=" . $usr[$i]["usersitenumber"] . "&user=" .
     		  //$usr[$i]["usernumber"] . "#form_user\">" . "ACTUALIZAR" . "</a>";

           }else{
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
require('footer.php');
?>
<script language="JavaScript" src="../sha256.js"></script>
<script language="JavaScript" src="../hex.js"></script>
<script language="JavaScript">
function computeHASH()
{
	document.passwordn1.value = bighexsoma(js_myhash(document.passwordn1.value),js_myhash(document.passwordo.value));
	document.passwordn2.value = bighexsoma(js_myhash(document.passwordn2.value),js_myhash(document.passwordo.value));
	document.passwordo.value = js_myhash(js_myhash(document.passwordo.value)+'<?php echo session_id(); ?>');
//	document.form3.passwordn1.value = js_myhash(document.form3.passwordn1.value);
//	document.form3.passwordn2.value = js_myhash(document.form3.passwordn2.value);
}
</script>

<script>
$(document).ready(function () {
  //$("#form3").submit(function(){
    /*computeHASH();
    alert('GROVER FONRI');
    if (confirm("Confirmar Registro?")){
        alert('GROVER FONRI');
    }*/


  //  alert('FABIAN SIERRA');
  //});
  $('#register_button').click(function(){
    //computeHASH();
    var passwordn1 = $('#passwordn1').val();
    var passwordn2 = $('#passwordn2').val();
    var passwordo = $('#passwordo').val();
    passwordn1 = bighexsoma(js_myhash(passwordn1),js_myhash(passwordn1));
    passwordn2 = bighexsoma(js_myhash(passwordn2),js_myhash(passwordn2));
  	passwordo = js_myhash(js_myhash(passwordo)+'<?php echo session_id(); ?>');

    var formData = {
            usernumber: $('#usernumber').val(),
            userci: $('#userci').val(),
            username: $('#username').val(),
            usertype: $('select[name=usertype]').val(),
            userenabled: $('select[name=userenabled]').val(),
            usermultilogin: $('select[name=usermultilogin]').val(),
            userfullname: $('#userfullname').val(),
            userdesc: $('#userdesc').val(),
            userip: $('#userip').val(),
            passwordn1: passwordn1,
            passwordn2: passwordn2,
            changepass: $('select[name=changepass]').val(),
            passwordo: passwordo
        };

    $.ajax({
            type: "POST",  // o "GET", dependiendo del método que necesites
            url: "../operaciones/registeruser.php",  // URL a la que enviar los datos
            data: formData,
            success: function(response) {
                alert(response);
                // Aquí puedes manejar la respuesta del servidor
            },
            error: function() {
                alert("Error en la petición AJAX");
            }
    });
    //alert('test: '+passw+' pass1: '+passwordn1+'pass2: '+passwordn2+'passo: '+passwordo);

    /*if (confirm("Confirmar Registro?")){
        alert('GROVER FONRI');
    }
    alert('GROVER FONRI');*/
	});


});
</script>
