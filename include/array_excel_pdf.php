<?php
function unserializar ($array) {
	$array = stripslashes($array); 
	$array = urldecode($array); 
	$array = unserialize($array); 
	return $array; 
}
require_once('../pdf/class.ezpdf.php');

	$array = $_POST['array_pasa'];
	$array = unserializar ($array);
	$cabeceras = $_POST['cabeceras'];
	$item = $_POST['item'];
	$titulo = $_POST['titulo'];
	$cabeceras = unserializar ($cabeceras);

	if (isset($_POST['tabla_excel'])) {
		header('Content-type: application/vnd.ms-excel');
		$header_xls = "Content-Disposition: attachment; filename = '".$item.".xls'";
		header($header_xls);
		header("Pragma: no-cache");
		header("Expires: 0");
		foreach ($array as $linea) {
			foreach ($linea as $dato) {
				echo $dato.",";
			}
			echo "\n"; 	
		}

	/*
		include_once "array_a_tabla.php"; 
	
		$atributos_tabla = array("width"=>"100%", "border"=>"1");
		$atributos_titulo = array("bgcolor"=>"#336699");
		$atributos_linea = array("bgcolor"=>"#ffffff");
	
		tabla($cabeceras, $array, $atributos_tabla, $atributos_titulo, $atributos_linea); 
*/
	} elseif (isset($_POST['tabla_pdf'])) {
		$pdf =& new Cezpdf('a4');
		$pdf->selectFont('../pdf/fonts/Courier.afm');
		$pdf->ezSetCmMargins(1,1,1.5,1.5);
	
		$options = array(
	                'shadeCol'=>array(0.9,0.9,0.9),
	                'xOrientation'=>'center',
	                'width'=>500
	            );
	
		$txt = $titulo."\n"; 
		$pdf->ezText($txt, 18);
		$pdf->ezTable($array, $cabeceras, '', $options);
		$pdf->ezStream();
	}
?>
