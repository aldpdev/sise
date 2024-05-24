<?php
require ('header.php');
$listdoc = DBAllDocuments();
?>

<div class="container">
    <h1 class="mt-5 mb-3 center">Lista de documentos</h1>
    <table class="table">
      <thead class="table-dark">
        <tr>
          <th scope="col">Id Documento</th>
          <th scope="col">Remitente</th>
          <th scope="col">Hoja Ruta</th>
          <th scope="col">Referencia</th>
          <th scope="col">Asunto</th>
          <th scope="col">Nr. de Hojas</th>
          <th scope="col">Tipo Documento</th>
          <th scope="col">Documento Adjunto</th>
        </tr>
      </thead>
      <tbody>
        <?php
        for ($i=0; $i < count($listdoc); $i++) {
          echo "<tr>\n";
          echo "<td><a href='seguimiento.php?id=".$listdoc[$i]["documentid"]."'>".$listdoc[$i]["documentid"]."</a></td>\n";
          echo "<td>".$listdoc[$i]["sendername"]."</td>\n";
          echo "<td>".$listdoc[$i]["routenumber"]."</td>\n";
          echo "<td>".$listdoc[$i]["reference"]."</td>\n";
          echo "<td>".$listdoc[$i]["documentaffair"]."</td>\n";
          echo "<td>".$listdoc[$i]["documentcount"]."</td>\n";
          echo "<td>".$listdoc[$i]["documenttype"]."</td>\n";
          echo "<td>".$listdoc[$i]["documentfilename"]."</td>\n";


          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
</div>
<?php
require ('footer.php');
?>
</html>
