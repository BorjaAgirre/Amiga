<?php

include "include/fechas.php"; 
include_once "clases/class.leer_mysqli.php";
include_once "headers.php";
$pagina = "alertas"; 
header_principal("alertas");

$debug = false; 

	$dbic = new Leer_Mysqli(); 
	$today = date('Y-m-d');
	if ($debug) $today = "2019-09-02";
	$alertas = $dbic->lee_alertas($today, 1); 
	if ($debug) {
		echo "Fecha a buscar: ".$today; 
		echo "<br>Alertas: <br>";
		echo "<pre>"; print_r($alertas); echo "</pre>"; 

	}	 
	if (empty($alertas)) {
		header( "Location: seguimiento.php" );
	} else {
		echo "<div id='alerta' style='color: #A80808'>";
		echo "<h2>ALERTA</h2>";

		foreach ($alertas as $alerta) {
			echo "<br>".$alerta['nombre']." ".$alerta['apellido1']." ".$alerta['apellido2']; 			
			echo "<br>".$alerta['comentario']; 
		}
		echo "</div>";
		echo "<a href='seguimiento.php'>Continuar...</a>";
	}


