<?php
session_start();
/* Replace the data in these two lines with data for your db connection */
$connection = mysql_connect("localhost","root","PhpM74DMiN$996+");
mysql_select_db("pickingprod",$connection);

if(isset($_GET['ID'])){
  $res = mysql_query("SELECT codigo, medida, item, referencia, unidades, gramos, peso FROM codigo_sap WHERE codigo =".$_GET['ID']) or die(mysql_error());

  if($inf = mysql_fetch_array($res)){
    echo "formObj.item.value = '".$inf["item"]."';\n";
    echo "formObj.referencia.value = '".$inf["referencia"]."';\n";
    echo "formObj.medida.value = '".$inf["medida"]."';\n";
    echo "formObj.cantidad.value = '".$inf["unidades"]."';\n";
    // echo "formObj.gramaje.value = '".$inf["gramaje"]."';\n";

  }else{
    echo "Error:".mysql_error();
    echo "formObj.firstname.value = '';\n";

  }
}else{
  echo "string";
}
?>
