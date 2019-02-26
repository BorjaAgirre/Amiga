<?php
/*session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();*/
include("clases/class.leer_mysqli.php");
$debug = 0; 

require_once('pdf/class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('pdf/fonts/Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$id_unico=$_GET['id_unico'];

/*
include "conexion.php";
$result=mysql_query("SELECT fecha, comentario FROM comentario WHERE id_unico=$id_unico ORDER BY fecha", $conexion); 
$result2=mysql_query("SELECT nombre, apellido1 FROM persona WHERE id_unico=$id_unico", $conexion);
*/

$db = new Leer_Mysqli(); 
$result = $db->leer_comentarios_pdf($id_unico);

$comentarios = $result[0];
$nomb = $result[1];

if ($debug > 0) { echo "COMENTARIOS: <pre>"; print_r($comentarios); echo "</pre>"; }
if ($debug > 0) { echo "NOMBRE: <pre>"; print_r($nomb); echo "</pre>"; }

$nombre=$nomb[0]['nombre'];
$apellido1=$nomb[0]['apellido1'];
if ($debug > 0) { echo "<br>nombre: ".$nombre." - apellido: ".$apellido1; }

foreach ($comentarios as $com) {
    if ($debug > 0) { echo "<br>".$com['comentario']; }
    if ($com['comentario'] != '') { $data[] = array('fecha' => $com['fecha'], 'comentario' => $com['comentario']); }
}
    if ($debug == -1) { echo "DATA<pre>"; print_r($data); echo "</pre>";  }

$titles = array(
                'fecha'=>'<b>Fecha</b>',
                'comentario'=>'<b>Comentario</b>'
            );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            );
			
$txttit = "<b>Centro de día Hazkuntza</b>   Ficha de acogida y seguimiento \n";
$txttit2= "<b>".$nombre." ".$apellido1."</b>\n\n";
 
$pdf->ezText($txttit, 12);
$pdf->ezText($txttit2, 18);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezStream();

?>	
