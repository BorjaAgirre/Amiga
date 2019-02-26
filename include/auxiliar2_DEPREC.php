<?php
/**
 * Creación de la tabla auxiliar, tabla que contiene los datos actualizados a fecha de hoy, 
 * y que calcula quiénes están activos.
 *
 */



/** Función que saca una 'fotografía' de las personas usuarias en una determinada fecha; crea una tabla nueva para ello.
 *  
 * 
 */
function fotografia_auxiliar($nombre_tabla, $fecha_comparar, $fecha_final){
	$ver_nombres = $GLOBALS["ver_nombres"];
	$conexion = $GLOBALS["conexion"];
	global $servicio; 

	// Crea la tabla 
	$query = "CREATE TABLE ".$nombre_tabla." like persona;";     
	$result=mysql_query($query, $conexion); 

	// Crea las variables $fecha_comp y $fecha_fin
	if ($fecha_comparar == "hoy") {
		$fecha_comp="CURDATE()";
	}  else $fecha_comp="'".$fecha_comparar."'";

	if ( $fecha_final == "hoy" ) {
		$fecha_fin="CURDATE()";
	} elseif ( $fecha_final == "" ) {
		$fecha_fin = "";
	} else {
		 $fecha_fin="'".$fecha_final."'"; 
	}

//	printf( "<br>En fotografia auxiliar, Fecha comp es: ".$fecha_comp." y fecha fin es: ".$fecha_fin);    //////////////////////////////////////

	// Lista de todos los id_unico
	$query = "SELECT DISTINCT(id_unico) FROM persona ORDER BY id_unico"; 
	$result=mysql_query($query, $conexion); 
	
//	echo "<br>Fecha ini: ".$fecha_comp." y fecha fin: ".$fecha_fin;  /////////////////////////////////////////////
	$i=0;
	while($row=mysql_fetch_array($result,MYSQL_BOTH)){
		
		// Averigua el id_pers de un determinado usuario justo anterior o igual a $fecha_comp
		$query_pr = "SELECT max(id_pers) as id_pers FROM persona WHERE id_unico = ".$row[0]." 
			AND insert_fecha = (select max(insert_fecha) FROM persona 
			WHERE id_unico = ".$row[0]." AND insert_fecha <= ".$fecha_comp.")";
		$result_pr = mysql_query($query_pr, $conexion); 
		$row_pr = mysql_fetch_array($result_pr, MYSQL_BOTH);
//		echo "<br><b>Usuario: ".$row[0]."</b><br> -id_pers: ".$row_pr['id_pers']."\t";   //////////////////////////////////////////////

		// Inserta en la tabla '$nombre_tabla' el registro escogido en las líneas anteriores
		$query_ins = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona 
			WHERE id_pers= ".$row_pr['id_pers'];
		$result_ins=mysql_query($query_ins, $conexion); 
//		$row_ins=mysql_fetch_array($result_ins,MYSQL_BOTH);

		// Si hay una fecha fin, se escogerán además otros id_pers, los que lleguen hasta fecha_fin
		if ($fecha_fin <> "") {
			$query_fin = "SELECT id_pers FROM persona WHERE id_unico = ".$row[0]." 
					AND insert_fecha > ".$fecha_comp." AND insert_fecha <= ".$fecha_fin."";
//			echo "<br>query: ".$query_fin;		/////////////////////////////////////////////////////////////////
			$result_fin = mysql_query($query_fin, $conexion); 

			while($row_fin = mysql_fetch_array($result_fin, MYSQL_BOTH)) {
//				echo "<br>id_unico: ".$row[0]."<br>";		//////////////////////////////////////////////////////////
//				echo "<pre>"; print_r($row_fin); echo "</pre>"; /////////////////////////////////////////////////////
		
				// Inserta en '$nombre_tabla' todos los registros de los id_pers obtenidos
				$query_ins = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona 
					WHERE id_pers= ".$row_fin['id_pers'];
				$result_ins=mysql_query($query_ins, $conexion); 
//				echo "<br> -id_pers: ".$row_fin['id_pers']." - ";  ///////////////////////////////////////////////////////

//				$row_ins=mysql_fetch_array($result_ins,MYSQL_BOTH);	
			}
		}
	}
}


/** Función que destruye las tablas creadas en mysql para realizar las 'fotografías' en determinadas fechas  */
function destruye_copia($nombre_tabla) {
	$query = "DROP TABLE ".$nombre_tabla.";"; 
	$conexion = $GLOBALS["conexion"];
	$result=mysql_query($query, $conexion);	
}

	$servicio=array("centroDia","berrisar","protegido",
			"santutxu","hiritar","prisionValores",
			"prisionEntrev","parteHartzen","document",
			"acompSocial","fol","seguimiento", "trabsoc");
/*   PARA HACER PRUEBAS
include "conexion.php";
echo "Empezando"; 
destruye_copia("copia_prueba"); 
fotografia_auxiliar("copia_prueba", "2010-01-01", "2010-12-31");

include "cerrar_conexion.php"; 

*/
?>
