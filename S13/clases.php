<?php

class dbMySQL{
	private $host="localhost";
	private $usuario="root";
	private $clave="";
	private $db="albumes";
	private $conn;
	public function __construct(){
		$this->conn=mysqli_connect($this->host,$this->usuario,$this->clave,$this->db);
		if(mysqli_connect_error()){
			printf("error en la conexion:%d",mysqli_connect_error());
			exit;
		}
		else
		{
			//print "conexion exitosa <br>";
		}
	}
	public function query($q){
		$data=array();
		if($q!=""){
			if($r=mysqli_query($this->conn,$q)){
				$data=mysqli_fetch_row($r);
			}
		}
		return $data;
	}
	public function close(){
		mysqli_close($this->conn);
		//print "cerrar la conexion en forma exitosa <br>";
	}
}


class albumes{
	private $id;
	private $nombre;
	private $figuritas;

	function __construct(){

	}
	function numalbumes(){
		$db=new dbMySQL();
		$data=$db->query("SELECT COUNT(*) FROM album");
		$db->close();
		unset($db);
		return $data[0];
	}
}
class usuarios{
	private $id;
	private $correo;
	function __construct(){

	}

	function numusuarios(){
		$db=new dbMySQL();
		$data=$db->query("SELECT COUNT(*) FROM usuario");
		$db->close();
		unset($db);
		return $data[0];
	}
	public static function buscausuario($usuario){
		$db=new dbMySQL();
		$data=$db->query("SELECT * FROM usuario WHERE correo='".$usuario."'");
		$db->close();
		unset($db);
		return isset($data[0]);
	}

}
class figuritas{
	private $id;
	private $album;
	private $usuario;
	private $numero;
	private $estado;
	function __construct(){

	}
	function numfiguritas(){
		$db=new dbMySQL();
		$data=$db->query("SELECT COUNT(*) FROM figuritas");
		$db->close();
		return $data[0];
	}
}


?>