<?php 
include "array_a_tabla.php"; 
include "conexion.php"; 

include "fechas.php"; 
include "array_a_csv.php"; 
include "auxiliar3.php"; 



function serializar($array) {
	$array = serialize($array); 
	$array = urlencode($array); 
	return $array;
}


function escribeTabla($titulo, $cabeceras, $array_tabla, $item) {	
	global $n;
	global $debug; 
	$ancho = 50 + ($n * 20);
	$ancho_s = "".$ancho."%";
	$atributos_tabla = array("width"=>$ancho_s, "border"=>"1");
	$atributos_titulo = array("bgcolor"=>"#336699");
	$atributos_linea = array("bgcolor"=>"#COCOCO");
	echo "<h1>".$titulo."</h1>";
	tabla($cabeceras, $array_tabla, $atributos_tabla, $atributos_titulo, $atributos_linea);

	$array_tabla = serializar($array_tabla);
	$cabeceras = serializar($cabeceras);
	echo "<form action='include/array_excel_pdf.php' method = 'POST'>"; 
	echo "<input type = 'hidden' name = 'array_pasa' value = '".$array_tabla."'>"; 
	echo "<input type = 'hidden' name = 'cabeceras' value = '".$cabeceras."'>";
	echo "<input type = 'hidden' name = 'item' value = '".$item."'>";
	echo "<br><input type='submit' name='tabla_excel' value='Crear Excel' >";
	echo "&nbsp; &nbsp; <input type='submit' name='tabla_pdf' value='Crear Pdf' >";
	echo "</form>"; 
//	crea_csv("tabla", $array_tabla);
}


/** Función que lee los datos de la tabla persona, dado un determinado campo y un valor  
*     - hace un SELECT de la tabla _max, según sexo, campo y valores pedidos
*     - crea un array con los resultados
*/ 
/*function datos($columna, $sexo, $campo_a_revisar, $valor1, $valor2) {
		$conexion=  $GLOBALS["conexion"];
		$nombre_tabla=  $GLOBALS["nombre_tabla"];
		$fecha=  $GLOBALS["fecha"];
		global $izaskun;   ///////////////////// provisional listas 2011
		global $servicio; 
		global $debug; 
		global $array_comprobar;  // Esta es la tabla fija con los id y los nombres 
		global $array_comp_aux;   // esta es la tabla que se utiliza en cada bucle

		$z=0;
		if ($z < 3) {	
			echo "campo: ". $campo_a_revisar." - valor: ".$valor1." - sexo: ".$sexo;
			echo "<pre>";
			print_r($array_comp_aux); 
			echo "</pre>";
		}
		$z++;

		$fecha_comparar = $fecha[$columna];
		$tabla = $nombre_tabla[$columna];
//		echo "<br>Nombre tabla: ".$tabla; //////////////////////////////////////////////////



		$debug_revisar = "nucleo_conv";  // Por si queremos revisar el proceso; se pone el nombre del campo a revisar

		if ($fecha_comparar=="") $fecha_comp="CURDATE()";
			else $fecha_comp="'".$fecha_comparar."'"; 

		if ($izaskun) {
			$tabla_max = "auxiliar_izaskun3"; ///////////////////////////////////////////////////////
		} else {
			$tabla_max = "".$tabla."_max"; 
		}


		// Se hace una selección de los que cumplen la condición. Puede haber varios resultados por cada persona (varios insert_fecha)
		switch($campo_a_revisar) {
			case "area":
				$query="SELECT per.id_unico, per.id_pers, per.nombre, per.apellido1, per.insert_fecha, per.fecha_ingreso, pai.area
						, pai.area FROM ".$tabla_max." AS per, paises_mundo AS pai WHERE per.sexo = '".$sexo."' 
						AND pai.area = '".$valor1."' AND per.nacionalidad = pai.id_pais
						ORDER BY nombre, id_unico";
				break; 

			case "edad":
				$query="SELECT id_unico, id_pers, nombre, apellido1, insert_fecha, fechanac, CURDATE(), 
					(YEAR(CURDATE()) - YEAR(fechanac)) - (RIGHT(CURDATE(),5) < RIGHT(fechanac,5)) as edad
					FROM ".$tabla_max."  WHERE (YEAR(CURDATE()) - YEAR(fechanac)) - (RIGHT(CURDATE(),5) < RIGHT(fechanac,5))
					BETWEEN '".$valor1."' AND '".$valor2."' 		
					AND sexo = '".$sexo."' 
					GROUP BY id_unico ORDER BY nombre, id_unico";	
				break;

			default:
				$query="SELECT id_unico, id_pers, nombre, apellido1, insert_fecha, fechanac, ".$campo_a_revisar."
					 FROM ".$tabla_max." WHERE sexo = '".$sexo."' AND ".$campo_a_revisar." = '".$valor1."'
					ORDER BY nombre, id_unico"; 
				break; 	
		}

		if ($debug >= 0) {
			echo "<br>Campo a revisar: ".$campo_a_revisar." - query: ".$query;	
		}       			


		//
		// Se crea una nueva array $array_datos con los resultados del select
		//
		$result = mysql_query($query, $conexion); 
		$cont = 0;
		while($row = mysql_fetch_array($result,MYSQL_BOTH)){
			$array_datos[$cont] = $row; 
			$cont++;
			if (($campo_a_revisar == $debug_revisar) && ($debug >= 0)) {	// debug
				echo "<br>cont: ".$cont." - id_pers: ".$row['id_pers']." - id_unico: ".$row['id_unico']." - row insert_fecha: "
				.$row['insert_fecha']." - array insert_fecha: ".$array_datos[$cont]['insert_fecha'] ;  /////////////////////////
			}
			$array_comp_aux[$row['id_unico']] = ""; 	// Vamos tachando los que aparecen
		}
		return $array_datos; 
}
*/

