<?php
require_once("clases.php");
$session=new session();
if($sesion->estadologin()){
	header("location:inicio.php");
}
else
{
	header("location:login.php")
}

?>