<head>

	<link href='http://fonts.googleapis.com/css?family=Paprika|Merienda+One|Courgette' rel='stylesheet' type='text/css'>



	<style type="text/css">

 h1 {
    font-family: 'Merienda One', cursive;
        font-size: 35px;
        text-shadow: 0.1em 0.1em 0.05em #C1BDC2;
        color: #634A05;
      }

      body {
        background: #fff url(images/blurred.jpg) no-repeat center top;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
      }

       .css-input {
       	padding:16px;
       	font-size:27px;
       	text-align:center;
       	border-width:6px;
       	border-radius:20px;
       	border-style:inset;
       	background-color:#faf2fa;
       	border-color:#09C609;
       	box-shadow: 0px 0px 5px 0px rgba(42,42,42,.75);
       	font-weight:normal;
       	font-style:italic;
       	font-family:sans-serif;
       }
	   .css-input:focus {
	   	outline:none;
	   }

	   button {
       border: none;
       background: #54380A;
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
       color: #54380A;
       box-shadow: inset 0 0 0 3px #54380A;
      }

	</style>
</head>
<body  style="background-image: url(fondo.jpg);">
<form action='cerrar_alistamiento.php'>

<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>

<h1>
	<center>
		Finalizar Alistamiento!
	</center>
</h1>
<center>
<table>

	<tr>
		<td>
				<h1>
					Ingrese Factura
				</h1>
		</td>
		<td>
			<center>
				<input type='number' name='factura' required class="css-input" autofocus>
			</center>
		</td>
	</tr>

	<tr>
		<td>
				<h1>
					Ingrese Identificacion
				</h1>
		</td>
		<td>
			<center>
				<input type='number' name='codigo' required class="css-input" autofocus>
			</center>
		</td>
	</tr>
</table>

<br>
<br>
<br>

		<button><b> Continuar!</button>
		</form>
			<form action='user.php'>
				<br><button><b> Volver!</button>
			</form>

</body>