/** Función para leer todos los datos de una lista desplegable, automáticamente, mediante un bucle 
*  - lee datos por sexo, usando la función datos()
*  - hace los totales
*  - crea una tabla
*  - muestra por pantalla
*/
function leerListaDespl($n, $titulo, $item_despl, $item_persona) {
	global $db;
	global $AUX; 
	global $debug;
	global $servicio; 
	global $ver_nombres; 
	global $atributos_tabla, $atributos_titulo, $atributos_linea;
	global $array_comprobar; 
	global $array_comp_aux;
	$array_comp_aux = $array_comprobar;
//	$conexion=  $GLOBALS["conexion"];
	define ("NUM_COLUMNAS", 3); 

	$col = $n * NUM_COLUMNAS;
	$array_sexo = array(1 => "Mujer", 2 => "Hombre");    // define los sexos
	$n_sexos = count($array_sexo);

	// inicializa variable $total para los totales verticales
	for ($m = 1; $m <= $n_sexos + 1; $m++) {   
		$total[$m] = 0;
	}

	// inicializa variable $lista_despl 
	unset($lista_despl); $lista_despl = array(""); 

	// 
	$lista_despl = $db->desplegable($item_despl); 
	$cont_tabla = 0;

	/*
	*  Realiza este bucle para cada item de la lista desplegable
	*  Genera un array ($array_tabla) 
	*/
	unset($array_tabla); 
	$i = 1;	// Esta variable representa la fila de la tabla
	foreach ($lista_despl as $id => $contenido) {
		// Para 'edad' hay dos valores por grupo, uno mínimo y uno máximo, se guardan en la tabla despl_aux_edad
		if ($item_persona == 'edad') {
			$valor1 = $AUX->aux['edad'][$cont_tabla][2];
			$valor2 = $AUX->aux['edad'][$cont_tabla][3];		
		} else {
			// Para todos los demás valores, el valor a comparar es el id de la tabla de desplegable
			// o en el caso de agrupaciones (ej: 'area'), el id de la tabla de desplegable auxiliar (ej: despl_aux_area)
			$valor1 = $id;
			$valor2 = 0; 
		}

		// Descripción del item, primera columna
		$array_tabla[$i][0] = $contenido;
 
		$j = 0;

		/* 
		*  Realiza este bucle para cada columna (sexo)
		*/
		foreach ($array_sexo as $key => $valor) {

			// Lee los datos para un sexo, y un determinado valor de la lista
			$datos[$j] = $db->leer_datos($item_persona, $key, $valor1, $valor2);
			$cont = 0;

			if ($ver_nombres) $array_tabla[$i-1][$key] = ""; 
			foreach ($datos[$j++] as $nom) {
				if ($ver_nombres) $array_tabla[$i-1][$key] .= $nom['nombre']." ".$nom['apellido1']."<br>\n";
				$cont++;
			}
			$array_tabla[$i][$key] = $cont;
		}

		// Obtener totales
		// Datos totales de fila, mujeres + hombres
		if ($ver_nombres) $array_tabla[$i-1][$n_sexos + 1] = ""; 
		$suma = 0;
		for ($k = 1; $k <= $n_sexos; $k++) {	// Suma horizontal
			$suma = $suma + $array_tabla[$i][$k];
		}
		$array_tabla[$i][$n_sexos + 1] = $suma; 

		// Suma vertical: Totales de columna
		for ($l = 1; $l <= $n_sexos + 1; $l++) {   // 
			$total[$l] = $total[$l] + $array_tabla[$i][$l];
		}

		// Incrementa $i de forma diferente según es con nombres o no.
		$i = ($ver_nombres) ? $i+2 : $i+1;
		$cont_tabla++;
	}

	// Última línea de la tabla $array_tabla: representa el total
	$array_tabla[$i][0] = "TOTAL";
	for ($m = 1; $m <= $n_sexos + 1; $m++) {
		$array_tabla[$i][$m] = $total[$m];
	}	

	// Escribe la tabla en pantalla 
	$cabeceras = array(0 => "") + $array_sexo + array(($n_sexos +1) => "Total");
	escribeTabla($titulo, $cabeceras, $array_tabla, $item_persona);

	// Saca de la lista $array_comp_aux los que aparecen en el cuadro y la imprime en pantalla: tabla 'Faltan'
	echo "Faltan: ";
	foreach ($array_comp_aux as $key => $valor) {
		if ($valor <> "") echo "<br>\n<a href='persona.php?load=".$key."'>".$key." - ".$valor."</a>";
	}
	return $array_tabla;
}



