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
require_once 'usuario.entidad.php';
require_once 'usuario.model.php';

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
            $usuario->__SET('correoElectronico',    $_REQUEST['correoElectronico']);
            $usuario->__SET('password',             $_REQUEST['password']);

			$model->Actualizar($usuario);
           
			header('Location: registroUsuarios.php');
			break;

		case 'registrar':
		    $usuario->__SET('idUsuario',          $_REQUEST['idUsuario']);
            $usuario->__SET('nombre',             $_REQUEST['nombre']);
            $usuario->__SET('apellidos',          $_REQUEST['apellidos']);
            $usuario->__SET('fechaNacimiento',    $_REQUEST['fechaNacimiento']);
            $usuario->__SET('sexo',               $_REQUEST['sexo']);
            $usuario->__SET('correoElectronico',    $_REQUEST['correoElectronico']);
            $usuario->__SET('password',             $_REQUEST['password']);


			$model->Registrar($usuario);
           
			header('Location: inicio.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
 
			header('Location: registroUsuarios.php');
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
     <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
      <link rel="stylesheet" type="text/css" href="static/css/estilo.css">
	  <meta name="viewport" content="width=device-width">

	 
	<title>Perfil</title>
</head>
<body>
	
	<section >

<?php 

$link = mysql_connect('localhost','root',''); 
if (!$link) { 
die('Error de coneccion ' . mysql_error()); 
} 
mysql_select_db('wish');
$usuario = $_SESSION['usuario'];
$result = mysql_query("SELECT * FROM usuarios WHERE nombre = '$usuario' or correoElectronico = '$usuario'");
// Check resultado 
// Si hubo un error mostras cual es 
if (!$result) { 
$message = 'Invalid query: ' . mysql_error() . " "; 
$message .= 'Whole query: ' . $query; 
die($message); 
} 
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

     echo "<img class='circulo'width='150' heigth='150' src='modulos/perfil/obtenerfotografia.php?id=$row[0]'>";

}
// Use result 
//Aca recorres todas las filas y te va devolviendo el resultado 
while ($row =mysql_fetch_row($result)) { ?>
<table>
	<tr>
        <td><label><h3>¡Hola </h3></label></td><td></td>
        <td><h3><?php echo ucfirst($row[1]); ?>!</h3></td>
    </tr>
   
</table>


 	
 	<a href="modulos/perfil/principalPerfil.php">Perfil</a><br>
 	<a href="">Escribir deseo</a><br>
 	<a href="">Notificaciones  </a><br>
 	<a href="">Ver todos los deseo</a><br>
 	<a href="">Ver deseos por categorias</a><br>
 	<a href="">Ver deseos realizados</a>
 	<br><br>
 	<a href="logout.php"> Salir</a>



<?php
}


// Conexion a la base de datos




//Liberas el resultado 
mysql_free_result($result); 


//Cerras coneccion 
mysql_close($link); 


			
?>               
	
	</section>
</body>
</html>
 
