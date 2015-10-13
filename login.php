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
    

    case 'eliminar':
      $model->Eliminar($_REQUEST['id']);
 
      header('Location: login.php');
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
  <link rel="stylesheet" type="text/css" href="static/css/estiloLogin.css">
  <script 
    src="bootstrap/js/bootstrap.min.js">
  </script>
  <meta name="viewport" content="width=device-width">
  <title>Wish.com</title>
</head>
<body> <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock"></span> Login</div>
                <div class="panel-body">
                    <form action=" validar_usuario.php" method="post"  class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">
                            Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="admin" class="form-control" id="inputEmail3" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">
                            Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_usuario"  class="form-control" id="inputPassword3" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/>
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success btn-sm">
                                Sign in</button>
                                 <button type="reset" class="btn btn-default btn-sm">
                                Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                    Not Registred? <a href="registroUsuarios.php">Register here</a></div>
            </div>
        </div>
    </div>
</div>
 
<br>
<br>
  <a href="index.html">Volver</a>   
              
 

</section>  

</body>
</html>


<!--
 <table class="pure-table pure-table-horizontal">
                    
                    <?php foreach($model->Listar() as $r): ?>
                       
                        <tr>
                            <td><?php echo $r->__GET('correoElectronico'); ?></td>  <td><?php echo $r->__GET('password'); ?></td>   
                        
                    
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->idUsuario; ?>">Eliminar</a>
                            </td>
                       </tr>
                    <?php endforeach; ?>
      </table> --<