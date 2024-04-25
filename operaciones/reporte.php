<?php
header('Content-type: text/html; charset=utf-8');
session_start();
include_once("../enlace.php");

?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<style>
		body {
			font-size: small;
			font-family: Arial, sans-serif;
			font-size: 12pt;
		}
	</style>
</head>

<body>
	<table>
		<thead>
			<tr>
				<td> <img src="../imagenes/banner.png" width="100%" alt=""> </td>
			</tr>
			<tr>
				<td>
					<center>
						<H2>FORMULARIO DE REGISTRO DE SALIDA DE DOCUMENTACION <BR> 
						<?php echo $finicio = $_GET['fi'] . " al " . $ffinal = $_GET['ff']; ?></H2>
					</center>
				</td>
			</tr>
		</thead>
	</table>
	<table id="tablacompartidos" border=1 cellpadding="2" cellspacing="0" style="width:100%">
		<thead class="text-center">
			<tr>
				<th style="background-color: #75AB96;">Nro</th>
				<th style="background-color: #75AB96;">NOMBRE SOLICITANTE</th>
				<th style="background-color: #75AB96;">UNIDAD</th>
				<th style="background-color: #75AB96;">DETALLE</th>
				<th style="background-color: #75AB96;">H.R.</th>
				<th style="background-color: #75AB96;">DOCUMENTO</th>
				<th style="background-color: #75AB96;">NUM DOC</th>
				<th style="background-color: #75AB96;">GESTION</th>
				<th style="background-color: #75AB96;">MOTIVO DESTINO</th>
				<th style="background-color: #75AB96;">FECHA PRESTAMO</th>
				<th style="background-color: #75AB96;">FECHA DEVOLUCION</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$finicio = $_GET['fi'];
			$ffinal = $_GET['ff'];

			$categoria = $_GET['cat'];
			if ($categoria == "GENERAL") {
				$sql = "SELECT * FROM formulario INNER JOIN controlentrada ON formulario.id_documento_formulario = controlentrada.idcontrolentrada  WHERE formulario.fecha_formulario BETWEEN '" . $finicio . "' AND '" . $ffinal . "' ORDER BY formulario.idformulario ASC";
			} else {
				$sql = "SELECT * FROM formulario INNER JOIN controlentrada ON formulario.id_documento_formulario = controlentrada.idcontrolentrada  WHERE controlentrada.categoria_controlentrada='" . $categoria . "' AND formulario.fecha_formulario BETWEEN '" . $finicio . "' AND '" . $ffinal . "' ORDER BY formulario.idformulario ASC";
			}

			$resultconsult = $conn->query($sql);

			echo mysqli_error($conn);
			$numero = 0;

			while ($row = $resultconsult->fetch_assoc()) {
				$numero += 1;
				echo '<tr>
            <td style="background-color:#fff;color:#000">' . $numero . '</td>
            <td>' . utf8_encode($row['nombre_formulario']) . '</td>
            <td>' . utf8_encode($row['unidad_formulario']) . '</td>
			<td>' . utf8_encode($row['documento_formulario']) . '</td>  
			<td>' . utf8_encode($row['hoja_controlentrada']) . '</td>  
			<td>' . utf8_encode($row['categoria_controlentrada']) . '</td>  
            <td>' . utf8_encode($row['numdoc_controlentrada']) . '</td>    
			<td>' . utf8_encode($row['gestion_controlentrada']) . '</td>
			<td>' . utf8_encode($row['motivo_formulario']) . '</td>          
            <td>' . $row['fecha_formulario'] . '</td>            
            <td>' . $row['fecha_devolucion_formulario'] . '</td>            
            </tr>';
			}
			if (mysqli_num_rows($resultconsult) == 0) {
				echo '<CENTER><h1> NO EXISTE REGISTROS</h1></CENTER>';
			}
			$conn->close();
			?>
		</tbody>
	</table>
</body>