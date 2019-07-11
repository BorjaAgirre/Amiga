<?php

function fecha_txt_sql($fecha){ 
	if (strpos($fecha, "/")) $separ = "/"; 
	if (strpos($fecha, "-")) $separ = "-"; 
		$fechasal = explode($separ, $fecha); 
		if (($fechasal[1] == "00") || ($fecha == ""))   // Casos en que es 2000-00-00,  0000-00-00  o no fecha
			return ""; 

		$fechaanno = $fechasal[2] + 2000;
		$fechames = $fechasal[1];
		$fechadia = $fechasal[0];
		if ($fechasal[2]<100 && $fechasal[1]<100 && $fechasal[0]<100)	{	// Dos cifras por elemento
			if ($fechasal[2] > 25) {
				$fechaanno=1900+$fechasal[2];
			} 
		} 
		elseif ($fechasal[2] > 100) {      // Tercer elemento con más cifras (año)
			$fechaanno = $fechasal[2];
		}
		elseif ($fechasal[0] > 100) {	// Primer elemento con más cifras (año); fecha en euskera o mysql
			$fechaanno = $fechasal[0];
			$fechadia = $fechasal[2];
		}
		$fecharet= $fechaanno."-".$fechames."-".$fechadia; 

	return $fecharet; 
} 

function fecha_sql_txt($fecha) {
	$fechasal = explode("-",$fecha);  
	if (($fechasal[1] == "00") || ($fecha == "")) {   // Contempla los casos en que es 2000-00-00,  0000-00-00  o no hay ninguna fecha
		$fecharet = ""; 
	} else {
		$fecharet= $fechasal[2]."/".$fechasal[1]."/".$fechasal[0]; 
	}
	return $fecharet; 
}
?>
