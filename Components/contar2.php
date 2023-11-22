<?php
session_start();
?>
  <link href='http://fonts.googleapis.com/css?family=Paprika|Merienda+One|Courgette' rel='stylesheet' type='text/css'>

<head>
<style type="text/css">
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
<form action='contar3.php'>
<section class="container">


<br>
<br>
<h1>
	Picking..!
</h1>
<br>


<input type="text" name='contador' autofocus>

<br>

<?php
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

if ($_GET) {
$factura1 = $_GET['factura'];
$codigo1 = $_GET['codigo'];	
$_SESSION['factura'] = $factura1;
$_SESSION['codigo'] = $codigo1 ;
}else{
$factura1 = $_SESSION['factura'];
$codigo1 = $_SESSION['codigo'];
}

$fecha = date('Y-m-d');
$hora_inicio2 = date("H:i:s",strtotime("-6 hour"));

//$query9 = "SELECT alistador from facturas where alistador = '$codigo1' and factura = $factura1";

$query9 = "UPDATE facturas SET picking = $codigo1 where factura = $factura1";
$result9 = mysql_query($query9);
//$rows = mysql_num_rows($result9);

if ($result9) {

$query11 = "SELECT DISTINCT f.factura,sum(f.cantidad) as cantidadp,cliente, a.codigo,a.id,a.nombre from facturas f, alistador a where factura=$factura1
and a.codigo = f.picking";

$result11 = mysql_query($query11);

if ($result11) {

	while ($array11 = mysql_fetch_array($result11)) {
		$factura11 = $array11['factura'];
		$cantidadp11 = $array11['cantidadp'];
		$cliente11 = $array11['cliente'];
		$codigo11 = $array11['codigo'];
		$id11 = $array11['id'];
		$nombre11 = $array11['nombre'];
		
	}

	 $query13 = "SELECT * FROM resumen_picking WHERE 
	factura = $factura1 and codigo = $codigo1 ";

	$result13 = mysql_query($query13);
	$num13 = mysql_num_rows($result13);

	if ($num13 == 1) {
			# code...
	}if ($num13 == 0) {
	$query12 = "INSERT INTO resumen_picking(cod, codigo, id, nombre, 
	cliente, factura, cantidad, fecha, hora_inicio) 
	VALUES ('','$codigo11',$id11,'$nombre11','$cliente11',$factura11,
	$cantidadp11,'$fecha','$hora_inicio2') ";
	
	$result12 = mysql_query($query12);

	if ($result12) {
		# code...
	}else{
		echo "Error 12:".mysql_error();
	}
	}else{	}	

	
	

}else{

	echo "Error: ".mysql_error();
}

$query = "SELECT c.codigo, f.cliente,f.factura,f.item,f.referencia,f.cantidad,f.peso from facturas f, codigo c where factura=$factura1
and c.item = f.item";

$result = mysql_query($query);

