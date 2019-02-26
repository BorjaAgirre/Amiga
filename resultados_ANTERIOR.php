<?php
/**
 * Creación de cuadros con datos estadísticos
 *
 */

include "config.php"; 
include "include/fechas.php"; 
include "include/array_a_csv.php"; 
include "include/auxiliar3.php"; 
include "include/array_a_tabla.php"; 
include "headers.php";
header_principal("resultados"); 


function serializar($array) {
	$array = serialize($array); 
	$array = urlencode($array); 
	return $array;
}


function escribeTabla($titulo, $cabeceras, $array_tabla, $item) {	
	global $n;
	global $debug_log; 
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
function datos($columna, $sexo, $campo_a_revisar, $valor1, $valor2) {
		$conexion=  $GLOBALS["conexion"];
		$nombre_tabla=  $GLOBALS["nombre_tabla"];
		$fecha=  $GLOBALS["fecha"];
		global $izaskun;   ///////////////////// provisional listas 2011
		global $servicio; 
		global $debug_log; 
		global $array_comprobar;  // Esta es la tabla fija con los id y los nombres 
		global $array_comp_aux;   // esta es la tabla que se utiliza en cada bucle
/*
		$z=0;
		if ($z < 3) {	
			echo "campo: ". $campo_a_revisar." - valor: ".$valor1." - sexo: ".$sexo;
			echo "<pre>";
			print_r($array_comp_aux); 
			echo "</pre>";
		}
		$z++;
*/
		$fecha_comparar = $fecha[$columna];
		$tabla = $nombre_tabla[$columna];
//		echo "<br>Nombre tabla: ".$tabla;  //////////////////////////////////////////////////



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

		if ($debug_log >= 0) {
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
			if (($campo_a_revisar == $debug_revisar) && ($debug_log >= 0)) {	// debug
				echo "<br>cont: ".$cont." - id_pers: ".$row['id_pers']." - id_unico: ".$row['id_unico']." - row insert_fecha: "
				.$row['insert_fecha']." - array insert_fecha: ".$array_datos[$cont]['insert_fecha'] ;  /////////////////////////
			}
			$array_comp_aux[$row['id_unico']] = ""; 	// Vamos tachando los que aparecen
		}
		return $array_datos; 
}


/** Función para leer todos los datos de una lista desplegable, automáticamente, mediante un bucle 
*  - lee datos por sexo, usando la función datos()
*  - hace los totales
*  - crea una tabla
*  - muestra por pantalla
*/
function leerListaDespl($n, $fecha, $titulo, $item_despl, $item_persona) {
	global $izaskun;   ////////// provisional listas 2011
	global $AUX; 
	global $debug_log;
	global $servicio; 
	global $ver_nombres; 
	global $atributos_tabla, $atributos_titulo, $atributos_linea;
	global $array_comprobar; 
	global $array_comp_aux;
	$array_comp_aux = $array_comprobar;

	define ("NUM_COLUMNAS", 3); 
	$conexion=  $GLOBALS["conexion"];

	$col = $n * NUM_COLUMNAS;

	$array_sexo = array(1 => "Mujer", 2 => "Hombre");    // define los sexos
	$n_sexos = count($array_sexo);

	for ($m = 1; $m <= $n_sexos + 1; $m++) {   // inicializa variable $total para los totales verticales
		$total[$m] = 0;
	}
	
	$query1= "SELECT * FROM ".$item_despl." ";
	$result1=mysql_query($query1, $conexion);

	/////////////////////////   ARREGLAR: 'Edad' no debería leerse de la base de datos, está en un $AUX->


	$cont_tabla = 0;
	while($row1=mysql_fetch_array($result1,MYSQL_BOTH)){ 
			
		// Se crea la tabla $array_tabla[fila][columna], donde la columna es: 
		// 0: descripción del item
		// 1: mujer
		// 2: hombre
		// 3: total

		// Definición de los valores $valor1 y $valor2; para los casos de 'edad' son diferentes.
		switch ($item_persona) {
			
			// Para 'edad' hay dos valores por grupo, uno mínimo y uno máximo, se guardan en la tabla despl_aux_edad
			case "edad":
				$valor1 = $AUX->aux['edad'][$cont_tabla][2];
				$valor2 = $AUX->aux['edad'][$cont_tabla][3];

//				$valor1 = $row1[2];
//				$valor2 = $row1[3];				
				break; 
			
			// Para todos los demás valores, el valor a comparar es el id de la tabla de desplegable
			// o en el caso de agrupaciones (ej: 'area'), el id de la tabla de desplegable auxiliar (ej: despl_aux_area)
			default:
				$valor1 = $row1[0];
				$valor2 = 0;
				break;
		}
			
		// Descripción del item
		$array_tabla[$i][0] = $row1[1];
 
		$j = 0;

		// Obtiene los datos para cada uno de los sexos definidos en el array $array_sexo
		foreach ($array_sexo as $key => $valor) {
			// Datos mujer para un valor determinado de la tabla desplegable
  			$datos[$j]=datos($n, $key, $item_persona, $valor1, $valor2);
			$cont = 0;
			if ($ver_nombres) $array_tabla[$i-1][$key] = ""; 
			foreach ($datos[$j++] as $nom) {
				if ($ver_nombres) $array_tabla[$i-1][$key] .= $nom['nombre']." ".$nom['apellido1']."<br>";
				$cont++;
			}
		$array_tabla[$i][$key] = $cont;

		}

		//
		// Obtener totales
		//
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
	escribeTabla($titulo, $cabeceras, $array_tabla, $item);

	// Saca la lista de los que no aparecen en el cuadro, para consultar
	echo "Faltan: ";
	foreach ($array_comp_aux as $key => $valor) {
		if ($valor <> "") echo "<br>\n<a href='persona.php?load=".$key."'>".$key." - ".$valor."</a>";
	}
	return $array_tabla;
}


/** Función para leer todos los datos de una serie de items, agrupados en el array $opciones  */
function leerItem($n, $fecha, $titulo, $opciones) {
	$conexion=  $GLOBALS["conexion"];
	global $ver_nombres;
	global $debug_log;
	global $atributos_tabla, $atributos_titulo, $atributos_linea;
	$n = $n * NUM_COLUMNAS;

	$array_sexo = array(1 => "Mujer", 2 => "Hombre");    // define los sexos
	$n_sexos = count($array_sexo);

	for ($m = 1; $m <= $n_sexos + 1; $m++) {   // inicializa variable $total para los totales verticales
		$total[$m] = 0;
	}

	foreach ($opciones as $item) {
			
		// Descripción del item
		$array_tabla[$i][0] = $item['titulo'];

		$j = 0;

		// Obtiene los datos para cada uno de los sexos definidos en el array $array_sexo
		foreach ($array_sexo as $key => $valor) {
			// Datos mujer para un valor determinado de la tabla desplegable
  			$datos[$j]=datos($n, $key, $item['persona'], 1, 0);
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


/*************************************************************************
*
* Aquí empieza el programa principal 
*
*/

	if ((isset($_POST['izaskun'])) && ($_POST['izaskun'] == 'true')) {
		$izaskun = true; 
	} else {
		$izaskun = false; 
	}

	$debug_log = -1; 		///////////////////////   DEBUG LOG IGUAL A CERO PARA QUE SAQUE NOTIFICACIONES Y -1 PARA QUE NO SAQUE

	$fecha[0]="1/1/2012";   // Fecha inicial por defecto
	$fecha[1]="31/12/2012";   // Fecha final por defecto (si se ha rellenado la inicial pero la final no, entonces la final quedará en blanco)

	$nombre_tabla[0]="copia_1";
//	$nombre_tabla[1]="copia_2";
//	$nombre_tabla[3]="copia_3";

	$ver_nombres=true; 

	$n = 0;    // $n es el conjunto de columnas Mujer-Hombre-total; puede repetirse n veces ese conjunto


	$servicio_array = $AUX->servicio; 

	$datos_items = $AUX->datos_items;

	/* echo "<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>";    */

	echo "<head></head><body style='background-color: beige'>";


	
	if (isset($_POST['fecha_0'])) {

		//  Da un valor a $ver_nombres según lo pedido en el formulario
		if ($_POST['con_nombre'] != "") $ver_nombres=true;
		if ($_POST['sin_nombre'] != "") $ver_nombres=false;
		echo "<div id='resultados_lista'>";

		// Cambia fecha[0] y fecha [1] si hay una propuesta diferente de fecha, por medio del formulario
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


		$servicio = (isset ($_POST['servicio'])) ? $_POST['servicio'] : "centroDia"; 
		$todos = (isset($_POST['todos'])) ? $_POST['todos'] : "on";
		$datos = $_POST['datos']; 

		/*
		 * Crea una tabla auxiliar principal, en la que se dan valores 0 o 1 a los diferentes campos 'activo_servicio'
		 *  de tal forma que sabemos si en esa fecha o intervalo una persona ha estado activa.
		 */
		include "conexion.php";

		// Crea la tabla auxiliar 
		destruye_copia($nombre_tabla[0]);
		fotografia_auxiliar($nombre_tabla[0], $fecha[0], $fecha[1]);



		/*
		 * Crea una tabla con todas las personas de ese intervalo para un determinado servicio y la muestra en pantalla
		 */
		
		// Hace un query con las personas de la tabla que están activas en ese servicio
		if ($izaskun) {
			$query_tot = "SELECT id_unico as Id, nombre, apellido1, apellido2 FROM auxiliar_izaskun3 ORDER BY apellido1";
		} else {
			$query_tot = "SELECT id_unico as Id, nombre, apellido1, apellido2 FROM ".$nombre_tabla[0]." WHERE activo_".$servicio." = 1 
				GROUP BY id_unico ORDER BY apellido1";
		}
		if ($debug_log >= 0) {
			echo $query_tot; 
		}

		$result_tot = mysql_query($query_tot, $conexion); 
		$i = 0;

		// Crea la $array_tot con los resultados del query
		while($row_tot = mysql_fetch_array($result_tot, MYSQL_BOTH)) {
			$array_tot[$i++] = $row_tot;
			$array_comprobar[$row_tot['Id']] = $row_tot['nombre']." ".$row_tot['apellido1']." ".$row_tot['apellido2']; 	
			// array para hacer comprobaciones de qué personas faltan en cada cuadro
		}
		$array_tot[$i] = array("Total", $i, ""); 

		// Escribe la tabla en pantalla 
		$titulo  = "<h1>Datos de todas las personas del intervalo</h1>";
		$cabeceras = array("Id", "Nombre","Apellido 1", "Apellido 2");
		escribeTabla($titulo, $cabeceras, $array_tot, "personas_intervalo"); 



		/*
		 * Crea todos los cuadros uno por uno 
 		*/


		//	echo "<pre>"; print_r($datos); echo "</pre>";
		if (in_array("area", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Nacionalidad", "despl_aux_area", "area");    
		if (in_array("edad", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Edad", "despl_aux_edad", "edad");          
		if (in_array("estado_civil", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Estado civil", "estado_civil", "estado_civil");
		if (in_array("nucleo_conv", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Nucleo convivencia", "despl_nucleoconv", "nucleo_conv");
		if (in_array("poblacion", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Poblacion vivienda actual", "poblaciones", "poblacion");
		if (in_array("poblacion_padron", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Poblacion padrón actual", "poblaciones", "poblacion_padron");
		if (in_array("DatosFormativosItem", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Nivel estudios", "despl_estudios", "DatosFormativosItem");
		if (in_array("NivelCastellano", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Nivel de castellano", "despl_idioma", "NivelCastellano");
		if (in_array("Trabaja", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Trabajo", "despl_trabaja", "Trabaja");
		if (in_array("AnosConsumo", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Años consumo", "despl_anosconsumo", "AnosConsumo");
		if (in_array("ConsumoPrinc", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Consumo Principal", "despl_consumoprinc", "ConsumoPrinc");
		if (in_array("EnfMentalTratamiento", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Centro de tratamiento", "despl_centrotrat", "EnfMentalTratamiento");
		if (in_array("TratamientoTipo", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Tipo de tratamiento", "despl_tipotrat", "TratamientoTipo");
		if (in_array("procedencia_demanda_lista", $datos) || ($todos == 'on')) 
			leerListaDespl($n, $fecha[$n], "Procedencia de la demanda", "despl_demanda", "procedencia_demanda_lista");  
		if (in_array("ingresos", $datos) || ($todos == 'on')) {
			$opciones[0] = array("persona" => "IngresosPropios", "titulo" => "Propios");
			$opciones[1] = array("persona" => "IngresosPnc", "titulo" => "Pensión no Contributiva");
			$opciones[2] = array("persona" => "IngresosOtros", "titulo" => "Otros");
			$opciones[3] = array("persona" => "IngresosNomina", "titulo" => "Nómina");
			$opciones[4] = array("persona" => "IngresosRentaBas", "titulo" => "Renta Garantía de Ingresos");
			$opciones[5] = array("persona" => "IngresosPrestContrib", "titulo" => "Prestación Contributiva");
			$opciones[6] = array("persona" => "IngresosSeDesconoce", "titulo" => "Desconocidos");
			$opciones[7] = array("persona" => "IngresosAyudaIndividual", "titulo" => "Ayuda Individual");
			$opciones[8] = array("persona" => "IngresosAyudaFamiliar", "titulo" => "Ayuda Familiar");
			$opciones[9] = array("persona" => "IngresosNo", "titulo" => "Sin Ingresos");
			leerItem($n, $fecha[$n], "Ingresos", $opciones);
			unset($opciones);
		}
		if (in_array("enferm", $datos) || ($todos == 'on')) {
			$opciones[0] = array("persona" => "Toxicomania", "titulo" => "Toxicomanía");
			$opciones[1] = array("persona" => "Autonomia", "titulo" => "Persona autónoma");
			$opciones[2] = array("persona" => "EnfermedadMental", "titulo" => "Enfermedad mental");
			$opciones[3] = array("persona" => "VIH", "titulo" => "VIH");
			$opciones[4] = array("persona" => "Hepatitis", "titulo" => "Hepatitis");
	 		leerItem($n, $fecha[$n], "Situación sanitaria", $opciones);
			unset($opciones);
		}
		if (in_array("penal", $datos) || ($todos == 'on')) {
			$opciones[0] = array("persona" => "PenalAntecedentesPrision", "titulo" => "Antecedentes Prisión");
			$opciones[1] = array("persona" => "PenalCausasPendientes", "titulo" => "Causas pendientes");
			$opciones[2] = array("persona" => "PenalMedidaSeguridad", "titulo" => "Medidas de seguridad");
			$opciones[3] = array("persona" => "PenalLibCondicional", "titulo" => "Libertad Condicional");
			$opciones[4] = array("persona" => "PenalPermisoPenitenc", "titulo" => "Permiso penitenciario");
			$opciones[5] = array("persona" => "PenalTercerGrado", "titulo" => "Tercer grado");
		 	leerItem($n, $fecha[$n], "Situación judicial", $opciones);
			unset($opciones);
		}
		if (in_array("tratam", $datos) || ($todos == 'on')) {
			$opciones[0] = array("persona" => "Tratamiento", "titulo" => "Tratamiento");
		 	leerItem($n, $fecha[$n], "Tratamiento médico", $opciones);
			unset($opciones);
		}
		if (in_array("motivo_salida", $datos) || ($todos == 'on')) 
			$motivo_salida = "ms_".$servicio; 
			leerListaDespl($n, $fecha[$n], "Motivo de la salida", "despl_salida", $motivo_salida); 
	
		echo "</div>";
		echo "</body>";


		/** Destruye las tres tablas que ha creado para leer los datos  */ 	

		//	destruye_copia($nombre_tabla[0]);
		//	destruye_copia($nombre_tabla[1]);
		 

		include "cerrar_conexion.php";

	} else {   // Fin del 'if isset'



	echo "<div id='resultados_opc'>";
	echo "<h2>Datos estadísticos</h2>";
	if ($izaskun) echo "<br><h2>Provisionalmente los datos salen solamente para Hiritar</h2>";   /////////////////////////////////////////
	if ($izaskun) echo "<br><strong><a href='include/usar_sql.php'>Pincha aquí para ver la lista con fecha de entrada y salida</a></strong>";    //////////////////////
	echo "<form name='opciones' id='opciones' action='".$_SERVER['PHP_SELF']."' method='post'>\n";
	echo "<br><input type='checkbox' name='izaskun' value='true' /> Pulsa aquí si eres Izaskun<br />"; 
	echo "<br>Fecha inicio: <input type='text' name='fecha_0' > &nbsp; &nbsp\n";
	echo "Fecha fin: <input type='text' name='fecha_1' >\n";
	echo "<br>(Formato de fecha: dia/mes/año) (Por defecto: año 2010)";
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
	echo "</form></div>";  // div resultados_opc

	echo ""; 

	}


?>
