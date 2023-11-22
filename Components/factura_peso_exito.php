<html>

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
        background: #fff url(fondo.jpg) no-repeat center top;
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
       	border-color:#6C3E0A; 
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

<br>
<br>

	<form action='subir_1_exito.php'>
		<center>
			<b>
				<h1>
					Iniciar Pesaje..!
				</h1>
			</b>
		</center>

<br>
<br>
<br>
<br>
<br>
<center>

		<table>
			<tr>
				<td>
					<b>
						<h1>
							Numero de identificacion 
						</h1>
					</b>
				</td>
				<td>
					<center>
							<input type='number' class='css-input' name='codigo' required autofocus>
					</center>
				</td>
			</tr>
		</table>


<br>
<br>
<br>
<br>

<table>
	<tr>
		<td>
			<button> <b> Continuar..!</button>
			</form>
		</td>
	
	
		<td>
			<form action='user.php'>
<br>
				<button> <b> Volver..!</button>
			</form>
		</td>
	</tr>
</table>

		


</html>