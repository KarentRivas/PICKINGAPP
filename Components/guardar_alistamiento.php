<?php
session_start();
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");


$factura = $_POST['factura'];
$codigo = $_POST['codigo'];
$fecha = date('Y-m-d');
$hora =  date("H:i:s",strtotime("-7 hour"));

$query = "SELECT DISTINCT factura,sum(cantidad) as cantidad, cliente FROM facturas WHERE factura = $factura ";
$result = mysql_query($query);

if ($result) {
  while ($array = mysql_fetch_array($result)) {
    $cantidad = $array['cantidad'];
    $cliente = $array['cliente'];
  }
}else {
  echo "Error: ".mysql_error();
}

$query2 = "SELECT nombre FROM alistador WHERE codigo = '$codigo'";
$result2 = mysql_query($query2);

if ($result2) {
  while ($array2 = mysql_fetch_array($result2)) {
    $nombre = $array2['nombre'];
  }
}

$query3 =  "INSERT INTO resumen_alistador(cod,id,nombre,cliente,factura,cantidad,fecha,hora_inicio)
VALUES ('','$codigo','$nombre','$cliente',$factura,$cantidad,'$fecha','$hora')";

$result3 = mysql_query($query3);

if ($query3) {
  echo "GUARADAR ALISTAMIENTO <BR>";
  $query4 = "UPDATE facturas SET alistador = '$codigo' where factura = $factura";
  $result4 = mysql_query($query4);

  if ($result4) {
    echo "UPDATES ALISTAMIENTO <BR>";

  echo "<center> <h1> OK </h1> </center>";
  echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=iniciar_alistamiento.php'>";
  }else {
    echo "Error: ".mysql_error;
  }

}else {
  echo "Error: ".mysql_error;
}
 ?>
