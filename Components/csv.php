<?php

session_start();
$firma = $_SESSION['nombres'];

include ('config.php');
$link = Conectarse();

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();  
                                   
$mail->Host = '200.26.137.33';  
$mail->SMTPAuth = true;         
$mail->Username = 'p.sistemas@manitoba.com.co';
$mail->Password = 'p.s2014';
?>

<html>

<head>
  <link rel='stylesheet' href='css/estilos.css'>
</head>


<?php

$item=$_SESSION['item'];
$destino=$_SESSION['destinos'];
$cliente=$_SESSION['clientes'];
$oc=$_SESSION['oc'];
$cantidad=$_SESSION['cantidad'];
$fecha=$_SESSION['fecha'];
$estado=$_GET['estado'];
$analisis=$_SESSION['analisis'];
$observacion=$_SESSION['observacion'];
$linea=$_SESSION['linea'];
$referencia=$_SESSION['referencia'];
$cantidad_referencia=$_SESSION['cantidad_referencia'];
$fecha_solicitada=$_SESSION['fecha_solicitada'];
$fec_vencimi=$_SESSION['fec_vencimi'];
$diferencia_dias=$_SESSION['diferencia_dias'];
$vaanalisis=$_SESSION['vaanalisis'];

$fecha_en_bodega = date("Y-m-d", strtotime("$fecha_solicitada - 4 days"));  

$sql = "INSERT INTO control_pedidos (codigo_pedidos,maquina,item,
referencia,destino,cliente,orden_compra,cantidad,fecha_solicitud,
fecha_solicitada,fecha_leadtime,fecha_pact2,dias,analisis,fecha_en_bodega,
estado,observacion,firma) VALUES ('','$linea','$item','$referencia','$destino',
'$cliente','$oc','$cantidad','$fecha','$fecha_solicitada','$fec_vencimi','','$diferencia_dias',
'$vaanalisis','$fecha_en_bodega','$estado','$observacion','$firma')";

$query = mysql_query($sql);
$id=mysql_insert_id();

if ($query) {
  echo'<div id="caja1" style="background: linear-gradient(90deg, #6E0F0F, #6E0F0F,#843232,#843232,#6E0F0F, #6E0F0F); ">';
  echo "<center> 
  <font face='arial'> 
    <h1>
      Informacion almacenada correctamente 
    </h1>
  </font>
  </center>";

  //MENSAJE
if ($estado == 'PENDIENTE POR DEFINIR FECHA') {
  $htmlBody = '
  <html>
    <head>
      <title>HTML Email</title>
    </head>
  <body>
    <br>
    <h2>
      GRACIAS POR USAR LA APLICACION PEDIDOS
    </h2>
  <p>
  
  <br>
  <br>
    SE HA REALIZADO EL INGRESO DEL SIGUIENTE PEDIDO, EL CUAL NO CUMPLE
    CON LA FECHA ESTABLECIDA POR LEADTIME.
  <br>
  <br>   
    CONSECUTIVO: '.$id.'
  <br>
  <br>   
    CLIENTE: '.$cliente.'
    
  <br>
  <br>   
    REFERENCIA: '.$referencia.'
  <br>
  <br> 
    CANTIDAD: '.$cantidad.'
  <br>
  <br> 
    FECHA SOLICITUD: '.$fecha_solicitada.'
  <br>
  <br> 
    OBSERVACION: '.$observacion.'
  <br>
  <br> 
    USUARIO: '.$_SESSION['nombres'].' '.$_SESSION['apellidos'].' 
  <br>
  <br> 

    SI DESEA CONSULTAR LA INFORMACION COMPLETA DEL PEDIDO, POR FAVOR <a href="/192.168.1.149/pedidos1/">DAR CLIC AQUI</a>
  </font>
  </body>
  </html>';
      
$mail->From = 'p.sistemas@manitoba.com.co';
$mail->FromName = 'PEDIDOS';

$mail->addAddress('p.sistemas@manitoba.com.co', 'Karent Rivas');
$mail->addAddress('administracion@manitoba.com.co', 'Rene Renteria');
$mail->addAddress('contabilida@manitoba.com.co', 'Fernanda Bejarano');
$mail->addAddress('asist.planeacion@manitoba.com.co', 'Samir Jaramillo');
$mail->addAddress('j.planeacion@manitoba.com.co','Katherine Amaya');
$mail->addAddress('analista.comercial@manitoba.com.co','Cesar Perea');
$mail->addAddress('sistemas@manitoba.com.co','Alvaro Almeida');


$mail->WordWrap = 50;      
$mail->isHTML(true);       

$mail->Subject = "Se realizo el envio de un nuevo pedido del cliente:".$cliente;
$mail->Body    = $htmlBody;

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<br> <br> Enviado';
}
}if($estado == 'PENDIENTE'){
  $htmlBody = '
  <html>
    <head>
      <title>HTML Email</title>
    </head>
  <body>
    <br>
    <h2>
      GRACIAS POR USAR LA APLICACION PEDIDOS
    </h2>
  <p>
  
  <br>
  <br>
    SE HA REALIZADO EL INGRESO DE UN NUEVO PEDIDO
  <br>
  <br>   
    CONSECUTIVO: '.$id.'
  <br>
  <br>   
    CLIENTE: '.$cliente.'
    
  <br>
  <br>   
    REFERENCIA: '.$referencia.'
  <br>
  <br> 
    CANTIDAD: '.$cantidad.'
  <br>
  <br> 
    FECHA SOLICITUD: '.$fecha_solicitada.'
  <br>
  <br> 
    OBSERVACION: '.$observacion.'
  <br>
  <br> 
    USUARIO: '.$_SESSION['nombres'].' '.$_SESSION['apellidos'].' 
  <br>
  <br> 

    SI DESEA CONSULTAR LA INFORMACION COMPLETA DEL PEDIDO, POR FAVOR <a href="/192.168.1.149/pedidos1/">DAR CLIC AQUI</a>
  </font>
  </body>
  </html>';
      
$mail->From = 'p.sistemas@manitoba.com.co';
$mail->FromName = 'PEDIDOS';

$mail->addAddress('p.sistemas@manitoba.com.co', 'Karent Rivas');
$mail->addAddress('administracion@manitoba.com.co', 'Rene Renteria');
$mail->addAddress('contabilida@manitoba.com.co', 'Fernanda Bejarano');
$mail->addAddress('asist.planeacion@manitoba.com.co', 'Samir Jaramillo');
$mail->addAddress('j.planeacion@manitoba.com.co','Katherine Amaya');
$mail->addAddress('analista.comercial@manitoba.com.co','Cesar Perea');
$mail->addAddress('sistemas@manitoba.com.co','Alvaro Almeida');


$mail->WordWrap = 50;      
$mail->isHTML(true);       

$mail->Subject = "Se realizo el envio de un nuevo pedido del cliente:".$cliente;
$mail->Body    = $htmlBody;

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<br> <br> Enviado';
}
}else{
  
}



}else{
  echo "Error: ".mysql_error();
}

?>
<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=form.php">
<form action='form.php'>
      <center><button>Volver!</button> </center>
</form>