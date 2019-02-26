		
<?php


//Entrada:
// $fecha: Valor de la fecha a comparar
// $fecha_compara: Fecha con la que se establecerá la comparación, si no se establece una fecha se comparara con la fecha actual. por defecto NULL
//Salida: BOLEAN, si las fechas son iguales se devuelve 0, si la primer fecha es menor a la segunda se devuelve -1, si la primer fecha es mayor a la segunda se devuelve 1.
//Nota: Esta función puede devolver el valor booleano FALSE, pero también puede devolver un valor no booleano que se evalúa como FALSE. Use el operador === para comprobar el valor devuelto por esta función.
//Autor: dantepiazza
//Version: 1.0
     



function comparar_fechas($fecha, $fecha_comparar = null){
	if($fecha_comparar == null){
		$fecha_comparar = date("Y-m-d H:i:s");
	}
	$fecha = strtotime($fecha);
	$fecha_comparar = strtotime($fecha_comparar);
	if($fecha == $fecha_comparar){  
		return 0;
	}
	else if($fecha < $fecha_comparar){  
		return -1;
	}
	else if($fecha > $fecha_comparar){    
		return 1;
	}
	return false;
}





/*
*
*    Este iterador copia en un campo lo que está puesto en otro
*/
function copia_campo($desde_campo, $hacia_campo) {
	// $desde_campo="fecha_salida"; 
	// $hacia_campo="ff_centroDia";

	include_once "clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
		$query="UPDATE persona SET ".$hacia_campo."=".$desde_campo." ;";
		echo "<br>Cambiado: ".$row["id_pers"]." - ".$row["apellido1"]." ; query: ".$query; 
		$db->pregunta_query($query);
	$db->cerrar_conexion;
}

/*
*
*    Este iterador elimina personas que están duplicadas en la tabla persona; hay que aportarle los id_unico 
*/
function eliminar_duplicados() {
	$duplicados = array(2161, 2162, 2163); 
	include_once "clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
	foreach ($duplicados as $dup) {
		echo "<br><b>".$dup.": </b>";
		$query = "SELECT id_pers, nombre, apellido1, apellido2, insert_fecha FROM persona WHERE id_unico = ".$dup;
		$result = $db->pregunta_query($query);
		$fecha_max = "2000-01-01"; 
		while($row = $result->fetch_array(MYSQLI_BOTH)) {
			$fecha = $row['insert_fecha'];
			echo "<br>".$row['id_pers']." - ".$row['nombre']." ".$row['apellido1']." ".$row['apellido2']." ".$fecha; 
			if (comparar_fechas($fecha, $fecha_max)) {
				$fecha_max = $fecha; 
				$id_pers_max_fecha = $row['id_pers']; 
			}
		}
		echo "<br>Fecha máxima: ".$fecha_max. " (id_pers: ".$id_pers_max_fecha.")"; 
		$query = "SELECT COUNT(*) FROM comentario WHERE id_unico = ".$dup;
		$result = $db->pregunta_query($query);
		$row = $result->fetch_array(MYSQLI_BOTH);
		echo "<br>Comentarios: ".$row[0]."<br>&nbsp;"; 
	}
	$db->cerrar_conexion;
}




/*
*     Este iterador sustituye un valor por otro en la tabla persona
*     Si el valor de $id_unico es distinto a 0, cambia solamente esa persona. 
*/
function sustituye_valor_p($campo_a_cambiar, $valor_anterior, $valor_nuevo, $id_unico) {
	// $campo_a_cambiar="ff_centroDia"; 
	// $valor_anterior="2000-00-00";
	// $valor_nuevo="0000-00-00";
?> 	
	<script type="text/javascript">
	<!--
	function confirmar() {
		var answer = confirm("¿Confirmas estos cambios? (Ya no se podrá volver atrás)")
		if (answer) {
			window.location = "iterador.php?ejec=2";
		}
		else {
			window.location = "iterador.php";
		}
	}
	//-->
	</script>
<?php 
	if ((isset($_GET['ejec'])) && ($_GET['ejec'] == 2)) {
		$ejec = 2; 
	} else {
		$ejec = 1; 
	}
	include_once "clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
	$result=$db->pregunta_query("SELECT * FROM persona");
	echo "<br>Comienza a sustituir; ejec: ".$ejec;
	while($row=$result->fetch_array(MYSQLI_BOTH)){
		if ( ($id_unico == $row['id_unico']) ||  ($id_unico == 0) ){
			if ($row[$campo_a_cambiar] == $valor_anterior) {  
				$query="UPDATE persona SET ".$campo_a_cambiar."='".$valor_nuevo."' WHERE id_pers=".$row["id_pers"];
				$query .= " ;";
				if ($ejec == 1) {					
					echo "<br>Identificador: ".$row["id_pers"]." - "
						.$row["nombre"]." ".$row["apellido1"]." ".$row["apellido2"]." - Fecha ".$row["insert_fecha"].
						"<br>\t&nbsp; &nbsp; Se cambia el campo ".$campo_a_cambiar.
						", sustituir ".$valor_anterior." por ".$valor_nuevo.
						"; <br>\t&nbsp; &nbsp; query: ".$query; 
				}
				if ($ejec == 2) {
					echo "<br>Se ejecuta:  ".$query;
					$db->pregunta_query($query);
				}	
			}      
		}
	}
	if ($ejec == 1) {
		echo "<form>";
		echo "<input type='hidden' name='ejec' value='2'>"; 
		echo "<br>&nbsp<br><input type='button' onclick='confirmar()' value='Ejecutar el cambio'>";
		echo "</form>";
	}
	$db->cerrar_conexion;
}




