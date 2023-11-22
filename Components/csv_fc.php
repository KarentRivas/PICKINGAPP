<?php
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
                $i = $i+1;
                if ($i == 1) {
                    # code...
                }else{
                
                //echo "Nit: ".$data[11]." Cliente: ".$data[12]."<br>";

                if ($data[11] == 890900608) {
                
                $query = "INSERT INTO exito(codigo,nit,cliente,
                sucursal,establecimiento,factura,remision,item,referencia,
                unidad_medida,cantidad,peso) VALUES ('','$data[11]','$data[12]',
                '$data[13]','$data[14]',$data[44],$data[43],$data[48],
                '$data[49]','$data[88]',$data[111],$data[123])";

              $result = mysql_query($query);

              if ($result) {
                
              }else{
                echo "Error: ".mysql_error();
              }
   
                }else{

                $query2 = "INSERT INTO facturas(cod,nit,cliente, 
                factura,item,referencia,unidad_medida,cantidad,peso) VALUES ('',
                '$data[11]','$data[12]',$data[44],$data[48],
                '$data[49]','$data[88]',$data[111],$data[123])";
                
                $result2 = mysql_query($query2);

                if ($result2) {
                  # code...
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
</form>_