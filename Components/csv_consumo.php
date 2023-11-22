9<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$database = 'bodega';
$table = 'facturas';
$i = 0;
mysql_connect("localhost","root","PhpM74DMiN$996+") or die ("no se ha podido conectar a la BD");
mysql_select_db("bodega") or die ("no se ha podido seleccionar la BD");

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
               if ($data[115] == 0) {

               }else{

                 if ($data[111]<0) {
                   $cantidad = $data[111] * -1;
                 }

                 if ($data[115]<0) {
                  echo $peso = $data[115] * -1;
                 }





                $i = $i++;
                if ($i == 1) {
                    # code...
                }else{

                //echo "Nit: ".$data[11]." Cliente: ".$data[12]."<br>";



                $query2 = "INSERT INTO facturas(cod,nit,cliente,
                factura,item,referencia,unidad_medida,cantidad,peso) VALUES ('',
                '$data[94]','$data[95]',$data[37],$data[65],
                '$data[66]','$data[100]',$cantidad,$peso)";

                $result2 = mysql_query($query2);

                if ($result2) {
                 header('Location:user.php' );
                }else{
                  echo "Error: ".mysql_error();
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
</form>
