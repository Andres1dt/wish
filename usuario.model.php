
<?php
class UsuarioModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=wish', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuarios");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Usuario();

				$alm->__SET('idUsuario', $r->idUsuario);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellidos', $r->apellidos);
				$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
				$alm->__SET('sexo', $r->sexo);
				$alm->__SET('correoElectronico', $r->correoElectronico);
				$alm->__SET('password', $r->password);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function ListarUsuarioRegistrado(){
	
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.php'); 
  exit();
}
 
	try
		{

			$link = mysql_connect('localhost','root',''); 
			if (!$link) { 
			die('Error de coneccion ' . mysql_error()); 
			} 
			mysql_select_db('wish');
			$usuario = $_SESSION['usuario'];
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE  correoElectronico = '$usuario'");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Usuario();

				$alm->__SET('idUsuario', $r->idUsuario);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellidos', $r->apellidos);
				$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
				$alm->__SET('sexo', $r->sexo);
				$alm->__SET('correoElectronico', $r->correoElectronico);
				$alm->__SET('password', $r->password);
				

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Obtener($idUsuario)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE idUsuario = ?");
			          

			$stm->execute(array($idUsuario));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Usuario();
			$alm->__SET('idUsuario', $r->idUsuario);
			$alm->__SET('nombre', $r->nombre);
			$alm->__SET('apellidos', $r->apellidos);
			$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
			$alm->__SET('sexo', $r->sexo);
			$alm->__SET('correoElectronico', $r->correoElectronico);
			$alm->__SET('password', $r->password);
			

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idUsuario)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM usuarios WHERE idUsuario = ?");			          

			$stm->execute(array($idUsuario));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Usuario $data)
	{
		try 
		{
			$sql = "UPDATE usuarios SET 
						nombre          = ?, 
						apellidos        = ?,
						fechaNacimiento = ?,
						Sexo            = ?,
						correoElectronico =?,
						password =?
				    WHERE idUsuario = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('apellidos'),
					$data->__GET('fechaNacimiento'),
					$data->__GET('sexo'),
					$data->__GET('correoElectronico'),
					$data->__GET('password'),
					$data->__GET('idUsuario')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	public function Actualizar2(Usuario $data)
	{
		try 
		{
			$sql = "UPDATE usuarios SET 
						nombre          = ?, 
						apellidos        = ?,
						fechaNacimiento = ?,
						Sexo            = ?
						
				    WHERE idUsuario = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('apellidos'),
					$data->__GET('fechaNacimiento'),
					$data->__GET('sexo'),
					
					$data->__GET('idUsuario')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
		$sql = "INSERT INTO usuarios (nombre,apellidos,fechaNacimiento,sexo,correoElectronico,password) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
				$data->__GET('apellidos'),
				$data->__GET('fechaNacimiento'),
				$data->__GET('sexo'),
				$data->__GET('correoElectronico'),
				$data->__GET('password')

				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
}
