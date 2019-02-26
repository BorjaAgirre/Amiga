<?
include("../clases/class.leer_mysqli.php");
include_once "array_a_tabla.php"; 

include "fechas.php";
include "imprime.php"; 

include_once "config.php"; 
include "conexion.php";

$debug = 0;

$actividad = 25; 
		echo "<h1> Lista de actividades</h1>"; 

	$db = new Leer_Mysqli(); 
	$activi = $db->lista_actividades();
	// echo "<pre>"; print_r($activi); echo "</pre>"; 
	
	echo "<b>Escoge la actividad que quieres ver:</b>\n<br>\n";
	echo "<form action=". $_SERVER['PHP_SELF']. " method='POST'>";
	echo "<select name='actividad'>\n"; 
	$i = 0;
	foreach ($activi as $act) {
		echo "<option value='".$act[0]."'>".$act['nombre_actividad']."</option>\n";
	}
	echo "</select><br><br>";
	echo "<br>Fecha inicio: <input type='text' name='fecha_0' > &nbsp; &nbsp\n";
	echo "Fecha fin: <input type='text' name='fecha_1' >\n";
	echo "<br>(Formato de fecha: dia/mes/año) (Por defecto: año 2014)";
	echo "<br><input type='submit' name='opciones' value='Enviar'>\n";
	echo "</form>"; 

	if (isset($_POST['actividad'])) {

		// 
		// Lista de actividades
		//
		echo "<p>&nbsp;</p>"; 

		$activ = $_POST['actividad'];
		if ((isset ($_POST['fecha_0'])) && ($_POST['fecha_0'] != '')) { $inicio = fecha_txt_sql($_POST['fecha_0']); } 
			else  { $inicio = "2014-01-01"; }
		if ((isset ($_POST['fecha_1'])) && ($_POST['fecha_1'] != '')){ $fin= fecha_txt_sql($_POST['fecha_1']); } 
			else  { $fin= "2014-12-31"; }
		$datos_activ = $db->actividades_intervalo($activ, $inicio, $fin);
		if ($debug != 0) {echo "DEBUG: <pre>"; print_r($datos_activ); echo "</pre>"; }

		/*
		* Escribe la tabla en pantalla
		*/
		$titulo  = "<h2>Lista de actividades en el periodo ".$inicio." - ".$fin."</h2>";
		$cabeceras = array("Fecha", "Comentario","Actividades");
		escribeTabla($titulo, $cabeceras, $datos_activ); 


		$db->crea_aux_actividad();
		$db->actividades_genero($activ, $inicio, $fin);


/*
	$actividad = $activi[$_POST['actividad']][0]; 

		// 
		// Lista por actividades
		//
		echo "<p>&nbsp;</p>"; 
		echo "<h2>Lista por actividades</h2>";

		$result_count=mysql_query("SELECT count(*) FROM actividad", $conexion);
		$row_count = mysql_fetch_array($result_count, MYSQL_BOTH); 
		$count = $row_count[0];


		echo "<table border='1'>";
		echo "<tr><td>Fecha</td><td>Mujeres</td><td>Hombres</td><td>Total</td><td>Comentarios</td><td>Observaciones</td><td>
				</td></tr>";

		$result_ini=mysql_query("SELECT * FROM actividad WHERE fecha_actividad > '2010-12-31' AND tipo_activ = '".$actividad."'
					ORDER BY fecha_actividad", $conexion);

		$cont_hb = 0;
		$cont_mj = 0;
		$cont_activ = 0;

		while($row_ini = mysql_fetch_array($result_ini,MYSQL_BOTH)){
			$activ = $row_ini['id_activ']; 

			$query_hb = "SELECT COUNT(*) as hb
				FROM auxiliar p, actividad a, comentario c 
				WHERE a.fecha_actividad > '2010-12-31' AND p.id_unico = c.id_unico  AND a.tipo_activ = '".$actividad."' 
				AND c.id_actividad = a.id_activ AND a.id_activ=".$activ." AND p.sexo = 2;";

			$result_hb=mysql_query($query_hb, $conexion);
			$row_hb = mysql_fetch_array($result_hb , MYSQL_BOTH);
			$hb = $row_hb['hb'];
			$cont_hb = $cont_hb + $hb; 

			$query_mj = "SELECT COUNT(*) as mj, p.id_unico,p.sexo, p.nombre, p.apellido1, c.id_coment, c.id_actividad, a.id_activ as id, 
				a.tipo_activ, a.comentario_actividad as comentario, a.observaciones_actividad as observ, a.fecha_actividad as fecha 
				FROM auxiliar p, actividad a, comentario c 
				WHERE a.fecha_actividad > '2010-12-31' AND p.id_unico = c.id_unico  AND a.tipo_activ = '".$actividad."' 
				AND c.id_actividad = a.id_activ AND a.id_activ=".$activ." AND p.sexo = 1;";

			$result_mj=mysql_query($query_mj, $conexion);
			$row_mj = mysql_fetch_array($result_mj,MYSQL_BOTH);
			$fecha=fecha_sql_txt($row_mj['fecha']);	
			$mj = $row_mj['mj']; 
			$cont_mj = $cont_mj + $mj; 

			$tot = $mj+$hb; 

			$cont_activ = $cont_activ + 1; 

			echo "<tr><td>$fecha</td><td>".$mj."</td><td>&nbsp;".$hb."</td><td>".$tot."</td>
					<td>&nbsp;<a href='../actividad.php?load=".$row_mj['id']."'>".
					$row_mj['comentario']."</a></td><td>&nbsp;".$row_mj['observ']."</td></tr>";

		}
		$suma = $cont_mj + $cont_hb; 
		echo "<tr><td>TOTAL: </td><td>".$cont_mj."</td><td>&nbsp;".$cont_hb."</td><td>".$suma."</td>
			<td></td><td></td></tr>";
		echo "</table border='1'>";
		echo "<br>Nº actividades: \t<b>".$cont_activ."</b>"; 
		echo "<br>&nbsp;<br>Media de personas por actividad: ";
		echo "<br><table><tr><td>Mujeres</td><td>Hombres</td><td>Total</td></tr>"; 
		echo "<tr><td>".round($cont_mj/$cont_activ,2)."</td><td>".round($cont_hb/$cont_activ,2)."</td><td>".round($suma/$cont_activ,2)."</td></tr>"; 
		echo "</table>"; 




		//
		// Lista por personas
		//


		echo "<p>&nbsp;</p>"; 
		echo "<h2>Lista por personas</h2>";

		$query_users = "SELECT 	
					COUNT(*) as veces,
					c.id_unico as id_unico, 
					p.nombre, 
					p.apellido1, 
					a.id_activ, 
					a.comentario_actividad 
				FROM auxiliar p, actividad a, comentario c 
				WHERE a.fecha_actividad <= '2011-12-31' 
					AND a.fecha_actividad >= '2011-01-01' 
					AND p.id_unico = c.id_unico  
					AND a.tipo_activ = '".$actividad."' 
					AND c.id_actividad = a.id_activ 
				GROUP BY c.id_unico 
				ORDER BY c.id_unico;";
		$result_users = mysql_query($query_users, $conexion);

		echo "\n<table border='1'>";
		echo "<tr><td>Veces</td><td>Nombre</td><td>Apellido</td><td></tr>";
		$i = 0; 
		while ($row_users = mysql_fetch_array($result_users,MYSQL_BOTH)) {
			echo "<tr><td>".$row_users['veces']."</td>
				<td><a href='../persona.php?load=".$row_users['id_unico']."'>".$row_users['nombre']."</a></td>
				<td>".$row_users['apellido1']."</td></tr>";
			$i = $i +1; 
		}
		echo "</table>"; 
		echo "<br>Personas diferentes: <b>".$i."</b>"; 
		echo "<br>&nbsp;"; 


		include "cerrar_conexion.php";
		echo "</table>\n</div>\n</center>\n</span>";
*/
	}  // Fin if isset 'actividad'


?>
