<?php 
session_start();

?>


<!--
<head><title>Zubietxe</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
</head>

<body>
-->
<?php






/////////////////////////////////// FUNCIONES


function rev($text)
{
	$text = strip_tags($text);	
	$text = str_replace ("*", "", $text);
	$text = str_replace ("#", "", $text);
	$text = str_replace ("\\", "", $text);
	$text = str_replace("mytext","",$text);
	$text = str_replace("mstext","",$text);
	$text = str_replace("query","",$text);
	$text = str_replace("insert ","",$text);
	$text = str_replace("update","",$text);
	$text = str_replace("delete","",$text);
	$text = str_replace("select","",$text);
	$text = str_replace("Character","",$text);
	$text = str_replace("MEMB_INFO","",$text);
 	$text = str_replace(" IN ","",$text);
 	$text = str_replace(" OR ","",$text);
	return $text;
}



// Función que escribe uno de los input del formulario, a partir del nombre de la variable
function escribeInput($variable, $size, $ac)  {
		global $i, $j, $array_acc, $array_obj; 
		$name = $variable."-".$i."-".$j."";
		$value = ($ac == "ac") ? $array_acc[$i][$j][$variable] : $array_obj[$i][$j][$variable];
		echo "<td><input type='text' id='".$variable."' size=".$size." name='".$name."' value='".$value."'></td>";
}


/////////////////////////////////////////
////////////////////////////////////////
// Función que escribe uno de los input del formulario, a partir del nombre de la variable
function escribeInput_prueba($variable, $size, $ac, $checked)  {
		global $i, $j, $array_acc, $array_obj; 
		$name = $variable."-".$i."-".$j."";
		$value = ($ac == "ac") ? $array_acc[$i][$j][$variable] : $array_obj[$i][$j][$variable];
		$t_checked = ($checked) ? "" : " style = 'display: none' ";
		echo "\n\t\t\t<input type='text' id='".$variable."' size=".$size." name='".$name."' ".$t_checked." value='".$value."'>";
}




// Función que escribe uno de los checkbox del formulario, a partir del nombre de la variable;
// también escribe el nombre del item, que puede ser una acción o un objetivo. 
// $id es el identificador conjunto, para usos de css o jquery, pero también para identificar el ítem como 'ac' o 'ob'
function escribeCheckbox($variable, $item, $id)  {
		global $i, $j, $array_acc, $array_obj; 
		$name = $variable."-".$i."-".$j."";
		$t_checked = ((($array_acc[$i][$j][$id]==1) && ($id == 'ac')) ||
				(($array_obj[$i][$j][$id]==1) && ($id == 'ob'))) ? " checked = 'checked' " : "";
		echo "<td><input type='checkbox' id='".$id."' name='".$name."' ".$t_checked." value='".$name."'> ".$item."</td>"; 
}


/////////////////////////////////////////////////
////////////////////////////////////////////////
// Función que escribe uno de los checkbox del formulario, a partir del nombre de la variable;
// también escribe el nombre del item, que puede ser una acción o un objetivo. 
// $id es el identificador conjunto, para usos de css o jquery, pero también para identificar el ítem como 'ac' o 'ob'
function escribeCheckbox_prueba($variable, $item, $id, $checked)  {
		global $i, $j; 
		$name = $variable."-".$i."-".$j."";
		$t_checked = ($checked) ? " checked = 'checked' " : "";
		echo "\n\t<div class='linea'><input type='checkbox' id='".$id."' name='".$name."' ".$t_checked." value='".$name."'> ".$item.""; 
}




// Vacía el array $array_acc y $array_obj
function vaciaArrays() {
	global $prueba, $dimensiones, $objetivos, $acciones, $item_acciones, $item_objetivos, $array_acc, $array_obj;
	for ( $dim=1; $dim<($dimensiones+1); $dim++ ) {
		// Acciones
		for ( $acc=0; $acc<$acciones[($dim-1)]; $acc++) {
			$array_acc[$dim][$acc]['ac'] = 0; 
			foreach ($item_acciones as $itm) {
				$array_acc[$dim][$acc][$itm] = "";
			}
		}
		// Objetivos
		for ( $obj=0; $obj<$objetivos[($dim-1)]; $obj++) {
			$array_obj[$dim][$obj]['ob'] = 0; 
			foreach ($item_objetivos as $itm) {
				$array_obj[$dim][$obj][$itm] = "";
			}
		}
	}
}


