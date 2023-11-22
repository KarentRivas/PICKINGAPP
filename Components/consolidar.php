<?php
  session_start();
  //    1|54
  // "GET<pre>";$arra =print_r($_POST);echo "</pre>";
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
  // echo $response;

  //curl_close($curl);
  $json = json_decode($response, true);
  //echo  $json['SessionId'];;
  //exit;
  echo $sesion = $json['SessionId'];
  $_SESSION['idsesion'] = $sesion;

  require_once 'clases/cl_operaciones_sap.php';

  $mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
  $mysqli->set_charset("utf8");

  $fecha = date('Y-m-d');
  $hora = date("H:i:s",strtotime("-7 hour"));

  function resta($inicio, $fin)
  {
    $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
    return $dif;
  }

if ($_POST) {
  echo $id = $_POST['id'];             /* SESSION */  $_SESSION['id'] = $id;
  echo $picking = $_POST['picking'];   /* SESSION */  $_SESSION['picking'] = $picking;
  // $sucursal = $_POST['sucursal']; /* SESSION */  $_SESSION['sucursal'] = $sucursal;
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
      CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/sml.svc/VW_CLIENTE_PICKING_Parameters(entry='.$picking.')/VW_CLIENTE_PICKING',
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
    echo $response1 = curl_exec($curl1);
    //echo $ruta;

    //exit();
    curl_close($curl1);
    $respuestaCliente = json_decode($response1, true);
    //print_r($respuestaCliente);
    //echo "<br>";

    if ($respuestaCliente) {
        echo $cliente = $respuestaCliente['value'][0]['cliente'];
        echo $cantidad = $respuestaCliente['value'][0]['cantidad'];
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



  }else {
    $picking = $_SESSION['picking'];             /* SESSION */  $_SESSION['picking'] = $picking;
    $id = $_SESSION['id'];             /* SESSION */  $_SESSION['id'] = $id;
    // $sucursal = $_SESSION['sucursal']; /* SESSION */  $_SESSION['sucursal'] = $sucursal;
  }
?>
<table>

<?php
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
$sesion;
$response2 = curl_exec($curl2);
curl_close($curl2);
//echo $response2;
$result = json_decode($response2, true);
//print_r($result);

//$stadoPick = $result['value'];
//echo empty($stadoPick) ? "Array is empty.": "Array is not empty." ;
//echo $stadoPick;
//exit();

foreach($result['value'] as $key => $array)
{
  $pick =       $array['AbsEntry'];
  $lin =        $array['PickEntry'];
  $cliente =    $array['CardName'];
  $item =       $array['ItemCode'];
  $referencia = $array['Dscription'];
  $cantidad =   $array['RelQtty'];
  $pedido =     $array['OrderEntry'];
  $linpedido =  $array['OrderLine'];

  $query = "INSERT INTO picking(codigo,picking,linea,item,descripcion,cantidad,linPedido,numPedido)
            VALUES ('',$pick,$lin,'$item','$referencia',$cantidad,$linpedido,$pedido)";

  $resultado = $mysqli->query($query);

  if ($resultado) {
  }else {
    echo "Error Picking: ".$mysqli->error;
  }
?>
<tr>
  <td><center><h2><b><?php echo $pick ?></b></h2></center></td>
  <td><center><h2><b><?php echo $lin ?></b></h2></center></td>
  <td><center><h2><b><?php echo $item ?></b></h2></center></td>
  <td><center><h2><b><?php echo $referencia ?></b></h2></center></td>
  <td><center><h2><b><?php echo number_format($cantidad,0,".",",") ?></b></h2></center></td>
</tr>
  <?php
  }

  $query2 = "SELECT picking,item,descripcion,SUM(cantidad) as cantidad
             FROM picking
             WHERE picking = $pick
             GROUP BY item";

  $resultado2 = $mysqli->query($query2);

  if ($resultado2) {
    while ($array = mysqli_fetch_array($resultado2)) {
      $picking = $array['picking'];
      $item = $array['item'];
      $descripcion = $array['descripcion'];
      $cantidad = $array['cantidad'];

      $query3 = "INSERT INTO contador (codigo,picking,item,descripcion,cantidad)
               VALUE ('',$picking,'$item','$descripcion',$cantidad)";
      $resultado3 = $mysqli->query($query3);

      if ($resultado3) {

      }else {
        echo "Error Consulta Consolidado: ".$mysqli->error;
      }

      /***DESCONSOLIDADO***/

      $query4 = "INSERT INTO desconsolidado (codigo,picking,item,descripcion,cantidad)
               VALUE ('',$picking,'$item','$descripcion',$cantidad)";
      $resultado4 = $mysqli->query($query4);

      if ($resultado4) {
      }else {
        echo "Error Consulta Consolidado: ".$mysqli->error;
      }

    }
  }else {
    echo "Error Consolidado: ".$mysqli->error;
  }

?>

</table>

<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=buscar_lpicking.html'>
