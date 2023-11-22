<?php
session_start();
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

echo "GET<pre>";$arra =print_r($_GET);echo "</pre>";


$acumulador = 0;

$factura =  $_SESSION['factura'];
$codigo =  $_SESSION['codigo'];

$_SESSION['factura'] = $factura;
$_SESSION['codigo'] = $codigo;
$contador = $_GET['contador'];


echo $query = "SELECT remision,item,referencia,cantidad,contar,peso,cpeso 
from contador_exito where remision = $factura";

$result = mysql_query($query);

while ($array = mysql_fetch_array($result)) {
	echo $item = $array['item'];
	echo $contar = $array['contar'];
	echo $cpeso = $array['cpeso'];

	if ($_GET['contador'] == '') {

		echo "sin contar";
	}else{

  $query2 = "SELECT item,unidades,gramos from codigo where codigo = ".$_GET['contador'];
  $result2 = mysql_query($query2);

	while ($array2 = mysql_fetch_array($result2)) {
		 echo $item2 = $array2['item'];
		 echo $unidades = $array2['unidades'];
		 echo $gramos = $array2['gramos'];
	}

	if ($_GET['item'][$item]  == $item2) {
	$acumulador = $contar+$unidades;
	$gramos2 = $gramos/1000;
	$acumulador2 = $cpeso+$gramos2;
	


	$query3 = "UPDATE contador_exito set contar = $acumulador,cpeso=$acumulador2 where remision = $factura and item = $item2";
	$result3 = mysql_query($query3);
	if ($result) {
		$_SESSION['factura'] = $factura;
		echo "Guardo";
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contar2_exito.php'>";
	}else{
		echo "Error Update: ".mysql_error();
	}

	}else{
		echo "Error = Este codigo de barras no corresponde a ese producto producto producto producto producto".$_GET['item'][$item];
	}

	
}
}

	

/*$fac = $_SESSION['fac'];
$number = $_GET['number'];
$contar = 0;
if ($fac == '12345') {
	
	$contar = $contar+$number;
	echo $contar;
}*/
?>
<!-- <META HTTP-EQUIV="REFRESH" CONTENT='0;URL=contar2.php'>
 --> 
