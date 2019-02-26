<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();




//
// Función para imprimir cada uno de los comentarios
//
function imprimeComentario($insertar, $date, $id_unico_load, $row_comentario){
		$tutores=  $_SESSION['tutores'];
		$hitos=  $_SESSION['hitos'];

		$link = ($insertar) ? "insertar_comentario.php" : "actualizar_comentario.php"; 
		$fecha = (!$insertar) ? fecha_sql_txt($row_comentario['fecha']) : $date;

		// <div>  ,  <table>  y  <style>
		echo "<div id='d_comentario'>";
		echo "\n\n<form name='persona'  autocomplete='off' id='persona' action='";
		echo $link; 
		echo "' method='post'>";
		echo "<table>";
		echo "\n<style type='text/css'></style>";

		//  Fecha
		echo "\n<tr><td>\nFecha: <input type='text' name='fecha' size='12' style='background-color:#AAAAFF;font-weight:bold' value='";
		echo $fecha; 

		// Tutor
				
		$nombretut = $row_comentario['nombre'];
		echo "'><br>&nbsp;\nTutor:\n<select name='tutor'>";
		foreach($tutores as $tut){
			echo "<option value='".$tut["id"]."'";
			$selected = ((($row_comentario["tutor"] == $tut["id"]) && (!$insertar)) || 
					(($_SESSION['idusuario'] == $tut["id"]) && ($insertar))) ? " selected" : "";
			echo $selected;
			echo ">".$tut["nombre"]."</option>";
		}
		echo "</select>";

		// Hito 
		echo  "<br>&nbsp;&nbsp;&nbsp;Hito \n<select name='hito'>";
//		echo "<option value=''>---------</option>";
		foreach($hitos as $hit) {
			echo "<option value='".$hit['id']."'";
			$selected = (($row_comentario['hito'] == $hit['id']) && (!$insertar)) ? " selected" : "";
			echo $selected;
			echo ">".$hit['hito']."</option>";
		}
		echo "</select></td>";

		// Area de texto		
		echo "<td><textarea name='comentario' ROWS=5 COLS=80>";
		if (!$insertar) echo $row_comentario[3];
		echo "</textarea><br>";		
		echo "</td>\n<td>";
			//echo "\n<input type='hidden' name='probando' id='probando' value='probando'>";//////////
		if ($insertar) {
			echo "\n<br><br><td>";
			echo "\n<input type='hidden' name='id_unico' id='id_unico' value='".$id_unico_load."'>";
			echo "\n<input type='image' src='graficos/guarda.png' name='submit' title='Insertar comentario'></td></tr>";		
		} else {
			echo "</td>\n<td>";
			echo "\n<input type='hidden' name='id_coment' id='id_coment' value='".$row_comentario['id_coment']."'>";
/*			echo "\n<input type='hidden' name='id_pers' id='id_pers' value='".$row_comentario[1]."'>";		*/
			echo "\n<input type='hidden' name='id_unico' id='id_unico' value='".$id_unico_load."'>";
	
			if ($row_comentario['tipo_comentario'] == 'a')
			echo "\n<a href='actividad.php?load=".$row_comentario['id_actividad']."'><img height='20px' title='Ir a actividad' src='actividad.gif'></a><br>";
			echo "\n<input type='image' src='graficos/guarda.png' name='submit' title='Actualizar comentario'></td></tr>";
		}

		echo "\n</table>\n</form>";
		echo "\n</div>";   // div d_comentario


}

//
// Includes
//
include_once "include/imprime.php";
include_once "include/fechas.php";
include_once "headers.php";
include_once "clases/class.leer_mysqli.php"; 
//include_once "include/funciones_buscar.php";




//
// COMIENZO DEL CÓDIGO
//

			$db = new Leer_Mysqli();

			//
			// Si se ha seleccionado un usuario, se carga la web con los datos
			//

			if ((isset($_GET['load'])) || (isset($_SESSION['load'])) )
			{

// Pendiente: 
// - poner el include funciones_buscar como funcion
// - poner todo este código en el include (no solo la función) y usarlo también en persona.php
// - cambiar el nombre maxid por id_pers_load
// - ponerlo un poco más elegante, sobre todo en persona.php, el tema de $id_unico  


				if (isset($_SESSION['load'])) 	{
						$id_unico_load=$_SESSION['load'];
//						echo "SESION: ".$id_unico_load;
					}
				if (isset($_GET['load'])) {
						$id_unico_load=$_GET['load'];
//						echo "SESION GET: ".$id_unico_load;
					}




				//
				//  Recoge los datos de la persona a partir de maxid
				//


				// Obtiene maxid, el maximo identificador a partir de un id_unico
				$maxid = $db->maxid($id_unico_load);

				$row_result = $db->lista_query("SELECT * FROM persona WHERE id_pers=".$maxid);
				$row = $row_result[0];


				// $row=mysql_fetch_array($result,MYSQL_BOTH);

				$_SESSION['load']=$id_unico_load;
			} else $id_unico_load = -1;
			
			if (isset($_GET['delete']))  {
				$deleteid=$_GET["delete"];

				$result = pregunta_query("DELETE FROM persona WHERE id_pers=$deleteid");

				echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=seguimiento.php'>";
			}

			$db->cerrar_conexion(); 

