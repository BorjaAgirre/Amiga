<?php

class Leer_Mysqli {

	var $dbhost = "localhost"; 

	var $dbusuario = "user_amiga"; 							 

	var $dbpassword = "Ee1cd1bd"; 

	var $db = "db_amiga";

	var $conexion;

	var $mysqli; 

	var $debug = false; 

	/**
	* Lista guardada provisionalmente para ejecutar escribe()
	*
	* @access public
	* @var object
	*/
	var $lista;

	public $despleg_motivo; 



	/*
	*  Constructor
	*/
	function Leer_Mysqli() {
		$res = $this->conexion();
		include_once "../config.php"; 
		return $res; 
	}



	/*
	*  Abre la conexión
	*/
	function conexion() {
		$this->mysqli = new mysqli($this->dbhost, $this->dbusuario, $this->dbpassword, $this->db);
		if ($this->mysqli->connect_errno) {
		    echo "<br>Fallo al conectar a MySQLi: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
		$this->mysqli->set_charset("utf8");
		return $this->mysqli; 
	}



	/*
	*  Cierra la conexión
	*/
	function cerrar_conexion() {
		$this->mysqli->close();
	}


	function getCharacterSet() {
		return $this->mysqli->character_set_name();
	}


	/*
	*  Escape
	*/
	function escape($strg) {
		return $this->mysqli->real_escape_string($strg);
	}


	/*
	*  Hace un select seguro a prueba de sql injection
	*/
	function pregunta_query_seguro($orden, $tabla, $columna_accion, $columna_where, $valor, $valor_where) {
		$db = $this->mysqli; 
		$stmt = $db->stmt_init(); 
		/* Sustituye a real_escape_string por seguridad */
		if ($orden == 'select') { $query = "SELECT ".$columna_accion." FROM ".$tabla." WHERE ".$columna_where."=?"; }
		elseif ($orden == 'update') { $query = "UPDATE ".$tabla." SET ".$columna_accion." = ? WHERE ".$columna_where." = '".$valor_where."' "; }
		if ($stmt = $db->prepare($query)) {
			$stmt->bind_param("s", $valor);
			$stmt->execute();
			$stmt->bind_result($result);
			$stmt->fetch();
 			$stmt->close();
		}
/*		echo "<br>result en pregunta_query_seguro: ".$result; 
		echo "<br>query en pregunta_query_seguro: ".$query;
		echo "<br>valor: ".$valor;
*/		return $result; 
	}




	/*
	*  Devuelve el resultado de una consulta
	*/
	function pregunta_query($query) {
		if ($this->debug) echo "<p>&nbsp;</p>QUERY pregunta_query: ".$query; 
		if($result = $this->mysqli->query($query)) {
			if ($this->debug) { echo "<pre>result de pregunta_query: "; print_r($result);  echo "</pre>";}
		} elseif ($this->mysqli->errno == 1062) {
			echo "<script>alert('Parece que este dato (usuario y fecha) ya estaba introducido')</script>"; 
		} else {
			echo "<br>IMPORTANTE, AVISAR AL RESPONSABLE DE LA BASE DE DATOS. No cambiar de página, las siguientes líneas son importantes"; 
			echo "<br>error en la lectura de la base de datos: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
			echo "<br>Query erróneo: ".$query."<br>";
			printf("Mensaje de error: %s\n", $this->mysqli->error); die();
		} 
		return $result;
	}



	/*
	*  Devuelve el resultado de una consulta en formato array
	*  Si $unico es true, solamente devuelve un valor por clave
	*  En caso contrario, cada clave devuelve un array completo con los datos. 
	*/	
	function lista_query($query, $unico = false) {
		$result = $this->pregunta_query($query); 
		if ($this->debug) { echo "<pre>result de lista_query: "; print_r($result);  echo "</pre>";}
		$cont = $result->num_rows; 
		unset($this->lista); 
		if ($this->debug) echo "<br>Número de filas en el query: ".$result->num_rows; 
		if ($cont == 0) {
			$this->lista = array(); 
		} else {
			for ($i = 0; $i<$cont; $i++) {
				$row = $result->fetch_array(MYSQLI_BOTH);
				if ($unico) {
					$this->lista[$i] = $row[0];	
				} else {
					$this->lista[$i] = $row;	
				}
			}
		}
//				echo "<pre>"; print_r($this->lista); echo "</pre>";	   // <------------------------------------------
		return $this->lista;
	}


	/*
	*  Obtiene maxid, el maximo identificador a partir de un id_unico
	*/
	function maxid($id_unico) {
		$query = "SELECT MAX(id_pers) AS maxid FROM persona WHERE id_unico = '".$id_unico."'";
		$rowidunico = $this->lista_query($query, true);
		return $rowidunico[0];
	}




	/*
	*  Obtiene el row para un determinado id_pers en la tabla persona
	*/
	function persona_idpers($id_pers) {
		$result = $this->pregunta_query("SELECT * FROM persona WHERE id_pers=".$id_pers);
		return $result;
	}


	/*
	*  Devuelve un array de la persona, dado un id_unico. 
	*  La busca en la tabla persona, y escoge el registro actual (el que historial = actual) 
	*/
	function leer_persona($id_unico) {
		$query = "SELECT * FROM persona WHERE id_unico = ".$id_unico." AND historial = 'actual' LIMIT 1;";
		$result = $this->lista_query($query); 
		return $result[0]; 
	}



	/*
	*  Devuelve un array con todos los id_pers de la persona, dado un id_unico. 
	*/
	function lista_id_pers($id_unico) {
		$query = "SELECT id_pers FROM persona WHERE id_unico = ".$id_unico." ORDER BY id_pers DESC";
		$result = $this->lista_query($query, true); 
		return $result; 
	}


	/*
	*  Obtiene el array para un determinado tutor dado su id_tutor
	*/
	function tutor_idtutor($id_tutor) {
		$result = $this->pregunta_query("SELECT * FROM tutor WHERE id_tutor=".$id_tutor);
		$row = $result->fetch_array(MYSQLI_BOTH);
		return $row;
	}

	/*
	*  Devuelve un array con todos las actividades
	*/
	function lista_actividades($id_unico) {
		$query = "SELECT * FROM lista_actividades";
		$result = $this->lista_query($query, false); 
		return $result; 
	}



	/*
	*  Guarda una sesion de indicadores
	*/
	function guarda_indicadores($id_unico, $fecha, $array_indicadores) {
		$query = "INSERT INTO indicadores_sesion (id_unico, fecha_sesion) VALUES (".$id_unico.", '".$fecha."');";
//		$result = $this->mysqli->query($query);
		$result = $this->pregunta_query($query);

		$lastid = $this->mysqli->insert_id;

		foreach ($array_indicadores as $indic => $value) {
			$query2 = "INSERT INTO indicadores (id_sesion, id_indic, valor) VALUES (".$lastid.", ".$indic.", ".$value.")";
			$result = $this->pregunta_query($query2);
		}
		return "ok";
	}


	/*
	*   Lee los indicadores dada una sesión
	*/
	function lee_indicadores($id_sesion) 
	{
		$query = "SELECT id_indic as indicador, valor  FROM indicadores WHERE id_sesion = ".$id_sesion.";";
		$result = $this->lista_query($query);
		foreach ($result as $arrayelem) {
			$indicadores[$arrayelem['indicador']] = $arrayelem['valor'];
		}
		return $indicadores; 
	}


	/*
	*   Lee todas las sesiones de indicadores dado un id_unico
	*/
	function lee_sesiones($id_unico)
	{
		$query = "SELECT id_sesion as sesion, fecha_sesion as fecha FROM indicadores_sesion WHERE id_unico = ".$id_unico." ORDER BY fecha_insercion DESC;";
		return $this->lista_query($query); 
	}



	/*
	*  Devuelve un array con toda la tabla de indicadores
	*/
	function tabla_indicadores() {
		$query = "SELECT * FROM tabla_indicadores";
		$result = $this->lista_query($query, false); 
		foreach ($result as $indicador) {
			$tabla[$indicador['id_indic']] = array(
				'grupo' => $indicador['grupo'],
				'nombre' => $indicador['nombre'],
				);
		}
		return $tabla; 
	}




	/*
	*  Devuelve un array con las alertas del día corriente para un miembro del equipo dado
	*/
	function lee_alertas($today, $fechaposterior, $tutor) {
		$grupo = $this->tutor_idtutor($tutor)['grupo'];
		$query = "SELECT p.nombre, p.apellido1, p.apellido2, c.comentario, c.alerta FROM comentario c INNER JOIN persona p 
			WHERE c.alerta >= '".$today."' 
			AND c.alerta <= '".$fechaposterior."'
			AND c.grupo = '".$grupo."'
			AND p.historial = 'actual'
			AND c.id_unico = p.id_unico";
		$result = $this->lista_query($query, false); 
		return $result; 
	}







	/*
	*  Devuelve un array con todos los datos de una actividad, dado un intervalo. 
	*/
	function actividades_intervalo($activ, $inicio, $fin) {
		$query = "SELECT fecha_actividad, comentario_actividad, observaciones_actividad 
				FROM `actividad` WHERE `tipo_activ` = ".$activ."
				AND `fecha_actividad` < '".$fin."' 
				AND `fecha_actividad` > '".$inicio."' 
				ORDER BY `fecha_actividad` DESC ";
		$result = $this->lista_query($query, false); 
		return $result; 
	}


	/*
	*  Lee los comentarios para publicar en pdf
	*/
	function leer_comentarios_pdf($id_unico) {
		$query1 = "SELECT fecha, comentario FROM comentario WHERE id_unico=".$id_unico." ORDER BY fecha"; 
		$coment = $this->lista_query($query1, false);
		$query2 = "SELECT nombre, apellido1 FROM persona WHERE id_unico= ".$id_unico. " LIMIT 1";
		$persona = $this->lista_query($query2, false); 
		return array($coment, $persona); 
	}



	/*
	*  Devuelve un array por cada uno de los géneros. 
	*  Es una lista con todas las personas que han participado en determinada actividad
	*/
	function actividades_genero($actividad, $inicio, $fin) {
			$query_hb = "SELECT p.id_unico,p.sexo, p.nombre, p.apellido1, c.id_coment, 
				c.id_actividad, a.id_activ as id, 
				a.tipo_activ, a.comentario_actividad as comentario, 
				a.observaciones_actividad as observ, a.fecha_actividad as fecha 
				FROM aux p, actividad a, comentario c 
				WHERE a.fecha_actividad > '".$inicio."' AND a.fecha_actividad < '".$fin."' 
				AND p.id_unico = c.id_unico  
				AND a.tipo_activ = '".$actividad."' 
				AND c.id_actividad = a.id_activ 
				AND p.sexo = 2";
			//echo $query_hb;
			$hb = $this->lista_query($query_hb, false);
			//$cont_hb = $cont_hb + $hb; 
			// echo "RESULTADO: <pre>"; print_r($hb); echo "</pre>";

			$query_mj = "SELECT p.id_unico,p.sexo, p.nombre, p.apellido1, c.id_coment, 
				c.id_actividad, a.id_activ as id, 
				a.tipo_activ, a.comentario_actividad as comentario, 
				a.observaciones_actividad as observ, a.fecha_actividad as fecha 
				FROM auxiliar p, actividad a, comentario c 
				WHERE a.fecha_actividad > '".$inicio."' AND a.fecha_actividad < '".$fin."'
				AND p.id_unico = c.id_unico  
				AND a.tipo_activ = '".$actividad."' 
				AND c.id_actividad = a.id_activ 
				AND p.sexo = 1;";

			$mj = lista_query($query_mj, false);
				//		echo "<pre>"; print_r($mj); echo "</pre>";

			$fecha= $mj['fecha'];
			$muj = $mj['mj']; 
			//$cont_mj = $cont_mj + $mj; 

			//$tot = $muj+$hb; 

			//$cont_activ = $cont_activ + 1; 

			//echo "<tr><td>$fecha</td><td>".$mj."</td><td>&nbsp;".$hb."</td><td>".$tot."</td>
			//		<td>&nbsp;<a href='../actividad.php?load=".$row_mj['id']."'>".
			//		$row_mj['comentario']."</a></td><td>&nbsp;".$row_mj['observ']."</td></tr>";
	}					







	/*
	* Devuelve el array de una tabla desplegable almacenada en Mysql con el nombre $despl	
	*/
	function desplegable_anterior($despl, $order = "") {
		$text_order = ($order != "") ? " ORDER BY ".$order." desc" : ""; 
		$result = $this->pregunta_query("SELECT id_despl, nombre, dato1, dato2 FROM desplegables WHERE despl = '".$despl." ".$text_order);
		unset($this->lista_despl); 
		while($row = $result->fetch_array(MYSQLI_BOTH))  {
			$this->lista_despl[$row[0]] = $row[1]; 	
		}
		return $this->lista_despl;
	}



	/*
	* Devuelve el array de una tabla desplegable almacenada en Mysql con el nombre $despl	
	*/
	function desplegable($despl, $order = "") {
		$text_order = ($order != "") ? " ORDER BY ".$order." desc" : ""; 
		$result = $this->pregunta_query("SELECT id_despl, nombre, dato1, dato2 FROM desplegables WHERE despl = '".$despl."';");
		unset($this->lista_despl); 
		while($row = $result->fetch_array(MYSQLI_BOTH))  {
			$this->lista_despl[$row[0]] = $row[1]; 	
		}
		return $this->lista_despl;
	}



	/*
	* Escribe el código html de una tabla desplegable
	* Puede ir posteriormente a la función desplegable(), o ir en solitario con todos los datos
	*/
	function despl_toHTML($name, $select, $despl = "", $order = "") {
//		echo "<br>Name: ".$name." - Select: ".$select." - Despl: ".$despl;
		if ($despl != "") $this->desplegable($despl, $order); 
		$texto =  "\n\t\t<select name = '".$name."'>";
		$texto .= "\n\t\t\t<option value='0'></option>";
		foreach ($this->lista_despl as $num => $item)  {
			$texto .= "\n\t\t\t<option value='".$num."'";
			if ($select == $num)  {
				$texto .= " selected";
			}
			$texto .= ">".$item."</option>";
		}
		$texto .= "\n\t</select>";
		return $texto;
	}







	/*
	* Devuelve un array con los servicios, perfecto para foreachs
	*/
	function array_servicios() {
		// Creamos un array $servicios_actuales con los servicios actualmente en uso 
		$lista = $this->lista_query("SELECT * FROM servicios"); 
		$j = 0; 
		foreach($lista as $serv) {
			$servicios_actuales[$serv['id_servicio']] = $serv['codigo']; 
		}
		return $servicios_actuales; 
	}


	/* 
	*  Devuelve una lista con los comentarios; devuelve solamente $TAMANO_PAGINA comentarios, 
	*  calculando según el número de página que se quiera ofrecer
	*/
	function leer_comentarios($id_unico, $pagina = 1) {
		//examino la página a mostrar y el inicio del registro a mostrar
		$TAMANO_PAGINA = 15; 
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
		$limit = ($pagina == 0) ? " " : "LIMIT ".$inicio.", ".$TAMANO_PAGINA." ";

		// Numero de comentarios en total y número de páginas
		$query_count = "SELECT * FROM comentario WHERE id_unico='".$id_unico."'";
	 	$result_count = $this->pregunta_query($query_count); 
		$num_coment = $result_count->num_rows; 
		$total_paginas = ceil($num_coment / $TAMANO_PAGINA);

		// Selecciona los comentarios
		$query_coment = "SELECT * FROM comentario WHERE id_unico='".$id_unico."' 
					ORDER BY fecha DESC, id_coment DESC ".$limit;
		$result = $this->lista_query($query_coment); 
		return array($result, $total_paginas);
	}


	/*
	*   Lee los datos de la tabla aux, para un determinado sexo, una determinada columna y un determinado valor de la columna.
	*   Devuelve una tabla con las columnas principales. 
	*/
	function leer_datos($campo_a_revisar, $sexo, $valor1, $valor2 = 0) {
		// Se hace una selección de los que cumplen la condición. Puede haber varios resultados por cada persona (varios insert_fecha)
		global $array_comp_aux; 
		$debug = -1;   
		switch($campo_a_revisar) {
			case "area":
				$query = "SELECT per.id_unico, per.id_pers, per.nombre, per.apellido1, per.fechaInsert, per.fechaIngreso, pai.dato1
						FROM aux AS per, desplegables AS pai WHERE pai.despl = 'paises_mundo' AND per.sexo = '".$sexo."' 
						AND pai.dato1 = '".$valor1."' AND per.nacionalidad = pai.id_despl
						ORDER BY nombre, id_unico";
				break; 

			case "edad":
				$query = "SELECT id_unico, id_pers, nombre, apellido1, fechaInsert, fechanac, CURDATE(), 
					(YEAR(CURDATE()) - YEAR(fechanac)) - (RIGHT(CURDATE(),5) < RIGHT(fechanac,5)) as edad
					FROM aux  WHERE (YEAR(CURDATE()) - YEAR(fechanac)) - (RIGHT(CURDATE(),5) < RIGHT(fechanac,5))
					BETWEEN '".$valor1."' AND '".$valor2."' 		
					AND sexo = '".$sexo."' 
					GROUP BY id_unico ORDER BY nombre, id_unico";	
				break;

			default:
				$query = "SELECT id_unico, id_pers, nombre, apellido1, fechaInsert, fechanac, ".$campo_a_revisar."
					 FROM aux WHERE sexo = '".$sexo."' AND ".$campo_a_revisar." = '".$valor1."'
					ORDER BY nombre, id_unico"; 
				break; 	
		}

		if ($debug >= 0) {
			echo "<br>Campo a revisar: ".$campo_a_revisar." - query: ".$query;	
		}       			

		//
		// Se crea una nueva array $array_datos con los resultados del select
		//
		unset($array_datos); 
		$result = $this->pregunta_query($query); 
		$cont = 0;
		while($row = $result->fetch_array(MYSQLI_BOTH)){
			$array_datos[$cont] = $row; 
			$cont++;
			// debug
			if (($campo_a_revisar == $debug_revisar) && ($debug >= 0)) {	
				echo "<br>cont: ".$cont." - id_pers: ".$row['id_pers']." - id_unico: ".$row['id_unico']." - row fechaInsert: "
				.$row['fechaInsert']." - array fechaInsert: ".$array_datos[$cont]['fechaInsert'] ;  /////////////////////////
			}
			$array_comp_aux[$row['id_unico']] = ""; 	// Vamos tachando los que aparecen
		}
		return $array_datos;
	}





	/*
	*  Obtiene los id_unico que están activos en determinado intervalo, consultando la tabla alta_baja
	*  Puede ser para un determinado servicio o cualquiera; para un determinado id_unico o cualquiera
	*  Si $no_repite es true, escoge el último item encontrado 
	*  Crea un array, en el que habrá eliminado los elementos de servicios que no están en uso 
	*/
//	function activos($fecha_ini, $fecha_fin, $servicio = '0', $id_unico = 0, $no_repite = true, $where = "") {
	function activos($arg) {
		
		// Cargar variables
		$hoy = date("Y-m-d");
		$text_repite = ((isset($arg['no_repite'])) && ($arg['no_repite'] == false)) ? "" : " ORDER BY id_altabaja DESC LIMIT 1 ";
		$text_id_unico = ((isset($arg['id_unico'])) && ($arg['id_unico'] != 0)) ? "id_unico = '".$arg['id_unico']."' AND "  : "";
		$text_columnas = ((isset($arg['columnas'])) && ($arg['columnas'] != '')) ? $arg['columnas'] : "*";
		$text_servicio = ((isset($arg['servicio'])) && ($arg['servicio'] != '0')) ? "servicio = '".$arg['servicio']."' AND " : "";
		$text_autor = ((isset($arg['autor'])) && ($arg['autor'] != '0')) ? "autor_inserc = '".$arg['autor']."' AND " : "";
		$text_group_id_unico = ((isset($arg['group_id_unico'])) && ($arg['group_id_unico'] == 'true')) ? " GROUP BY id_unico " : "";
		$fecha_ini = (isset($arg['fecha_ini'])) ? $arg['fecha_ini'] : $hoy;
		$fecha_fin = (isset($arg['fecha_fin'])) ? $arg['fecha_fin'] : $hoy;
		$where = (isset($arg['where'])) ? " ".$arg['where']." AND" : "";
		$text_persona_pre = ""; $text_persona_post = ""; $text_persona_group = ""; $text_tutor = ""; 
		if ((isset($arg['persona'])) && ($arg['persona'] == true)) {
			$text_persona_pre = "INNER JOIN persona p"; 
			$text_persona_post = "ab.id_unico = p.id_unico AND historial = 'actual' AND"; 
			$text_persona_group = "GROUP BY p.id_pers ORDER BY p.nombre"; 	// Esto hay que revisar, no debería dar dos resultados por persona...
			$text_tutor = ((isset($arg['tutor'])) && ($arg['tutor'] != '0')) ? "p.responsable = '".$arg['tutor']."' AND " : "";	
			$text_repite = ""; 	
		}

		// Diseña el query según las variables
		$query = "SELECT ".$text_columnas." FROM `alta_baja` ab
				".$text_persona_pre."
				WHERE 				
				".$text_persona_post."
				".$text_id_unico."
				".$text_servicio."
				".$text_autor."
				".$text_tutor."
				".$where."
				(
					(
						alta_baja = 'x'
						AND fecha_correl > '".$fecha_ini."'
						AND fecha <= '".$fecha_fin."'
					)
					OR (
						alta_baja = 'a'
						AND fecha <= '".$fecha_fin."'
					)
				)  				
				".$text_persona_group."
				".$text_repite."
				".$text_group_id_unico."
				 ;"; 
		if ($this->debug) echo "<br>QUERY ACTIVOS: ".$query; 
		$servicios_actuales = $this->array_servicios(); 
 
		// Hacemos la consulta
		$result = $this->pregunta_query($query); 
		$cont = $result->num_rows; 
		if ($this->debug) echo "<br>Número de filas en el query: ".$cont; 

		// Creamos el array a partir de la consulta
		if ($this->debug) echo "<br>Creando el array..."; 
		for ($i = 0; $i<$cont; $i++) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			if ($this->debug) echo "<br>fila ".$i.", valor de [servicio]: ".$row['servicio'];
			if (in_array($row['servicio'], $servicios_actuales)) {   // sólo pasa a la lista si el servicio está en uso 
				if ($this->debug) echo " ---> existe"; 
				$lista_altabaja[$i] = $row; 	
			}
		}

		// Lo guardamos como $this->lista, para poder utilizarlo posteriormente
		unset($this->lista); 
		$this->lista = $lista_altabaja; 
		return $this->lista; 
	}



