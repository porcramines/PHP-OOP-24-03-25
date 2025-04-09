<?php
include_once("clases.php");
$albumes=new albumes();
print "tenemos ".$albumes->numalbumes()." albumes en el sistema <br>";
$usuarios = new usuarios();
print "tenemos ".$usuarios->numusuarios()."usuarios en el sistema <br>";
$figuritas =new figuritas();
print "tenemos ".$figuritas->numFiguritas()."figuritas en el sistema <br>";

?>