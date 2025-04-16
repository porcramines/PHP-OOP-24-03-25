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
			print "conexion exitosa <br>";
		}
	}
	public function query($q){
		$data=array();
		if($q!=""){
			if($r=mysqli_query($this->conn,$q)){
				$data=mysqli_fetch_array($r);
			}
		}
		return $data;
	}
	public function query2($q){
		$data=array();
		if ($q!="") {
			if ($r=mysqli_query($this->conn,$q)) {
				while ($row=mysqli_fetch_array($r)) {
					array_push($data,$row);
				}
			}
		}
		return $data;
	}
	public function close(){
		mysqli_close($this->conn);
		print "cerrar la conexion en forma exitosa <br>";
	}
}
class sesion{
	private $login=false;
	private $usuario;
	function __construct(){
		session_start();
		$this->verificalogin();
		if($this->login){
			//si esta logueado
		}
		else{
			//no esta logueado
		}
	}
	private function verificalogin(){
		if(isset($_SESSION["usuario"])){
			$this->usuario=$_SESSION["usuario"];
			$this->login=true;
		}
		else{
			unset($this->usuario);
			$this->logn=false;
		}
	}
	public function iniciologin($usuario){
		if($usuario){
			$this->usuario=$_SESSION['usuario']=$usuario;
			$this->login=true;
		}
	}
	public function finlogin($usuario){
		unset($_SESSION['usuario']);
		unset($this->usuario);
		$this->login=false;
	}
	public function estadologin(){
		return $this->login;
	}
	public function getusuario(){
		return $this->usuario;
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
	static function leealbum(){
		$db=new dbMySQL();
		$data=$db->query("SELECT * FROM album");
		$db->close();
		unset($db);
		return $data;
	}
	static function creaalbum($usuario,$album,$numfiguritas){
		$db=new dbMySQL();
		for($i=1;$i<=$numfiguritas;$i++){
			$data=$db->query("INSERT INTO figuritas VALUES(0,'".$album."','".$usuario."','".$i."',0)");
		}
		$db->close();
		unset($db);
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
	static function getusuario($usuario){
		$db=new dbMySQL();
		$data=$db->query("SELECT id FROM usuario WHERE correo ='".$usuario."'");
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
	static function numfiguritas($usuario,$album){
		$db=new dbMySQL();
		$data=$db->query("SELECT COUNT(*) FROM figuritas WHERE album='".$album."' AND usuario='".$usuario."'");
		$db->close();
		unset($db);
		return $data[0];
	}

}


?>