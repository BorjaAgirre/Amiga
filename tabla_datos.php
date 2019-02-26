<?php


$atributos_tabla = array("width"=>"100%", "border"=>"1");
$atributos_linea = array("bgcolor"=>"#336699");

$tabla = "auxiliar";
$items = array("nombre", "apellido1", "apellido2", "id_pers", "activo_general");
$titulos = array("Nombre", "Apellido", "Apellido2", "Id Pers", "Activo");

$condicion = array("activo_santutxu", "1"); 
$orden = "apellido1";

include "include/tablas.php"; 
tabla($atributos_tabla, $atributos_linea, $tabla, $titulos, $items, $condicion, $orden);


?>
