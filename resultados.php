<?php
/**
 * Creación de cuadros con datos estadísticos
 *
 */

include_once "config.php"; 
include_once "include/fechas.php"; 
include_once "include/array_a_csv.php"; 
//include_once "include/auxiliar3.php"; 
include_once "include/array_a_tabla.php"; 
include_once "clases/class.leer_mysqli.php"; 
include_once "headers.php";
header_principal("resultados"); 


function serializar($array) {
	$array = serialize($array); 
	$array = urlencode($array); 
	return $array;
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

			if ($ver_nombres) {
				$array_tabla[$i-1][0] = "";
				$array_tabla[$i-1][$key ] = ""; 
				foreach ($datos[$j++] as $nom) {
					$array_tabla[$i-1][$key ] .= $nom['nombre']." ".$nom['apellido1']."<br>\n";
					$cont++;
				}
			}
			$array_tabla[$i][$key ] = $cont;
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
	displayTable($titulo, $cabeceras, $array_tabla, $item_persona);

	// Saca de la lista $array_comp_aux los que aparecen en el cuadro y la imprime en pantalla: tabla 'Faltan'
	echo "Faltan: ";
	foreach ($array_comp_aux as $key => $valor) {
		if ($valor <> "") echo "<br>\n<a href='persona.php?load=".$key."'>".$key." - ".$valor."</a>";
	}
//	echo "<pre>"; print_r($array_tabla); echo "</pre>";
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

	$lista_despl = $db->desplegable('salida'); 
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
				OR ( ab.alta_baja = 'a' AND ab.fecha <= '".$fecha[1]."' ) );";
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








