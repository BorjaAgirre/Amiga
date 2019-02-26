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
include_once "include/array_a_tabla.php";


$insert_id_usuario=$_COOKIE['id_usuario'];
$insert_fecha=date("Y/m/d");
$prueba = false; 

//$sesionindic = $_POST;
$sesionindic = 1;

if ($prueba) {
	echo $sesionindic;
}

?>

<html>
<body>
	<h2></h2>

<?php


$db = new Leer_Mysqli(); 

// Tratamiento de las fechas introducidas
// $fechasql=fecha_txt_sql($indicadores['fecha']);

$fechaini = "2019-01-01";
$fechafin = "2019-12-31";

echo "<h2>Calculado entre ".fecha_sql_txt($fechaini)." y ".fecha_sql_txt($fechafin)."</h2>";
echo "<em>(Todavia no hay un formulario para cambiar las fechas; hablar con Borja)</em>";

$arrayindicadores = $db->calculaMediaIndicadores($fechaini, $fechafin);

escribeTabla("Medias de los indicadores", array("id", "nombre", "media"), $arrayindicadores);


$db->cerrar_conexion();




?>

</body>
</html>
