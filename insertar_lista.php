<?
$fecha=date("Y/m/d");
$fecha2=date("d/m/Y");
include_once "clases/class.leer_mysqli.php";

$db = new Leer_Mysqli(); 
foreach($_REQUEST as $dato){ 
	
	if ($dato>0)
	{
	$db->pregunta_query(
	"INSERT INTO lista
	(fecha,
	id_pers)
	
	VALUES (
	'$fecha',
	'$dato')
	");
	}
}  

echo "<script language='javascript' type='text/javascript'>
alert('Lista de asistencias del día ".$fecha2." actualizada');
</script>";
?>
