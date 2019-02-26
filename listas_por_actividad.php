<?php		
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();

// 
//  En esta página está pendiente darle un poco de forma a los div y a la página en general
//

$debug = false; 

include "headers.php";

header_principal("listas_actividad"); 

include_once "clases/class.leer_mysqli.php";
include "include/array_a_tabla.php"; 

	$db = new Leer_Mysqli(); 

	$lista_activ = $db->lista_query("SELECT * from lista_actividades;");
//	$row_count = $result_count->fetch_array(MYSQLI_BOTH); 


	// Fechas
	$fecha_ini = ((isset($_POST['fecha_ini'])) && ($_POST['fecha_ini'] != "")) ? $_POST['fecha_ini'] : "2013-01-01"; 
	$fecha_fin = ((isset($_POST['fecha_fin'])) && ($_POST['fecha_fin'] != "")) ? $_POST['fecha_fin'] : "2013-12-30";


	// Crea array de la lista de actividades
//	$query_activ = "select * from lista_actividades;";
//	$result_activ=mysql_query($query_activ, $conexion); 


	// Formulario inicial
	echo "<div id='resultados_activ'>";
	echo "<h2>Listas de actividades</h2>";
	echo "<form name='opciones' id='opciones' action='".$_SERVER['PHP_SELF']."' method='post'>\n";
	echo "<br>Fecha inicio: <input type='text' name='fecha_ini' value='".$fecha_ini."'> &nbsp; &nbsp\n";
	echo "Fecha fin: <input type='text' name='fecha_fin' value='".$fecha_fin."'>\n";
	echo "<br>(Formato de fecha: dia/mes/año)";
	echo "<br>Por defecto: 1/1/2013 - 30/12/2013  SI SE QUIERE UTILIZAR ESAS FECHAS, DEJAR EN BLANCO";
	echo "<br>Estadísticas con nombres o solamente numéricas.<br>\n"; 
	echo "<br><input type='submit'  name='con_nombre'  value='Con nombres + Tabla general'>&nbsp; &nbsp\n";
	echo "<input type='submit'  name='sin_nombre'  value='Sólo Tabla general'><p></p>\n";
	echo "</form></div>";

