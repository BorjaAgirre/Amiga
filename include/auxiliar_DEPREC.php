<?php
/**
 * Creación de la tabla auxiliar, tabla que contiene los datos actualizados a fecha de hoy, 
 * y que calcula quiénes están activos.
 *
 */

$prueba_aux = false; 





/** Función que marca en la tabla auxiliar quiénes están activos en un determinado servicio.
*   Utilizaremos los campos 'fi_servicio' y 'ff_servicio' de la persona, que nos indican fecha de inicio y final en el servicio
*   Llama un UPDATE que se ejecuta en toda la tabla a la vez desde MySql, sin hacer ningún bucle en php
*   Este UPDATE marca a 1 el campo 'activo_servicio' (sustituir 'servicio' por el contenido de $servicio)
*   cuando la fecha a comparar 'fecha_comp' está entre fi_servicio y ff_servicio, es decir, la persona está en activo en ese servicio. 
*   También hace lo mismo con intervalos, haciendo un OR entre la fecha inicial y final (puede estar activa al principio o al final)
*   
*   NOTA: EXISTE UNA COPIA EN auxiliar3.php.  Tenerlo en cuenta si se cambia aquí. 
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



/*   GUARDO TEMPORALMENTE LA ANTERIOR COPIA DE marca_activo, POR SI HUBIERA ALGÚN FALLO, PERO PARECE SER QUE NO ES NECESARIO
	EN LA NUEVA HE ELIMINADO LAS REFERENCIAS A LA TABLA persona, QUE NO SON NECESARIAS PORQUE 
	LAS VARIABLES CITADAS ESTÁN YA COPIADAS EN LA TABLA copia_1
function marca_activo($servicio, $nombre_tabla, $fecha_comp, $fecha_fin)  {
	$conexion = $GLOBALS["conexion"];

	// Para un determinado $servicio, hace el cambio en toda la tabla
	$query = "UPDATE ".$nombre_tabla." c LEFT JOIN persona p ON p.id_pers = c.id_pers
		SET c.activo_".$servicio." = ( 
		((".$fecha_comp." >= p.fi_".$servicio." AND p.fi_".$servicio."<>'0000-00-00')
		 AND (".$fecha_comp." < p.ff_".$servicio." OR p.ff_".$servicio."='0000-00-00' OR p.ff_".$servicio."='2000-00-00'))";

	// Esta parte se añade cuando hay fecha_fin, para intervalos. 
	if ( $fecha_fin <> "") {    
		$query .= "OR
		((".$fecha_fin.">=p.fi_".$servicio." AND p.fi_".$servicio."<>'0000-00-00')
		 AND (".$fecha_fin."<p.ff_".$servicio." OR p.ff_".$servicio."='0000-00-00' OR p.ff_".$servicio."='2000-00-00'))";
	}
	$query .= ");";		
	$result=mysql_query($query, $conexion); 
	// Para intervalos: 
	// Hay que comprobar que el usuario no haya comenzado después de fecha_comp y terminado antes de fecha_fin
	// con lo cual el UPDATE anterior no habrá detectado que esa persona ha estado activa en el servicio en ese periodo
	if ( $fecha_fin <> "" )  {
		
		// Buscamos los id_pers de la persona en ese intervalo y comprobamos si en alguno de ellos se daría positivo 
		// y para ello revisamos en la tabla persona si hay comienzos o finales de uso del servicio en ese plazo de tiempo
		$query2 = "UPDATE ".$nombre_tabla." c LEFT JOIN persona p ON p.id_pers = c.id_pers 
			SET c.activo_".$servicio." = 1 WHERE c.activo_".$servicio." = 0 
			AND (p.fi_".$servicio." BETWEEN ".$fecha_comp." AND ".$fecha_fin."
			OR p.ff_".$servicio." BETWEEN ".$fecha_comp." AND ".$fecha_fin.")"; 

		$result2 = mysql_query($query2, $conexion); 
	}
}
*/



/** 
 *  Función que saca una 'fotografía' de las personas usuarias en una determinada fecha; crea una tabla nueva para ello.
 * 
 */
