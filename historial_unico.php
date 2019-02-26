<?php
	
/*
*   Esta función saca un array con una  lista de los registros de una determinada persona
*/
function historial_unico($id_unico) {
	include "conexion.php";
	$query = "SELECT * FROM persona WHERE id_unico = '".$id_unico."' ";
	$result=mysql_query($query, $conexion);
	$i = 0;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) { 			
		$array_fin[$i++] = $row; 
	}
	include "cerrar_conexion.php";
	return $array_fin; 
}



/*****************************************
*
*   PROGRAMA PRINCIPAL 
*
******************************************/


include "include/array_a_tabla.php"; 
$array_fin = historial_unico(2027);

//  Dibujar tabla 

echo "<table border='1'>"; 
echo "\n<tr>"; 
foreach ($array_fin[0] as $key => $valor) {
	echo "\n<th>";
	echo $key; 
	echo "</th>";
}
echo "</tr>";

foreach ($array_fin as $row) {
	echo "\n<tr>";
	foreach ($row as $item) {
		echo "\n<td>";
		echo $item; 
		echo "</td>";
	}
	echo "</tr>"; 
}
echo "</table>";




/*
$atributos_tabla = array("border"=>"1");
$atributos_titulo = array("bgcolor"=>"#336699");
$atributos_linea = array("bgcolor"=>"#COCOCO");

tabla($array_fin[0], $array_fin, $atributos_tabla, $atributos_titulo, $atributos_linea)
*/
?>
