<?php

/** 
*
*   DEPRECATED
*	GUARDO ESTE ARCHIVO POR DOS RAZONES: 
*	1- PORQUE resultados.php y resultados2.php LO SIGUEN UTILIZANDO
*	2- PORQUE SE PUEDE APROVECHAR LA function fotografia_ingreso PARA INCRUSTARLA EN auxiliar.php
*
* Función que saca una 'fotografía' de las personas usuarias en una determinada fecha; crea una tabla nueva para ello.  
*/
function fotografia($nombre_tabla, $fecha_comparar, $activos){
	$ver_nombres = $GLOBALS["ver_nombres"];
	$conexion = $GLOBALS["conexion"];
	$query = "CREATE TABLE ".$nombre_tabla." like persona;";     
	$result=mysql_query($query, $conexion); 
	if ($fecha_comparar=="") $fecha_comp="CURDATE()";
		else $fecha_comp="'".$fecha_comparar."'"; 
	if ($activos) {
		$and_activo = " AND (".$fecha_comp."<=fecha_salida OR fecha_salida='0000-00-00' OR fecha_salida='2000-00-00') ";
	} else {
		$and_activo = ""; 
	}

	$query = "SELECT DISTINCT(id_unico) FROM persona ORDER BY id_unico"; 
	$result=mysql_query($query, $conexion); 
		$i=0;
		while($row=mysql_fetch_array($result,MYSQL_BOTH)){
			$query2 = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona WHERE id_unico=".$row[0].$and_activo." 
			AND  insert_fecha= (SELECT max(insert_fecha) FROM persona WHERE insert_fecha <= ".$fecha_comp." 
			AND id_unico=".$row[0]." GROUP BY id_unico) ORDER BY id_pers DESC LIMIT 1";

/*			echo "<br>".$query2;			*/
			$result2=mysql_query($query2, $conexion); 
			$row2=mysql_fetch_array($result2,MYSQL_BOTH);
			if ($row2["id_pers"] != "") {
				echo "<br>\n".$row[0]." - ".$row2["id_pers"]." - ".$row2["nombre"]." - ".$row2["apellido1"]." - ".$row2["nucleo_conv"];	
			}
		}

}



/** Función que saca una 'fotografía' de las personas usuarias el día de su ingreso en el centro; crea una tabla nueva para ello.  
	Saca todos los usuarios/as, independientemente de que estén activos, etc. 
	Es necesario que coincidan bien los datos: debe haber un insert_fecha que coincida con su fecha de ingreso*/
function fotografia_ingreso($nombre_tabla){
	$ver_nombres = $GLOBALS["ver_nombres"];
	$conexion = $GLOBALS["conexion"];
	$query = "CREATE TABLE ".$nombre_tabla." like persona;";     
	$result=mysql_query($query, $conexion); 
	$query = "SELECT DISTINCT(id_unico) FROM persona ORDER BY id_unico"; 
	$result=mysql_query($query, $conexion); 
		$i=0;
		while($row=mysql_fetch_array($result,MYSQL_BOTH)){
			$query2 = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona WHERE id_unico=".$row[0]." 
			AND  insert_fecha= fecha_ingreso		
			ORDER BY id_pers DESC LIMIT 1";
			
/*			echo "<br>".$query2;			*/
			$result2=mysql_query($query2, $conexion); 
			$row2=mysql_fetch_array($result2,MYSQL_BOTH);
			if ($row2["id_pers"] != "") {
				echo "<br>\n".$row[0]." - ".$row2["id_pers"]." - ".$row2["nombre"]." - ".$row2["apellido1"]." - ".$row2["nucleo_conv"];
				echo " - ".$row2["fecha_ingreso"]." - ".$row2["insert_fecha"];  
				$i++;
			}
		}
}



/** Función que destruye las tablas creadas en mysql para realizar las 'fotografías' en determinadas fechas  */
function destruye_copia($nombre_tabla) {
	$query = "DROP TABLE ".$nombre_tabla.";"; 
	$conexion = $GLOBALS["conexion"];
	$result=mysql_query($query, $conexion);	
}

?>