// Crea el nuevo array cuando se llama a la página tras rellenar el formulario
function creaArrays() {
	global $prueba, $dimensiones, $acciones, $objetivos, $item_acciones, $item_objetivos, $array_acc, $array_obj;
	if($prueba) echo "<b>CREANDO EL NUEVO ARRAY \$array_acc</b>";
	for ( $dim=1; $dim<($dimensiones+1); $dim++ ) {

		//  Acciones 
		for ( $acc=0; $acc<$acciones[($dim-1)]; $acc++) {
			if ($prueba) echo "<br>DIMENSIÓN: ".$dim." - ACCIÓN: ".$acc;   //
			$key = 'acc-'.$dim.'-'.$acc.''; 
			if ($prueba) echo "<br> - buscando POST[".$key."]";  //
			if (isset ($_POST[$key])) { 
				if ($prueba) echo "--------------> encontrado ".$_POST[$key];  //
				$array_acc[$dim][$acc]['ac'] = 1; // marca de línea 
				foreach ($item_acciones as $itm) {
					$key = $itm."-".$dim."-".$acc;
					if (isset ($_POST[$key])) { 
						//  Validar
						if ($prueba) echo "<br>&nbsp;&nbsp;&nbsp;Grabado en array_acc en ".$itm."-".$dim."-".$acc.": ".$_POST[$key];  //
						$array_acc[$dim][$acc][$itm] = $_POST[$key];
					}
				}
			}
		}

		// Objetivos	
		for ( $obj=0; $obj<$objetivos[($dim-1)]; $obj++) {
			if ($prueba) echo "<br>DIMENSIÓN: ".$dim." - OBJETIVO: ".$obj;   //
			$key = 'obj-'.$dim.'-'.$obj.''; 
			if ($prueba) echo "<br> - buscando POST[".$key."]";  //
			if (isset ($_POST[$key])) { 
				if ($prueba) echo "--------------> encontrado ".$_POST[$key];  //
				$array_obj[$dim][$obj]['ob'] = 1; // marca de línea 
				foreach ($item_objetivos as $itm) {
					$key = $itm."-".$dim."-".$obj;
					if (isset ($_POST[$key])) { 
						//  Validar
						if ($prueba) echo "<br>&nbsp;&nbsp;&nbsp;Grabado en array_obj en ".$itm."-".$dim."-".$obj.": ".$_POST[$key];  //
						$array_obj[$dim][$obj][$itm] = $_POST[$key];
					}
				}
			}
		}
	}

}



// Graba el contenido de los arrays (las líneas marcadas) en Mysql 
function grabaArraysMysql($id_unico, $id_pei_unico) {

	// Conexión
	include_once "../conexion_mysqli.php";
	include_once "../fechas.php";  

	global $prueba, $dimensiones, $acciones, $objetivos, $item_acciones, $item_objetivos, $array_acc, $array_obj;
	if ($prueba) echo "<b><br>&nbsp;<br>GRABANDO EN MYSQL</b>"; 
	for ( $dim=1; $dim<($dimensiones+1); $dim++ ) {

		// Acciones
		for ( $acc=0; $acc<$acciones[($dim-1)]; $acc++) {
			if ($array_acc[$dim][$acc]['ac'] == 1) {
				$query_a = "INSERT INTO pei ( id_unico, id_pei_unico, dimension, accion,
						 ".implode(", ", $item_acciones).") VALUES ( ";
				$query_a .= "".$id_unico.", ".$id_pei_unico.", ".$dim.", ".$acc;
				foreach ($item_acciones as $itm) {
					$relleno = $array_acc[$dim][$acc][$itm];
					if ($relleno == "") {		
						$query_a .= ", NULL"; 
					} else {
						if (($itm == 'fecha_ini') || ($itm == 'fecha_fin')) {
							$query_a .= ", '".fecha_txt_sql($array_acc[$dim][$acc][$itm])."'";
						} else {
							$texto = rev($array_acc[$dim][$acc][$itm]); 
							$query_a .= ", '".$mysqli->escape_string($texto)."'";
						}
					}
				} 	
				$query_a .= " );"; 

				// Sube los datos con mysqli
				if ($prueba) echo "<br>QUERY: '".$query_a."'";  
				if(!$result = $mysqli->query($query_a))  {
 				   	die('<br>Error con query_a en form_pei.php, al insertar los datos [' . $mysqli->error . ']');
				}
			}
		}
		
		// Objetivos
		for ( $obj=0; $obj<$objetivos[($dim-1)]; $obj++) {
			if ($array_obj[$dim][$obj]['ob'] == 1) {
				$query_o = "INSERT INTO pei ( id_unico, id_pei_unico, dimension, objetivo,
					 ".implode(", ", $item_objetivos).") VALUES ( ";
				$query_o .= "".$id_unico.", ".$id_pei_unico.", ".$dim.", ".$obj;			
				foreach ($item_objetivos as $itm) {
					$relleno = $array_obj[$dim][$obj][$itm];
					if ($relleno == "") {		
						$query_o .= ", NULL"; 
					} else {
						if (($itm == 'fecha_ini') || ($itm == 'fecha_fin')) {
							$query_o .= ", '".fecha_txt_sql($array_acc[$dim][$acc][$itm])."'";
						} else {
							$texto = rev($array_obj[$dim][$obj][$itm]);
							$query_o .= ", '".$mysqli->escape_string($texto)."'";
						}
					}
				} 
				$query_o .= " )"; 

				// Sube los datos con mysqli
				if ($prueba) echo "<br>QUERY: '".$query_o."'";  
				if(!$result = $mysqli->query($query_o))   {
 				   	die('<br>Error con query_o en form_pei.php, al insertar los datos [' . $mysqli->error . ']');
				}
			}
		}
	}	
	$mysqli->close(); 
}




