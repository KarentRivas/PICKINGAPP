<?php
session_start();
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

$codigo = $_SESSION['codigo'];
$id = $_SESSION['id'];
$fecha = date('Y-m-d');

 $contar = strlen($codigo);
if ($contar == 18) {

	$codigo = substr($codigo,0,4);
}else{

	$codigo = $_SESSION['codigo'];
}

$item = $_POST['item'];
$referencia = $_POST['referencia'];
$medida = $_POST['medida'];
$unidades = $_POST['unidades'];
$unidades = $_POST['unidades'];
$gramos = $_POST['gramos'];
$peso = $_POST['peso'];

$query = "UPDATE codigo SET medida='$medida',unidades=$unidades,gramos=$gramos,peso=$peso
WHERE codigo = $codigo";

$result = mysql_query($query);

if ($result) {

  $query2 = "INSERT INTO `mod_codigos`(`cod`, `codigo`, `id`, `fecha`)
  VALUES ('','$codigo','$id','$fecha') ";
  $result2 = mysql_query($query2);

  if ($result2) {
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=buscar_codigo.php'>";

  }else {
    echo "Error: ".mysql_error();
  }

}else {
  echo "Error: ".mysql_error();
}


 ?>
