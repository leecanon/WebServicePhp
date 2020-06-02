<?php 

require_once "lib/nusoap.php";


$cliente = new nusoap_cliente("http://www.webservice.fya/index.php?wsdl");
$alumnos = $cliente->call("cargarAlumnos",array("id"=>10));
$alumnos = json_decode($alumnos);

echo " <ul>";
foreach ($alumnos as $alumno) {
	echo "<li>".$alumno->Codigo." ".$alumno->flota." ".$alumno->p_neto." "."</li>";
}
echo "</ul>";