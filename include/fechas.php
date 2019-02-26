<?php

function fecha_txt_sql($fecha){ 
	if (strpos($fecha, "/")) $separ = "/"; 
	if (strpos($fecha, "-")) $separ = "-"; 
		$fechasal = explode($separ, $fecha); 
		if (($fechasal[1] == "00") || ($fecha == ""))     // Contempla los casos en que es 2000-00-00,  0000-00-00  o no fecha
			return ""; 
		if ($fechasal[2]<100 && $fechasal[1]<100 && $fechasal[0]<100)	{	
			if ($fechasal[2]<20) {
				$fechasal[2]=$fechasal[2]+2000;
			} else {
				$fechasal[2]=1900+$fechasal[2];
			}
		}
		$fecharet= $fechasal[2]."-".$fechasal[1]."-".$fechasal[0]; 

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
