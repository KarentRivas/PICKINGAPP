<?php
session_start();
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

echo "GET<pre>";$arra =print_r($_POST);echo "</pre>";

$id = $_POST['id'];
$item = $_POST['item'];
$referencia = $_POST['referencia'];
$medida = $_POST['medida'];
$cantidad = $_POST['cantidad'];

$query = "SELECT codigo,medida,item,referencia,unidades FROM codigo WHERE codigo = $id";
$result = mysql_query($query);
$num = mysql_num_rows($result);

echo "$num";

if ($num == 0) {
  $query2 = "INSERT INTO codigo(codigo,medida,item,referencia,unidades) VALUES ('$id','$medida',$item,'$referencia',$cantidad)";
  $result = mysql_query($query2);
  if ($result) {
    // code...
  }else {
    echo "Error al registrar un codigo nuevo:".mysql_error();
  }
}else {
  $query3 = "UPDATE codigo SET medida='$medida',item=$item,referencia='$referencia',unidades=$cantidad WHERE codigo = '$id'";
  $result3 = mysql_query($query3);

  if ($result3) {
    // code...
  }else {
    echo "Error al modificar la referencia: ".mysql_error();
  }
}

 ?>