/*
*     Este iterador sustituye un valor por otro en la tabla comentario 
*/
function sustituye_valor_c($campo_a_cambiar, $valor_anterior, $valor_nuevo) {
	// $campo_a_cambiar="tutor"; 
	// $valor_anterior="10";
	// $valor_nuevo="7";
	include_once "clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
	$result = $db->pregunta_query("SELECT * FROM comentario");
	while($row=$result->fetch_array(MYSQLI_BOTH)){
		if ($row[$campo_a_cambiar]==$valor_anterior) {  
			$query="UPDATE comentario SET ".$campo_a_cambiar."='".$valor_nuevo."' WHERE id_coment=".$row["id_coment"].";";
			echo "<br>Cambiado: ".$row["id_coment"]." - ".$row["nombre"]." ; query: ".$query; 
			$db->pregunta_query($query);
		}      
	}
	$db->cerrar_conexion;
}






/*  Este bucle revisa busca e imprime todos los registros de todos los usuarios 
*	cuyo maximo valor en $campo_a_cambiar es mayor que un determinado $valor 		
*/
function busca_valor($campo_a_cambiar, $valor) {
	$campo_a_cambiar="procedencia_demanda_lista"; 
	$valor="0";
	echo "Empezando...<br>";
	include_once "clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
	$result=$db->pregunta_query("SELECT max(".$campo_a_cambiar.") AS valor, id_pers, id_unico FROM persona GROUP BY id_unico");
	while($row=$result->fetch_array(MYSQLI_BOTH)){
		if ($row["valor"]!=$valor) {  
			$query="UPDATE persona SET ".$campo_a_cambiar."=".$row["valor"]." WHERE id_unico=".$row["id_unico"].";";		
			$result2=$db->pregunta_query($query);				
			while($row2=$result->fetch_array(MYSQLI_BOTH)) {
				echo "<br>".$row2["id_unico"]." - ".$row2["id_pers"]." - ".$row2["apellido1"]." - "
					.$row2["insert_fecha"]." ; ".$row2[$campo_a_cambiar]; 
			}
		}      
	}
	$db->cerrar_conexion;
}


/*  Este bucle busca el último valor en un determinado campo $campo, para una determinada selección de id_unicos (ver $query_busc)
*	y generaliza ese valor para la totalidad de los registros de ese usuario y ese campo
*/
function generaliza_valor($campo) {

	$tabla = "persona"; 
	include_once "clases/class.leer_mysqli.php";
	$db = new Leer_Mysqli();
		// En primer lugar escogemos una serie de personas con las condiciones que queramos
		// Nótese que este query es totalmente arbitrario
//		$query_busc= "select id_unico from persona 
//			where insert_fecha > '2011-07-05' and 
//			(insert_usuario = 'ana' or insert_usuario='ainhoa' or insert_usuario='borja') 
//			group by id_unico order by id_unico;";

		$query_busc = "select id_unico from ".$tabla." where id_unico = 71 group by id_unico"; 

//		$query_busc= "select id_unico from persona where id_unico = 154 group by id_unico"; 
		$result_busc=$db->pregunta_query($query_busc );				

		// Y a continuación actuamos en cada una de esas personas
		while($row_busc = $result_busc->fetch_array(MYSQLI_BOTH)) {		

			// Buscamos los últimos valores en dicho campo para esa persona
			$query_valor= "select id_unico, ".$campo.", nombre, apellido1 from ".$tabla." where id_unico=".$row_busc['id_unico']." and 
				id_pers=(select max(id_pers) from persona where id_unico=".$row_busc['id_unico'].") order by insert_fecha;";
//			echo "<br>".$query_valor;
			$result_valor=$db->pregunta_query( $query_valor);				
			$row_valor = $result_valor->fetch_array(MYSQLI_BOTH);
//			echo "<br>persona: ".$row_valor['id_unico']." - valor: ".$row_valor[$campo];

			// Y ahora actualizamos ese valor para todo el id_unico
			$query_act = "update ".$tabla." set ".$campo." = '".$row_valor[$campo]."' where id_unico= ".$row_valor['id_unico'].";";
			echo "<br>cambiado: ".$row_valor['nombre']." ".$row_valor['apellido1']." con el valor ".$row_valor[$campo];
			$result_act=$db->pregunta_query( $query_act);	
			

		}
	$db->cerrar_conexion;
}

/******************************************************
*
*    PROGRAMA PRINCIPAL
*
******************************************************/



// Hay que cambiar el resto de funciones con el modelo de sustituye_valor_p
// generaliza_valor("IngresosRentaBas");
eliminar_duplicados(); 
?>
