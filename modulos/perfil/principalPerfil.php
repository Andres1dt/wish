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
require_once '../../usuario.entidad.php';
require_once '../../usuario.model.php';

// Logica
$usuario = new Usuario();
$model = new UsuarioModel();


if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
            $usuario->__SET('idUsuario',          $_REQUEST['idUsuario']);
            $usuario->__SET('nombre',             $_REQUEST['nombre']);
            $usuario->__SET('apellidos',          $_REQUEST['apellidos']);
            $usuario->__SET('fechaNacimiento',    $_REQUEST['fechaNacimiento']);
            $usuario->__SET('sexo',               $_REQUEST['sexo']);
   

            $model->Actualizar2($usuario);
           
            header('Location: principalPerfil.php');
            break;


        case 'editar':
            $usuario = $model->Obtener($_REQUEST['id']);
         
            break;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../.../bootstrap/css/bootstrap-theme.min.css">
      <link rel="stylesheet" type="text/css" href="../../static/css/estilo.css">
	  <meta name="viewport" content="width=device-width">

	 
	<title>Perfil</title>
</head>
<body>
	<h2>Perfil actual</h2>
	<section >

<?php 

$link = mysql_connect('localhost','root',''); 
if (!$link) { 
die('Error de coneccion ' . mysql_error()); 
} 
mysql_select_db('wish');
$usuario = $_SESSION['usuario'];
$result = mysql_query("SELECT * FROM usuarios WHERE  correoElectronico = '$usuario'");
// Check resultado 
// Si hubo un error mostras cual es 
if (!$result) { 
$message = 'Invalid query: ' . mysql_error() . " "; 
$message .= 'Whole query: ' . $query; 
die($message); 
} 

// Use result 
//Aca recorres todas las filas y te va devolviendo el resultado 
while ($row =mysql_fetch_row($result)) { ?>
<table>
	<tr>
        <td><label>Nombre: </label></td><td><?php echo ucfirst(strtolower($row[1])); ?></td>
    </tr>
    <tr>
        <td><label>Apellidos: </label></td><td><?php echo ucwords(strtolower($row[2]));  ?></td>
    </tr>
    <tr>
        <td><label>Fecha de Nacimiento: </label></td><td><?php echo $row[3]; ?></td>
    </tr>
    <tr>
        <td><label>Sexo: </label></td><td><?php echo $row[4] == 0 ? 'Hombre' : 'Mujer'; ?></td>
    </tr>  
	<tr>
        <td><label>Correo Electrónico: </label></td><td><?php echo $row[5]; ?></td>
    </tr>
   
</table>


<!--
<form action="almacenar.php" method="POST" enctype="multipart/form-data">
   
    <input type="file" name="imagen" id="imagen" />
    <input type="submit" name="subir" value="Subir Imagen"/>
</form>-->

<?php
}


// Conexion a la base de datos

    $link = mysql_connect('localhost','root',''); 
    if (!$link) { 
    die('Error de coneccion ' . mysql_error()); 
    } 
    mysql_select_db('wish');
    $usuario = $_SESSION['usuario'];
               $prueba = mysql_query("SELECT imagenes.imagen_id  from usuarios, imagenes  WHERE  correoElectronico = '$usuario' 
                and imagenes.idUsuario = usuarios.idUsuario");
               // Si hubo un error mostras cual es 
        if (!$prueba) { 
        $message = 'Invalid query: ' . mysql_error() . " "; 
        $message .= 'Whole query: ' . $query; 
        die($message); 
        } 


    while ($row =mysql_fetch_row($prueba)) {

     echo "<img class='circulo' width='150' heigth='150' src='obtenerfotografia.php?id=$row[0]'>";

}



//Liberas el resultado 
mysql_free_result($result); 


//Cerras coneccion 
mysql_close($link); 


			
?>               
	<br><br>
    <form action="editarDatosUsuarios.php">
       
        <input class="btn btn-success" name="iniciar" type="submit" value="Editar" /><br>
    </form>
    
    <br><br><a href="../../inicio.php">Volver</a>
	</section>
</body>
</html>
