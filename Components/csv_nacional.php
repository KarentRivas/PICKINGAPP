<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$database = 'bodega';
$table = 'facturas';
$i = 0;
$k = 0;
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

$query7 = "SELECT * FROM temp";
$result7 = mysql_query($query7);
$numero = mysql_num_rows($result7);
if ($query7) {
if ($numero > 0) {
  $query8 = "DELETE FROM TEMP";
  $result8 = mysql_query($query8);

  if ($result8) {
    # code...
  }else {
    echo "Error8: ".mysql_error();
  }


  }
}
    if(isset($_POST['submit']))
    {

         $fname = $_FILES['sel_file']['name'];
         //echo 'Cargando nombre del archivo: '.$fname.' ';
         $chk_ext = explode(".",$fname);

         if(strtolower(end($chk_ext)) == "csv")
         {

             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");

             while (($data = fgetcsv($handle, 9000, ",")) !== FALSE)
             {
                $i = $i+1;
                if ($i == 1) {
                    # code...
                }else{

                //echo "Nit: ".$data[11]." Cliente: ".$data[12]."<br>";

                // if ($data[11] == 890900608) {
                // 
                // }else{



                        $query4 = "INSERT INTO temp(cod,fecha,nit,cliente,factura,item,referencia,unidad_medida,
                        cantidad,peso) VALUES ('','$data[51]','$data[11]','$data[12]',$data[44],$data[48],'$data[49]',
                        '$data[88]',$data[111],$data[123])";

                        $result4 = mysql_query($query4);

                        if ($result4) {
                        }else {
                          echo "Error: ".mysql_error();

                    }
                //  }




                  }


                // $query3 = "SELECT * FROM facturas where fecha = $data[51] and
                // factura = $data[44] and item = $data[48]";
                //
                // $result3 = mysql_query($query3);
                // $num3 = mysql_num_rows($result3);
                //
                // if ($result3) {
                //   if ($num3 > 0) {
                //
                //   }else {
                //
                //     $query2 = "INSERT INTO facturas(cod,fecha,nit,cliente,
                //     factura,item,referencia,unidad_medida,cantidad,peso) VALUES ('',
                //     '$data[51]','$data[11]','$data[12]',$data[44],$data[48],
                //     '$data[49]','$data[88]',$data[111],$data[123])";
                //
                //     $result2 = mysql_query($query2);
                //
                //     if ($result2) {
                //       echo "Factura: ".$data[44]." Item: ".$data[48]."<br>";
                //       // header('Location:user.php' );
                //     }else{
                //       echo "Error: ".mysql_error();
                //     }
                //   }
                // }




                  }
                }

                $query5 = "SELECT fecha,nit,cliente,factura,item,referencia,unidad_medida FROM temp";
                $result5 = mysql_query($query5);

                if ($result5) {
                  while ($array5 = mysql_fetch_array($result5)) {
                    $factura = $array5['factura'];
                    $item = $array5['item'];
                    $fecha = $array5['fecha'];
                    $nit = $array5['nit'];
                    $cliente = $array5['cliente'];
                    $referencia = $array5['referencia'];
                    $unidad_medida = $array5['unidad_medida'];

                    // echo ;

                    $query6 = "SELECT sum(cantidad) as cantidad, sum(peso) as peso
                    From temp WHERE factura = $factura and item = $item";

                    $result6 = mysql_query($query6);

                    if ($result6) {
                      while ($array6 = mysql_fetch_array($result6)) {
                        $cantidad = $array6['cantidad'];
                        $peso = $array6['peso'];

                        // echo "Factura: ".$factura." Item: ".$item." Cantidad: ".$cantidad."<br>";

                        $query3= "SELECT * FROM facturas WHERE
                        fecha = '$fecha' and factura = $factura and item = $item";

                        $result3 = mysql_query($query3);
                        $num = mysql_num_rows($result3);

                        if ($num > 0) {

                          echo "Factura: ".$factura." Item: ".$item." Cantidad: ".$cantidad."Ya Existe <br>";

                        }else {

                               $query2 = "INSERT INTO facturas(cod,fecha,nit,cliente,
                               factura,item,referencia,unidad_medida,cantidad,peso) VALUES ('',
                               '$fecha','$nit','$cliente',$factura,$item,
                               '$referencia','$unidad_medida',$cantidad,$peso)";

                               $result2 = mysql_query($query2);

                               if ($result2) {
                                 echo "Factura: ".$factura." Item: ".$item." Cantidad: ".$cantidad."Se Guardo <br>";
                                 // header('Location:user.php' );
                               }else{
                                 echo "Error: ".mysql_error();
                               }
                        }

                     //  }

                    }

                  }
                }

             }


             fclose($handle);
             }
             else
             {

             echo "<br> Archivo invalido!";
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
  text-shadow:
     1px  1px rgba(255, 255, 255, .1),
    -1px -1px rgba(0, 0, 0, .88);
}
</style>

<form action='user.php'>
    <input type='submit' value='Volver...!'>
</form>_