$pagina = "seguimiento"; 
header_principal("seguimiento");

include_once "menu_lateral.php";
		//
		// Escribe los cumpleaños si no hay un usuario escogido. 
		//		
		if ($id_unico_load <= 0) {
			$dbc = new Leer_Mysqli(); 
			$mes = date(n); 
			$dia = date(j); 
			$mes_sig = ($mes == 12) ? 1 : $mes+1; 
			$lis = $dbc->cumples($mes); 
			echo "<br><b>CUMPLEAÑOS: </b>"; 
			for ($c=0; $c < count($lis[0]); $c++) {
				$antes = ""; $despues = ""; 
				if ($lis[0][$c] == $dia) {
					$antes = "<strong>"; $despues = "</strong>"; 
				}
				echo "<br>".$antes.$lis[0][$c]."-".$lis[1][$c]."\t ".$lis[2][$c]." ".$lis[3][$c]." ".$lis[4][$c].$despues; 
			}
			for ($c=0; $c < count($lis[6]); $c++) {
				echo "<br>".$lis[6][$c]."-".$lis[7][$c]."\t".$lis[8][$c]." ".$lis[9][$c]." ".$lis[10][$c]; 
			}
			$dbc->cerrar_conexion(); 
		}
		//
		// Imprime los comentarios (solamente si hay un usuario escogido)
		//	

		if ($id_unico_load>0)  { 

			if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina = 1; }

			// Imprime los datos de la persona
			echo "<div id='formulario'>";
			echo "<div id='d_persona'>";
			echo "<br>Nombre: <strong> &nbsp; &nbsp;".$row['nombre']." ".$row['apellido1']."  ".$row['apellido2'].
					"</strong>";

			// Pendiente de añadirle el botón submit
			echo "</div>";  // div d_persona;

			$dbs = new Leer_Mysqli(); 
			$array = $dbs->leer_comentarios($id_unico_load, $pagina); 

			$array_comentarios = $array[0]; 
			$total_paginas = $array[1];
			// echo "<pre>";print_r($array_comentarios); echo "</pre>";
			$dbs->cerrar_conexion(); 

			$fecha= date("d/m/Y");   // Formato de fecha
			
			echo "<div id='iframe'>";
			
			// Imprime el primer comentario vacío, para rellenar 
			imprimeComentario(true, $fecha, $id_unico_load, ""); 

			echo "<br>"; 
			// Imprime el resto de los comentarios rellenados
			foreach($array_comentarios as $row_comentario)  {
				if ($row_comentario['comentario'] != "") {
					imprimeComentario(false, $fecha, $id_unico_load, $row_comentario);
				}
			}
						echo "Identificador base datos:  (".$id_unico_load.")<br>";
			echo "</div><br>";   // iframe

			if ($pagina == 0) {
				echo "<a href='seguimiento.php?pagina=1' id='indice_coment'>Seguimiento por páginas</a>"; 
			} else {
				echo "<a href = 'seguimiento.php?pagina=0' id='indice_coment'>Todas</a>&nbsp;- &nbsp; "; 
				//muestro los distintos índices de las páginas, si es que hay varias páginas
				$PAGINAS_EN_INDICE = 14; 
				if ($total_paginas > 1) {
				    $puntos = ($total_paginas > $PAGINAS_EN_INDICE) ? true : false ; 
				    for ($i=1; $i<=$total_paginas; $i++){
						if ($pagina == $i)
							//si muestro el índice de la página actual, no coloco enlace
							echo $pagina." ";
						else  {
							// en primer lugar, el caso de que haya que colocar puntos suspensivos
							if ($puntos) {
								if (($i==5) && (($pagina < 2) || ($pagina > ($total_paginas-1)))) echo "..."; 
								if ((abs($pagina - $i) < 3) || ($i < 5) || ($total_paginas-$i < 4 )) {
									echo "<a href='seguimiento.php?pagina=".$i."' id='indice_coment'>".$i."</a> ";
								}  elseif (abs($pagina - $i) == 3)
									echo "..."; 
							} else  echo "<a href='seguimiento.php?pagina=".$i."' id='indice_coment'>".$i."</a> ";
						}	
				    }
				}
			} 
			echo "\n<div style='font-size:12px'><br><a href= 'seguimientopdf.php?id_unico= ".$id_unico_load."' >Imprimir en pdf</a></div>";
		}

		echo "</div>\n</body>\n</html>";
		?>

