<?php


function calcularactivo($fechasalida)  {
	date_default_timezone_set('Europe/Madrid');
	$salida = new DateTime($fechasalida);
	$hoy = new DateTime(date("Y/m/d"));
	if ($salida<$hoy)
		return false;
	else
		return true;
}




function imprimeListaDesplegable($nombre_campo, $titulo, $campo_mysql, $color, $order, $width, $top, $left, $lugar_titulo)	{
		$rowd=  $GLOBALS["row"];		
		echo "\n\t\t\t<div id='".$nombre_campo."' style='position:absolute; top: ".$top."%;
			left:  ".$left."%; font-size:14;   visibility:show;'>".$titulo."&nbsp;&nbsp;";
		if (!$lugar_titulo) echo "<br>";

		// Corrector por los antiguos nombres de los desplegables
		$despl = ( substr($campo_mysql, 0, 6) == "despl_" )? substr($campo_mysql, 6) : $campo_mysql; 

		echo "\n\t\t\t<select name='".$nombre_campo."' style= 'background-color:#".$color."; width:".$width."px; font-size:14;font-weight:bold;   visibility:show;'>";



		// Aquí se abren dos posibilidades, porque hay que probar con el método de utilizar 
		// las variables guardadas en SESSION, en lugar de abrir y cerrar la base de datos. 
		if ($nombre_campo == "algun_campo_para_probar") {

		} else {

			$dbim = new Leer_Mysqli();
			if ($despl == 'tutor') {
				$query = "SELECT id_tutor, nombre FROM tutor ORDER BY nombre";
			} else  {
				$query="SELECT id_despl, nombre FROM desplegables WHERE despl = '".$despl."' ORDER BY id_despl";
			}
			$result = $dbim->pregunta_query($query); 
			echo "\n\t\t\t<option value='0'></option>";
			while($row_leido = $result->fetch_row())  {
				echo "\n\t\t\t<option value='".$row_leido[0]."'";
				if ($rowd[$nombre_campo]==$row_leido[0])  {
					echo " selected";
				}
				echo ">".$row_leido[1]."</option>";
			}
			$dbim->cerrar_conexion;
			echo "</select></div>";

/*
			$dbim = new Leer_Mysqli(); 
			$query="SELECT * FROM ".$campo_mysql." ORDER BY ".$order;
			$result = $dbim->pregunta_query($query); 
			echo "\n\t\t\t<option value='0'></option>";
			while($row_leido = $result->fetch_row())  {
				echo "\n\t\t\t<option value='".$row_leido[0]."'";
				if ($rowd[$nombre_campo]==$row_leido[0])  {
					echo " selected";
				}
				echo ">".$row_leido[1]."</option>";
			}
			$dbim->cerrar_conexion;
			echo "</select></div>";
*/

		}
	}



function imprimeItem($identificador, $titulo, $size, $color_inicial, $top, $left, $lugar_titulo) {
	$rowi=  $GLOBALS["row"];
	echo "\n\n\t\t\t<div id='".$identificador."' style='position:absolute; top: ".$top."%;  left:  ".$left."%; font-size:14;   visibility:show;'>\n";
	echo "\t\t\t";
	$url = "popup_historial.php?id_unico=".$rowi['id_unico']."&identificador=".$identificador; 
	echo "<img src='graficos/punto.jpeg' onclick='javascript:new_window(\"".$url."\");'>&nbsp;";
	echo $titulo."&nbsp; &nbsp;";

	if (!$lugar_titulo) echo "<br>";
	echo "<input type='text'  name='".$identificador."' size='".$size."' style=' background-color:#".$color_inicial.";font-weight:bold' value='".$rowi[$identificador]."'>\n";
	echo "\t\t\t</div>";
}




function imprimeItemFecha($identificador, $titulo, $size, $color_inicial, $top, $left, $lugar_titulo) {
	$rowif=  $GLOBALS["row"];
	echo "\n\n\t\t\t<div id='".$identificador."' style='position:absolute; top: ".$top."%;  left:  ".$left."%; font-size:14;   visibility:show;'>\n";
	echo "\t\t\t".$titulo."&nbsp; &nbsp;";
	if (!$lugar_titulo) echo "<br>";
	echo "<input type='text'  name='".$identificador."' size='".$size."' style=' background-color:#".$color_inicial.";font-weight:bold' value='".fecha_sql_txt($rowif[$identificador])."'>\n";
	echo "\t\t\t</div>";
}



function imprimeHistorial($identificador, $titulo, $size, $color_inicial, $top, $left, $lugar_titulo)
{
	$rowif=  $GLOBALS["row"];
	
	echo "<img src='historial.png' onClick='historial".$identificador."()' style='position:absolute; top: ".$top."%;  left:  ".$left."%; font-size:14;   visibility:show;'>";
	
	$top=$top+4; // Para que el DIV aparezca justo debajo de la imagen Historial siempre
	
	// DIV HISTORIAL
	echo "<div id='info".$identificador."' style='position:absolute; background-color:#CCCCFF; z-index:4; font-size:16; visibility:hidden; top:".$top."%; left:".$left."%;'>";
	
	$loadid=$_GET["load"];
/*	include "conexion.php";
	$resultidunico=mysql_query("SELECT id_unico FROM persona WHERE id_pers =".$loadid,$conexion); 
	$rowidunico=mysql_fetch_row($resultidunico);
	$id_unico=$rowidunico[0];
*/	

	include_once "../clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
	$query_tabla="SELECT DISTINCT ($identificador),insert_fecha FROM persona WHERE id_unico=$loadid GROUP BY $identificador";
	$resulthist= $db->pregunta_query($query_tabla);

	echo "<table>";
	while($rowhist = $resulthist->fetch_row())	{
		echo "<tr>";
		echo "<td><b>".$rowhist[0].'</b></td><td><i>('.fecha_sql_txt($rowhist[1]).')</i></td>';
		echo "</tr>";
	}
	echo "</table></div>";
	$db->cerrar_conexion();
	
	
		// SCRIPT PARA crear un script por cada identificador diferente con su DIV diferente
	echo "<script>invisible();</script>";
	echo "<script>function muestra".$identificador."(){ window.document.getElementById('info".$identificador."').style.visibility='visible'; }</script>";
	echo "<script>function esconde".$identificador."(){ window.document.getElementById('info".$identificador."').style.visibility='hidden'; }</script>";
	echo "<script>function historial".$identificador."(){ 
		if (getventanahistorial()==1) 	{
			esconde".$identificador."();
			invisible();
		} else  {
			muestra".$identificador."();
			visible();
		}
	
	}</script>";
	

	
	
	
}



