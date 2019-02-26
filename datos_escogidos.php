<?php 
session_start();
include("login.class.php");
$login=new login();
$login->inicia();


if (isset($_POST['datos'])) {
	include "include/array_desplegable.php"; 

	/*
		echo "datos escogidos<br><pre>";
		print_r($poblaciones);
		echo "</pre>"; 
	*/
	
	include "include/array_a_tabla.php"; 
	include "include/leer_datos.php"; 
	
	$datos_escog = $_POST['datos']; 
	
	$r = 0;
	foreach($datos_escog as $dat) {
		$items[$r] = $dat;
		$titulos[$r++] = $_SESSION['campos_bd'][$dat][0];
	}
	
	
	// Lee los datos que se le piden de la base de datos y los vuelca en $array
	$tabla = "auxiliar";
	$condicion = ""; 
	$orden = "";
	$array = leer_datos($tabla, $items, $condicion, $orden);
	
	// Cabecera de activos a día de hoy
	echo "<h1>".$area."</h1><br>";
	echo "<h2>Activos a día de hoy</h2><br>";
	
	// Imprime la tabla partiendo de $array
	$atributos_tabla = array("width"=>"100%", "border"=>"1");
	$atributos_titulo = array("bgcolor"=>"#336699");
	$atributos_linea = array("bgcolor"=>"#COCOCO");
	tabla( $titulos, $array, $atributos_tabla, $atributos_titulo, $atributos_linea);
}

//include "cerrar_conexion.php"; 
?>
