<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();


include "include/imprime.php"; 
include "include/fechas.php";
include "headers.php";
header_principal("persona_alta_baja"); 
$pagina = "persona_alta_baja"; 
include "menu_lateral.php";
include "config.php"; 
include "clases/class.registra.php"; 
include_once "clases/class.leer_mysqli.php";

$debug = false; 

//		   Si al cargar la web se ha seleccionado un usuario, se carga con los datos    

		$id_unico = ""; 

//
//  Cambiar por una llamada a la clase de lista_activos, que todavía no existe, que encuentre los activos para un determinado usuario
//

	$db = new Leer_Mysqli(); 

	if ((isset($_GET['load'])) || (isset($_SESSION['load'])) )	{
		if (isset($_SESSION['load'])) $id_unico=$_SESSION['load'];
		if (isset($_GET['load'])) $id_unico=$_GET['load'];
		if ($id_unico != 0) {
			//include_once  "include/funciones_buscar.php";
			$maxid = $db->maxid($id_unico); 

			//include "conexion.php";
			$result = $db->persona_idpers($maxid);
			//include "cerrar_conexion.php";
			$row = $result->fetch_array(MYSQLI_BOTH);
			$id_pers = $maxid;	
			$_SESSION['load']=$id_unico;
		}
	}
	
	
	if (isset($_GET['delete']))	{
		$deleteid=$_GET["delete"];
		include "conexion.php";
		$result=mysql_query("DELETE FROM persona WHERE id_pers=$deleteid", $conexion);
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=persona.php'>";
		include "cerrar_conexion.php";
	}

	/*
	*  Crea un array con los datos recibidos del formulario
	*/
	if (isset($_POST['altabaja'])) {
		if ($debug) { echo "<pre>"; print_r($_POST); echo "</pre>";}
		$array_ab = array(); 
		$reg = new Registra(); 
		foreach ($AUX->servicio as $cod => $key) {
			if ((isset($_POST['alta_'.$cod])) && ($_POST['alta_'.$cod] != "")) {

				$result = $reg->validaFecha($cod, $_POST['alta_'.$cod]);  
				if ($debug) { echo "<br>Result ".$cod."<pre>"; print_r($result); echo "</pre>"; }				
				if ($result['error'] == 0) {
					$actual = new DateTime("now"); 
					$fecha_alta = new DateTime($result['valor']); 
					$intervalo = $actual->diff($fecha_alta);
					$dif_dias = $intervalo->format('%R%a');
					if ($debug) echo "<br>Diferencia: ".$dif_dias; 
					if ($dif_dias > 0) {
						echo "<script>alert('Has cogido un día mayor que la fecha de hoy<br>No es válido')</script>"; 
					} else {
						$array_ab['alta'][$cod] = $result['valor'];
					}
				}
			}

			if ($debug) echo "<br>Alta ejecutada"; 

			if ((isset($_POST['baja_'.$cod])) && ($_POST['baja_'.$cod] != "")) {
				$result = $reg->validaFecha($cod, $_POST['baja_'.$cod]); 
				if ($result['error'] == 0) $array_ab['baja'][$cod] = $result['valor'];
			}
			if (isset($_POST['motivo_'.$cod])) {
				$result = $_POST['motivo_'.$cod]; 
				$array_ab['motivo'][$cod] = $result;
			}
		}

		if ($debug) {
			echo "<br>Array_ab: <pre>"; 
			print_r($array_ab); 
			echo "</pre>";
		}



		$array_error = $reg->array_error; 
		if (count($array_error) == 0) {		// array interna de la clase Registra(), 
			// Si no hay errores en el formulario, procesar datos
			$datos = new Leer_Mysqli();
			$id_usuario=$_SESSION['idusuario'];
			$datos->inserta_alta_baja($array_ab, $id_unico, $id_usuario); 
			$datos->cerrar_conexion(); 
		} else {
			echo "<script>alert('Fecha errónea en el campo señalado en rojo')</script>"; 
		}
	} 



//
//  Dibuja el menú según el array de servicios, que podría contener los datos de css
//


if ((isset($id_unico)) && ($id_unico !='')) {
	$datos = new Leer_Mysqli(); 
	$datos->despleg_motivo = $datos->desplegable("salida");   // definimos
	echo "\n\t<div class='wrapper'>\n\t";
	echo "<form id='alta_baja'  autocomplete='off' name='alta_baja' action='persona_alta_baja.php' method='post' 
			onSubmit='return validaFechaDDMMAAAA()'>\n\t<table>";
	echo "\n\t<tr>\n\t<td></td>\n\t<td><h2>Alta</h2></td>\n\t<td><h2>Baja</h2></td>";
	echo "\n\t<td><h2>Nueva alta</h2></td>\n\t<td><h2>Motivo baja</h2></td>\n\t</tr>";

/*		echo "<br>Array error:<pre>"; 
		print_r($array_error); 
		echo "</pre>";
	
*/
	$result_pers = $datos->leer_persona($id_unico);
	echo "<h2><b>".$result_pers['nombre']." ".$result_pers['apellido1']." ".$result_pers['apellido2']."</b></h2>"; 
	

	echo "\n<script type ='text/javascript' src='jq/js/scripts_historial.js'></script>";

	foreach($AUX->servicio as $cod =>$serv) {
		if ($cod != '0') {  
			$e_error = ($array_error[$cod] != 0) ? true : false ; 
	//		echo "<br>Error en ".$cod." es ".$e_error; 
			$cuadro = $datos->form_altabaja($cod, $id_unico, $e_error); 
	//		$datos->escribe();  //  para debug; recomendable poner debug=true en clases/class.leer_mysqli.php
			$texto_back = (isset($cuadro[99])) ? $cuadro[99] : "";
			echo "\n\t<tr>";
			$url = "popup_altabaja.php"; 
			echo "\n\t<td ".$texto_back."><img src='graficos/punto.jpeg' onclick='javascript:new_window(\"".$url."\");'>&nbsp;".$serv."</td>";
			echo "\n\t<td>".$cuadro[0]."</td>";
			echo "\n\t<td>".$cuadro[1]."</td>";
			echo "\n\t<td>".$cuadro[2]."</td>";
			echo "\n\t<td><div id='despleg'>".$cuadro[3]."</div></td>";
			echo "\n\t</tr>"; 
		}
	}
	echo "\n\t</table>";
	echo "\n\t<input name='altabaja' type='hidden' value='si'>";
//	echo "\n\t<input name='' type='hidden' value=''>";
	echo "\n\t<p>&nbsp;</p><input style='margin-left:40%' name='enviar' type='submit' value='&nbsp;Enviar&nbsp;'>";
	echo "\n\t</form>\n\t</div>\n\t";

}

echo "<br>";

?>
