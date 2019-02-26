<?php
/**
 * Creación de la tabla auxiliar, tabla que contiene los datos actualizados a fecha de hoy, 
 * y que calcula quiénes están activos.
 *
 */



/** Función que marca en la tabla auxiliar quiénes están activos en un determinado servicio.
*   Utilizaremos los campos 'fi_servicio' y 'ff_servicio' de la persona, que nos indican fecha de inicio y final en el servicio
*   Llama un UPDATE que se ejecuta en toda la tabla a la vez desde MySql, sin hacer ningún bucle en php
*   Este UPDATE marca a 1 el campo 'activo_servicio' (sustituir 'servicio' por el contenido de $servicio)
*   cuando la fecha a comparar 'fecha_comp' está entre fi_servicio y ff_servicio, es decir, la persona está en activo en ese servicio. 
*   También hace lo mismo con intervalos, haciendo un OR entre la fecha inicial y final (puede estar activa al principio o al final)
*   
*   NOTA: por ahora, exactamente copiado de auxiliar.php
 */
function marca_activo($servicio, $nombre_tabla, $fecha_comp, $fecha_fin)  {
	$conexion = $GLOBALS["conexion"];

	// Para un determinado $servicio, hace el cambio en toda la tabla
	$query = "UPDATE ".$nombre_tabla." 
		SET activo_".$servicio." = ( 
		((".$fecha_comp." >= fi_".$servicio." AND fi_".$servicio."<>'0000-00-00')
		 AND (".$fecha_comp." < ff_".$servicio." OR ff_".$servicio."='0000-00-00' OR ff_".$servicio."='2000-00-00'))";

	// Esta parte se añade cuando hay fecha_fin, para intervalos. 
	if ( $fecha_fin <> "") {    
		$query .= "OR
		((".$fecha_fin.">=fi_".$servicio." AND fi_".$servicio."<>'0000-00-00')
		 AND (".$fecha_fin."<ff_".$servicio." OR ff_".$servicio."='0000-00-00' OR ff_".$servicio."='2000-00-00'))";
	}
	$query .= ");";		
//	echo "query marca_activo: ".$query;

	$result=mysql_query($query, $conexion); 

	// Para intervalos: 
	// Hay que comprobar que el usuario no haya comenzado después de fecha_comp y terminado antes de fecha_fin
	// con lo cual el UPDATE anterior no habrá detectado que esa persona ha estado activa en el servicio en ese periodo
	if ( $fecha_fin <> "" )  {
		// Buscamos los id_pers de la persona en ese intervalo y comprobamos si en alguno de ellos se daría positivo 
		// y para ello revisamos en la tabla persona si hay comienzos o finales de uso del servicio en ese plazo de tiempo
		$query2 = "UPDATE ".$nombre_tabla." 
			SET activo_".$servicio." = 1 WHERE activo_".$servicio." = 0 
			AND (fi_".$servicio." BETWEEN ".$fecha_comp." AND ".$fecha_fin."
			OR ff_".$servicio." BETWEEN ".$fecha_comp." AND ".$fecha_fin.")"; 

		$result2 = mysql_query($query2, $conexion); 
	}
}





/** 
 *  Función que saca una 'fotografía' de las personas usuarias en una determinada fecha y para determinado servicio
 *  Crea varias tablas nuevas para ello.
 *  TODO: No está aún preparado para el caso de $servicio = 'general'
 */
function fotografia_auxiliar($nombre_tabla, $fecha_comparar, $fecha_final, $servicio){
	$debug_log = -1; 		// Si es 0 o mayor, aparecen mensajes para debug
	$ver_nombres = $GLOBALS["ver_nombres"];
	$conexion = $GLOBALS["conexion"];
	global $servicio; 

	// Crea la tabla general
	$query = "CREATE TABLE ".$nombre_tabla." like persona;";     
	$result=mysql_query($query, $conexion); 

	// Crea la tabla servicio
	$query = "CREATE TABLE ".$nombre_tabla."_serv like persona;";     
	$result=mysql_query($query, $conexion); 

	// Crea la tabla max
	$query = "CREATE TABLE ".$nombre_tabla."_max like persona;";     
	$result=mysql_query($query, $conexion); 

	// Crea la tabla min
	$query = "CREATE TABLE ".$nombre_tabla."_min like persona;";     
	$result=mysql_query($query, $conexion); 

	// Crea las variables $fecha_comp y $fecha_fin
	if ($debug_log >= 0) {
		if ($debug_log >= 0) {
			printf( "<br>ANTES: En fotografia auxiliar, Fecha comparar es: ".$fecha_comparar.
				" y fecha final es: ".$fecha_final);   // Error log
		}
	}
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
	if ($debug_log >= 0) {
		if ($debug_log >= 0) {
			printf( "<br>DESPUES: En fotografia auxiliar, Fecha comp es: ".$fecha_comp." y fecha fin es: ".$fecha_fin);   // Error log
		}
	}


	// 
	// Bucle con todos los id_unico que haya
	//
	$query = "SELECT DISTINCT(id_unico) FROM persona ORDER BY id_unico"; 
	$result=mysql_query($query, $conexion); 
	
	if ($debug_log >= 0) {
		echo "<br>Fecha ini: ".$fecha_comp." y fecha fin: ".$fecha_fin;  // Error log
	}

	$i=0;
	while($row=mysql_fetch_array($result,MYSQL_BOTH)){
		
		// Averigua el id_pers de un determinado usuario justo anterior o igual a $fecha_comp
		$query_pr = "SELECT max(id_pers) as id_pers FROM persona WHERE id_unico = ".$row[0]." 
			AND insert_fecha = (select max(insert_fecha) FROM persona 
			WHERE id_unico = ".$row[0]." AND insert_fecha <= ".$fecha_comp.")";

		if ($debug_log >= 0) {
			echo "<br>query_pr: ".$query_pr;		// Error log
		}

		$result_pr = mysql_query($query_pr, $conexion); 
		$row_pr = mysql_fetch_array($result_pr, MYSQL_BOTH);
		if ($debug_log >= 0) {
			echo "<br><b>Usuario: ".$row[0]."</b><br> -id_pers: ".$row_pr['id_pers']."\t";   // Error log
		}

		// Inserta en la tabla '$nombre_tabla' el registro escogido en las líneas anteriores
		$query_ins = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona 
			WHERE id_pers= ".$row_pr['id_pers'];
		$result_ins=mysql_query($query_ins, $conexion); 
			// $row_ins=mysql_fetch_array($result_ins,MYSQL_BOTH);

		// Si hay una fecha fin, se escogerán además otros id_pers, los que lleguen hasta fecha_fin
		if ($fecha_fin <> "") {
/*			if ($servicio == 'hiritar') {   ////////////////////    ARREGLO PROVISIONAL
				$query_fin = "SELECT id_pers FROM persona WHERE id_unico = ".$row[0]." 
						AND insert_fecha > ".$fecha_comp." AND insert_fecha <= ".$fecha_fin."
						AND ff_hiritar > '2011-01-01'";
			} else {
*/				$query_fin = "SELECT id_pers FROM persona WHERE id_unico = ".$row[0]." 
						AND insert_fecha > ".$fecha_comp." AND insert_fecha <= ".$fecha_fin."";
//			}
			if ($debug_log >= 0) {
				echo "<br>query_fin: ".$query_fin;		// Error log
			}

			$result_fin = mysql_query($query_fin, $conexion); 

			while($row_fin = mysql_fetch_array($result_fin, MYSQL_BOTH)) {
				if ($debug_log >= 0) {
					echo "<br>id_unico: ".$row[0]."<br>";		// Error log
					echo "<pre>"; print_r($row_fin); echo "</pre>"; // Error log
				}
		
				// Inserta en '$nombre_tabla' todos los registros de los id_pers obtenidos
				$query_ins = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona 
					WHERE id_pers= ".$row_fin['id_pers'];
				$result_ins=mysql_query($query_ins, $conexion); 
				if ($debug_log >= 0) {
					echo "<br> -id_pers: ".$row_fin['id_pers']." - ";  // Error log
				}

					// $row_ins=mysql_fetch_array($result_ins,MYSQL_BOTH);	
			}
		}
	}


	/******************************************************************************
	* Para un determinado servicio, pone los indicadores 'activo' que corresponden
	*   - es necesario hacer esto para que solamente sean válidos los registros que están dentro del intervalo
	*   - hay que tener en cuenta que la tabla auxiliar contiene registros (normalmente uno) anteriores al intervalo pedido
	******************************************************************************/

	// Pone a cero el indicador de 'activo' de la nueva tabla en determinado servicio
	$query_cero="UPDATE ".$nombre_tabla." SET activo_".$servicio."= 0";
	$result=mysql_query($query_cero, $conexion); 
//	echo "query cero: ".$query_cero; 

	// Para un determinado $servicio, hace el cambio en toda la tabla
	marca_activo($servicio, $nombre_tabla, $fecha_comp, $fecha_fin);


	/******************************************
	* Creación de la tabla auxiliar servicio (ej.:  copia_1_serv) 
	*   - se trata de una tabla en la que solo aparecen los que estan activos en determinado servicio
	*   - puede haber varios registros por cada persona
	******************************************/
	$query_pers = "SELECT id_unico FROM ".$nombre_tabla." GROUP BY id_unico ORDER BY id_unico"; 
	$result_pers=mysql_query($query_pers, $conexion); 
	while($row_pers = mysql_fetch_array($result_pers, MYSQL_BOTH)) {
		$query_serv = "INSERT INTO ".$nombre_tabla."_serv (SELECT * FROM ".$nombre_tabla." 
				WHERE id_unico = ".$row_pers['id_unico']." AND activo_".$servicio." = 1)";	
		$result_serv = mysql_query($query_serv, $conexion); 
//	echo "<br>query serv: ".$query_serv;	
	}



	/***************************************************
	* Creación de las tablas auxiliares máxima y mínima  (ej.: copia_1_max y copia_1_min) 
	*  - de todos los valores encontrados por cada persona (id_unico), se escoge el valor máximo o mínimo
	*  - un sólo registro por persona
	****************************************************/
	if ($fecha_fin <> "") {
		$query_pers2 = "SELECT DISTINCT(id_unico) as id_unico FROM ".$nombre_tabla."_serv ORDER BY id_unico"; 
		$result_pers2=mysql_query($query_pers2, $conexion); 
//		echo "<br>query pers2: ".$query_pers2; 

		while($row_pers2 = mysql_fetch_array($result_pers2, MYSQL_BOTH)) {
			$query_max = "INSERT INTO ".$nombre_tabla."_max (SELECT * FROM ".$nombre_tabla."_serv 
				WHERE id_unico = ".$row_pers2['id_unico']." AND insert_fecha =  
				(SELECT max(insert_fecha) FROM ".$nombre_tabla."_serv WHERE id_unico = ".$row_pers2['id_unico'].") 
				ORDER BY id_pers DESC LIMIT 1)";
			$result_max = mysql_query($query_max, $conexion); 

			$query_min = "INSERT INTO ".$nombre_tabla."_min (SELECT * FROM ".$nombre_tabla."_serv 
				WHERE id_unico = ".$row_pers2['id_unico']." AND insert_fecha = 
				(SELECT min(insert_fecha) FROM ".$nombre_tabla."_serv WHERE id_unico = ".$row_pers2['id_unico'].") 
				ORDER BY id_pers ASC LIMIT 1)";
			$result_min = mysql_query($query_min, $conexion); 
//		echo "<br>query min: ".$query_max; 
		}
	}
	if ($debug_log >= 0) {
		echo "<br>query: ".$query_fin;		// Error log
	}
}


/*
* Función que destruye las tablas creadas en mysql para realizar las 'fotografías' en determinadas fechas  
*/
function destruye_copia($nombre_tabla) {

	$conexion = $GLOBALS["conexion"];

	$query = "DROP TABLE ".$nombre_tabla.";"; 
	$result=mysql_query($query, $conexion);	

	$query = "DROP TABLE ".$nombre_tabla."_serv;"; 
	$result=mysql_query($query, $conexion);	

	$query = "DROP TABLE ".$nombre_tabla."_max;"; 
	$result=mysql_query($query, $conexion);	

	$query = "DROP TABLE ".$nombre_tabla."_min;"; 
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
