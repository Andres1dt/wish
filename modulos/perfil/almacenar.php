<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.php'); 
  exit();
}
 ?>

<?php
// Conexion a la base de datos
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("wish") or die(mysql_error());
 
// Comprobamos si ha ocurrido un error.
if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0)
{
    echo "Ha ocurrido un error.";
}
else
{
    // Verificamos si el tipo de archivo es un tipo de imagen permitido.
    // y que el tamaño del archivo no exceda los 16MB
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16384;
 
    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024)
    {
 
        // Archivo temporal
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
 
        // Tipo de archivo
        $tipo = $_FILES['imagen']['type'];
 
        // Leemos el contenido del archivo temporal en binario.
        $fp = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
 
        //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
        // $data=file_get_contents($imagen_temporal);
 
        // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
        $data = mysql_escape_string($data);

        $usuario = $_SESSION['usuario'];
        $result = mysql_query("SELECT idUsuario FROM usuarios WHERE nombre = '$usuario' or correoElectronico = '$usuario'");
        if (!$result) { 
            $message = 'Invalid query: ' . mysql_error() . " "; 
            $message .= 'Whole query: ' . $query; 
            die($message); 
        } 
         

while ($row =mysql_fetch_row($result)) {


        // Insertamos en la base de datos.
        $resultado = @mysql_query("INSERT INTO imagenes (imagen, tipo_imagen, idUsuario) VALUES ('$data', '$tipo', '$row[0]')");
 }
        if ($resultado)
        {
            header('Location: principalPerfil.php');
        }
        else
        {
            echo "Ocurrió algun error al copiar el archivo.";
        }
    }
    else
    {
        echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
    }
}
?>