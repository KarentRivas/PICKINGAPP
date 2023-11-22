<?php
session_start();
?>
  <link href='http://fonts.googleapis.com/css?family=Paprika|Merienda+One|Courgette' rel='stylesheet' type='text/css'>

<head>
<style type="text/css">
 button {
       border: none;
       background: #5B4105;
       color: #f2f2f2;
       padding: 10px;
       font-size: 18px;
       border-radius: 5px;
       position: relative;
       box-sizing: border-box;
       transition: all 500ms ease;
       box-shadow: 15 0 0 3px red;

      }
      button:hover {
       background: rgba(0,0,0,0);
       color: #5F3C07;
       box-shadow: inset 0 0 0 3px #5F3C07;
      }   
body {
        background: #fff url(images/blurred.jpg) no-repeat center top;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
      }

input, select, textarea {
}
#example {
color: red;
}

table{
	background: none;
	box-shadow: 2px 2px 5px #999;
	font-family: 'arial';
}

h1{
	font-family: 'Merienda One', cursive;
	font-size: 38px;
	color: white;
	border: 2px;
	text-shadow: 0px 0px 19px #7ABF31;
}
thead td{
	font-family: 'Merienda One', cursive;
}

tbody td{
	background: #EAE5D8;
}

tbody input{
	border: none;
	background: #EAE5D8;
}

 button {
       border: none;
       background: #402807;
       color: #f2f2f2;
       padding: 10px;
       font-size: 18px;
       border-radius: 5px;
       position: relative;
       box-sizing: border-box;
       transition: all 500ms ease;
       box-shadow: 15 0 0 3px red;

      }
      button:hover {
       background: rgba(0,0,0,0);
       color: #402807;
       box-shadow: inset 0 0 0 3px #402807;
      }   
</style>


</head>
<body  style="background-image: url(fondo.jpg);">

<form action='contar3_exito.php'>
<section class="container">


<br>

<center>
	<h1>
		Picking Exito..!
	</h1>
</center>
<br>
<br>
<br>
<input type="text" name='contador' autofocus>

<br>


<br>
<br>
<?php
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

if ($_GET) {
//echo "GET<pre>";$arra =print_r($_GET);echo "</pre>";


$codigo1 = $_GET['codigo'];	
$_SESSION['codigo'] = $codigo1 ;
}else{
$remision = $_SESSION['factura'];
$codigo1 = $_SESSION['codigo'];
}

$query10 = "SELECT remision from resmuen_ato_exito where codigo = '$codigo1' and tiempo ='00:00:00'";
$result10 = mysql_query($query10);

while ($array10 = mysql_fetch_array($result10)) {
	$remision = $array10['remision'];
    $_SESSION['factura'] = $remision;

}




$query9 = "SELECT alistador from exito where alistador = '$codigo1' and remision = '$remision'";
$result9 = mysql_query($query9);
$rows = mysql_num_rows($result9);