echo "<table border='0'  WIDTH='100%' class='order-table scroll'> 
<thead>
	<tr>
		<td style='font-size: 15px; color: white; face=arial' bgcolor='#6C3E0A' >
		<center>
		 	<b>&nbsp;<br>
		  		ITEM  
		  	</b>
		</center><br>
		</td>

		<td HEIGHT='12' style='font-size: 15px; color: white; face=arial' bgcolor='#6C3E0A' >
		<center>
		 	<b>
		  		REFERENCIA 
		  	</b>
		</center>
		</td>

		<td style='font-size: 15px; color: white; face=arial' bgcolor='#6C3E0A' >
		<center>
		 	<b>
		  		CANTIDAD 
		  	</b>
		</center>
		</td>

		<td style='font-size: 15px; color: white; face=arial' bgcolor='#6C3E0A' >
		<center>
		 	<b>
		  		CONTAR C 
		  	</b>
		</center>
		</td>

		<td style='font-size: 15px; color: white; face=arial' bgcolor='#6C3E0A' >
		<center>
		 	<b>
		  		PESO 
		  	</b>
		</center>
		</td>

		<td style='font-size: 15px; color: white; face=arial' bgcolor='#6C3E0A' >
		<center>
		 	<b>
		  		CONTADOR P 
		  	</b>
		</center>
		</td>

	</tr>
		
	</thead>
	<tbody>
	<tr>
	";
	while ($array = mysql_fetch_array($result)) {

	 $item = $array['item'];
	 $cliente = $array['cliente'];
	 $referencia = $array['referencia'];
	 $cantidad = $array['cantidad'];
	 $factura = $array['factura'];
	 $codigo = $array['codigo'];
	 $peso = $array['peso'];

	 $_SESSION['item'] = $item;
	 $_SESSION['cantidad'] = $cantidad;
	 $_SESSION['factura'] = $factura;

	$query3 = "SELECT distinct (factura),item,contar,cpeso from contador where item = $item and factura = $factura";
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
	$query2 = "INSERT INTO contador (factura,item,referencia,cantidad,peso)
	VALUES ($factura,$item,'$referencia',$cantidad,$peso)";

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
	 echo "<td width='52px'> <center> <b> &nbsp;<br>".$item." <br>&nbsp; </td>";
	 echo "<td width='52px'> <center> <b>".$referencia." <br> </td>";
	 echo "<td width='52px'> <center> <b>".$cantidad." <br> </td>";
	 echo "<td width='52px'> <center> <b>".$contar."<br> </td>";
	 echo "<td width='52px'> <center> <b>".$peso."<br> </td>";
	 echo "<td width='52px'> <center> <b>".$cpeso."<br> </td>";
	 echo "<td width='52px'> <center> <b> <img src= 'hi.png'> </td>";
	 echo "</tr>";

	 $query4 = "UPDATE contador SET ok = 'OK' where item = $item";
	 $result4 = mysql_query($query4);

	 if ($result4) {
	 	
	 }else{
	 	echo "Error: ".mysql_error();
	 }	
	}else{
	 echo "<td> <center> &nbsp;<br> <input type ='text' size='3' id='example' name='item[$item]' style='text-align:center' value ='".$item."' readonly> <br>&nbsp; </td>";
	 echo "<td> <center> <font color ='red'> ".$referencia." <br> </td>";
	 echo "<td> <center> <input type ='text' size='3' id='example' name='cantidad[$item]' style='text-align:center' value ='".$cantidad."' readonly> <br> </td>";
	 echo "<td> <center> <font color ='red'> ".$contar."<br> </td>";
	 echo "<td> <center> <font color ='red'> ".$peso."<br> </td>";
	 echo "<td> <center> <font color ='red'> ".$cpeso."<br> </td>";
	 echo "<br> </tr>";

	}	 

}


echo "</table>";


$query10 = "SELECT * FROM contador where ok='' and factura=$factura";
$result10 = mysql_query($query10);
$num = mysql_num_rows($result10);

if ($num == 0) {
	# code...


$query5 ="SELECT *,sum(cpeso) as pes FROM contador where ok='OK' and factura = $factura";
$result5 = mysql_query($query5);
if ($num == 0) {
	while ($array5 = mysql_fetch_array($result5)) {
		$pes = $array5['pes'];
	}
	echo " <H1> <B> FACTURA FINALIZADA!!!!!!";
	//echo "<h2> <b> Peso Total: ".$pes."</b> </h2>";
	$hora_fin = date("H:i:s",strtotime("-6 hour"));
	
	$query6 = "UPDATE resumen_picking set hora_fin = '$hora_fin'";
	$result6 = mysql_query($query6);

	if ($result6) {
		
		$query7 = "SELECT hora_inicio,hora_fin,TIMEDIFF(hora_fin,hora_inicio) AS tiempo 
		from resumen_picking where factura = $factura";

		$result7 = mysql_query($query7);
		if ($result7) {
			
			while ($array7 = mysql_fetch_array($result7)) {
				$hora_fin1 = $array7['hora_fin'];
				$hora_inicio1 = $array7['hora_inicio'];
				$tiempo = $array7['tiempo'];



			$query8 = "UPDATE resumen_picking set tiempo = '$tiempo' where factura= '$factura'";
			$result8 = mysql_query($query8);
			if ($result8) {
				# code...
			}else{
				echo "Error: ".mysql_error();
			}

			
			}
			//echo "<br> tiempo:".$tiempo;
		    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=ingresar_fc.php'>";

		}else{
			echo "Error: ".mysql_error();
		}
	}else{
		echo "Error: ".mysql_error();
	}

}else{

}

}else{

}
}else{

	echo "Debes iniciar la factura antes de empezar el contador... Gracias!";
}

?>

<input type='submit' style="display: none;">

</form>

<form action='ingresar_fc.php'>
	<br>
	<center>
	<button>VOLVER..!</button>
</form>