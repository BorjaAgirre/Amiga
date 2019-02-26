<?php

require_once('pdf/class.ezpdf.php');
include "include/fechas.php"; 
include "conexion.php";
include_once "clases/class.leer_mysqli.php"; 

$pdf =& new Cezpdf('a4');
$pdf->selectFont('pdf/fonts/Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);


//  Comprueba si llega un 'load'
if (isset($_GET['load']))  {
	$load_activ=$_GET['load'];
}
		
$db = new Leer_Mysqli(); 
$result = $db->pregunta_query("SELECT * FROM actividad WHERE id_activ=".$load_activ); 
$activ = $result->fetch_array(MYSQLI_BOTH); 

// $result=mysql_query("SELECT * FROM actividad WHERE id_activ=".$load_activ, $conexion); 
// $totEmp = mysql_num_rows($result);
// $activ=mysql_fetch_array($result,MYSQL_BOTH);
$id_act = $activ['tipo_activ'];

$result_tipo = $db->pregunta_query("SELECT nombre_actividad FROM lista_actividades WHERE id_listaactividad = ".$id_act); 
// $totEmp_tipo = mysql_num_rows($result_tipo);
$tipo_activ = $result_tipo->fetch_array(MYSQLI_BOTH);
// echo "<pre>"; print_r($tipo_activ); echo "</pre>"; 

$result_com = $db->pregunta_query("SELECT per.id_unico, CONCAT(per.nombre,' ',per.apellido1) AS nombre, com.comentario FROM comentario AS com INNER JOIN persona AS per ON com.id_unico=per.id_unico WHERE historial = 'actual' AND com.id_actividad = ".$load_activ); 
//$totEmp_com = mysql_num_rows($result_com);
//$coment=mysql_fetch_assoc($result_com);
//$data[] = array_merge($coment);


$ixx = 0;
while($coment = $result_com->fetch_array(MYSQLI_BOTH)) {
    $ixx = $ixx+1;
    $data[] = array_merge($coment);
}

$titles = array(
                'nombre'=>'<b>Nombre</b>',
                'comentario'=>'<b>Comentario</b>'
            );
$options = array(
                'shadeCol'=>array(0.9,0.8,0.8),
                'xOrientation'=>'center',
                'width'=>500,
		'fontSize'=>8
            );
			
$txttit = "<b>ACTIVIDAD: </b>";
$txttit.= $tipo_activ['nombre_actividad']."\n";
$txttit.= "<b>FECHA: </b>";
$txttit.= fecha_sql_txt($activ['fecha_actividad'])."\n\n";

$txttit.= "<b>Descripción:</b>\n";
$txttit.= $activ['comentario_actividad']."\n\n";

$txttit.= "<b>Observaciones:</b>\n";
$txttit.= $activ['observaciones_actividad']."\n\n";

//$txttit=utf8_decode($txttit); 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("Fecha del documento ".date("d/m/Y"), 8);
$pdf->ezText("Hora del documento: ".date("H:i:s")."\n\n", 8);
$pdf->ezStream();
/*
include "cerrar_conexion.php"; */
?>	
