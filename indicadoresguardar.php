<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();

include_once "clases/class.leer_mysqli.php";
include "include/fechas.php"; 
include_once "headers.php";
header_principal("indicadores"); 
$pagina = "indicadores"; 
include_once "menu_lateral.php";
include_once "include/imprime.php"; 


$insert_id_usuario=$_COOKIE['id_usuario'];
$insert_fecha=date("Y/m/d");
$prueba = false; 

$indicadores = $_POST;

if ($prueba) {
	print('<pre>');
	print_r($indicadores);
	print('</pre>');
}

?>

<html>
<body>
	<h2>Datos guardados correctamente</h2>

<?php


$db = new Leer_Mysqli(); 

// Tratamiento de las fechas introducidas
$fechasql=fecha_txt_sql($indicadores['fecha']);


foreach ($indicadores as $key => $value) {
	if (substr($key, 0, 8) === 'element_') {
		$num_indic = substr($key, 8);
//		if ($prueba) echo "<br>Indicador detectado - ".$num_indic;

		$array_elements[$num_indic] = $value;
	}
}

$lastid = $db->guarda_indicadores($indicadores['id_unico'], $fechasql, $array_elements);

$db->cerrar_conexion();




?>

</body>
</html>
