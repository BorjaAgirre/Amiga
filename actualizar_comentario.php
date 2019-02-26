<?php

include "include/fechas.php"; 
include_once "clases/class.leer_mysqli.php";

	$db = new Leer_Mysqli(); 
	$id_coment=(int)$_POST['id_coment'];
	$comentario = $db->escape($_POST['comentario']);
	$hito=$_POST['hito'];
	$tutor=$_POST['tutor'];
	$fecha = fecha_txt_sql($_POST['fecha']);
	$db->pregunta_query("UPDATE comentario SET comentario='$comentario' WHERE id_coment=$id_coment;");
	$db->pregunta_query("UPDATE comentario SET hito='$hito' WHERE id_coment=$id_coment;");
	$db->pregunta_query("UPDATE comentario SET tutor='$tutor' WHERE id_coment=$id_coment;");
	$db->pregunta_query("UPDATE comentario SET fecha='$fecha' WHERE id_coment=$id_coment;");
	$db->pregunta_query("UPDATE comentario SET tipo_comentario='c' WHERE id_coment=$id_coment;");

	//$my_error = mysql_error($conexion);
	$my_error = "";
	
	if(!empty($my_error)) {
	echo "Ha habido un error al insertar los valores. $my_error"; 
	} else {

	echo "Los datos han sido introducidos satisfactoriamente";
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=seguimiento.php'>";	

	}
	$db->cerrar_conexion();
?>
