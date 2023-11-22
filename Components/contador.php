<?php
session_start();
$mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
$mysqli->set_charset("utf8");

$codigo = $_POST['codigo'];
$id = $_SESSION['id'];
$picking = $_SESSION['picking'];

$query5 = "SELECT * FROM contador WHERE picking = $picking AND ok = ''";
$result5 = $mysqli->query($query5);
echo $numok = mysqli_num_rows($result5);

if ($numok > 0) {
  echo "$numok";

  $query = "SELECT unidades,item FROM codigo_sap WHERE codigo = '$codigo'";
  $result = $mysqli->query($query);
  if ($result) {
    while ($array = mysqli_fetch_array($result)) {
      $unidades = $array['unidades'];
      $item = $array['item'];
    }
  }else {
    echo "Error Codigo:".$mysqli->error;
  }

  $query2 = "SELECT contador,cantidad FROM contador WHERE picking = $picking AND item = '$item'";
  $result2 = $mysqli->query($query2);
  $valores = mysqli_num_rows($result2);
  if ($valores == 0) {
    echo "LA REFERENCIA INGRESADA NO PERTENECE A ESTA LISTA DE PICKING";
    ?><META HTTP-EQUIV='REFRESH' CONTENT='3;URL=picking.php'><?php
  }else {
    if ($result2) {
      while ($array2 = mysqli_fetch_array($result2)) {
         $contador = $array2['contador'];
         $cantidad = $array2['cantidad'];

        echo $contar = $contador+$unidades;

        if ($contar == $cantidad) {
          $query4 = "UPDATE contador SET ok = 'OK',contador = $contar WHERE picking = $picking AND item = '$item'";
          $result4 = $mysqli->query($query4);
          if ($result4) {
            // code...
            header('Location: picking.php');
          }else {
            echo "Error al dar OK: ".$mysqli->error;
          }

          $query3c = "UPDATE desconsolidado SET faltante = $contar WHERE picking = $picking AND item = '$item'";
          $result3c = $mysqli->query($query3c);
          if ($result3c) {
            header('Location: picking.php');
          }else {
            echo "Error Guardar CONTADOR: ".$mysqli->error;
            }
        }

        if ($contar < $cantidad) {

          $query3 = "UPDATE contador SET contador = $contar WHERE picking = $picking AND item = '$item'";
          $result3 = $mysqli->query($query3);
          if ($result3) {
            header('Location: picking.php');
          }else {
            echo "Error Guardar CONTADOR: ".$mysqli->error;
            }

          $query3c = "UPDATE desconsolidado SET faltante = $contar WHERE picking = $picking AND item = '$item'";
          $result3c = $mysqli->query($query3c);
          if ($result3c) {
            header('Location: picking.php');
          }else {
            echo "Error Guardar CONTADOR: ".$mysqli->error;
            }


          }if ($contar > $cantidad) {
            echo "LA CANTIDAD CONTADA ES MAYOR QUE LA LIBERADA";
          }
        }
      }
    }

  }else {
    echo "PICKING FINALIZADO";
    $query6 = "SELECT item,cantidad,linea FROM picking WHERE picking = $picking";
    $result6 = $mysqli->query($query6);
    if ($result6) {
      while ($array6 = mysqli_fetch_array($result6)) {
        $item = $array6['item'];
        $cantidad = $array6['cantidad'];
        $linea = $array6['linea'];

        $query7 = "SELECT cantidad FROM desconsolidado WHERE picking = $picking AND item ";
        $result7 = $mysqli->query($query7);
        if ($result7) {
          while ($array7 = mysqli_fetch_array($result7)) {
            $cantidad_des = $array7['cantidad'];
            $desconsolidar = $cantidad_des - $cantidad;
          }
        }
      }
    }
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
    $sesion = $json['SessionId'];
    $_SESSION['idsesion'] = $sesion;
    header('Location: desconsolidar.php?picking='.$picking);

  }


 ?>
