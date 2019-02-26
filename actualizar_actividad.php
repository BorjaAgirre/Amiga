<?php
include "include/fechas.php";
include_once "clases/class.leer_mysqli.php";

	$id_activ=$_GET['load'];
	$tipo_activ=$_POST['tipo_activ'];
	$responsable=$_POST['responsable'];
	$responsable2=$_POST['responsable2'];
	$volunt=$_POST['volunt'];
	$fecha_actividad=fecha_txt_sql($_POST['fecha_actividad']);
	$comentario_actividad=$_POST['comentario_actividad'];
	
	$db = new Leer_Mysqli(); 

	$db->pregunta_query("UPDATE actividad SET tipo_activ='$tipo_activ' WHERE id_activ=$id_activ;");
	$db->pregunta_query("UPDATE actividad SET responsable='$responsable' WHERE id_activ=$id_activ;");
	$db->pregunta_query("UPDATE actividad SET responsable2='$responsable2' WHERE id_activ=$id_activ;");
	$db->pregunta_query("UPDATE actividad SET volunt='$volunt' WHERE id_activ=$id_activ;");
	$db->pregunta_query("UPDATE actividad SET fecha_actividad='$fecha_actividad' WHERE id_activ=$id_activ;");
	$db->pregunta_query("UPDATE actividad SET comentario_actividad='$comentario_actividad' WHERE id_activ=$id_activ;");
	//$db->pregunta_query("UPDATE actividad SET tipo_comentario='a' WHERE id_activ=$id_activ;");

	//$my_error = mysql_error($conexion);
	$my_error = ""; 
	
	if(!empty($my_error)) {
	echo "Ha habido un error al insertar los valores. $my_error"; 
	} else {

// echo "Los datos han sido introducidos satisfactoriamente";
	$result = $db->pregunta_query("SELECT MAX(id_activ) FROM actividad");
	$row = $result->fetch_row($result);

	
	
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php?acude=$id_activ'>";	

	}
	
	

?>
