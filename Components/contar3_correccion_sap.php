<?php
  error_reporting(0);
session_start();
//mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
//mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");
$mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
$mysqli->set_charset("utf8");

// $codigo = $_POST['codigo'];
$picking = $_SESSION['picking'];
$id = $_SESSION['id'];
$sucursal = $_SESSION['sucursal'];
// $sucursal = $_SESSION['sucursal'];

$_SESSION['picking'] = $picking;
$_SESSION['id'] = $id;
$_SESSION['sucursal'] = $sucursal;

// $_SESSION['sucursal'] = $sucursal;

$contar = strlen($_POST['codigo']);

if ($contar == 18) {
 $codigo = $_POST['codigo'];
 $codigo = substr($codigo,0,4);
}else{

 $codigo = $_POST['codigo'];

}

$fecha = date('Y-m-d');
$hora = date("H:i:s",strtotime("-7 hour"));

?>

<!DOCTYPE html>
<html>
<link href='https://fonts.googleapis.com/css?family=Syncopate' rel='stylesheet' type='text/css'>
  <head>
    <meta charset="utf-8">
    <title>CONTADOR</title>

    <style media="screen">
    h2{
      /*font-family: 'Poiret One', cursive;*/
      font-family: 'Syncopate', sans-serif;
      font-size: 30px;
    }
    h1{
      font-family: 'Syncopate', sans-serif;
      font-size: 300%;
    }


    </style>

  <script type="text/javascript">

    var par=false;
    function parpadeo() {
        col=par ? 'red' : 'black';
        document.getElementById('txt').style.color=col;
        par = !par;
        setTimeout("parpadeo()",500); //500 = medio segundo
    }
    window.onload=parpadeo;
    </script>

  </head>
  <body>

  </body>
</html>

<?php
$query = "SELECT codigo,medida,item,referencia,unidades,gramos,peso
FROM codigo_sap WHERE codigo = '$codigo' ";

$result = $mysqli->query($query);
if ($result) {

  while ($array = mysqli_fetch_array($result)) {
    $item = $array['item'];
    $unidades = $array['unidades'];
  }

  $query2 = "SELECT cantidad,contar
  FROM contador_sap WHERE item = '$item' and picking = '$picking' and sucursal='$sucursal' ";

  $result2 = $mysqli->query($query2);
  $num = mysqli_num_rows($result2);

  if ($num == 0) {
    echo $query9 = "INSERT INTO error_picking_sap(cod,picking,usuario,item,fecha,hora)
    VALUES ('','$picking','$id','$item','$fecha','$hora')";

    $result9 = $mysqli->query($query9);

    if ($result9) {
      ?>

        <CENTER>

          <br>
          <br>
          <br>
          <br>
        <span id="txt">
          <H1>
            EL PRODUCTO INGRESADO NO PERTENECE A ESTE DOCUMENTO DE PICKING
            <META HTTP-EQUIV='REFRESH' CONTENT='3;URL=contar_correccion_sap.php'>
          </H1>
        </span>
        <?php
    }else{
      echo "Error: ". $mysqli->error;
    }
  }


  if ($result2) {

    while ($array2 = mysqli_fetch_array($result2)) {
      $contar = $array2['contar'];
      $cantidad = $array2['cantidad'];
    }
  }
}else{

}

$acumulador = $unidades + $contar;

if ($acumulador == $cantidad) {

  $query4 = "UPDATE contador_sap SET contar = $acumulador, ok = 'Ok'
  WHERE item = '$item' and picking = '$picking' and sucursal = '$sucursal'";

  $result4 = $mysqli->query($query4);

  if ($result4) {
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contar_correccion_sap.php'>";
  }else{
    echo "Error: ".$mysqli->error;
  }

}if ($acumulador < $cantidad) {

  $query3 = "UPDATE contador_sap SET contar = $acumulador, barras = '$codigo'
  WHERE item = '$item' and picking = '$picking' and sucursal = '$sucursal'";

  $result3 = $mysqli->query($query3);

  if ($result3) {
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contar_correccion_sap.php'>";
  }else{
    echo "Error: ".$mysqli->error;
  }
}if ($acumulador > $cantidad) {

  $fecha = date('Y-m-d');
  $hora =  date('H:i');

  $query5 = "INSERT INTO error_picking_sap(cod,picking,usuario,item,fecha,hora)
  VALUES ('','$picking','$id','$item','$fecha','$hora')";

  $result5 = $mysqli->query($query5);
  
  if ($result5) {

  }else{
    echo "Error: ". $mysqli->error;
  }
?>

  <CENTER>

    <br>
    <br>
    <br>
    <br>
  <span id="txt">
    <H1>
      LA CANTIDAD CERTIFICADA ES MAYOR A LA SOLICITADA EN EL PICKING
      <!-- <META HTTP-EQUIV='REFRESH' CONTENT='3;URL=contar_correccion_sap.php'> -->
    </H1>
  </span>
  <?php

}
 ?>