/** Función para leer todos los datos de una serie de items, agrupados en el array $checkboxes  */
function leerItem($n, $titulo, $checkboxes) {
//	$conexion=  $GLOBALS["conexion"];
	global $db; 
	global $ver_nombres;
	global $debug;
	global $atributos_tabla, $atributos_titulo, $atributos_linea;
	$n = $n * NUM_COLUMNAS;

	$array_sexo = array(1 => "Mujer", 2 => "Hombre");    // define los sexos
	$n_sexos = count($array_sexo);

	for ($m = 1; $m <= $n_sexos + 1; $m++) {   // inicializa variable $total para los totales verticales
		$total[$m] = 0;
	}

	$i = 1;	// Esta variable representa la fila de la tabla
	foreach ($checkboxes as $checkbox) {
			
		// Descripción del item
		$array_tabla[$i][0] = $checkbox['titulo'];

		$j = 0;


		/* 
		*  Realiza este bucle para cada columna (sexo)
		*/
		foreach ($array_sexo as $key => $valor) {
			// Datos para un valor determinado de la tabla desplegable
  			$datos[$j] = $db->leer_datos($checkbox['persona'], $key, 1);
			$cont = 0;
			if ($ver_nombres) $array_tabla[$i-1][$key] = ""; 
			foreach ($datos[$j++] as $nom) {
				if ($ver_nombres) $array_tabla[$i-1][$key] .= $nom['nombre']." ".$nom['apellido1']."<br>";
				$cont++;
			}
			$array_tabla[$i][$key] = $cont;
		}

		// Datos totales de fila, mujeres + hombres
		if ($ver_nombres) $array_tabla[$i-1][$n_sexos + 1] = ""; 
		$suma = 0;
		for ($k = 1; $k <= $n_sexos; $k++) {	// Suma horizontal
			$suma = $suma + $array_tabla[$i][$k];
		}
		$array_tabla[$i][$n_sexos + 1] = $suma; 

		// Suma vertical: Totales de columna
		for ($l = 1; $l <= $n_sexos + 1; $l++) {   // 
			$total[$l] = $total[$l] + $array_tabla[$i][$l];
		}

		// Incrementa $i de forma diferente según es con nombres o no.
		$i = ($ver_nombres) ? $i+2 : $i+1;
	}

	$array_tabla[$i][0] = "TOTAL";
	for ($m = 1; $m <= $n_sexos + 1; $m++) {
		$array_tabla[$i][$m] = $total[$m];
	}	

	$cabeceras = array(0 => "") + $array_sexo + array(($n_sexos +1) => "Total");
	$item = $item_persona;
	escribeTabla($titulo, $cabeceras, $array_tabla, $item);
	return $array_tabla;
}


