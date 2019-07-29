<?php

$idunico=$_POST['idunico'];
$id_actividad=$_POST['id_activ'];
if ($idunico!=0) {

	include "include/fechas.php";
	include_once "clases/class.leer_mysqli.php";


	$fecha_actividad = $_POST['fecha_actividad'];
	$comentario=$_POST['comentario'];
	$tutor=$_POST['tutor'];
	$alerta = fecha_txt_sql($_POST['alerta']);
	$mens_alerta = (empty($alerta))	? 'NULL' : "'".$alerta."'";
	echo $idunico;
	
	$db = new Leer_Mysqli(); 

	$db->pregunta_query(
		"INSERT INTO comentario (
			id_unico,
			fecha,
			id_actividad,
			comentario,
			tutor,
			tipo_comentario,
			alerta)
		 VALUES (
			'$idunico',
			'$fecha_actividad',
			'$id_actividad',
			'$comentario',
			'$tutor',
			'a',
			$mens_alerta)"
		);
   
	//$my_error = mysql_error($conexion);
	$my_error = "";
	
	if(!empty($my_error)) {
	echo "Ha habido un error al insertar los valores. $my_error"; 
	} else {

	$result = $db->pregunta_query("SELECT MAX(id_activ) FROM actividad");
	$row = $result->fetch_row();
	
	 echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php?acude=".$id_actividad."'>";	
	$db->cerrar_conexion();
	}
} else {
// 
//  PONER ALERTA DE QUE 'NO SE HA CARGADO BIEN EL USUARIO'
//
echo "<h1>No se ha cargado ningun nombre de usuario</h1>";
echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php?acude = $id_actividad'>";	
}
?>
