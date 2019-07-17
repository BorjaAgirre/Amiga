<?php

include "include/fechas.php"; 

include_once "clases/class.leer_mysqli.php";

	$dbic = new Leer_Mysqli(); 
	//echo "Post probando: ".$_POST['tutor'];
	$id_unico=$_POST['id_unico'];
	$comentario=$dbic->escape($_POST['comentario']);
//	$hito= ((isset($_POST['hito'])) && ($_POST['hito'] != ''))? "'".$_POST['hito']."'" : "NULL";
	$hito = $_POST['hito'];
	$tutor = $_POST['tutor'];
	$fecha=fecha_txt_sql($_POST['fecha']);
	$alerta = fecha_txt_sql($_POST['alerta']);
	$mens_alerta = (empty($alerta))	? 'NULL' : "'".$alerta."'";
	$grupo=$_COOKIE['grp'];
	$permisos=$_COOKIE['prm'];
	
	$query = "INSERT INTO comentario (id_unico,comentario,hito,tutor,fecha,grupo,permisos, tipo_comentario, alerta) 
		VALUES ('".$id_unico."','".$comentario."','".$hito."','".$tutor."','".$fecha."','".$grupo."','".$permisos."', 'c',".$mens_alerta.")";
	// echo "query comentario: ".$query; 
	$dbic->pregunta_query($query);

	//$my_error = mysql_error($conexion);
	$my_error = ""; 
	
	if(!empty($my_error)) {
	echo "Ha habido un error al insertar los valores. $my_error"; 
	} else {
	echo "Los datos han sido introducidos satisfactoriamente";
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=seguimiento.php'>";	

	}
	$dbic->cerrar_conexion();
?>