/*
	// Define un array con nombres y apellidos para utilizar después
	$query_nom = $db->lista_query("SELECT id_unico, nombre, apellido1, apellido2, sexo 
						FROM persona GROUP BY id_unico ORDER BY id_unico;");
//	$result_nom=mysql_query($query_nom, $conexion); 
	while($row_nom = mysql_fetch_array($result_nom,MYSQL_BOTH)){
		$sexo = ($row_nom['sexo'] == 1) ? "M" : "H";    // línea provisional a falta de incorporar nuevas opciones (transexual, etc.)
		$array_nom[$row_nom['id_unico']] = array($row_nom['nombre'], $row_nom['apellido1'], $row_nom['apellido2'], $sexo);
	}		
*/
	$mostrar_tabla = 1; 
	// Variable $mostrar_tabla nos dice si aparecen las tablas o no
	if ( isset($_POST['con_nombre']) || isset($_POST['sin_nombre']) ) {
		if (isset($_POST['con_nombre'])) { $mostrar_tabla=1; }
			else 
		{ $mostrar_tabla = 0; }
	}






	// Variables tablas
	$atributos_tabla = array("width"=>"60%", "border"=>"1");
	$atributos_titulo = array("bgcolor"=>"#336699");
	$atributos_linea = array("bgcolor"=>"#COCOCO");

	// Bucle principal
	$cont_tot = 0;		// contador general de las actividades
	$array_tot[$cont_tot++] = array("Actividad", "Personas", "Mujeres", "Hombres"); 	// cabecera de tabla general

	foreach ($lista_activ as $activ){
		$id_activ= $activ['id_listaactividad'];
		$nom_activ = $activ['nombre_actividad'];
		if ($debug) echo "<br><h3>".$nom_activ."</h3>"; 
		if ($debug) {echo "<pre>"; print_r($activ); echo "</pre>"; }
		$query = "SELECT count(*) as veces, c.id_unico as persona FROM comentario as c, actividad as a 
			WHERE c.id_actividad=a.id_activ AND a.tipo_activ=".$id_activ." AND a.fecha_actividad > '".$fecha_ini."' 
			AND a.fecha_actividad < '".$fecha_fin."'  GROUP BY c.id_unico ORDER BY c.id_unico;";

/*
	echo "<head></head><body style='background-color: beige'>";
	echo "<div id='resultados_opc'>";
	echo "<form name='query' id='query' action='".$_SERVER['PHP_SELF']."' method='post'>\n";
	echo "<br>Query: <input type='text' name='query_pedido' size=100 > &nbsp; &nbsp\n";
	echo "<input type='submit'  name='boton'  value='Enviar'><p></p>\n";
	echo "</form></div>";
	echo "</body>"; 

	if (isset($_POST['boton'])) {

		$query= $_POST['query_pedido'];

*/

//		echo "query es: ".$query; 
		$array_datos[0] = array("N", "Nombre", "Apellido 1", "Apellido 2", "Sexo", "Asistencias"); 

		$personas_veces = $db->lista_query($query, false); 



		$cont_sexo[1] = 0; $cont_sexo[2] = 0;  // inicializa contadores por sexo
		$cont = 1; 
		foreach ($personas_veces as $persona){
			$datos_pers = $db->leer_persona($persona['persona']);
			$array_datos[$cont][0] = $cont;
			$array_datos[$cont][1] = $datos_pers['nombre']; 		
			$array_datos[$cont][2] = $datos_pers['apellido1']; 	
			$array_datos[$cont][3] = $datos_pers['apellido2'];
			$sexo = $datos_pers['sexo'];
		//	echo "<br>array datos sexo: ".$datos_pers['apellido1']." - ".$sexo;
			if ($sexo == "1") {
				$cont_sexo[1] = $cont_sexo[1] +1; 
				$array_datos[$cont][4] = "M";
			} else {
				$cont_sexo[2] = $cont_sexo[2] +1; 
				$array_datos[$cont][4] = "H";
			}
			$array_datos[$cont++][5] = $persona['veces'];  
		}
		if ($debug) {echo "<pre>"; print_r($array_datos); echo "</pre>"; }

		if ($mostrar_tabla == 1) {
			echo "<br><h2>Actividad: ".$nom_activ."</h2>"; 
			tabla("", $array_datos, $atributos_tabla, $atributos_titulo, $atributos_linea);
			echo "<h2>Total: ".($cont-1)."</h2>"; 
		}
		unset($array_datos);

	$array_tot[$cont_tot][0] = $nom_activ;
	$array_tot[$cont_tot][1] = $cont-1;
	$array_tot[$cont_tot][2] = $cont_sexo[1];
	$array_tot[$cont_tot++][3] = $cont_sexo[2];

//	} fin isset 

	} // fin while row_activ

	// Mostrar tabla final
	$atributos_tabla = array("width"=>"50%", "border"=>"1");
	echo "<h1>Tabla general: </h1>"; 
	tabla("", $array_tot, $atributos_tabla, $atributos_titulo, $atributos_linea);

	$cabeceras = array("Actividad", "Personas", "Mujeres", "Hombres"); 
	$item = "actividades"; 
	$titulo = "Asistencia a actividades"; 

	echo "<form action='include/array_excel_pdf.php' method = 'POST'>"; 
	echo "<input type = 'hidden' name = 'array_pasa' value = '".$array_tot."'>"; 
	echo "<input type = 'hidden' name = 'cabeceras' value = '".$cabeceras."'>";
	echo "<input type = 'hidden' name = 'item' value = '".$item."'>";
	echo "<input type = 'hidden' name = 'titulo' value = '".$titulo."'>";
	echo "<br><input type='submit' name='tabla_excel' value='Crear Excel' >";
	echo "&nbsp; &nbsp; <input type='submit' name='tabla_pdf' value='Crear Pdf' >";
	echo "</form>"; 

	$db->cerrar_conexion(); 
?>
