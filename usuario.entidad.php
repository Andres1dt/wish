<?php
class Usuario
{
	private $idUsuario;
	private $nombre;
	private $apellidos;
	private $fechaNacimiento;
	private $sexo;
	private $correoElectronico;
	private $password;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