// Busca en Mysql el último id_pei_unico (identificador del Pei) grabado para determinado id_unico.
function buscaIdPeiUnico($id_unico) {
	global $prueba; 
	include_once "../conexion_mysqli.php"; 

	$query_id_pei = "SELECT id_pei_unico FROM pei WHERE id_unico = ".$id_unico." ORDER BY id_pei_unico DESC LIMIT 1;";
	if ($prueba) echo "<br>QUERY ID PEI: '".$query_id_pei."'";  
	if(!$result_id_pei = $mysqli->query($query_id_pei))   {
 	  	die('<br>Error con query_id_pei en form_pei.php, al insertar los datos [' . $mysqli->error . ']');
	}
	// Si hay peis con ese id_unico,
	if ($result_id_pei->num_rows > 0) {

		// Obtiene la variable mayor_id_pei_unico
		while($row_id_pei = $result_id_pei->fetch_assoc()) {
				$mayor_id_pei_unico = $row_id_pei['id_pei_unico'];	
		}
		if ($prueba) echo "<br>Mayor id pei unico: ".$mayor_id_pei_unico; 
		$mysqli->close(); 
		return $mayor_id_pei_unico; 
	} else {
		$mysqli->close(); 
		return -1; 
	}
}

// Crea un array a partir de lo obtenido en MySql
function mysqlArrays($id_unico, $id_pei_unico) {

	include "../conexion_mysqli.php"; 
	include_once "../fechas.php";  
	global $prueba, $dimensiones, $acciones, $objetivos, $item_acciones, $item_objetivos, $array_acc, $array_obj;

	// Obtiene la tabla pei con el id_pei_unico indicado (el último PEI creado)
	$query_pei = "SELECT * FROM pei WHERE id_unico = ".$id_unico." AND id_pei_unico = ".$id_pei_unico.";";
	if ($prueba) echo "<br>QUERY PEI: '".$query_pei."'";  
	if(!$result_pei = $mysqli->query($query_pei))   {
		  die('<br>Error con query_pei en form_pei.php, al insertar los datos [' . $mysqli->error . ']');
	}
	// Convierte esos datos de mysql al array
	while($row_pei = $result_pei->fetch_assoc()){
		if ($row_pei['objetivo'] >0) {
			$array_obj[$row_pei['dimension']][$row_pei['objetivo']]['ob'] = 1;
			$array_obj[$row_pei['dimension']][$row_pei['objetivo']]['meta'] = $row_pei['meta'];
		}
		if ($row_pei['accion'] >0) {
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['ac'] = 1; 
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['tarea'] = $row_pei['tarea'];
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['recurso'] = $row_pei['recurso'];
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['fecha_ini'] = fecha_sql_txt($row_pei['fecha_ini']);
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['fecha_fin'] = fecha_sql_txt($row_pei['fecha_fin']);
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['responsable'] = $row_pei['responsable'];
			$array_acc[$row_pei['dimension']][$row_pei['accion']]['resultado'] = $row_pei['resultado'];
		}
	}
	$mysqli->close(); 
}



///////////////////////// CODIGO 

include_once "datos_pei.php";   // Recoge los datos
include_once "../../headers.php"; 

$prueba = false;
// $id_unico = 0; 

// Recoge el id_unico de la persona de la que estamos hablando
if ((isset($_GET['load'])) || (isset($_SESSION['load'])) )   {
	if (isset($_SESSION['load'])) 	{
		$id_unico = $_SESSION['load'];
	}
	if (isset($_GET['load'])) {
		$id_unico = $_GET['load'];
	}
} else {
	echo "<h2>No se puede realizar un PEI si no se ha seleccionado a una persona.<br>";
	echo "Por favor, vuelve a <a href='../../persona.php'>la aplicación</a>.</h2>"; 
}

if ($prueba) echo "<h2>Id único es: ".$id_unico." </h2>";

// En primer lugar vaciamos las arrays auxiliares, $array_acc, $array_obj
vaciaArrays();   


