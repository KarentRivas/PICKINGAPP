<?php
  error_reporting(0);
  session_start();


  if (!isset($_SESSION['sesion']))
  {
    //Conexion a Service Layer
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/Login',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"CompanyDB": "PRODMANITOBA", "Password": "1234", "UserName": "soporte"}',
      CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
    ));
    $response = curl_exec($curl);
    //echo $response;

    //curl_close($curl);
    $json = json_decode($response, true);
    //echo  $json['SessionId'];;
    //exit;
    $sesion = $json['SessionId'];
    $_SESSION['sesion'] = $sesion;
    echo "inicio "; echo  $sesion;
  }
  else{
    $sesion = $_SESSION['sesion'];
    echo "else "; echo  $sesion;
  }

  require_once 'clases/cl_operaciones_sap.php';

  $mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
  $mysqli->set_charset("utf8");

  echo $fecha = date('Y-m-d');

  $hora = date("H:i:s",strtotime("-7 hour"));

  function resta($inicio, $fin)
  {
    $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
    return $dif;
  }

//echo "POST<pre>";$arra =print_r($_POST);echo "</pre>";
if ($_POST) {
  $id = $_POST['id'];             /* SESSION */
  $_SESSION['id'] = $id;
  $picking = $_POST['picking'];             /* SESSION */
  $_SESSION['picking'] = $picking;
  $sucursal = $_POST['cbxSucursal'];
  $_SESSION['sucursal'] = $sucursal;
  // $sucursal = $_POST['sucursal']; /* SESSION */  $_SESSION['sucursal'] = $sucursal;
  //echo " id: ".$id." - picking: ". $picking." - sucursal: ".$sucursal;
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



    $curl1 = curl_init();
    //$ruta='https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/sml.svc/VW_CLIENTE_PICKINGParameters(entry='.$picking.')/VW_CLIENTE_PICKING';

    curl_setopt_array($curl1, array(
    CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/sml.svc/VW_CLIENTE_PICKINGParameters(entry='.$picking.')/VW_CLIENTE_PICKING',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Cookie: B1SESSION='.$sesion.''
    ),
  ));
  $response1 = curl_exec($curl1);
  //echo $ruta;

  //exit();
  curl_close($curl1);
  $respuestaCliente = json_decode($response1, true);
  //print_r($respuestaCliente);
  //echo "<br>";

  if ($respuestaCliente) {
      $cliente = $respuestaCliente['value'][0]['cliente'];
      $cantidad = $respuestaCliente['value'][0]['cantidad'];
  }
  //echo $cliente;
  //echo "<br>";
  //echo $cantidad;
  //exit();

  $query0 = "INSERT INTO resumen_picking_sap(cod,id,nombre,cliente,picking,cantidad,fecha,
  hora_inicio) VALUES ('', $id,'$nombre','$cliente',$picking,$cantidad,'$fecha','$hora')";
