<?php
require_once 'funciones.php';
 
if(!empty($_POST)){
      if (subir_fichero('imagenes','campofotografia'))
         echo 'Archivo recibido correctamente';
         
}
?>