//
// Hace esta parte cuando se ha enviado un formulario
//
if (isset($_POST['enviar']) ) {
	$id_pei_unico = $_POST['id_pei_unico'] + 1; 
	if ($prueba) echo "<br>id_pei_unico enviado por el formulario, más uno: ".$id_pei_unico; 

	creaArrays(); 	// lee los arrays desde los POST enviados por el formulario
	grabaArraysMysql($id_unico, $id_pei_unico);	// graba los datos de arrays en mysql
	echo "<br><h1>Se ha enviado el formulario</h1>";
} else {


// Hace esta parte si se ha llegado aquí mediante un link (no se ha enviado formulario)
	$id_pei_unico = buscaIdPeiUnico($id_unico);    // Averigua si con este id_unico ya se han grabado anteriormente PEIs. 
	if ($prueba) echo "<br>id_pei_unico es ".$id_pei_unico; 
	if ($id_pei_unico > 0) {	// solamente si existe un Pei anterior
		mysqlArrays($id_unico, $id_pei_unico); 	//  lee los datos de mysql y los pasa al array
	} else {
		$id_pei_unico = 0;	// damos a $id_pei_unico el valor 0, ya que es el primer PEI de esta persona 
	}
}

if ($prueba) { echo "<pre>"; print_r($array_acc);   echo "</pre>"; }	//
if ($prueba) { echo "<pre>"; print_r($array_obj);   echo "</pre>"; }	//


/////////
// Dibuja el formulario en pantalla
////////


$config_head['array_css'] = 			'pei.css'; 
$config_head['array_javascript'] = array(	"../../jq/jquery.min.js", 
						"../../jq/jquery-ui.js"); 
$config_head['activ'] = false; 
$config_head['menu'] = true; 
$config_head['logo'] = false; 
$config_head['pest'] = false; 

header('form_pei', $config_head);
?>
<script  type="text/javascript">


$(document).ready(function () {
  $("div.linea").each(function(index) {
    var $x = $(this).find("div");

    $(this).find("input#ob").click(function(){
      if ($(this).is(":checked"))
        {
          $x.show("fast");
        } else {
          $x.hide("fast");
        }
    });
  });
});

</script>


<?php

echo "\n<div id='form_pei'>"; 
echo "\n<form name='pei' action = 'form_pei.php' method='post'>";

foreach ($dimension as $i => $dim) {
	echo "\n<div id='dimension'>"; 
	echo "\n<div id='title_dimension'>\n<br>".$i.". ".$dim."</div>"; 

	// Tabla OBJETIVOS
	echo "\n<div class='tabla_ob'>"; 
//	echo "\n<table>";
//	echo "\n\t<tr id='primer_tr'><td>OBJETIVO</td><td>META</td></tr>";
	echo "\n\tOBJETIVO&nbsp;META";
	foreach ($objetivo_pei[$i] as $j => $obj) {
//		echo "\n\t<tr>"; 
		$checked = ($array_obj[$i][$j]['ob'] == 1);
		escribeCheckbox_prueba("obj", $obj, "ob", $checked);	
		echo "\n\t\t<div id='esconder'>"; 
		escribeInput_prueba("meta", 50, "ob", $checked);
		echo "\n\t\t</div>\n\t</div>"; 
//		echo "</tr>"; 		
	}
//	echo "\n</table>"; 
	echo "\n</div>";   // div tabla_ob

	// Tabla ACCIONES
	echo "\n<div class='tabla_ac'>"; 
	echo "\n<table>";
	echo "\n\t<tr id='primer_tr'><td>ACCIONES A <br>DESARROLLAR</td><td>TAREAS</td><td>RECURSOS</td>
			<td>FECHA INI</td><td>FECHA FIN</td><td>RESPONSABLES</td><td>RESULTADO</td></tr>";
	$j=0; 
	foreach ($accion_pei[$i] as $j => $acc) {
		echo "\n\t<tr>"; 
		escribeCheckbox("acc", $acc[0], "ac");
		echo "<div id='esconder'>"; 
		escribeInput("tarea", 10, "ac");
		escribeInput("recurso", 10, "ac");
		escribeInput("fecha_ini", 7, "ac"); 
		escribeInput("fecha_fin", 7, "ac"); 
		escribeInput("responsable", 10, "ac");
		escribeInput("resultado", 10, "ac");
		echo "</div>"; 
		echo "</tr>"; 
	}
	echo "\n</table>"; 
	echo "\n</div>"; // div tabla_ac
	echo "\n</div>"; // div dimension
}
echo "\n<input type='hidden' name='id_pei_unico' value='".$id_pei_unico."'>"; 
echo "\n<input type='submit' name='enviar' value='Enviar'>"; 
echo "\n</form>"; 
echo "\n</div>";  // div form_pei

echo "\n<a href='rtf_pei.php'>Imprimir</a>"; 

?>

</body>
