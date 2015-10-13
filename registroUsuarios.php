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
	 
	<title>Registro</title>
</head>
<body>
	<section class="seccionDatos">
        <h2>Registro de Usuario</h2>
		<form action="?action=<?php echo $usuario->idUsuario > 0 ? 'actualizar' : 'registrar'; ?> " method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idUsuario" value="<?php echo $usuario->__GET('idUsuario'); ?>" />
                        
                           <input class="form-control" type="text" placeholder="Nombre" style="text-transform: capitalize;" title="Se necesita un nombre" required name="nombre" value="<?php echo $usuario->__GET('nombre'); ?>" style="width:100%;" />
                           <input class="form-control" type="text" placeholder="Apellidos" style="text-transform: capitalize;" title="Se necesita los apellidos" required name="apellidos" value="<?php echo $usuario->__GET('apellidos'); ?>" style="width:100%;" />
                           <label>Fecha de Nacimiento</label> <br>
                           <input class="form-control"  type="date" name="fechaNacimiento" value="<?php echo $usuario->__GET('fechaNacimiento'); ?>" style="width:100%;" /> 
                           <label>Sexo</label> <br>
                                <select class="form-control"  name="sexo" style="width:100%;">
                                    <option value="1" <?php echo $usuario->__GET('sexo') == 1 ? 'selected' : ''; ?>>Mujer</option>
                                    <option value="0" <?php echo $usuario->__GET('sexo') == 0 ? 'selected' : ''; ?>>Hombre</option>
                                </select>    
                            <input class="form-control" type="email" placeholder="Correo Electrónico"  title="Se necesita un correo electrónico" required name="correoElectronico"  value="<?php echo $usuario->__GET('correoElectronico'); ?>" style="width:100%;" />
                           
                            <input class="form-control" type="password" placeholder="Introducir Contraseña" title="Se necesita un contraseña" required name="password" value="<?php echo $usuario->__GET('password'); ?>"style="width:100%;" />
   							
                            <input type="checkbox" required name="terminos" ><a href="#">Acepto los Términos y condiciones</a> <br>
                            <button type="submit" class="btn btn-success">Guardar</button>    
                                          
    </form>
  <!--
	<table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                        	<th style="text-align:left;">ID</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Apellidos</th>
                            <th style="text-align:left;">Fecha de Nacimiento</th>
                            <th style="text-align:left;">Sexo</th>
                            <th style="text-align:left;">Correo Electronico</th>
                            <th style="text-align:left;">Password</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                        	<td><?php echo $r->__GET('idUsuario'); ?></td>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('apellidos'); ?></td>
                            <td><?php echo $r->__GET('fechaNacimiento'); ?></td>
                            <td><?php echo $r->__GET('sexo') == 1 ? 'H' : 'F'; ?></td>
                            <td><?php echo $r->__GET('correoElectronico'); ?></td>
                            <td><?php echo $r->__GET('password'); ?></td>
                            
                            <td>
                                <a href="?action=editar&id=<?php echo $r->idUsuario; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->idUsuario; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>   -->
	<a href="login.php">Cancelar</a>
	</section>
	

</body>
</html>