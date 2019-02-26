<?php 

function array_desplegable($campo) {
	global $campos_bd;

	include "conexion.php"; 

	$array_campo = $campos_bd[$campo];
	$nombre_tabla = $array_campo[1];
	$nombre_dato = $array_campo[2];
	if (is_array($nombre_dato)) {
		$query = "SELECT ".$nombre_id;
		foreach ($nombre_dato as $dat) {
			$query .= ", ".$dat;
		}
		$nombre_dato = $nombre_dato[0];
		$query .= " FROM ".$nombre_tabla." ORDER BY ".$nombre_dato;
		$nombre_id = "id_".$nombre_dato;
	} else {
		$nombre_id = "id_".$nombre_dato;
		$query = "SELECT ".$nombre_id.", ".$nombre_dato." FROM ".$nombre_tabla." ORDER BY ".$nombre_dato;
	}
//		echo "array desplegable - query es: ".$query;
	$result=mysqli_query($query, $conexion); 
	while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
/*
	echo "<br>array desplegable - row<br><pre>";
	print_r($row);
	echo "</pre>";
*/
		$id = $row[$nombre_id];
		$desplegable[$campo][$id][$nombre_dato]=$row[$nombre_dato];
	}
	include "cerrar_conexion.php"; 
	return $desplegable[$campo];
}


include "inicializa.php"; 

$poblaciones=array_desplegable('poblacion');


include "conexion.php"; 

// Tutores
$result=mysqli_query("SELECT id_tutor, nombre FROM tutor ORDER BY nombre", $conexion); 
$i=0;
while($row_tutor=mysqli_fetch_array($result,MYSQLI_BOTH)){
	$tutores[$i]["nombre"]=$row_tutor["nombre"];
	$tutores[$i]["id"]=$row_tutor["id_tutor"];
	$i++; 
}


// Hitos
$result2=mysqli_query("SELECT id_hito, nombre_hito FROM hito ORDER BY nombre_hito", $conexion); 
$i=0;
while($row_hito=mysqli_fetch_array($result2,MYSQLI_BOTH)){
	$hitos[$i]["hito"]=$row_hito["nombre_hito"];
	$hitos[$i]["id"]=$row_hito["id_hito"];
	$i++; 
}


// Países
$result_paises=mysqli_query("SELECT id_pais, pais, area FROM paises_mundo ORDER BY pais", $conexion); 
while($row_pais=mysqli_fetch_array($result_paises,MYSQLI_BOTH)){
	$id = $row_pais["id_pais"];
	$paises[$id]["pais"]=$row_pais["pais"];
	$paises[$id]["area"]=$row_pais["area"];
}
include "cerrar_conexion.php"; 

$_SESSION['tutores']= $tutores;
$_SESSION['hitos']= $hitos;
$_SESSION['paises'] = $paises;

/*
	echo "<br>array desplegable - poblaciones:<br><pre>";
	print_r($poblaciones);
	echo "</pre>";
*/
?>
