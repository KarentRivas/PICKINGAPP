<?php
session_start();

header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=PENDIENTE_MENSUAL.xls" );


mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$query = "SELECT cod,id,nombre,cliente,factura,cantidad,fecha,hora_inicio,
hora_fin,tiempo FROM resumen_alistador WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_final'";

$result = mysql_query($query);

?>
<table border='1'>
	<tr>
		<td colspan='11' bgcolor='#E235F2'>
			<center>
				<b>
					TIEMPOS DE CERTIFICACION
				</b>
			</center>
		</td>
	</tr>

	<tr>
		<td bgcolor='#F470F2'>
			<center>
				<b>
					#
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					ID
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					NOMBRE
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					CLIENTE
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					FACTURA
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					CANTIDAD
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					FECHA
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					HORA INICIO
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					HORA FIN
				</b>
			</center>
		</td>

		<td bgcolor='#F470F2'>
			<center>
				<b>
					TIEMPO CERTIFICACION
				</b>
			</center>
		</td>
	</tr>

	<tr>
<?php
if ($result) {

	while ($array = mysql_fetch_array($result)) {

		$cod = $array['cod'];
		$id = $array['id'];
		$nombre = $array['nombre'];
		$cliente = $array['cliente'];
		$factura = $array['factura'];
		$cantidad = $array['cantidad'];
		$hora_inicio = $array['hora_inicio'];
		$hora_fin = $array['hora_fin'];
		$tiempo = $array['tiempo'];
		$fecha = $array['fecha'];

		?>

		<td>
			<center>
				<?php echo $cod; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $id; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $nombre; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $cliente; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $factura; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $cantidad; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $fecha; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $hora_inicio; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $hora_fin; ?>
			</center>
		</td>

		<td>
			<center>
				<?php echo $tiempo; ?>
			</center>
		</td>
</tr>

		<?php
	}

}

?>

</table>
