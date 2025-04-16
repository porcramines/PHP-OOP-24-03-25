<?php
require_once("clases.php");
$sesion=new sesion();
if ($sesion->estadologin()==false) {
	header("location:login.php");
	exit;
}

$album = albumes::leealbum();
$idusuario=usuarios::getusuario($sesion->getusuario());
$numfiguritas=figuritas::numfiguritas($idusuario,$album[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio</title>
</head>
<body>
<h1>bienvenido a la pagina <?php print $sesion->getusuario();?></h1>
<h1>El album que tenemos es: <?php print $album[1];?></h1>	
<p>tienes <?php print $numfiguritas;?> figuras en el album</p>	
<?php
if ($numfiguritas==0) {
	albumes::creaalbum($idusuario,$album[0],$album[2]);
}
?>
</body>
</html>