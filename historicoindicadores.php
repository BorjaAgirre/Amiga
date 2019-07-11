<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();

include_once "include/imprime.php";
include_once "include/fechas.php";
include_once "headers.php";
header_principal("indicadores");
$pagina = "indicadores"; 
$debug = false; 

include_once "clases/class.leer_mysqli.php"; 


		//echo "<br><h2>HOLA soy Borja, estoy haciendo cambios en el programa, en unos minutos vuelven a aparecer los datos. </h2>";
		$db = new Leer_Mysqli(); 

		/*   Si al cargar la web se ha seleccionado un usuario, se carga con los datos    */

		$id_unico = ""; 

		if ((isset($_GET['load'])) || (isset($_SESSION['load'])) )
		{
			if (isset($_SESSION['load'])) $id_unico=$_SESSION['load'];
			if (isset($_GET['load'])) $id_unico=$_GET['load'];

			if ($id_unico != 0) {
				//include_once  "include/funciones_buscar.php";
				$maxid = $db->maxid($id_unico); 
				$result = $db->persona_idpers($maxid); 
				$row = $result->fetch_array(MYSQLI_BOTH); 
				$id_pers = $maxid;	
				$_SESSION['load']=$id_unico;
			}
		}
		
		
		if (isset($_GET['delete']))
		{
			$deleteid=$_GET["delete"];

			$datos = new Leer_Mysqli(); 
			$result = $datos->pregunta_query("DELETE FROM persona WHERE id_pers=".$deleteid); 
			$datos->cerrar_conexion(); 
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=persona.php'>";

//			Cambiado a Mysqli; dejo las anteriores líneas temporalmente por si hay errores
//			include "conexion.php";
//			$result=mysql_query("DELETE FROM persona WHERE id_pers=$deleteid", $conexion);
//			include "cerrar_conexion.php";
		}

		
		?>
		
	<script language="Javascript">
		function opcion()  {
 			ventana=confirm("Se va a proceder a borrar a esta persona de la bases de datos. Esta acción no se puede deshacer. ¿ESTÁS SEGURO?");
			if (ventana) {
				alert("El registro ha sido borrado");
			} else {
				alert("No se ha borrado el registro");             
			}                                   
		}
		function validar() {
		}
	</script>
		



		<div id="completa">

<?php

			$db = new Leer_Mysqli();



			$fecha= date("d/m/Y");

			echo "<div class='indic_titulo'>";
			echo "HISTÓRICO DE INDICADORES";
			echo "</div><div class='indic_titulo'>";
			echo "<br>Nombre: <strong> &nbsp; &nbsp;".$row['nombre']." ".$row['apellido1']."  ".$row['apellido2'].
						"</strong>\n";
			echo "</div>";

			echo "<form name='historico'  autocomplete='off' id='persona' enctype='multipart/form-data' action='indicadoresguardar.php' method='post'>\n";

			echo "<div class='indic_titulo'>\n";
			echo "</div>";

			echo "<p><h4>1=Nada  2=Algo  3=Bastante  4=Mucho  5=Totalmente </h4></p> ";
			
			


			$tabla = $db->tabla_indicadores();
		
			$sesionespersona = $db->lee_sesiones($id_unico); 

			echo "<table id='historicoindicadores'>"; 

			foreach ($sesionespersona as $sesionindicadores) {
				$idsesion = $sesionindicadores['sesion'];
				$fechasesion = $sesionindicadores['fecha'];
				$arrayindicadores[$idsesion]['array'] = $db->lee_indicadores($idsesion);
				$arrayindicadores[$idsesion]['fecha'] = $fechasesion;
			}

			if ($debug) {echo "<pre>"; print_r($arrayindicadores); echo "</pre>";}

			echo "<tr><th></th>";
			foreach ($arrayindicadores as $indicadoresfecha) {
				echo "<th class='textovertical'>\n";			
				echo fecha_sql_txt($indicadoresfecha['fecha']);
				echo "</th>\n";
			}			
			echo "</tr>";

			foreach ($tabla as $id_indic => $array_indic) {
				echo "<tr>"; 
					echo "<td>".$id_indic." - ".$array_indic["nombre"];
					echo "</td>\n";
					foreach ($arrayindicadores as $indicadoresfecha) {
						echo "<td>\n";			
						echo $indicadoresfecha['array'][$id_indic];
						echo "</td>\n";
					}
				echo "</tr>\n";
			}
			
			echo "</table>";
			echo "<p>&nbsp;</p>";
			echo "<input type='hidden' name='id_unico' value='".$id_unico."'>";
			echo "<button type='submit'  value='submit'>Enviar</button>";
			echo "<p>&nbsp;</p>";
			echo "</form>\n";

		echo "</div>\n";
		echo "</body>\n</html>";
?>