//echo $query0;
  $result0 =$mysqli->query($query0);
  if ($result0) {

  }else {
    echo "Error 2: ".$mysqli->error;
  }


  $query8 = "INSERT INTO cajas_picking_sap(cod,picking,grande,nacional,mini,prestigio,exportacion,mantequilla,mediana)
  VALUES ('',$picking,$grande,$nacional,$mini,$prestigio,$exportacion,$mantequilla,$mediana)";

  $result8 = $mysqli->query($query8);

  if ($result8) {

  }else {
    echo "Error 3: ".$mysqli->error;
  }


}else {
  $picking = $_SESSION['picking'];             /* SESSION */
  $_SESSION['picking'] = $picking;
  $id = $_SESSION['id'];             /* SESSION */
  $_SESSION['id'] = $id;
  $sucursal = $_SESSION['sucursal'];
  $_SESSION['sucursal'] = $sucursal;
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

    #loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background-color: #FFFFFF;
      z-index: 9;
      opacity: 0.7;
      display:flex;
      justify-content:center;
      align-items:center;
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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="js/guardaparcial.js"></script>

  </head>
  <body>

<form class="" action="contar3_correccion_sap.php" method="post">

<?php


$query6 = "SELECT cod,ok  FROM contador_sap WHERE picking = '$picking' and ok = '' and sucursal = '$sucursal'";
$result6 = $mysqli->query($query6);
$oks = mysqli_num_rows($result6);

$query7 = "SELECT cod,ok  FROM contador_sap WHERE picking = '$picking' and sucursal = '$sucursal'";
$result7 = $mysqli->query($query7);
$rows = mysqli_num_rows($result7);

if (($oks == 0) AND ($rows <> 0 ) ) {

  $query13 = "SELECT hora_inicio FROM resumen_picking_sap WHERE picking = '$picking'";
  $result13 = $mysqli->query($query13);

  if ($result13) {
    while ($array13 = mysqli_fetch_array($result13)) {
      $hora_inicio = $array13['hora_inicio'];
    }

    $horaf = date("H:i:s",strtotime("-7 hour"));
    $tiempo=resta($hora_inicio,$horaf);

    $query14 = "UPDATE resumen_picking_sap SET hora_fin = '$horaf', tiempo = '$tiempo'
    WHERE picking = '$picking'";

    $result14 = $mysqli->query($query14);

    if ($result14) { }
    else {
      echo "Error 5: ". $mysqli->error;
    }

  }

  ?>
<center>
  <br>
  <br>
  <h3>
    <span id="txt">

    <?php

      $curlPick = curl_init();
        curl_setopt_array($curlPick, array(
        CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/sml.svc/VW_ESTADO_PICKINGParameters(picking='.$picking.')/VW_ESTADO_PICKING',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('Content-Type: application/json','Cookie: B1SESSION='.$sesion.''),
      ));
      $responsePick = curl_exec($curlPick);
      curl_close($curlPick);
      $respuestaPick = json_decode($responsePick, true);
      //print_r($respuestaPick);
      if ($respuestaPick) {
          $estado = $respuestaPick['value'][0]['Status'];
      }
      //echo $estado;
      //exit();
      //$result = true;

      if ($estado == 'R')
      {
        ?>
          PICKING FINALIZADO..!
        <?php
          //$Consulta = "SELECT "

          //$OpePicking = new cl_operaciones_sap();
          //$OpePicking->AsignarPicking($picking);
          //$OpePicking->ActualizarPicking();
        ?>

        <META HTTP-EQUIV='REFRESH' CONTENT='2;URL=ingresar_pick.php'>
        <?php
      }
      else{
        ?>
         PICKING YA REGISTRADO..!
        <META HTTP-EQUIV='REFRESH' CONTENT='2;URL=ingresar_pick.php'>
        <?php
      }
    ?>
    </span>
  </h1>
  <?php
}else{
  $curl2 = curl_init();
  curl_setopt_array($curl2, array(
    CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/sml.svc/VW_DATOS_PICKINGParameters(picking='.$picking.')/VW_DATOS_PICKING',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
	  'Prefer:odata.maxpagesize=500',
      'Content-Type: application/json',
      'Cookie: B1SESSION='.$sesion.''
    ),
  ));
  $response2 = curl_exec($curl2);
  curl_close($curl2);
  //echo $response2;
  $result = json_decode($response2, true);
  //print_r($result);

  $stadoPick = $result['value'];
  //echo empty($stadoPick) ? "Array is empty.": "Array is not empty." ;
  //echo $stadoPick;
  //exit();
  echo "<br><h2>";
  echo "Observaciones: ";
  echo $stadoPick[0]['Remarks'];
  echo "</h2><br>";



?>

<input type="text" name="codigo" autofocus>

<center>

    <table  border="1">
      <tr>
      <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">PICKING</font></h2></b></center>
        </td>
        <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">LINEA</font></h2></b></center>
        </td>
        <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">ITEM</font></h2></b></center>
        </td>
        <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">REFERENCIA</font></h2></b></center>
        </td>
        <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">CANTIDAD</font></h2></b></center>
        </td>
        <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">CONTAR</font></h2></b></center>
        </td>
        <td bgcolor="green" font-size="50%" >
          <center><b><h2><font color="white">SUCURSAL</font></h2></b></center>
        </td>
      </tr>
<?php


  $query = "SELECT * FROM asignacion_picking_sap WHERE picking = $picking and alistador = $id AND sucursal = '$sucursal'";
  $result = $mysqli->query($query);


  if ($result)
  {
    while ($array = mysqli_fetch_array($result))
    {
      $pick =       $array['picking'];
      $lin =        $array['linPicking'];
      $item =       $array['item'];
      $referencia = $array['referencia'];
      $cantidad =   $array['cantidad'];
      $sucursal =   $array['sucursal'];
      $pedido =     $array['numPedido'];
      $linpedido =  $array['linPedido'];

      //echo $pick." - ". $lin ." - ".$cliente. " - ".$item." - ". $referencia ." - ".$cantidad;
      //echo "<br>";

      $query2 = "SELECT cod,picking,item,referencia,cantidad,contar,ok,barras
                  FROM contador_sap WHERE picking = '$picking' and item = '$item' and sucursal = '$sucursal'";
      //echo  $query2;
      //echo "<br>";
      $result2 = $mysqli->query($query2);
      $filas = mysqli_num_rows($result2);

      if ($result2)
      {
        if ($filas > 0)
        {
          while ($array2 = mysqli_fetch_array($result2))
          {
            $contar2 = $array2['contar'];
            $ok2 = $array2['ok'];
            ?>

  <tr>
    <td><center><b><?php echo $pick ?></b></center></td>
    <td><center><b><?php echo $lin ?></b></center></td>
    <td><center><b><?php echo $item ?></b></center></td>
    <td><center><b><?php echo $referencia ?></b></center></td>
    <td><center><b><?php echo number_format($cantidad,0,".",",") ?></b></center></td>
    <td><center><b><?php echo number_format($contar2,0,".",",") ?></b></center></td>
    <td><center><b><?php echo $sucursal ?></b></center></td>
    <td><center><b><?php if ($ok2 == 'Ok') { ?><img src="hi.png"/><?php } ?></b></center></td>
  </tr>

  <?php
          }

        }
        else
        {
          $query3 = "INSERT INTO contador_sap(cod,picking,item,referencia,cantidad,numPedido,linPedido,sucursal)
                      VALUES ('$lin','$picking','$item','$referencia',$cantidad,$pedido,$linpedido,'$sucursal')";
          $result3 = $mysqli->query($query3);
          if ($result3) {
        ?>
          <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contar_correccion_sap.php'>
        <?php
        }else {
          echo "Error 6: ".$mysqli->error;
        }
      }
      }else
      {
        echo "Error 7: ".$mysqli->error;
      }
    }
  }
  else
  {
    ?>
<center>
  <br>
  <br>
  <h3>
    <span id="txt">
      PICKING YA REGISTRADO..!
      <META HTTP-EQUIV='REFRESH' CONTENT='2;URL=ingresar_pick.php'>
    </span>
  </h1>
  <?php
  }

?>
    </table>
    <button>continuar</button>
    <!--<button id="parcial" name="parcial" type="button" onclick = "accion(<?php echo $picking ?>);">Registro Parcial</button>-->
    <button type="button" onclick="location.href='ingresar_pick.php';">Regresar</button>
    <div id="loader" style="display: none">
      <img src="img/loader.gif" alt="loader">
    </div>


<?php
}
 ?>

</center>
</form>
</body>
</html>