/** 
*  Función para leer todos los datos de los motivos   
*  Es una función específica para ese item, ya que utiliza una tabla diferente de MySql
*/
function leerSalida($n, $fecha, $servicio) {
	global $db; 
	global $ver_nombres;
	global $debug;

	define ("NUM_COLUMNAS", 3); 

	$col = $n * NUM_COLUMNAS;
	$array_sexo = array(1 => "Mujer", 2 => "Hombre");    // define los sexos
	$n_sexos = count($array_sexo);

	// inicializa variable $total para los totales verticales
	for ($m = 1; $m <= $n_sexos + 1; $m++) {   
		$total[$m] = 0;
	}

	$lista_despl = $db->desplegable('despl_salida'); 
	$i = 2;	// Esta variable representa la fila de la tabla

	foreach ($lista_despl as $id => $motivo) {

		// Descripción del item
		$array_tabla[$i][0] = $motivo;

		/* 
		*  Realiza este bucle para cada columna (sexo)
		*/

		foreach ($array_sexo as $key_sexo => $sexo) {
			$query = "SELECT ab.id_unico, p.nombre, p.apellido1, ab.fecha, ab.fecha_correl 
				FROM alta_baja ab LEFT JOIN persona p ON (ab.id_unico = p.id_unico)
				WHERE p.historial = 'actual' AND p.sexo = ".$key_sexo." AND ab.motivo_baja = ".$id." AND ab.servicio = '".$servicio."'
				AND ( ( ab.alta_baja = 'x' AND ab.fecha_correl > '".$fecha[0]."' AND ab.fecha <= '".$fecha[1]."' ) 
				OR ( ab.alta_baja = 'a' AND ab.fecha <= '".$fecha[1]."' ) ) ;";
//			echo "<br>Query motivo: ".$query; 
			$lista_motivo = $db->lista_query($query); 
//			echo "<pre>"; print_r($lista_motivo); echo "</pre>"; 
			$cont = 0; 
			foreach ($lista_motivo as $key => $motivo) {
//				$persona = $db->leer_persona($id_unico); 
				if ($ver_nombres) $array_tabla[$i-1][$key_sexo] .= $motivo['nombre']." ".$motivo['apellido1']."<br>";
				$cont++; 
			}
			$array_tabla[$i][$key_sexo] = $cont;
		}

		// Obtener totales
		// Datos totales de fila, mujeres + hombres
		if ($ver_nombres) $array_tabla[$i-1][$n_sexos + 1] = ""; 
		$suma = 0;
		for ($k = 1; $k <= $n_sexos; $k++) {	// Suma horizontal
			$suma = $suma + $array_tabla[$i][$k];
		}
		$array_tabla[$i][$n_sexos + 1] = $suma; 

		// Suma vertical: Totales de columna
		for ($l = 1; $l <= $n_sexos + 1; $l++) {   // 
			$total[$l] = $total[$l] + $array_tabla[$i][$l];
		}

		// Incrementa $i de forma diferente según es con nombres o no.
		$i = ($ver_nombres) ? $i+2 : $i+1;
		$cont_tabla++;

	}

	$array_tabla[$i][0] = "TOTAL";
	for ($m = 1; $m <= $n_sexos + 1; $m++) {
		$array_tabla[$i][$m] = $total[$m];
	}	

	$cabeceras = array(0 => "") + $array_sexo + array(($n_sexos +1) => "Total");
	$item = $item_persona;
	echo "<i><br>NOTA SOBRE LOS MOTIVOS DE LA SALIDA: <br>Algunas personas pueden aparecer repetidas, ya que es posible que tengan varias altas y bajas en el intervalo temporal pedido</i>"; 
	escribeTabla("Motivos de la salida", $cabeceras, $array_tabla, $item);
	return $array_tabla;
}






