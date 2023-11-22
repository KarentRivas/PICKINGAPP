<?php
session_start();

$mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
$mysqli->set_charset("utf8");

//mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
//mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");


echo $fecha = date('Y-m-d');
$hora = date("H:i:s",strtotime("-7 hour"));

function resta($inicio, $fin)
  {
  $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
  return $dif;
  }

//echo "POST<pre>";$arra =print_r($_POST);echo "</pre>";
if ($_POST) {
  $id = $_POST['id'];             /* SESSION */  $_SESSION['id'] = $id;
  $factura = $_POST['factura'];             /* SESSION */  $_SESSION['factura'] = $factura;
  // $sucursal = $_POST['sucursal']; /* SESSION */  $_SESSION['sucursal'] = $sucursal;


  $grande = $_POST['grande'];
  $mediana = $_POST['mediana'];
  $prestigio = $_POST['prestigio'];
  $nacional = $_POST['nacional'];
  $mantequilla = $_POST['mantequilla'];
  $mini = $_POST['mini'];
  $exportacion = $_POST['exportacion'];

  $query11 = "SELECT nombre FROM alistador WHERE id = $id";
  //$result11 = $mysqli->query($query11);

  $result11 = $mysqli->query($query11);

  if ($result11) {
    while ($array11 = mysqli_fetch_array($result11)) {
      $nombre = $array11['nombre'];
    }
  }else {
    echo "Error 1: ".$mysqli->error;
  }


  $query12 = "SELECT cliente, sum(cantidad) as cantidad FROM facturas
  WHERE factura = $factura";
  $result12 = $mysqli->query($query12);

  if ($result12) {
    while ($array12 = mysqli_fetch_array($result12)) {
      $cliente = $array12['cliente'];
      $cantidad = $array12['cantidad'];
    }
  }

  $query0 = "INSERT INTO resumen_picking(cod,id,nombre,cliente,factura,cantidad,fecha,
  hora_inicio) VALUES ('', $id,'$nombre','$cliente',$factura,$cantidad,'$fecha','$hora')";

  $result0 =$mysqli->query($query0);
  if ($result0) {

  }else {
    echo "Error 2: ".$mysqli->error;
  }


  $query8 = "INSERT INTO cajas_picking(cod,factura,grande,nacional,mini,prestigio,exportacion,mantequilla,mediana)
  VALUES ('',$factura,$grande,$nacional,$mini,$prestigio,$exportacion,$mantequilla,$mediana)";

  $result8 = $mysqli->query($query8);

  if ($result8) {

  }else {
    echo "Error 3: ".$mysqli->error;
  }

  $query9 = "UPDATE facturas SET picking = $id WHERE factura = '$factura'";
  $result9 = $mysqli->query($query9);

  if ($result9) {

  }else {
    echo "Error 4: ".$mysqli->error;
  }



}else {
  $factura = $_SESSION['factura'];             /* SESSION */  $_SESSION['factura'] = $factura;
  $id = $_SESSION['id'];             /* SESSION */  $_SESSION['id'] = $id;
  // $sucursal = $_SESSION['sucursal']; /* SESSION */  $_SESSION['sucursal'] = $sucursal;
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <title>Buscar Factura!</title>
    <!-- <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Syncopate' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lemon" rel="stylesheet">
    <style media="screen">
      h2{
        /*font-family: 'Poiret One', cursive;*/
        font-family: ''Syncopate', sans-serif';
        font-size: 22px;
      }
      h1{
        font-family: ''Syncopate', sans-serif';
        font-size: 200%;
      }

      h3{
        font-family: ''Lemon', cursive';
        font-size: 600%;
      }

      .css-input {
       padding:16px;
       font-size:27px;
       text-align:center;
       border-width:6px;
       border-radius:20px;
       border-style:inset;
       background-color:#fff;
       border-color:#7D12C9;
       box-shadow: 0px 0px 5px 0px rgba(42,42,42,.75);
       font-weight:normal;
       font-style:italic;
       font-family: 'Syncopate', sans-serif;

      }
    .css-input:focus {
     outline:none;
     font-family: 'Syncopate', sans-serif;

    }

    button {
      border: none;
      background: green;
      color: #f2f2f2;
      padding: 10px;
      font-size: 18px;
      border-radius: 5px;
      position: relative;
      box-sizing: border-box;
      transition: all 500ms ease;
      box-shadow: 15 0 0 3px red;
      font-family: 'Syncopate', sans-serif;


     }
     button:hover {
      background: rgba(0,0,0,0);
      color: green;
      box-shadow: inset 0 0 0 3px green;
      font-family: 'Syncopate', sans-serif;
     }
     body {
             /* background: #fff url(fondo.jpg) no-repeat center top; */
             -webkit-background-size: cover;
             -moz-background-size: cover;
             background-size: cover;
           }
    </style>

    <script>
    var par=false;
    function parpadeo() {
        col=par ? '#7C10D5' : 'black';
        document.getElementById('txt').style.color=col;
        par = !par;
        setTimeout("parpadeo()",500); //500 = medio segundo
    }
    window.onload=parpadeo;
    </script>

  </head>
  <body>

<form class="" action="contar3_correccion.php" method="post">

<?php


$query6 = "SELECT cod,ok  FROM contador WHERE factura = '$factura' and ok = ''";
$result6 = $mysqli->query($query6);
$oks = mysqli_num_rows($result6);

$query7 = "SELECT cod,ok  FROM contador WHERE factura = '$factura'";
$result7 = $mysqli->query($query7);
$rows = mysqli_num_rows($result7);

if (($oks == 0) AND ($rows <> 0 ) ) {

$query13 = "SELECT hora_inicio FROM resumen_picking WHERE factura = '$factura'";
$result13 = $mysqli->query($query13);

if ($result13) {
  while ($array13 = mysqli_fetch_array($result13)) {
    $hora_inicio = $array13['hora_inicio'];
  }


$horaf = date("H:i:s",strtotime("-7 hour"));
$tiempo=resta($hora_inicio,$horaf);

$query14 = "UPDATE resumen_picking SET hora_fin = '$horaf', tiempo = '$tiempo'
WHERE factura = '$factura'";

$result14 = $mysqli->query($query14);

if ($result14) {

}else {
  echo "Error 5: ". $mysqli->error;
}

}

  ?>
<center>
  <br>
  <br>
  <h3>
    <span id="txt">
      FACTURA FINALIZADA..!
      <META HTTP-EQUIV='REFRESH' CONTENT='2;URL=ingresar_fc.php'>
    </span>
  </h1>
  <?php
}else{


?>

<input type="text" name="codigo" autofocus>

<center>

    <table>
      <tr>
        <td bgcolor="green" font-size="50%" >
          <center>
            <b>
              <h2>
                <font color="white">
                ITEM
              </font>
              </h2>
            </b>
          </center>
        </td>

        <td bgcolor="green" font-size="50%" >
          <center>
            <b>
              <h2>
                <font color="white">
                REFERENCIA
              </font>
              </h2>
            </b>
          </center>
        </td>

        <td bgcolor="green" font-size="50%" >
          <center>
            <b>
              <h2>
                <font color="white">
                CANTIDAD
              </font>
              </h2>
            </b>
          </center>
        </td>

        <td bgcolor="green" font-size="50%" >
          <center>
            <b>
              <h2>
                <font color="white">
                CONTAR
              </font>
              </h2>
            </b>
          </center>
        </td>
      </tr>
<?php



$query = "SELECT DISTINCT item, cliente,referencia,cantidad FROM facturas WHERE factura = '$factura'";
$result = $mysqli->query($query);

if ($result) {

  while ($array = mysqli_fetch_array($result)) {


  $cliente = $array['cliente'];
  $item = $array['item'];
  $referencia = $array['referencia'];
  $cantidad = $array['cantidad'];

$query2 = "SELECT cod,factura,item,referencia,cantidad,contar,ok,barras
FROM contador WHERE factura = '$factura' and item = $item";
$result2 = $mysqli->query($query2);
$filas = mysqli_num_rows($result2);

if ($result2) {



  if ($filas > 0) {

while ($array2 = mysqli_fetch_array($result2)) {
  $contar2 = $array2['contar'];
  $ok2 = $array2['ok'];
  ?>

  <tr>
    <td>
      <center>
        <h2>
          <b>
            <?php echo $item ?>
          </b>
        </h2>
      </center>
    </td>

    <td>
      <center>
        <h2>
          <b>
            <?php echo $referencia ?>
          </b>
        </h2>
      </center>
    </td>

    <td>
      <center>
        <h2>
          <b>
            <?php echo $cantidad ?>
          </b>
        </h2>
      </center>
    </td>

    <td>
      <center>
        <h2>
          <b>
              <?php echo $contar2 ?>
          </b>
        </h2>
      </center>
    </td>

    <td>
      <center>
        <h2>
          <b>
              <?php
              if ($ok2 == 'Ok') {
                ?>
                <img src="hi.png"/>
                <?php
              }
              ?>
          </b>
        </h2>
      </center>
    </td>
  </tr>

  <?php
}

}else{
  $query3 = "INSERT INTO contador(cod,factura,item,referencia,cantidad)
    VALUES ('','$factura','$item','$referencia',$cantidad)";

    $result3 = $mysqli->query($query3);

    if ($result3) {
    ?>
      <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contar_correccion.php'>
    <?php
    }else {
      echo "Error 6: ".$mysqli->error;
    }
}
}else{
  echo "Error 7: ".$mysqli->error;
}
  }

}

?>
    </table>

    <button > continuar </button>

<?php
}
 ?>

</center>
</form>
</body>
</html>
