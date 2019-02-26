<?php

	include "include/fechas.php";
	$identificador = $_GET['identificador'];
	$id_unico = $_GET['id_unico'];
	echo "<h2>- historial - </h2>";

	include "conexion.php"; 

	$query_tabla="SELECT DISTINCT (".$identificador."),insert_fecha FROM persona WHERE id_unico=".$id_unico." GROUP BY ".$identificador;
	$resulthist=mysql_query($query_tabla, $conexion);
	echo $conexion3; 
	echo "<table>";
	echo "<tr><td>Item</td><td>Fecha</td></tr>"; 
	while($rowhist=mysql_fetch_row($resulthist))	{
		echo "<tr>";
		echo "<td><b>".$rowhist[0].'</b></td><td><i>('.fecha_sql_txt($rowhist[1]).')</i></td>';
		echo "</tr>";
	}
	echo "</table>";
	include "cerrar_conexion.php";
?>