function fotografia_auxiliar($nombre_tabla, $fecha_comparar, $fecha_final){
	$ver_nombres = $GLOBALS["ver_nombres"];
	$conexion = $GLOBALS["conexion"];
	global $servicio, $prueba_aux; 

	$servicio=array("centroDia","berrisar","protegido",	// Si se cambia, hay una copia en la siguiente funcion
			"santutxu","hiritar","prisionValores",
			"prisionEntrev","parteHartzen","document",
			"acompSocial","fol","seguimiento", "trabsoc");

	// Crea la tabla (o la sustituye) con el nombre dado (ej: auxiliar, copia...) 
	$query = "CREATE TABLE ".$nombre_tabla." like persona;";     
	$result=mysql_query($query, $conexion); 

	// Dispone fecha_comparar
	if ($fecha_comparar == "hoy") {
		$fecha_comp="CURDATE()";
	}  else $fecha_comp="'".$fecha_comparar."'";

	// Dispone fecha_final
	if ( $fecha_final == "hoy" ) {
		$fecha_fin="CURDATE()";
	} elseif ( $fecha_final == "" ) {
		$fecha_fin = "";
	} else {
		 $fecha_fin="'".$fecha_final."'"; 
	}


	// 
	// Bucle con todos los id_unico que haya
	//
	$query = "SELECT DISTINCT(id_unico) FROM persona ORDER BY id_unico"; 
	$maximo = "pers";    // Habitualmente utilizamos el máximo id_pers (y no el máximo insert_fecha)
	$result=mysql_query($query, $conexion); 
		$i=0;

		while($row=mysql_fetch_array($result,MYSQL_BOTH)){

			// Este es el código en el caso de que se quiera seleccionar según el máximo (insert_fecha) y no el máximo (id_pers)
			// Normalmente en desuso.
			if ($maximo == "fecha") {
				$query2 = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona WHERE id_unico=".$row[0]." 
				AND  insert_fecha= (SELECT max(insert_fecha) FROM persona WHERE id_unico=".$row[0].") 
				LIMIT 1";      
			}
			if ($prueba_aux) { echo "<br>".$query2; }

			// Se selecciona el registro correspondiente al máximo id_pers (de la tabla 'persona') y se copia en la nueva tabla
			if ($maximo == "pers") {
				$query2 = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona WHERE id_unico=".$row[0]." 
				AND  id_pers= (SELECT max(id_pers) FROM persona WHERE id_unico=".$row[0].") 
				LIMIT 1";
			}

			$result2=mysql_query($query2, $conexion); 
			$row2=mysql_fetch_array($result2,MYSQL_BOTH);
		}


	// Pone a cero todos los indicadores de 'activo' de la nueva tabla
	$query_cero="UPDATE ".$nombre_tabla." SET activo_general=0,
			activo_centroDia = 0,
			activo_berrisar = 0,
			activo_protegido = 0,
			activo_santutxu = 0,
			activo_hiritar = 0,
			activo_prisionValores = 0,
			activo_prisionEntrev = 0,
			activo_parteHartzen = 0,
			activo_document = 0,
			activo_acompSocial = 0,
			activo_fol = 0,
			activo_seguimiento = 0,
			activo_trabsoc = 0
			)";
	$result=mysql_query($query_cero, $conexion); 


	// Bucle de todos los servicios: marca el servicio como 1 cuando están activos
	foreach ($servicio as $serv) {
		marca_activo($serv, $nombre_tabla, $fecha_comp, $fecha_fin);
	}


	// Pone el activo_general a 1 cuando hay alguno de los activos_servicio a 1
	$query_activo="UPDATE ".$nombre_tabla." SET activo_general=(
			activo_centroDia OR
			activo_berrisar OR
			activo_protegido OR
			activo_santutxu OR
			activo_hiritar OR
			activo_prisionValores OR
			activo_prisionEntrev OR
			activo_parteHartzen OR
			activo_document OR
			activo_acompSocial OR
			activo_fol OR
			activo_seguimiento OR
			activo_trabsoc
			)";
	$result=mysql_query($query_activo, $conexion); 
}



/** Función que saca una 'fotografía' de las personas usuarias en una determinada fecha; crea una tabla nueva para ello.
 *  
 * 
 */
function intervalo_auxiliar($nombre_tabla, $fecha_inicial, $fecha_final){
	$ver_nombres = $GLOBALS["ver_nombres"];
	$conexion = $GLOBALS["conexion"];
	global $servicio; 

	$servicio=array("centroDia","berrisar","protegido",
			"santutxu","hiritar","prisionValores",
			"prisionEntrev","parteHartzen","document",
			"acompSocial","fol","seguimiento", "trabsoc");

	$query = "CREATE TABLE ".$nombre_tabla." like persona;";     
	$result=mysql_query($query, $conexion); 
	if ( $fecha_inicial == "" ) $fecha_ini = "CURDATE()";
		else $fecha_ini = "'".$fecha_inicial."'";
	if ( $fecha_final == "" ) $fecha_fin = "CURDATE()";
		else $fecha_fin = "'".$fecha_final."'";  

	$query = "SELECT DISTINCT(id_unico) FROM persona ORDER BY id_unico"; 
	$result=mysql_query($query, $conexion); 
		$i=0;
		while($row=mysql_fetch_array($result,MYSQL_BOTH)){

			$query_in = "INSERT INTO ".$nombre_tabla." SELECT * FROM persona WHERE id_unico=".$row[0]." 
			AND  id_pers= (SELECT max(id_pers) FROM persona WHERE id_unico=".$row[0].") 
			LIMIT 1";

/*			echo "<br>".$query2;			*/

			$result_int=mysql_query($query_int, $conexion); 
			$row2=mysql_fetch_array($result_int,MYSQL_BOTH);
		}

	$query_cero="UPDATE ".$nombre_tabla." SET activo_general=0,
			activo_centroDia = 0,
			activo_berrisar = 0,
			activo_protegido = 0,
			activo_santutxu = 0,
			activo_hiritar = 0,
			activo_prisionValores = 0,
			activo_prisionEntrev = 0,
			activo_parteHartzen = 0,
			activo_document = 0,
			activo_acompSocial = 0,
			activo_fol = 0,
			activo_seguimiento = 0,
			activo_trabsoc = 0
			)";
	$result=mysql_query($query_cero, $conexion); 

	foreach ($servicio as $serv) {
		marca_activo($serv, $nombre_tabla, $fecha_ini, $fecha_fin);
	}

	$query_activo="UPDATE ".$nombre_tabla." SET activo_general=(
			activo_centroDia OR
			activo_berrisar OR
			activo_protegido OR
			activo_santutxu OR
			activo_hiritar OR
			activo_prisionValores OR
			activo_prisionEntrev OR
			activo_parteHartzen OR
			activo_document OR
			activo_acompSocial OR
			activo_fol OR
			activo_seguimiento OR
			activo_trabsoc
			)";
	$result=mysql_query($query_activo, $conexion); 
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


?>
