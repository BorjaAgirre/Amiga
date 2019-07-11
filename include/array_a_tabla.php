<?php
/*

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
*/


function display() {
	echo "OK";
}



function displayTable($titulo, $cabeceras, $rows, $item = 'x')  {
 	echo "<p>&nbsp;</p>";
 	echo "<h3>".$titulo."</h3>";
	 $disp = '<table class="zebra">';

	 $disp .= displayRowCabecera($cabeceras);
	 foreach ($rows as $tr) 
	 {
 		$disp .= displayRow($tr, false);
	 }
	 $disp .= '</table>';
	 echo $disp;
 }


function displayRow($tr) {
//		 echo "<pre>"; print_r($tr); echo "</pre>"; 
	 	$disp .= '<tr>';
	 	foreach ($tr as $td)
		{
		 	$disp .= '<td>' . $td . '</td>';
		}
 		$disp .= '</tr>';
 		return $disp;
	}

function displayRowCabecera($tr) {
//		 echo "<pre>"; print_r($tr); echo "</pre>"; 
	 	$disp .= '<tr>';
	 	foreach ($tr as $td)
		{
		 	$disp .= '<th>' . $td . '</th>';
		}
 		$disp .= '</tr>';
 		return $disp;
	}

?>
