<?php	

	include "include/fechas.php";
	$tipo_activ=$_POST['tipo_activ'];
	include_once "clases/class.leer_mysqli.php";
	
	$fecha_actividad=fecha_txt_sql($_POST['fecha_actividad']);
	
	
	//Validacion
	if ($tipo_activ==5)
	echo "<script>alert('No has seleccionado ninguna actividad')</script>";
	else if (strlen($fecha_actividad==0))
	echo "<script>alert('Introduzca una fecha correcta')</script>";
	
	$db = new Leer_Mysqli(); 
	if ($tipo_activ > 0 AND strlen($fecha_actividad > 0)) // Si no está vacía
			{
			$db->pregunta_query("INSERT INTO actividad 
			(tipo_activ,
			responsable,
			responsable2,
			volunt,
			fecha_actividad,
			comentario_actividad,
			observaciones_actividad)
			
			VALUES (
			'{$tipo_activ}',
			'{$_POST['responsable']}',
			'{$_POST['responsable2']}',
			'{$_POST['volunt']}',
			'{$fecha_actividad}',
			'{$_POST['comentario_actividad']}',
			'{$_POST['observaciones_actividad']}')
			");
			
			//$my_error = mysql_error($conexion);
			$my_error = ""; 
			
			if(!empty($my_error)) {
			echo "Ha habido un error al insertar los valores. $my_error"; 
			sleep(19);
			} else {

			echo "Los datos han sido introducidos satisfactoriamente";
			$result = $db->pregunta_query("SELECT MAX(id_activ) FROM actividad");
			$row = $result->fetch_row();

			
			
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php?acude=$row[0]'>";	

			}
	}
	else
	{
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php'>";	
	}
	$db->cerrar_conexion(); 
?>
