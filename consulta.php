<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();


function desplegable_multiple() {
	$campos_bd=$_SESSION['campos_bd'];	// $campos_basedatos se define en include/inicializa.php

	$r = 0;
	echo "<b>Escoge las opciones que quieres ver:</b>\n<br>Ten pulsado Ctrl mientras pinchas con el ratón.<br><br>\n";
	echo "<form action='datos_escogidos.php' method='POST'>";
	echo "<select name='datos[]' size='30' MULTIPLE>\n"; 
	foreach ($campos_bd as $campo => $it) {
		echo "campo: ".$campo." y it: ".$it."<br>";
		echo "<option value='".$campo."'>".$it[0]."</option>\n";
	}
	echo "</select><br><br>";
	echo "<input type='submit' name='opciones' value='Enviar'>\n";
//	echo "<br><input type='hidden' name='datos' value='".$datos."'>\n";
	echo "</form>"; 
}



function seleccion_inicial() {
	define( '_VALID_MOS' , 1);	
	echo "<form action=".$_SERVER['PHP_SELF']." method='POST' name='principal'>\n<br>";
	echo "<b>Escoge qué información necesitas: </b><br><br>\n";
//	echo "<input type='radio' name='seleccion' value='1'>Lista con datos escogidos - todavía solo permite unas pocas opciones<br>\n";
	echo "<input type='radio' name='seleccion' value='2'>Activos a día de hoy en cada área<br>\n";
	echo "<input type='radio' name='seleccion' value='3'>Ver datos desagregados de usuarios/as en un intervalo y un recurso dado<br>\n";
	echo "<input type='radio' name='seleccion' value='4'>Ver lista del centro de día<br>\n";
	echo "<input type='radio' name='seleccion' value='6'>Listas de tiempo libre<br>\n";
	echo "<input type='radio' name='seleccion' value='9'>Medias de indicadores en un determinado intervalo de tiempo<br>\n";	
//	echo "<input type='radio' name='seleccion' value='7'>Listas de Aranzazu<br>\n";
	echo "<b>Actividades: </b><br>\n"; 
	echo "<input type='radio' name='seleccion' value='5'>Estadísticas generales de las actividades<br>\n";
	echo "<input type='radio' name='seleccion' value='8'>Datos sobre actividades específicas<br>\n";	
	echo "<br><input type='submit' name='s_principal' value='Continuar'>\n";
//	echo "<br><input type='hidden' name='valor' value=".$_POST['valor'].">\n";
	echo "</form>\n";
}


/************************************************************  
*	Aquí empieza el programa principal
*
*/

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

/*
// Si se ha escogido ya en el desplegable múltiple, se reenvían los datos a otra página para que los procese
if (isset($_POST['opciones']))  {
	$dat_array = $_POST['datos'];
	$_SESSION['dat_array'] = $dat_array;
	header("Location: http://".$host.$uri."/santutxu.php");
} else {
*/
// Si se ha pasado por la selección inicial, se ejecuta la funcion correspondiente
	if (isset($_POST['seleccion'])) {	
		$sel=$_POST['seleccion'];
		switch ($sel) {
			case 0:
				seleccion_inicial();
				break;
			case 1:
				desplegable_multiple();
				break;
			case 2:
				header("Location: http://".$host.$uri."/areas.php");
				break;
			case 3:
				header("Location: http://".$host.$uri."/resultados.php");
				break;
			case 4:
				header("Location: http://".$host.$uri."/lista_centro_dia.php");
				break;
			case 5:
				header("Location: http://".$host.$uri."/listas_por_actividad.php");
				break;
			case 6:
				header("Location: http://".$host.$uri."/include/tiempo_libre.php");
				break;
			case 7:
				header("Location: http://".$host.$uri."/include/listas_aranzazu.php");
				break;
			case 8:
				header("Location: http://".$host.$uri."/include/consulta_actividades.php");
				break;
			case 9:
				header("Location: http://".$host.$uri."/indicadoresleer.php");
				break;				
		}
	} else  {	
		seleccion_inicial();
	}
/*
}
*/
?>
