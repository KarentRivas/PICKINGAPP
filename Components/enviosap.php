<?php
session_start();
$picking = $_GET['picking'];
// echo "GET<pre>";$arra =print_r($_SESSION);echo "</pre>";
echo $idsesion = $_SESSION['idsesion'];

// class cl_operaciones_sap
// {
//
//     public $picking, $linea, $codigoarticulo, $cantidad;
//
//     public function AsignarPicking($NumeroPicking){
//         $this->picking=$NumeroPicking;
//     }//Cierra function AsignarBodegaOrigen
//
//     public function ActualizarPicking()
//     {

/**********************con. sap************************************/
/*
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
            $json = json_decode($response, true);
            $sesionGuardar = $json['SessionId'];
            curl_close($curl);
*/

            $mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
            $mysqli->set_charset("utf8");

            try
            {

                $query = "SELECT item,descripcion,efectuado,codigo,picking,linea,numPedido,linPedido FROM picking WHERE efectuado>0 and picking = $picking";
                // echo $query;
                $result = $mysqli->query($query);
                if ($result)
                {
                    while ($array = mysqli_fetch_array($result))
                    {
                      $array['item'];
                      $array['descripcion'];
                      $array['efectuado'];
                      $array['codigo'];
                      $array['picking'];
                      $array['linea'];
                      $array['numPedido'];
                      $array['linPedido'];
                      $getSL = '{"PickList": {"Absoluteentry": '.$array['picking'].',"PickListsLines": [{"BaseObjectType": 17,"LineNumber": '.$array['linea'].',"OrderRowID": '.$array['linPedido'].',"OrderEntry":'.$array['numPedido'].',"PickedQuantity": '.$array['efectuado'].'}]}}';
                        //echo $getSL;
                        echo "<br>";
                        $curlAct = curl_init();
                        curl_setopt_array($curlAct, array(
                            CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/PickListsService_UpdateReleasedAllocation',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>'{"PickList": {"Absoluteentry": '.$array['picking'].',"PickListsLines": [{"BaseObjectType": 17,"LineNumber": '.$array['linea'].',"OrderRowID": '.$array['linPedido'].',"OrderEntry":'.$array['numPedido'].',"PickedQuantity": '.$array['efectuado'].'}]}}',
                            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Cookie: B1SESSION='.$idsesion.''),
                        ));
                        $response = curl_exec($curlAct);
                        print_r($response);
                        curl_close($curlAct);
                    }
                    $RetVal = 0;
                    if($RetVal==0){
                        echo "<br>";
                        ?>
                        <center>
                          <h1>
                              Picking Actualizado Correctamente En SAP
                          </h1>
                        <?php
                        // header("Location: user.php");
                        exit;
                    }
                    else{
                        echo "<br>";
                        echo "Picking NO Actualizado En SAP";
                    }

                }

            }
            catch (Exception $e) {
                $mensaje = $e;
                echo $mensaje;
            }
    //     }
    // }
    header('Location: user.php');
?>
