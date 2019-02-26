<?php 
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();


function serializar($array) {
	$array = serialize($array); 
	$array = urlencode($array); 
	return $array;
}
include_once "headers.php";
include_once "config.php"; 
$servicio_array = $AUX->servicio; 
header_principal("resultados"); 

/*
$areas[0]= array("centroDia", "Centro de día");
$areas[1]= array("santutxu", "Piso Santutxu");
$areas[2]= array("berrisar", "Piso Berrisar");
$areas[3]= array("protegido", "Pisos protegidos");
$areas[4]= array("hiritar", "Piso Hiritar");
$areas[5]= array("prisionValores", "Taller valores prisión");
$areas[6]= array("prisionEntrev", "Entrevistas prisión");
$areas[7]= array("parteHartzen", "Campo de trabajo 'Parte Hartzen'");
$areas[8]= array("document", "Documentación");
$areas[9]= array("acompSocial", "Acompañamiento social");
$areas[10]= array("fol", "Fol");
$areas[11]= array("seguimiento", "Seguimiento");
$areas[12]= array("trabsoc", "Trab. Social");
$areas[13]= array("itb", "ITB");
*/
	echo "<p>&nbsp;<p>"; 
	echo "<b>Escoge el área que quieres ver:</b>\n<br>\n";
	echo "<form action=". $_SERVER['PHP_SELF']. " method='POST'>";
	echo "<select name='area'>\n"; 
	$i = 0;
	foreach ($servicio_array as $key => $serv) {
		echo "<option value='".$key."'>".$serv."</option>\n";
	}
	echo "</select><br><br>";
	echo "<input type='submit' name='opciones' value='Enviar'>\n";
//	echo "<br><input type='hidden' name='pal_magica' value=".$_POST['pal_magica'].">\n";
	echo "</form>"; 

if (isset($_POST['area'])) {

	include "include/array_a_tabla.php"; 
	include_once "clases/class.leer_mysqli.php";
	include "include/leer_datos.php"; 
	$db = new Leer_Mysqli(); 

	$items = array("nombre", "apellido1", "apellido2", "id_unico");

	$fecha_hoy = date("Y-m-d"); 

	$cod_area = $_POST['area'];

	$titulo_area = $servicio_array[$cod_area];
	$arg['servicio'] = $cod_area;
	$arg['fecha_ini'] = $fecha_hoy;
	$arg['fecha_fin'] = $fecha_hoy; 
	//$arg['fecha_ini'] = "2013-07-01";
	//$arg['fecha_fin'] = "2013-12-31"; 
	$arg['no_repite'] = false; 
	$arg['persona'] = true; 

	// Lee los datos que se le piden de la base de datos y los vuelca en $array

	$result = $db->activos($arg); 
	$n =0;
	foreach ($result as $row) {
		$array[$n][] = $row['nombre']; 
		$array[$n][] = $row['apellido1']; 
		$array[$n][] = $row['apellido2']; 
		$array[$n][] = $row['id_unico']; 
		$n++;
	}

 	// echo "<br>Array resultante: <pre>"; print_r($array); echo "</pre>"; 

	// Cabecera de activos a día de hoy
	echo "<h1>".$titulo_area."</h1><br>";
	echo "<h2>Activos a día de hoy</h2><br>";

	// Imprime la tabla partiendo de $array
	$atributos_tabla = array("width"=>"100%", "border"=>"1");
	$atributos_titulo = array("bgcolor"=>"#336699");
	$atributos_linea = array("bgcolor"=>"#COCOCO");
	$titulos = array("Nombre", "Apellido", "Apellido2", "Identificador");
	tabla( $titulos, $array, $atributos_tabla, $atributos_titulo, $atributos_linea);

	// Hay que serializar para transformar las tablas
	$ser_array = serializar($array); 
	$ser_titulos = serializar($titulos); 

	// Botones para pdf y excel
	echo "<form action='include/array_excel_pdf.php' method = 'POST'>"; 
	echo "<input type = 'hidden' name = 'array_pasa' value = '".$ser_array."'>"; 
	echo "<input type = 'hidden' name = 'cabeceras' value = '".$ser_titulos."'>";
	echo "<input type = 'hidden' name = 'item' value = '".$area."'>";
	echo "<input type = 'hidden' name = 'titulo' value = 'Lista actual ".$titulo_area."'>";
	echo "<br><input type='submit' name='tabla_excel' value='Crear Excel' >";
	echo "&nbsp; &nbsp; <input type='submit' name='tabla_pdf' value='Crear Pdf' >";
	echo "</form>"; 
/*
	// Cabecera de año $year
	$year = "2013"; 
	echo "<h2>Han pasado en ".$year."</h2><br>";




	// Lee datos con la nueva condición
	$condicion = "activo_".$area." = 1 OR ff_".$area." >= '".$year."-01-01'"; 
	$array = leer_datos($tabla, $items, $condicion, $orden);

	// Imprime la nueva tabla
	tabla($titulos, $array, $atributos_tabla, $atributos_titulo, $atributos_linea);

	// Hay que serializar para transformar las tablas
	$ser_array = serializar($array); 
	$ser_titulos = serializar($titulos); 

	// Botones para pdf y excel
	echo "<form action='include/array_excel_pdf.php' method = 'POST'>"; 
	echo "<input type = 'hidden' name = 'array_pasa' value = '".$ser_array."'>"; 
	echo "<input type = 'hidden' name = 'cabeceras' value = '".$ser_titulos."'>";
	echo "<input type = 'hidden' name = 'item' value = '".$area."'>";
	echo "<input type = 'hidden' name = 'titulo' value = 'Lista año ".$year.": ".$titulo_area."'>";
	echo "<br><input type='submit' name='tabla_excel' value='Crear Excel' >";
	echo "&nbsp; &nbsp; <input type='submit' name='tabla_pdf' value='Crear Pdf' >";
	echo "</form>"; 
*/
}

?>