if ($rows > 0) {
	



$query = "SELECT c.codigo, f.cliente,f.sucursal,f.establecimiento,f.remision,f.item,f.referencia,f.cantidad,f.peso from exito f, codigo c where f.remision=$remision
and c.item = f.item  and c.medida = f.unidad_medida";

$result = mysql_query($query);

echo "<table border='0'  WIDTH='100%' class='order-table scroll'> 
<thead>
	<tr>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> CODIGO </b>
		</td>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> ITEM </b>
		</td>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> REFERENCIA </b>
		</td>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> CANTIDAD </b>
		</td>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> CONTAR C </b>
		</td>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> PESO </b>
		</td>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#C24C0E' >
		<center> <b> CONTADOR P </b>
		</td>
	</tr>
		
	</thead>
	<tbody>
	<tr>
	";
	while ($array = mysql_fetch_array($result)) {

	 $item = $array['item'];
	 $referencia = $array['referencia'];
	 $cantidad = $array['cantidad'];
	 $remision = $array['remision'];
	 $sucursal = $array['sucursal'];
	 $establecimiento = $array['establecimiento'];
	 $codigo = $array['codigo'];
	 $peso = $array['peso'];

	 $_SESSION['item'] = $item;
	 $_SESSION['cantidad'] = $cantidad;
	 $_SESSION['remision'] = $remision;

    $query3 = "SELECT item,remision,contar,cpeso from contador_exito where item = $item and remision = $remision";
	$result3 = mysql_query($query3);
	$filas = mysql_num_rows($result3);

	while ($array3 = mysql_fetch_array($result3)) {
		$contar = $array3['contar'];
		$cpeso = $array3['cpeso'];
	}

	if ($result3) {


		
	}else{
		echo "Error: ".mysql_error();
	}
	if ($filas == 0) {
	$query2 = "INSERT INTO contador_exito (cod,sucursal,establecimiento,
		remision,item,referencia,cantidad,peso)
	VALUES ('','$sucursal','$establecimiento',$remision,$item,
		'$referencia',$cantidad,$peso)";

	$result2 = mysql_query($query2);

	if ($result2) {
		echo "<meta http-equiv='refresh' content='0' >";
	}else{
		echo "Error: ".mysql_error();

	}	
	}
	else{

	}

	if (($contar == $cantidad) && ($cpeso == $peso)) {
	 echo "<td> <center> ".$codigo." <br> </td>";
	 echo "<td> <center> ".$item." <br> </td>";
	 echo "<td> <center> ".$referencia." <br> </td>";
	 echo "<td> <center> ".$cantidad." <br> </td>";
	 echo "<td> <center> ".$contar." <br> </td>";
	 echo "<td> <center> ".$peso." <br> </td>";
	 echo "<td> <center> ".$cpeso." <br> </td>";
	 echo "<td> <center>  <b> <font color='green'> OK  <br> </td>";
	 echo "</tr>";

	 $query4 = "UPDATE contador_exito SET ok = 'OK' where item = $item and remision = $remision";
	 $result4 = mysql_query($query4);

	 if ($result4) {
	 	
	 }else{
	 	echo "Error: ".mysql_error();
	 }	
	}else{
	 echo "<td> <center> <br> <font color ='red'> ".$codigo." <br>&nbsp; <br> </td>";
	 echo "<td> <center> <input type ='text' id='example' style='text-align:center' name='item[$item]' value ='".$item."' readonly> <br> </td>";
	 echo "<td> <center> <font color ='red'> ".$referencia." <br> </td>";
	 echo "<td> <center> <input type ='text' id='example' style='text-align:center' name='cantidad[$item]' value ='".$cantidad."' readonly> <br> </td>";
	 echo "<td> <center> <font color ='red'> ".$contar." <br> </td>";
	 echo "<td> <center> <font color ='red'> ".$peso." <br> </td>";
	 echo "<td> <center> <font color ='red'> ".$cpeso." <br> </td>";
	 echo "</tr>";

	}	 

}


echo "</table>";

$query5 ="SELECT * FROM contador_exito where ok='' and remision = $remision";
$result5 = mysql_query($query5);
$num = mysql_num_rows($result5);
if ($num == 0) {
$query11 ="SELECT cod,sum(cpeso) as pes FROM contador_exito where ok='OK' and remision = $remision";
	$result11 = mysql_query($query11);
	while ($array11 = mysql_fetch_array($result11)) {
		$pes = $array11['pes'];

	}

	if ($pes == '') {
			//echo"opop";
		}else{
	echo "<H1> <B> <center> <font color ='black'> FACTURA FINALIZADA!!!!!! </B> <br>";
	//echo "<h2> <b> Peso Total".$pes."</b> </h2>";
	$hora_fin = date("H:i:s",strtotime("-6 hour"));
	
	$query6 = "UPDATE resmuen_ato_exito set hora_fin = '$hora_fin' where remision=$remision";
	$result6 = mysql_query($query6);

	if ($result6) {
		
		$query7 = "SELECT hora_inicio,hora_fin 
		from resmuen_ato_exito where remision = $remision";

		$result7 = mysql_query($query7);
		if ($result7) {
			
			while ($array7 = mysql_fetch_array($result7)) {
				$hora_fin1 = $array7['hora_fin'];
				$hora_inicio1 = $array7['hora_inicio'];

				function resta($inicio, $fin)
			  			{
						  $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
						  return $dif;
						 }	
				$tiempo = resta($hora_inicio1,$hora_fin1);
			
			//echo "<br> tiempo:".$tiempo;

			$query8 = "UPDATE resmuen_ato_exito set tiempo = '$tiempo' where remision= '$remision'";
			$result8 = mysql_query($query8);
			if ($result8) {
				# code...
			}else{
				echo "Error: ".mysql_error();
			}

			}
		}else{
			echo "Error: ".mysql_error();
		}
	}else{
		echo "Error: ".mysql_error();
	}
	
}
//echo "cero";
}else{
	

}

}else{

	echo "<h2>Debes iniciar la factura antes de empezar el contador... Gracias!</h2>";
}

?>
<button>Enviar!</button>

</form>

<form action='ingresar_fc_exito.php'>
	<button>Volver!</button>
</form>