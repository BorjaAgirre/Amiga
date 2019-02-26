<?php


function escribeTabla($titulo, $cabeceras, $array_tabla, $item = 'x') {	

	global $n;
	global $debug; 

	$ancho = 50 + ($n * 20);
	$ancho_s = "".$ancho."%";
	$atributos_tabla = array("width"=>$ancho_s, "border"=>"1");
	$atributos_titulo = array("bgcolor"=>"#66BB99");
	$atributos_linea = array("bgcolor"=>"#COCOCO");
	echo "<h1>".$titulo."</h1>";
	tabla($cabeceras, $array_tabla, $atributos_tabla, $atributos_titulo, $atributos_linea);
	/*
	$array_tabla = serializar($array_tabla);
	$cabeceras = serializar($cabeceras);

	echo "<form action='include/array_excel_pdf.php' method = 'POST'>"; 
	echo "<input type = 'hidden' name = 'array_pasa' value = '".$array_tabla."'>"; 
	echo "<input type = 'hidden' name = 'cabeceras' value = '".$cabeceras."'>";
	if ($item != 'x') echo "<input type = 'hidden' name = 'item' value = '".$item."'>";
	echo "<br><input type='submit' name='tabla_excel' value='Crear Excel' >";
	echo "&nbsp; &nbsp; <input type='submit' name='tabla_pdf' value='Crear Pdf' >";
	echo "</form>"; 
//	crea_csv("tabla", $array_tabla); 
*/

}


function tabla($titulos, $array, $atributos_tabla, $atributos_titulo, $atributos_linea)  {

	require_once("HTML/Table.php");
	echo "Datos";	
	$table = new HTML_Table($atributos_tabla);
	$table->addRow($titulos, $atributos_titulo, "TH");
	foreach ($array as $linea) {
	        $table->addRow($linea, $atributos_linea);
	}

	$table->updateRowAttributes(1, "color=red");
	$table->display();

}

?>
