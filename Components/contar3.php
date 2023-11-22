<?php
session_start();
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");


// "GET<pre>";$arra =print_r($_GET);echo "</pre>";

$acumulador = 0;

$factura =  $_SESSION['factura'];
$codigo =  $_SESSION['codigo'];

$_SESSION['factura'] = $factura;
$_SESSION['codigo'] = $codigo;

echo $contador = $_GET['contador'];


$query = "SELECT factura,item,referencia,cantidad,contar,peso,cpeso 
from contador where factura = $factura";

$result = mysql_query($query);

while ($array = mysql_fetch_array($result)) {
	$item = $array['item'];
	$contar = $array['contar'];
	$cpeso = $array['cpeso'];

	if ($_GET['contador'] == '') {
		# code...
	}else{
  $query2 = "SELECT item,unidades,gramos from codigo where codigo = ".$_GET['contador'];
  $result2 = mysql_query($query2);

	while ($array2 = mysql_fetch_array($result2)) {
		 $item2 = $array2['item'];
		 $unidades = $array2['unidades'];
		 $gramos = $array2['gramos'];
	}

	if ($_GET['item'][$item]  == $item2) {
	$acumulador = $contar+$unidades;
	$gramos2 = $gramos;
	 $acumulador2 = $cpeso+$gramos2;
	


	$query3 = "UPDATE contador set contar = $acumulador,cpeso=$acumulador2 where factura = $factura and item = $item2";
	$result3 = mysql_query($query3);
	if ($result) {
		$_SESSION['factura'] = $factura;
		echo "Guardo";
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contar2.php'>";
	}else{
		echo "Error Update: ".mysql_error();
	}

	}else{
		echo "Error = Este codigo de barras no corresponde a ese producto".$_GET['item'][$item];
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
