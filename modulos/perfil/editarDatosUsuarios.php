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
	<title>Editar Datos</title>
	     <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../.../bootstrap/css/bootstrap-theme.min.css">
      <link rel="stylesheet" type="text/css" href="../../static/css/estilo.css">
	  <meta name="viewport" content="width=device-width">
</head>
<body>

		<section class="seccionDatos">
        <h2>Modificaciones de información</h2>
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
                           
                            <button type="submit" class="btn btn-success">Guardar</button>  

                                          
    </form>
    <table class="pure-table pure-table-horizontal">
        
                    <?php foreach($model->ListarUsuarioRegistrado() as $r): ?>
                        <tr>
                        	
                           
                            <td>
                                <a href="?action=editar&id=<?php echo $r->idUsuario; ?>">Obtener datos</a>
                            </td>
                          
                        </tr>
                    <?php endforeach; ?>
                </table> 
	 <br><br><a href="principalPerfil.php">Volver</a>
</body>
</html>