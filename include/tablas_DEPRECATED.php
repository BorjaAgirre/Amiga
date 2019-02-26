<?php
/* La he puesto como deprecated porque parece ser que la que se usa es include/array_a_tabla.php
*  Al menos así es en resultados.php
*/



function tabla($atributos_tabla, $atributos_linea, $tabla, $titulos, $items, $condicion, $orden)  {

	include "conexion.php";

	$i=0;
	$query = "SELECT ";
	foreach ($items as $it) {
		if ($i++ != 0) $query .= ", ";
		$query .= $it;
	}
	$query .= " FROM ".$tabla;
//	if ($condicion != "") $query .= " WHERE ". $condicion[0]." = ".$condicion[1];
	if ($condicion != "") $query .= " WHERE ". $condicion;
	if ($orden != "") $query .= " ORDER BY ".$orden;

	$result=mysql_query($query, $conexion);    

	require_once("HTML/Table.php");
	
	$attributes = $atributos_tabla;
	
	$table = new HTML_Table($attributes);
	
	$contents = $titulos;
	$attributes = $atributos_linea;
	$table->addRow($contents, $attributes, "TH");
	
	$attributes = array("bgcolor"=>"#COCOCO");
	
	while($row = mysql_fetch_array($result,MYSQL_BOTH)) {
		$j=0;
		foreach ($items as $it) {
	        	$contents[$j++] = $row[$it];
		}
	        $table->addRow($contents, $attributes);
	}
	
	$table->display();
	
	include "cerrar_conexion.php";
}

?>
