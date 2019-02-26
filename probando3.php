<?php



include "clases/class.leer_mysqli.php";



$datos = new Leer_Mysqli(); 
//$datos->activos('2012-02-01', '2012-04-01', 'centroDia', '35', false);
//$datos->escribe(); 
//$datos->activos('2012-02-01', '2012-04-01', 'centroDia', '34');
//$datos->escribe(); 
//
//$datos->activos('2012-01-01', '2012-04-01', 'berrisar', 0, false);
//$datos->escribe(); 
//$datos->activos('2012-01-01', '2012-04-01', 'berrisar');
//$datos->escribe(); 
//
//$datos->activos('2012-01-01', '2012-04-01', '0', '37', false);
//$datos->escribe(); 
//$datos->activos('2012-01-01', '2012-04-01', '0', '34');
//$datos->escribe(); 

//$datos->activos('2012-01-01', '2012-04-01',0,0,false);
//$datos->escribe(); 
//$datos->activos('2012-01-01', '2012-04-01');
//$datos->escribe(); 
$datos->inserta_alta_baja("bla"); 
$datos->cerrar_conexion();

?>
