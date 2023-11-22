<?php
session_start();
$mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
$mysqli->set_charset("utf8");
echo "GET<pre>";$arra =print_r($_SESSION);echo "</pre>";


/***********DESCONSOLIDADO****************/
echo $picking = $_GET['picking'];


$query = "SELECT codigo, picking, linea, item, descripcion, cantidad, efectuado FROM picking WHERE picking = $picking";
$result = $mysqli->query($query);

if ($result) {
  while ($array = mysqli_fetch_array($result)) {
    $codigo = $array['codigo'];
    $picking = $array['picking'];
    $linea = $array['linea'];
    $item = $array['item'];
    $descripcion = $array['descripcion'];
    $cantidad = $array['cantidad'];
    $efectuado = $array['efectuado'];

    // echo "<br>0";
    // echo "<br>";

    /********************AQUI ESTA CONSOLIDADO PARA SACAR***************************/

    echo $conso = "SELECT codigo, picking, item, descripcion, cantidad, faltante
              FROM desconsolidado
              WHERE picking = $picking and item = '$item'";

              echo "<br>";

         $rescon = $mysqli->query($conso);

         if ($rescon) {
           while ($arrayc = mysqli_fetch_array($rescon)) {

              $codigo2 = $arrayc['codigo'];
              $picking2 = $arrayc['picking'];
              $item2 = $arrayc['item'];
              $descripcion2 = $arrayc['descripcion'];
              $cantidad2 = $arrayc['cantidad']; echo "<BR>";
              $faltante2 = $arrayc['faltante'];

            if ($faltante2 == 0) {
              echo "es cero entonces cantidad es igual a faltante2";
            }else{


            if ($faltante2 >= $cantidad) {
              echo  $desconsolidar = $faltante2 - $cantidad; echo "<br>";

              /***actualizacion de consolidado es el resultado de la resta****/
              $updcon = "UPDATE desconsolidado SET faltante = $desconsolidar
                         WHERE picking = $picking and item = '$item'";

              $resupdcon = $mysqli->query($updcon);
              if ($resupdcon) {
                echo "<BR>"; echo $faltante2; echo "<BR>";
              }else {
                echo "Error al desconsolidar: ".$mysqli->error;
              }

              $upddes = "UPDATE picking SET efectuado = $cantidad
                         WHERE picking = $picking and item = '$item' and codigo = $codigo";
              $resupddes = $mysqli->query($upddes);

              if ($resupddes) {
                // code...
              }else {
                echo "Error al actualizar el pickin ejecutado: ".$mysqli->error;
              }

            }elseif ($faltante2<=$cantidad) {

              $upddes = "UPDATE picking SET efectuado = $faltante2
                        WHERE picking = $picking and item = '$item' and codigo = $codigo";

              $resupddes = $mysqli->query($upddes);

              $updcon = "UPDATE desconsolidado SET faltante = 0
                         WHERE picking = $picking and item = '$item'";

              $resupdcon = $mysqli->query($updcon);
            }


            }
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
echo $sesion = $json['SessionId'];
$_SESSION['idsesion'] = $sesion;
?>


<meta HTTP-EQUIV="REFRESH" CONTENT="0;URL=enviosap.php?picking=<?php echo $picking ?>">
<?php

 ?>
