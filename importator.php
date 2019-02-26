<?php

/*
ESTE PROGRAMA IMPORTA DATOS DE LA TABLA auxiliar SOBRE LAS FECHAS DE INICIO Y FINAL DE LOS DIFERENTES SERVICIOS.
LOS INSERTA EN LA TABLA alta_baja CORRESPONDIENTEMENTE. 
*/

/*


include "clases/class.leer_mysqli.php"; 
include "config.php"; 

$servicios = $AUX->servicio; 
$datos = array(
		'1'=> array(	'fi_centroDia'=>'2012-05-06', 'ff_centroDia'=>'2012-05-07',
				'fi_santutxu'=>'2012-06-07', 'ff_santutxu'=>'0000-00-00',	
				'fi_berrisar'=>'2012-07-06', 'ff_berrisar'=>'2012-07-10'
			),
		'2'=> array(	'fi_centroDia'=>'2012-09-06', 'ff_centroDia'=>'0000-00-00',
				'fi_santutxu'=>'2012-11-06', 'ff_santutxu'=>'2012-11-20',	
				'fi_berrisar'=>'2012-12-06', 'ff_berrisar'=>'0000-00-00'
			)
	);

$db = new Leer_Mysqli();
$result = $db->lista_query("SELECT * FROM auxiliar"); 
// $db->escribe(); 


// Abrir mysqli, consultaQuery
// Para cada registro, 
foreach ($result as $persona) {
	echo "<p>&nbsp;</p>Id_unico: ".$persona['id_unico']." - ".$persona['nombre']." ".$persona['apellido1'];
	$id_unico = $persona['id_unico']; 
	//  Recoger con mysqli una persona, con $id_unico
	foreach ($servicios as $key => $serv) {
//		$array_pers = $datos[$id_unico];

		if ($persona['fi_'.$key] != '0000-00-00') {
			if ($persona['ff_'.$key] != "0000-00-00") {
				$alta_baja = 'x';
				$fecha_correl = $persona['ff_'.$key];
				$fecha = $persona['fi_'.$key];
			} else {
				$alta_baja = 'a';
				$fecha = $persona['fi_'.$key];
				$fecha_correl = "";
			}
			$ms = $persona['ms_'.$key]; 
			$autor = $persona['tutor']; 	
//			echo "<br>Servicio: ".$key."; Alta-baja: ".$alta_baja."; Fecha: ".$fecha."; Fecha Correl.: ".$fecha_correl; 
			$query = "INSERT INTO alta_baja (id_unico, servicio, alta_baja, fecha, fecha_correl, motivo_baja, autor_inserc) "; 
			$query .= "VALUES (".$id_unico.", '".$key."', '".$alta_baja."', '".$fecha."', '".$fecha_correl."', '".$ms."', '".$autor."');"; 
			echo "<br>".$query;
			$db->pregunta_query($query); 
		}
	
	}
	
}

$db->cerrar_conexion();
*/
?>
