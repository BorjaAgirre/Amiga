<?php
include_once "clases/class.leer_mysqli.php";

	$db = new Leer_Mysqli();
	$id_coment=(int)$_POST['id_coment'];
	$tutor=$_POST['tutor'];
	$id_pers=(int)$_POST['id_pers'];
	$comentario = $db->escape($_POST['comentario']);
	$db->pregunta_query("UPDATE comentario SET comentario='$comentario' WHERE id_coment=$id_coment;");
	$db->pregunta_query("UPDATE comentario SET tutor='$tutor' WHERE id_coment=$id_coment;");
	$db->pregunta_query("UPDATE comentario SET tipo_comentario='a' WHERE id_coment=$id_coment;");

	//$my_error = mysql_error($conexion);
	$my_error = "";
	
	if(!empty($my_error)) {
	echo "Ha habido un error al insertar los valores. $my_error"; 
	} else {

	echo "Los datos han sido introducidos satisfactoriamente";
	$result = $db->pregunta_query("SELECT MAX(id_activ) FROM actividad");
	$row = $result->fetch_row();

	echo "<script>history.go(-1)</script>";	
	}
	$db->cerrar_conexion();

?>
