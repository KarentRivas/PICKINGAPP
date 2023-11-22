<?php
    error_reporting(0);
    session_start();
    
    class cl_operaciones_sap
    {

        public $picking, $linea, $codigoarticulo, $cantidad;

        public function AsignarPicking($NumeroPicking){
            $this->picking=$NumeroPicking;
        }//Cierra function AsignarBodegaOrigen

        public function ActualizarPicking()
        {
            
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
              $sesionGuardar= $sesion;
              curl_close($curl);
            }
            else{
                $sesionGuardar = $_SESSION['sesion'];
            }
            
            
            
            
            //curl = curl_init();
            //curl_setopt_array($curl, array(
            //    CURLOPT_URL => 'https://vm-hbt-hm36.heinsohncloud.com.co:50000/b1s/v1/Login',
            //    CURLOPT_RETURNTRANSFER => true,
            //    CURLOPT_ENCODING => '',
            //    CURLOPT_MAXREDIRS => 10,
            //    CURLOPT_TIMEOUT => 0,
            //    CURLOPT_FOLLOWLOCATION => true,
            //    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //    CURLOPT_CUSTOMREQUEST => 'POST',
            //    CURLOPT_POSTFIELDS =>'{"CompanyDB": "PRODMANITOBA", "Password": "1234", "UserName": "soporte"}',
            //    CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
            //));
            //$response = curl_exec($curl);
            //$json = json_decode($response, true);
            //$sesionGuardar = $json['SessionId'];
            //curl_close($curl);

            $mysqli = new mysqli('127.0.0.1', 'root', 'PhpM74DMiN$996+', 'pickingprod');
            $mysqli->set_charset("utf8");

            try
            {

                $query = "SELECT item,referencia,contar,cod,picking,numPedido,linPedido FROM contador_sap WHERE contar>0 and picking = ". $this->picking;
                //echo $query;
                $result = $mysqli->query($query);
                if ($result)
                {
                    while ($array = mysqli_fetch_array($result))
                    {
                        $getSL = '{"PickList": {"Absoluteentry": '.$array['picking'].',"PickListsLines": [{"BaseObjectType": 17,"LineNumber": '.$array['cod'].',"OrderRowID": '.$array['linPedido'].',"OrderEntry":'.$array['numPedido'].',"PickedQuantity": '.$array['contar'].'}]}}';
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
                            CURLOPT_POSTFIELDS =>'{"PickList": {"Absoluteentry": '.$array['picking'].',"PickListsLines": [{"BaseObjectType": 17,"LineNumber": '.$array['cod'].',"OrderRowID": '.$array['linPedido'].',"OrderEntry":'.$array['numPedido'].',"PickedQuantity": '.$array['contar'].'}]}}',
                            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Cookie: B1SESSION='.$sesionGuardar.''),
                        ));
                        $response = curl_exec($curlAct);
                        print_r($response);
                        curl_close($curlAct);
                    }
                    $RetVal = 0;
                    if($RetVal==0){
                        echo "<br>";
                        echo "Picking Actualizado Correctamente En SAP";
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
        }
    }
?>
