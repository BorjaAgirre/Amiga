<?php

function crea_csv($nombre, $array) {
	// Grabar archivo

	$nombre = $nombre.".csv";
	$fp = fopen($nombre, 'w');

	foreach ($array as $fields) {
	    fputcsv($fp, $fields);
	}

	fclose($fp);
}
?>
