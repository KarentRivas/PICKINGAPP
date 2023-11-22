<?php
session_start();
?>


<html>
<head>
  <meta charset="utf-8">
  <title>ITEMS</title>
  <link href="https://fonts.googleapis.com/css?family=Architects+Daughter|El+Messiri" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Courgette|Homemade+Apple|Merienda|Shrikhand" rel="stylesheet">

  <style media="screen">

  .tablas{
    border-collapse: inherit;
    text-align: center;
    border: 0px solid white;
    box-shadow: none;
    background: none;
  }
  .td{
    border: 0px solid #fff;
  }

  h1{
    font-family: 'Merienda', cursive;
    font-size: 35px;
    color: #056107;
  }
  table{
    border-collapse:collapse;
    text-align: center;
    border: 5px solid #056107;
    box-shadow: 7px 5px 15px #888888;
    font-family: 'El Messiri', sans-serif;
    font-size: 20px;
    background:rgba(45, 58, 44, 0.1);
  }
  td{
    border: 1px solid #056107;
    background: none;
  }

    .select{
     font-family: 'El Messiri', sans-serif;
      border: none;
      font-size: 20px;
      text-align: center;
      background: none;
      color: #000;
      }


    input[type=number],[type=email],[type=text],[type=password],select{
     font-family: 'El Messiri', sans-serif;
      border: none;
      font-size: 20px;
      text-align: center;
      background: none;
      color: #000;
      }

  body {
    background: #fff url(img/fondo1.jpg) no-repeat center top;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
  }

  button {
        border: none;
        background: #056107;
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
        color: #056107;
        box-shadow: inset 0 0 0 3px #056107;
       }

       .rgba{
         background: rgba(5, 97, 7, 0.81);
         color: white;
       }


    </style>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <script type="text/javascript">

    var ajax = new sack();
    var currentClientID=false;
    function getClientData()
    {
      var clientId = document.getElementById('id').value.replace(/D/g,'');
      if(clientId!=currentClientID){
        currentClientID = clientId
        ajax.requestFile = 'getCliente.php?ID='+clientId; // Specifying which file to get
        ajax.onCompletion = showClientData; // Specify function that will be executed after file has been found
        ajax.runAJAX();   // Execute AJAX function
      }

    }

    function showClientData()
    {
      var formObj = document.forms['clientForm'];
      eval(ajax.response);
    }

    function initFormEvents()
    {
      document.getElementById('id').onblur = getClientData;
      document.getElementById('id').focus();

    }

    window.onload = initFormEvents;
    </script>

    <script type="text/javascript">

    function tabular(e,obj) {
      tecla=(document.all) ? e.keyCode : e.which;
      if(tecla!=13) return;
      frm=obj.form;
      for(i=0;i<frm.elements.length;i++)
        if(frm.elements[i]==obj) {
          if (i==frm.elements.length-1) i=-1;
          break }
      frm.elements[i+1].focus();
      return false;
    }

      function aMays(e, elemento) {
      tecla=(document.all) ? e.keyCode : e.which;
       elemento.value = elemento.value.toUpperCase();
      }
    </script>
</head>

<center>

<body>

<form name="clientForm" action='guardar_codigos_sap.php' method="post">

<br><br><br>

<h1>
  CREAR / MODIFICAR CODIGOS
</h1>
<br><br>


<table border='0' class='' id="tabla">
<tr>
	<td class="rgba">
		 <b> CODIGO </b>
	</td>

	<td>
		<input type="number" id="id" name="id" size="60" required onkeypress="return tabular(event,this)" onkeyup='aMays(event, this)'/>
	</td>
</tr>

<tr>
	<td class="rgba">
		<b>ITEM:</b>
	</td>
	<td>
		<input type="text" name="item" required onkeypress="return tabular(event,this)" onkeyup='aMays(event, this)'/>
	</td>
</tr>

<tr>
	<td class="rgba">
		<b>REFERENCIA</b>
	</td>

	<td>
    <input type="text" name="referencia" size="60">
	</td>
</tr>

<tr>
	<td class="rgba">
		<b> UNIDAD DE MEDIDA:</b>
	</td>

	<td>
    <input type="text" name="medida" value="">
	</td>
</tr>

<tr>
	<td class="rgba">
		<b> CANTIDAD:</b>
	</td>

	<td>
    <input type="number" name="cantidad" value="">
	</td>
</tr>


</table>
<br><br><br>
<table class="tablas">
<tr>
	<td class="td">
    	<button> GUARDAR! </button>
    </td>
</form>

<form action='user.php'>
   	<td class="td">
      <button> VOLVER! </button>
    </td>
</tr>
</form>

</center>

</body>
