<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();


include "include/fechas.php"; 
include_once "clases/class.leer_mysqli.php";
include_once "headers.php";
$pagina = "alertas"; 
header_principal("alertas", array('menu' => false, 'pest' => false));

$debug = false; 


function escribeAlerta($alerta) {
	echo "<div class='unaalerta'>";
	echo "<h3>".date('d-m-Y', strtotime($alerta['alerta'])).": ".$alerta['nombre']." ".$alerta['apellido1']." ".$alerta['apellido2']."</h3>";	
	echo $alerta['comentario']; 
	echo "</div>"; 
}


function escribeAlertas($alertas) {
	echo "<div id='alerta' >";

	echo "<h2>ALERTAS de los próximos 4 días para ".$_SESSION['nombreusuario'].":</h2>";

	foreach ($alertas as $alerta) {
		escribeAlerta($alerta);  
	}
	echo "<a href='seguimiento.php' class='button'>Continuar</a>";
	echo "</div>";	
}


/* Obtiene la fecha de hoy  */
$today = date('Y-m-d');
if ($debug) $today = "2019-09-02";
$fechaposterior =  date('Y-m-d',strtotime($today."+ 4 days"));

/*  Lee las alertas de hoy para el tutor activo  */
$dbic = new Leer_Mysqli(); 
$alertas = $dbic->lee_alertas($today, $fechaposterior, $_SESSION['idusuario']); 
if ($debug) {
	echo "Fecha a buscar: ".$today; 
	echo "<br>Alertas: <br>";
	echo "<pre>"; print_r($alertas); echo "</pre>"; 

}	 

/*  Si las hay, escribe las alertas; caso contrario, continúa con seguimiento.   */
if (!empty($alertas)) {
	escribeAlertas($alertas);
} else {
	header( "Location: seguimiento.php" );
}


