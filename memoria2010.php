<?php 


include "include/array_a_tabla.php"; 
include "include/leer_datos.php"; 


// Lee los datos que se le piden de la base de datos y los vuelca en $array

// Cabecera de activos a día de hoy
echo "<h2>Activos a día de hoy</h2><br>";

// Imprime la tabla partiendo de $array
$atributos_tabla = array("width"=>"100%", "border"=>"1");
$atributos_titulo = array("bgcolor"=>"#336699");
$atributos_linea = array("bgcolor"=>"#COCOCO");
$titulos = array("Nombre", "Apellido", "Apellido2", "Id Pers", "Activo");
$tabla = "auxiliar";
$items = array("nombre", "apellido1", "apellido2", "id_pers", "activo_general");
$condicion = "activo_centroDia = 1"; 
$orden = "apellido1";
$array = leer_datos($tabla, $items, $condicion, $orden);

tabla( $titulos, $array, $atributos_tabla, $atributos_titulo, $atributos_linea);

include "include/array_a_csv.php";
crea_csv("archivo", $array);

?>
