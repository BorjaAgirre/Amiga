<?php 
session_start();
include("login.class.php");
$login=new login();
$login->inicia();


function serializar($array) {
	$array = serialize($array); 
	$array = urlencode($array); 
	return $array;
}

include "include/array_a_tabla.php"; 
include "include/leer_datos.php"; 


$area = "centroDia";
$titulo_area = "Centro de día";

// Lee los datos que se le piden de la base de datos y los vuelca en $array
$tabla = "auxiliar";
$items = array("nombre", "apellido1", "apellido2", "come_lu", "come_ma", "come_mi", "come_ju", "come_vi", "tl_sabado", "tl_domingo", "come_sa_notas", "creditrans", "PenalTbc");
$condicion = "activo_centroDia = 1"; 
$orden = "id_unico";
$array = leer_datos($tabla, $items, $condicion, $orden);

//  Transformar el array para quitar los ceros y cambiar los unos por X

$i=0; 
foreach ($array as $persona) {
	$j=0;
	foreach ($persona as $valor) {
		$array2[$i][$j] = $valor; 
		if ($valor == "1") $array2[$i][$j] = "X"; 
		elseif ($valor == "0") $array2[$i][$j] = ""; 
		$j++;
	}
	$i++;
}




// Cabecera de activos a día de hoy
echo "<h1>Centro de día</h1><br>";

// Imprime la tabla partiendo de $array
$atributos_tabla = array("width"=>"100%", "border"=>"1");
$atributos_titulo = array("bgcolor"=>"#336699");
$atributos_linea = array("bgcolor"=>"#COCOCO");
$titulos = array("NOMBRE", "APELLIDO", "APELLIDO 2", "LU", "MA", "MI", "JU", "VI", "SAB", "DOM","NOTAS", "CTRANS", "TBC");
tabla( $titulos, $array2, $atributos_tabla, $atributos_titulo, $atributos_linea);

// Hay que serializar para transformar las tablas
$ser_array = serializar($array2); 
$ser_titulos = serializar($titulos); 

// Botones para pdf y excel
echo "<form action='include/array_excel_pdf.php' method = 'POST'>"; 
echo "<input type = 'hidden' name = 'array_pasa' value = '".$ser_array."'>"; 
echo "<input type = 'hidden' name = 'cabeceras' value = '".$ser_titulos."'>";
echo "<input type = 'hidden' name = 'item' value = 'centroDia'>";
echo "<input type = 'hidden' name = 'titulo' value = 'Lista actual Centro de día'>";
echo "<br><input type='submit' name='tabla_excel' value='Crear Excel' >";
echo "&nbsp; &nbsp; <input type='submit' name='tabla_pdf' value='Crear Pdf' >";
echo "</form>"; 


?>