	/* 
	*   Crea una tabla auxiliar (aux) en Mysql, con el grupo de personas de un determinado intervalo
	*   para un determinado servicio
	*/
	function crea_aux($fecha_ini, $fecha_fin, $serv, $busca_item = NULL, $busca_personas, $busca_valor = NULL ) {
		//  Elimina la tabla aux si existe
		$this->elimina_aux(); 

		// Crea la nueva tabla 
		$query = "CREATE TABLE aux like persona;";
		$this->pregunta_query($query);

		if (isset($busca_item) && isset($busca_valor)) {
			$item = ( "" != $busca_item ) ? " AND ".$busca_item." = ".$busca_valor : "";
		}


		if (empty($busca_personas)) {
			// Uso normal: no hay personas en la lista a buscar
			// Lee las personas del servicio y las fechas dadas
			$arg = array(
				'fecha_ini' => $fecha_ini,
				'fecha_fin' => $fecha_fin,
				'servicio' => $serv,
				'no_repite' => false, 
				'group_id_unico' => true		// para que aparezca una sola vez cada id_unico, aunque haya varias altas y bajas
			);
			$result = $this->activos($arg); 
		} else {
			// Lista de personas a buscar
			foreach ($busca_personas as $persona_listada) {
				$result[] = array( 'id_unico' => $persona_listada); 
			}

		}

		if ($this->debug) {
			echo "<pre>Result: "; 
			print_r($array_personas);
			echo "</pre>";
		}

		// Escribe en la tabla auxiliar los datos de las personas seleccionadas
		foreach ($result as $row) {
			$query2 = "INSERT INTO aux SELECT * FROM persona WHERE id_pers=(SELECT id_pers FROM persona 
					WHERE id_unico=".$row['id_unico']. $item . " AND historial = 'actual') ;";
			if ($this->debug) echo "<br>".$query2;
			$this->pregunta_query($query2);
		}
		return $result;	
	}


	/* 
	*   Crea una tabla auxiliar (aux) en Mysql, con el grupo de personas de un determinado intervalo
	*   para un determinado servicio
	*/
	function crea_aux_actividad() {
		//  Elimina la tabla aux si existe

		$this->elimina_aux(); 

		// Crea la nueva tabla 
		$query = "CREATE TABLE aux like persona;";
		$this->pregunta_query($query);

		// Búsqueda de personas que han realizado la actividad en determinadas fechas
		$query_tl = "SELECT count(*) as veces, c.id_unico as persona FROM comentario as c, actividad as a 
			WHERE c.id_actividad=a.id_activ AND a.tipo_activ=7 AND a.fecha_actividad > '2011-01-01' AND a.fecha_actividad < '2011-06-30' 
			GROUP BY c.id_unico ORDER BY c.id_unico;";
		$result = $this->lista_query($query_tl); 

		// Escribe en la tabla auxiliar los datos de las personas seleccionadas
		foreach ($result as $row) {
			$query2 = "INSERT INTO aux SELECT * FROM persona WHERE id_pers=(SELECT id_pers FROM persona 
					WHERE id_unico=".$row['persona']." AND historial = 'actual');";
			$this->pregunta_query($query2);
		}
		return $result;	
	}



	/*
	*  Elimina la tabla aux si existe
	*/
	function elimina_aux() {	
		$query = "DROP TABLE IF EXISTS aux"; 
		$this->pregunta_query($query);  
	}


	/*
	* Función específica para el formulario de alta_baja
	* Devuelve los tres textos para rellenar cada columna del formulario, incluidos los 'input' necesarios en HTML.
	*/
	function form_altabaja($cod, $id_unico, $error) {
		$hoy = date("Y-m-d"); 
		$cuadro = array("", "", "", ""); 
		$arg = array (
			'fecha_ini' => "2000-01-01",
			'servicio' => $cod,
			'id_unico' => $id_unico
		);
		$fila = $this->activos($arg); 
		$t_error = ($error) ? " style='border: 2px solid red'" : ""; 
		if (count($fila) == 0) {  // Caso 1: no hay entradas ni salidas anteriores en este servicio (no activo actualmente)
			$cuadro[0] = "<input type='text' name='alta_".$cod."' size=7 ".$t_error.">";
		} else {
			if ($fila[0]['alta_baja'] == 'x') {    // Caso 2: hay entrada y salida anterior (no activo actualmente)
				$cuadro[0] = "<b>".fecha_sql_txt($fila[0]['fecha'])."</b>";
				$cuadro[1] = "<b>".fecha_sql_txt($fila[0]['fecha_correl'])."</b>";
				$cuadro[2] = "<input type='text' name='alta_".$cod."' size=7 ".$t_error." >";
				$cuadro[3] = $this->despleg_motivo[$fila[0]['motivo_baja']];
			} else {  				  // Caso 3: hay entrada pero no salida  (activo actualmente) 
				$cuadro[0] = "<b>".fecha_sql_txt($fila[0]['fecha'])."</b>";
				$cuadro[1] = "<input type='text' name='baja_".$cod."' size=7  ".$t_error." >";
				$cuadro[3] = $this->despl_toHTML("motivo_".$cod, $fila[0]['motivo_baja'],"salida");
				$cuadro[99] = " style='background-color: #D0D7FA' "; 
			}
		}
		return $cuadro; 
	}



	/*
	*  Dado un id_unico y un servicio, busca el registro donde se dió de alta (la última 'a').
	*  La función inserta_alta_baja, que es quien llama a esta función, se encarga de darlo de baja. 
	*/
	function reg_alta($id_unico, $serv) {
		$query = "SELECT id_altabaja FROM alta_baja WHERE id_unico = ".$id_unico." 
				AND servicio = '".$serv."' AND alta_baja = 'a'
				ORDER BY id_altabaja DESC LIMIT 1"; // esta última línea no es necesaria si no hay errores
		$result_alta = $this->pregunta_query($query); 
		if ($this->debug) echo "<br>Query reg_alta: ".$query; 
		$reg_alta = $result_alta->fetch_array(MYSQLI_NUM);
		return $reg_alta[0]; 
	}


	/*
	* Inserta un nuevo registro en la tabla 'alta_baja', según lo introducido en el formulario en persona_alta_baja.php
	*/
	function inserta_alta_baja($array_ab, $id_unico, $insert_usuario) {
		$insert_fecha=date("d/m/y");
		$servicios_actuales = $this->array_servicios(); 
		foreach ($servicios_actuales as $cod => $serv) {		
			if (isset($array_ab['alta'][$serv])) {
//				echo "<br>ALTA --->".$serv." - ".$id_unico; 
				$query = "INSERT INTO alta_baja 
					(id_unico, servicio, serv, alta_baja, fecha, autor_inserc) VALUES
					(".$id_unico.", '".$serv."', '".$cod."', 'a', '".$array_ab['alta'][$serv]."', '".$insert_usuario."' )";
					if ($this->debug) echo "<br>Query ALTA de inserta_alta_baja: ".$query; 
				$this->pregunta_query($query); 
//				echo $query; 
			}
			if (isset($array_ab['baja'][$serv])) {
//				echo "<br>BAJA --->".$serv." - ".$id_unico; 
				$reg_alta = $this->reg_alta($id_unico, $serv); 
				$mot_baja = (isset($array_ab['motivo'][$serv])) ? ", motivo_baja = ".$array_ab['motivo'][$serv] : ""; 
				$query = "UPDATE alta_baja 
						SET alta_baja = 'x', fecha_correl = '".$array_ab['baja'][$serv]."'
							".$mot_baja."
						WHERE id_altabaja = ".$reg_alta."; ";
				if ($this->debug) echo "<br>Query BAJA de inserta_alta_baja: 
					<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>".$query; 					 
				$this->pregunta_query($query); 
			}
		}
	}



	/*
	* Función creada para mostrar por pantalla el resultado de la función activos()
	* Para uso de debug. 
	*/
	function escribe() {
		if (count($this->lista) == 0) {
			echo "<br>No hay ninguna línea<p>&nbsp;</p>"; 
		} else {	
			echo "<br><pre>"; 
			print_r($this->lista); 
			echo "</pre>"; 
		}
	}



	/*
	* Función creada para mostrar por pantalla un texto. 
	* Para uso de debug. 
	*/
	function prueba() {
			echo "<br>Procesando leer_mysqli"; 
	}


	/*
	* Función para la lectura de los cumpleaños. Usada en seguimiento. 
	* Para uso de debug. 
	*/
	function cumples() {
		$mes = date(n);
		$dia = date(j); 
		$mes_sig = ($mes == 12) ? 1 : $mes+1; 
//		echo "mes: ".$mes." - mes sig: ".$mes_sig; 
		$query = "SELECT id_unico, nombre, apellido1, apellido2, fechanac FROM persona WHERE historial = 'actual'";
		$result = $this->pregunta_query($query); 
		while($row = $result->fetch_array(MYSQLI_BOTH))  {
			$fecha = explode("-",$row['fechanac']); 
			if (($mes == $fecha[1]) || ($mes_sig == $fecha[1])) {
				if (($mes == $fecha[1]) && ($dia <= $fecha[2] )) {
					$lista_mes[] = array($row['id_unico'], $row['nombre'], $row['apellido1'], 
							$row['apellido2'], $fecha[2], $fecha[1]);
				}
				if (($mes_sig == $fecha[1]) && ($dia >= $fecha[2] )) {
					$lista_mes_sig[] = array($row['id_unico'], $row['nombre'], $row['apellido1'], 
							$row['apellido2'], $fecha[2], $fecha[1]);
				}
			}
		}
		// Mes actual 
		// Cambia las líneas por columnas, para usar el multisort. 
		foreach ($lista_mes as $key => $fila) {
   			$mes_b[$key]  = $fila[5];  
   			$dia_b[$key] = $fila[4];
			$nombre_b[$key] = $fila[1];
			$apellido1_b[$key] = $fila[2];
			$apellido2_b[$key] = $fila[3];
			$id_unico_b[$key] = $fila[0]; 
		}
		// Mes siguiente al actual 
		foreach ($lista_mes_sig as $key => $fila) {
   			$mes_c[$key]  = $fila[5];  
   			$dia_c[$key] = $fila[4];
			$nombre_c[$key] = $fila[1];
			$apellido1_c[$key] = $fila[2];
			$apellido2_c[$key] = $fila[3];
			$id_unico_c[$key] = $fila[0]; 
		}

		array_multisort($dia_b, SORT_ASC, $nombre_b, $apellido1_b, $apellido2_b, $id_unico_b);
		array_multisort($dia_c, SORT_ASC, $nombre_c, $apellido1_c, $apellido2_c, $id_unico_c);

		// La lista final es un chorizo con todas las arrays (columnas) ordenadas.
		// Probablemente se pueda hacer de otra forma más fina, pero no tengo tiempo. Y funciona.
		$lista_final = array($dia_b, $mes_b, $nombre_b, $apellido1_b, $apellido2_b, $id_unico_b, 
						$dia_c, $mes_c, $nombre_c, $apellido1_c, $apellido2_c, $id_unico_c); 

		return $lista_final; 
	}


	function calculaMediaIndicadores($fechaini, $fechafin) {
		$query = "SELECT t.id_indic, t.nombre, AVG(i.valor) 
				FROM tabla_indicadores as t, indicadores as i, indicadores_sesion as s 
				WHERE i.id_indic = t.id_indic 
					and i.id_sesion = s.id_sesion 
					and s.fecha_sesion <= '".$fechafin."'
					and s.fecha_sesion >= '".$fechaini."'
				GROUP BY i.id_indic;";
		$result = $this->lista_query($query); 
		return $result;		
	}

}

?>