/*************************************************************************************************************************************
*   Primero crea un array ($array_tl) con la lista de las personas que han participado en la actividad 7 en determinadas fechas
*/


include_once "../clases/class.leer_mysqli.php"; 

	$i = 0;

	$debug = true; 

	$nombre_tabla[0] = "actividad"; 

	$ver_nombres=true; 

	$n = 0;    // $n es el conjunto de columnas Mujer-Hombre-total; puede repetirse n veces ese conjunto


	$servicio=array("centroDia","berrisar","protegido",
			"santutxu","hiritar","prisionValores",
			"prisionEntrev","parteHartzen","document",
			"acompSocial","fol","seguimiento", "trabsoc", "general");

	$datos_items = array(
		"area" =>  "Nacionalidad",
		"edad"  =>   "Edad",  
		"estado_civil" =>  "Estado civil",
		"nucleo_conv"  => "Nucleo convivencia",
		"poblacion"  =>  "Poblacion vivienda actual",
		"poblacion_padron"  =>   "Poblacion padrón actual",
		"DatosFormativosItem"  =>  "Nivel estudios",
		"NivelCastellano"  =>  "Nivel de castellano",
		"Trabaja"  =>  "Trabajo",
		"AnosConsumo"  =>  "Años consumo",
		"ConsumoPrinc"  =>  "Consumo Principal",
		"EnfMentalTratamiento"  =>  "Centro de tratamiento",
		"TratamientoTipo"  =>  "Tipo de tratamiento",
		"procedencia_demanda_lista"  =>  "Procedencia de la demanda",
		"ingresos" => "Ingresos",
		"enferm" => "Enfermedades", 
		"penal" => "Penales",
		"tratam" => "Tratamientos"
	);

	$datos = array_keys($datos_items); 


	echo "<head></head><body style='background-color: beige'>";
	echo "<div id='resultados_tl'>";
	echo "<h2>Datos de Tiempo Libre</h2>";
	echo "<form name='opciones' id='opciones' action='".$_SERVER['PHP_SELF']."' method='post'>\n";
	echo "<br>Fecha inicio: <input type='text' name='fecha_0' > &nbsp; &nbsp\n";
	echo "Fecha fin: <input type='text' name='fecha_1' >\n";
	echo "<br>(Formato de fecha: dia/mes/año) (Por defecto: año 2010)";
	echo "<p></p>Campos a mostrar: (si no se escoge ninguno se mostrarán todos)<br>";
	echo "<br><select name='datos[]' MULTIPLE>\n"; 
	foreach ($datos_items as $campo => $nombre_campo) {
		echo "<option value='".$campo."'>".$nombre_campo."</option>\n";
	}
	echo "</select><br><br>";
	echo "<br>Estadísticas con nombre o solamente numéricas.<br>\n"; 
	echo "<br><input type='submit'  name='con_nombre'  value='Con nombres'>&nbsp; &nbsp\n";
	echo "<input type='hidden' name='enviado' value='enviado'>\n";
	echo "<input type='submit'  name='sin_nombre'  value='Sin nombres'><p></p>\n";
	echo "</form></div>";

	if (isset($_POST['enviado'])) {

		if ($debug) echo "<br>Enviado";

		//  Da un valor a $ver_nombres según lo pedido en el formulario
		if ($_POST['con_nombre'] != "") $ver_nombres=true;
		if ($_POST['sin_nombre'] != "") $ver_nombres=false;
		

		/***************************************
		*  
		*  PRIMERA PARTE:
		*  Crea una tabla auxiliar: actividad_max, con los id_pers con fecha máxima, 
		*  de los id_unico que han participado en las actividades
		*
		***************************************/


	$db = new Leer_Mysqli(); 
	$db->crea_aux_actividad();


/*	
//	echo $query_tot; 
	$i = 0;
	$result_tl = mysql_query($query_tl, $conexion); 
	while($row_tl = mysql_fetch_array($result_tl, MYSQL_BOTH)) {
		$array_tl[$i++] = $row_tl;
		$query_max = "INSERT INTO actividad_max (SELECT * FROM persona 
			WHERE id_unico = ".$row_tl['persona']." AND insert_fecha =  
			(SELECT max(insert_fecha) FROM persona WHERE id_unico = ".$row_tl['persona'].") 
			ORDER BY id_pers DESC LIMIT 1)";
//		echo "<br>query_max: ".$query_max;
		$result_max = mysql_query($query_max, $conexion); 
	}

//	escribeTabla("Participantes: ", array("veces", "persona"), $array_tl, "participantes");

//	echo "<pre>"; 
//	print_r($array_tl); 
//	echo "</pre>"; 

*/
/***************************************
*  
*  SEGUNDA PARTE:
*  Mostrar por pantalla los datos desagregados, a partir de la tabla creada
*
***************************************/


	$todos = 'on'; 
/*	$datos = array(""); 
	$n = 0;
	$fecha[0] = '2000-00-00';  // datos inútiles
*/

//	echo "<pre>"; print_r($datos); echo "</pre>";
		/*
		 * Crea todos los cuadros uno por uno 
		*/
		if (in_array("area", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Nacionalidad", "despl_aux_area", "area");    
		if (in_array("edad", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Edad", "despl_aux_edad", "edad");          
		if (in_array("estado_civil", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Estado civil", "estado_civil", "estado_civil");
		if (in_array("nucleo_conv", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Nucleo convivencia", "despl_nucleoconv", "nucleo_conv");
		if (in_array("poblacion", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Poblacion vivienda actual", "poblaciones", "poblacion");
		if (in_array("poblacion_padron", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Poblacion padrón actual", "poblaciones", "poblacion_padron");
		if (in_array("DatosFormativosItem", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Nivel estudios", "despl_estudios", "DatosFormativosItem");
		if (in_array("NivelCastellano", $datos) || ($todos == 'on')) 
			leerListaDespl($n,"Nivel de castellano", "despl_idioma", "NivelCastellano");
		if (in_array("Trabaja", $datos) || ($todos == 'on')) 
			leerListaDespl($n,"Trabajo", "despl_trabaja", "Trabaja");
		if (in_array("AnosConsumo", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Años consumo", "despl_anosconsumo", "AnosConsumo");
		if (in_array("ConsumoPrinc", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Consumo Principal", "despl_consumoprinc", "ConsumoPrinc");
		if (in_array("EnfMentalTratamiento", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Centro de tratamiento", "despl_centrotrat", "EnfMentalTratamiento");
		if (in_array("TratamientoTipo", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Tipo de tratamiento", "despl_tipotrat", "TratamientoTipo");
		if (in_array("procedencia_demanda_lista", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Procedencia de la demanda", "despl_demanda", "procedencia_demanda_lista");  
		if (in_array("ingresos", $datos) || ($todos == 'on')) {
			$checkboxes[0] = array("persona" => "IngresosPropios", "titulo" => "Propios");
			$checkboxes[1] = array("persona" => "IngresosPnc", "titulo" => "Pensión no Contributiva");
			$checkboxes[2] = array("persona" => "IngresosOtros", "titulo" => "Otros");
			$checkboxes[3] = array("persona" => "IngresosNomina", "titulo" => "Nómina");
			$checkboxes[4] = array("persona" => "IngresosRentaBas", "titulo" => "Renta Garantía de Ingresos");
			$checkboxes[5] = array("persona" => "IngresosPrestContrib", "titulo" => "Prestación Contributiva");
			$checkboxes[6] = array("persona" => "IngresosSeDesconoce", "titulo" => "Desconocidos");
			$checkboxes[7] = array("persona" => "IngresosAyudaIndividual", "titulo" => "Ayuda Individual");
			$checkboxes[8] = array("persona" => "IngresosAyudaFamiliar", "titulo" => "Ayuda Familiar");
			$checkboxes[9] = array("persona" => "IngresosNo", "titulo" => "Sin Ingresos");
			leerItem($n, "Ingresos", $checkboxes);
			unset($checkboxes);
		}
		if (in_array("enferm", $datos) || ($todos == 'on')) {
			$checkboxes[0] = array("persona" => "Toxicomania", "titulo" => "Toxicomanía");
			$checkboxes[1] = array("persona" => "Autonomia", "titulo" => "Persona autónoma");
			$checkboxes[2] = array("persona" => "EnfermedadMental", "titulo" => "Enfermedad mental");
			$checkboxes[3] = array("persona" => "VIH", "titulo" => "VIH");
			$checkboxes[4] = array("persona" => "Hepatitis", "titulo" => "Hepatitis");
	 		leerItem($n, "Situación sanitaria", $checkboxes);
			unset($checkboxes);
		}
		if (in_array("penal", $datos) || ($todos == 'on')) {
			$checkboxes[0] = array("persona" => "PenalAntecedentesPrision", "titulo" => "Antecedentes Prisión");
			$checkboxes[1] = array("persona" => "PenalCausasPendientes", "titulo" => "Causas pendientes");
			$checkboxes[2] = array("persona" => "PenalMedidaSeguridad", "titulo" => "Medidas de seguridad");
			$checkboxes[3] = array("persona" => "PenalLibCondicional", "titulo" => "Libertad Condicional");
			$checkboxes[4] = array("persona" => "PenalPermisoPenitenc", "titulo" => "Permiso penitenciario");
			$checkboxes[5] = array("persona" => "PenalTercerGrado", "titulo" => "Tercer grado");
		 	leerItem($n, "Situación judicial", $checkboxes);
			unset($checkboxes);
		}
		if (in_array("tratam", $datos) || ($todos == 'on')) {
			$checkboxes[0] = array("persona" => "Tratamiento", "titulo" => "Tratamiento");
		 	leerItem($n, "Tratamiento médico", $checkboxes);
			unset($checkboxes);
		}
		if (in_array("salida", $datos) || ($todos == 'on')) {
		 	leerSalida($n, $fecha, $servicio);
		}

/*		if (in_array("motivo_salida", $datos) || ($todos == 'on')) 
			$motivo_salida = "ms_".$servicio; 
			leerListaDespl($n, $fecha[$n], "Motivo de la salida", "despl_salida", $motivo_salida); 
*/	





include "cerrar_conexion.php";

	$db->elimina_aux(); 
	$db->cerrar_conexion(); 

}


?>