function imprimeCheckbox($identificador, $titulo, $color_inicial, $top, $left, $lugar_titulo, $negrita) {
	$rowic=  $GLOBALS["row"];
	echo "\n\n\t\t\t<div id='".$identificador."' style='position:absolute; background-color:#".$color_inicial.";top: ".$top."%;  left:  ".$left."%; font-size:14; visibility:show;'>";
	if ($lugar_titulo=='dcha') 
	{    
		echo "<input type='checkbox' name='".$identificador."' size='12;font-weight:bold' value='1'";
		if ($rowic[$identificador]=='1') echo " checked";
		echo ">";
	}
	
	if ($negrita) {
		echo "\n\t\t\t<b>".$titulo."</b>";	
	} else {
		echo "\n\t\t\t".$titulo;
	}
	if ($lugar_titulo=='arriba') 
	{
		echo "<br><input type='checkbox' name='".$identificador."' size='12;font-weight:bold' value='1'";
		if ($rowic[$identificador]=='1') echo " checked";
		echo ">";
	}   
	if ($lugar_titulo=='izda') 
	{    
		echo "<input type='checkbox' name='".$identificador."' size='12;font-weight:bold' value='1'";
		if ($rowic[$identificador]=='1') echo " checked";
		echo ">";
	}
		echo "\n\t\t\t</div>"; 
}  


function imprimeRadio($radio_completo, $name, $color_inicial) {
	$rowr=$GLOBALS["row"];
	$i=1;
	foreach ($radio_completo as $radio) {
	echo "\n\n\t\t\t<div id='".$name."' style='position:absolute; background-color:#".$color_inicial.";top: ".$radio["top"]."%;  left:  ".$radio["left"]."%; font-size:14; visibility:show;'>";
		echo "<input type='radio' value='".$i."' name='".$name."'";
		if ($rowr[$name]==$i) echo "checked";
		echo ">&nbsp;".$radio['titulo']."&nbsp;<br /></div>";
		$i++;
	}
}

function imprimeTexto($identificador, $titulo, $rows, $cols, $color_inicial, $top, $left, $lugar_titulo) {
	$rowitxt=  $GLOBALS["row"];
	echo "\n\n\t\t\t<div id='".$identificador."' style='position:absolute; top: ".$top."%;  left:  ".$left."%; font-size:14;   visibility:show;'>\n";
	echo "\t\t\t".$titulo."&nbsp; &nbsp;";
	if (!$lugar_titulo) echo "<br>";
	echo "<textarea name='".$identificador."' style=' background-color:#".$color_inicial.";font-weight:bold' cols=".$cols." rows=".$rows.">".$rowitxt[$identificador]."</textarea>\n";
	echo "\t\t\t</div>";
}
	
function imprimeTitulo($identificador, $texto, $top, $left, $negrita) {
	echo "\n\n\t\t\t<div id='".$identificador."' style='position:absolute; top: ".$top."%;  left:  ".$left."%; font-size:14;   visibility:show;'>\n";
	if ($negrita) echo "<b>";
	echo $texto; 
	if ($negrita) echo "</b>";
	echo "\t\t\t</div>";
}

//  imprimeImagen en fase experimental todavía. Hay que resolver el problema
//  de que sea un formulario dentro de un formulario. 
function imprimeImagen($identificador, $imagen, $top, $left) {
	global $id_unico; 
	$rowimg=  $GLOBALS["row"];
	echo "\n\n\t\t\t<div id='".$identificador."' style='position:absolute; top: ".$top."%;  left:  ".$left."%; font-size:14;   visibility:show;'>";
	$arch_imagen = "upload_imagenes/".$id_unico.".jpg";
	if (file_exists($arch_imagen))  { 
		echo "\n\t\t\t<img src='".$arch_imagen."' />"; 
	}
	echo "\n\t\t\t\t<label for='name'><p>Nueva fotografía:</p></label>";
	echo "\n\t\t\t\t<input type='file' size='10' name='imagen' value='' />";
	echo "\n\t\t\t\t<input type='hidden' name='action' value='simple' />";

	echo "\n\t\t\t</div>\n";
}




/*	
	ESTE SCRIPT LO HE TRASLADADO A jq/js/historial.js
	SUPONGO QUE HARÁ EL MISMO EFECTO
	
	<script>
	var v;
	function visible()  {
    		v=1;
	}
		
	function invisible()	{
    		v=0;
	}

	function getventanahistorial()	{
   		return v;
	}

	</script>
*/
?>
