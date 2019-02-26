<?php 

$campos_bd["nombre"] = 		array("Nombre");
$campos_bd["apellido1"] = 	array("Apellido 1");
$campos_bd["apellido2"] = 	array("Apellido 2");
$campos_bd["fechanac"] = 	array("Fecha nacimiento");
$campos_bd["lugar_nac"] = 	array("Lugar de nacimiento");
$campos_bd["dni_pas"] = 	array("DNI");
$campos_bd["num_ss"] = 		array("Num. Seguridad Social");
$campos_bd["nacionalidad"] = 	array("Nacionalidad");
$campos_bd["telefono"] = 	array("Teléfono");
$campos_bd["direccion"] = 	array("Dirección");
$campos_bd["poblacion"] = 	array("Población", "poblaciones", "poblacion");
$campos_bd["nucleo_conv"] = 	array("Núcleo convivencia");
$campos_bd["estado_civil"] = 	array("Estado civil");
$campos_bd["hijos"] = 		array("Hijos");
$campos_bd["n_hijos"] = 	array("Número hijos");
$campos_bd["observaciones_hijos"] = array("Observaciones hijos");
$campos_bd["id_pers"] = 	array("Identificador");

//include_once "../clases/class.leer_mysqli.php";

// Tutores
$dbi = new Leer_Mysqli();
$result = $dbi->pregunta_query("SELECT id_tutor, nombre FROM tutor ORDER BY nombre"); 
$i=0;
while($row_tutor = $result->fetch_array(MYSQLI_BOTH)){
	$tutores[$i]["nombre"]=$row_tutor["nombre"];
	$tutores[$i]["id"]=$row_tutor["id_tutor"];
	$i++; 
}
//echo "Tutores: <pre>"; print_r($tutores); echo "</pre>";


// Hitos
$result2 = $dbi->pregunta_query("SELECT id_hito, nombre_hito FROM hito ORDER BY nombre_hito"); 
$i=0;
while($row_hito = $result2->fetch_array(MYSQLI_BOTH)){
	$hitos[$i]["hito"]=$row_hito["nombre_hito"];
	$hitos[$i]["id"]=$row_hito["id_hito"];
	$i++; 
}


$_SESSION['tutores']= $tutores;
$_SESSION['hitos']= $hitos;


$dbi->cerrar_conexion();

/*
	echo "<br>array desplegable - poblaciones:<br><pre>";
	print_r($tutores);
	echo "</pre>";
*/
?>