/*************************************************************************
*
* Aquí empieza el programa principal 
*
*/

	$lista_personas = array( 76 ,185 ,2096  ,2205 ,2212  ,2314  ,2471  ,2536  ,2558  ,2577 ,2616  ,2622  ,2623  ,2641);

	$debug = 0; 		///////////////////////   DEBUG LOG IGUAL A CERO PARA QUE SAQUE NOTIFICACIONES Y -1 PARA QUE NO SAQUE
	$fecha[0]="1/1/2018";   // Fecha inicial por defecto
	$fecha[1]="31/12/2018";   // Fecha final por defecto (si se ha rellenado la inicial pero la final no, entonces la final quedará en blanco)
	$servicio_array = $AUX->servicio; 
	$datos_items = $AUX->datos_items;
	$ver_nombres=true; 
	$n = 0;    // $n es el conjunto de columnas Mujer-Hombre-total; puede repetirse n veces ese conjunto

	echo "<head></head><body style='background-color: beige'>";


	if (isset($_POST['fecha_0'])) {			// Solamente se ejecuta si se ha puesto alguna fecha inicial
 
		//  Valores recogidos del formulario
		if ($_POST['con_nombre'] != "") $ver_nombres=true;
		if ($_POST['sin_nombre'] != "") $ver_nombres=false;
		$servicio = (isset ($_POST['servicio'])) ? $_POST['servicio'] : "0"; 
		$todos = (isset($_POST['todos'])) ? $_POST['todos'] : "on";
		$datos = $_POST['datos']; 



		$busca_por_item = ($_POST['por_item_toxicomania'] != "") ? "Toxicomania" : NULL;
		$busca_por_lista = ($_POST['por_lista_personas'] != "") ? $lista_personas : array();

		echo "<div id='resultados_lista'>";


		/*	
		*   Cambia fecha[0] y fecha [1] si hay una propuesta diferente de fecha, por medio del formulario
		*/
		if ((isset($_POST['fecha_0'])) && ( $_POST['fecha_0'] <> "" )) {   // si la primera fecha está puesta como POST...
			$fecha[0] = fecha_txt_sql($_POST['fecha_0']);  
			if ((isset($_POST['fecha_1'])) && ( $_POST['fecha_1'] <> "" )) {   // ... y la segunda también ...
				$fecha[1] = fecha_txt_sql($_POST['fecha_1']);  // ... se ponen las dos fechas enviadas; 
				echo "<h1>Intervalo: de ".$fecha[0]." a ".$fecha[1]."</h1>";
			} else 							// ... pero si la segunda no está puesta, ...
				$fecha[1] = "";					//  ... entonces la segunda fecha es "", ... 
				echo "<h1>Fecha: ".$fecha[0]."</h1>";
		} else {
			$fecha[0] = fecha_txt_sql($fecha[0]);		// ... pero si inicialmente no está enviada ninguna de ambas, 	
			$fecha[1] = fecha_txt_sql($fecha[1]);		// ... entonces ambas son las iniciales por defecto. 
			echo "<h1>Intervalo: de ".$fecha[0]." a ".$fecha[1]."</h1>";
		}


		/*
		 * Crea una array con todas las personas de ese intervalo para un determinado servicio 
		 * y crea también una tabla para ir tachando y que queden solamente los usuarios que no aparecen en un item
		 */
		$db = new Leer_Mysqli(); 
		$array_ab = $db->crea_aux($fecha[0], $fecha[1], $servicio, $busca_por_item,  $busca_por_lista, 1); 
		$array_result = $db->lista_query("SELECT * FROM aux ORDER BY nombre"); 


		foreach ($array_result as $pers) {
			$array_tot[] = array($pers['id_unico'], $pers['nombre'], $pers['apellido1'], $pers['apellido2']);
			$array_comprobar[$pers['id_unico']] = $pers['nombre']." ".$pers['apellido1']." ".$pers['apellido2']; 	
		}
		$array_tot[] = array("Total", sizeof($array_tot), ""); 


		/*
		* Escribe la tabla en pantalla; es la tabla inicial con todas las personas de ese servicio y ese intervalo
		*/
		$titulo  = "<h1>Datos de todas las personas del intervalo</h1>";
		$cabeceras = array("Id", "Nombre","Apellido 1", "Apellido 2");
		displayTable($titulo, $cabeceras, $array_tot, "personas_intervalo"); 


		/*
		 * Crea todos los cuadros uno por uno 
		*/
		if (in_array("area", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Nacionalidad", "aux_area", "area");    
		if (in_array("edad", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Edad", "aux_edad", "edad");          
		if (in_array("estado_ivil", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Estado civil", "estado_civil", "estadoCivil"); //////////
		if (in_array("nucleo_conv", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Nucleo convivencia", "nucleoconv", "nucleoConv");
		if (in_array("poblacion", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Poblacion vivienda actual", "poblaciones", "poblacion");/////////
		if (in_array("poblacion_padron", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Poblacion padrón actual", "poblaciones", "poblacionPadron");////////
		if (in_array("DatosFormativosItem", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Nivel estudios", "estudios", "nivelFormativo");
		if (in_array("NivelCastellano", $datos) || ($todos == 'on')) 
			leerListaDespl($n,"Nivel de castellano", "idioma", "NivelCastellano");
		if (in_array("Trabaja", $datos) || ($todos == 'on')) 
			leerListaDespl($n,"Trabajo", "trabaja", "Trabaja");
		if (in_array("AnosConsumo", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Años consumo", "anosconsumo", "AnosConsumo");
		if (in_array("ConsumoPrinc", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Consumo Principal", "consumoprinc", "ConsumoPrinc");
		if (in_array("EnfMentalTratamiento", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Centro de tratamiento", "centrotrat", "EnfMentalTratamiento");
		if (in_array("TratamientoTipo", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Tipo de tratamiento", "tipotrat", "TratamientoTipo");
		if (in_array("procedencia_demanda_lista", $datos) || ($todos == 'on')) 
			leerListaDespl($n, "Procedencia de la demanda", "demanda", "procedenciaDemandaLista");  
		if (in_array("ingresos", $datos) || ($todos == 'on')) {
			$checkboxes[0] = array("persona" => "IngresosPropios", "titulo" => "Propios");
			$checkboxes[1] = array("persona" => "IngresosPnc", "titulo" => "Pensión no Contributiva");
			$checkboxes[2] = array("persona" => "IngresosOtros", "titulo" => "Otros");
			$checkboxes[3] = array("persona" => "IngresosNomina", "titulo" => "Nómina");
			$checkboxes[4] = array("persona" => "IngresosRGI", "titulo" => "Renta Garantía de Ingresos");
			$checkboxes[5] = array("persona" => "IngresosPrestContrib", "titulo" => "Prestación Contributiva");
			$checkboxes[6] = array("persona" => "IngresosSeDesconoce", "titulo" => "Desconocidos");
			$checkboxes[7] = array("persona" => "IngresosAyudaIndividual", "titulo" => "Ayuda Individual");
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
		echo "</div>";
		echo "</body>";

		$db->elimina_aux(); 
		$db->cerrar_conexion(); 


	} else {   // Fin del 'if isset'



	echo "<div id='resultados_opc'>";
	echo "<h2>Datos estadísticos</h2>";
	if ($izaskun) echo "<br><h2>Provisionalmente los datos salen solamente para Hiritar</h2>";   /////////////////////////////////////////
	if ($izaskun) echo "<br><strong><a href='include/usar_sql.php'>Pincha aquí para ver la lista con fecha de entrada y salida</a></strong>";    //////////////////////
	echo "<form name='opciones' id='opciones' action='".$_SERVER['PHP_SELF']."' method='post'>\n";
	echo "<br>Fecha inicio: <input type='text' name='fecha_0' > &nbsp; &nbsp\n";
	echo "Fecha fin: <input type='text' name='fecha_1' >\n";
	echo "<br>(Formato de fecha: dia/mes/año) (Por defecto: año 2018)";
	echo "<br><br>Recurso: &nbsp; &nbsp<select name='servicio'>\n"; 
	foreach ($servicio_array as $key => $serv) {
		echo "<option value='".$key."'>".$serv."</option>\n";
	}
	echo "</select><br><br>";
	echo "<p></p>Campos a mostrar: (si no se escoge ninguno se mostrarán todos)<br>";
	echo "<br><select name='datos[]' MULTIPLE>\n"; 
	foreach ($datos_items as $campo => $nombre_campo) {
		echo "<option value='".$campo."'>".$nombre_campo."</option>\n";
	}
	echo "</select><br><br>";
	echo "<br>Estadísticas con nombre o solamente numéricas.<br>\n"; 
	echo "<br><input type='submit'  name='con_nombre'  value='Con nombres'>&nbsp; &nbsp\n";
	echo "<input type='submit'  name='sin_nombre'  value='Sin nombres'><p></p>\n";
	echo "<br>Estadísticas de personas con algún elemento activo:<br>";
	echo "<br><input type='submit'  name='por_item_toxicomania'  value='Toxicomanía'>&nbsp; &nbsp\n";	
	echo "<br>Estadísticas de personas de una lista determinada:<br>";
	echo "<br><input type='submit'  name='por_lista_personas'  value='Lista personas'>&nbsp; &nbsp\n";	
	echo "</form></div>";  // div resultados_opc

	echo ""; 

	}


?>
