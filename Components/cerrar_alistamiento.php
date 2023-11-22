<?php
session_start();
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");
?>
  <link href='http://fonts.googleapis.com/css?family=Paprika|Merienda+One|Courgette' rel='stylesheet' type='text/css'>
<head>
	<style type="text/css">
		 h1 {
    	font-family: 'Merienda One', cursive;
        font-size: 35px;
        text-shadow: 0.1em 0.1em 0.05em #C1BDC2;
        color: #703F06;
      		}
      	 body {
        background: #fff url(images/blurred.jpg) no-repeat center top;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
      		}
	</style>
</head>



<body style="background-image: url(fondo.jpg);">

<?php

 function resta($inicio, $fin)
{
  $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
  return $dif;
 }

 $codigo = $_GET['codigo'];
$factura = $_GET['factura'];

echo $query = "SELECT * FROM  resumen_alistador WHERE id = '$codigo' and factura = $factura";
$result =  mysql_query($query);
$num = mysql_num_rows($result);

if ($num == 0) {

	echo "
	<center>
	<br>
	<br>
	<br>
	<span class='luz' id='blink'> <b> ALERTA! </span> </b> <br>

	<h1>
	Usted no tiene facturas pendientes por cerrar <br>
	verifique si fue iniciada previamente.
	</h1>
	";
}if ($num == 1) {

    $hora_fin = date("H:i:s",strtotime("-7 hour"));


    while ($array = mysql_fetch_array($result)) {
    	$hora_inicio = $array['hora_inicio'];
    }


    $tiempo = resta($hora_inicio,$hora_fin);
     "$tiempo";


	echo $query2 = "UPDATE resumen_alistador SET hora_fin = '$hora_fin',
	tiempo = '$tiempo' WHERE id = '$codigo' and factura = $factura";

	$result = mysql_query($query2);

	if ($result) {
		header("Location:finalizar_alistamiento.php");
	}else{
		echo "Error: ".mysql_error();
	}

	echo "Factura cerrada con exito";
  // echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=finalizar_alistamiento.php'>";


}if ($num > 1) {

	echo "
	<center>
	<br>
	<br>
	<br>
	<span class='luz' id='blink'> <b> ALERTA! </span> </b> <br>

	<h1>
	Usted tiene mas de una facturas pendientes por cerrar <br>
	comuniquese con e Administrador.
	</h1>
	";

}

?>

<script>
(function() {

setInterval(function(){
  var el = document.getElementById('blink');
  if(el.className == 'luz'){
      el.className = 'luz on';
  }else{
      el.className = 'luz';
  }
},500);

})();
</script>

<style>
.luz.on{
  color: #EA0808;/*color del texto al cambiar*/
  text-shadow:
     1px  1px rgba(255, 255, 255, .1),
    -1px -1px rgba(0, 0, 0, .88),
     0px  0px 20px #EA0808;/*color de la luz del texto*/
}
.luz{
  font-size:80px;/*tamaño de la fuente*/
  color: #000000;
  font-family: 'Merienda One', cursive;
  text-shadow:
     1px  1px rgba(255, 255, 255, .1),
    -1px -1px rgba(0, 0, 0, .88);
}
</style>
