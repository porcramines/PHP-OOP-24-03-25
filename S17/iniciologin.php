<?php
require_once("clases.php");
$sesion=new sesion();
$usuario=$_POST["correo"];
if ($usuario != "") {
	if (usuarios::buscausuario($usuario)) {
		$sesion->iniciologin($usuario);
		header("location:inicio.php");
		print "logueado";
		exit;
	}
	else
	{
		header("location:login.php");
		exit;
	}
}
else
{
	header("location:login.php");
}
?>
