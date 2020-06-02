<?php 

require_once "lib/nusoap.php";

$servicio = new soap_servicio();
$servicio->configureWSDL("primer servicio","urn:mundopccmb");

if(!isset($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
}


function cargarAlumnos($id){
	$cn = mysqli_connect("localhost","root","","Alumnos");
	$alumnos = $cn->query("SELECT dni,nombre,ap_p,ap_m FROM estudiantes WHERE dni=".$id);
	$ArrAlumnos = [];
	while ($alumno = mysqli_fetch_array($alumnos,MYSQLI_ASSOC)) {
		$ArrAlumnos[] = $alumno ;
	}
	return json_encode($ArrAlumnos);
}

$servicio->register("cargarAlumnos",array("id"=>"xsd:int"),
				 				    array("return"=>"xsd:string"),
				 				    "urn:mundopccmb",
				 				    "urn:mundopccmb#cargarAlumnos",
				 				    "rpc",
				 				    "encoded",
				 				    "Carga todos los alumnos"
				  );

$servicio->service($HTTP_RAW_POST_DATA);