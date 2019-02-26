<?php		
include "array_a_tabla.php"; 
include "conexion.php"; 

		$query = "select nombre, apellido1, EmpadronamientoFecha from copia_1_max 
			where EmpadronamientoFecha = '' group by id_unico order by nombre;"; 
//		$query = "select p.nombre, p.apellido1 from comentario c, persona p, actividad a where c.fecha > '2011-01-01' and c.fecha < '2011-11-15' and c.id_actividad <>-1 and p.id_unico = c.id_unico and sexo=2 and a.tipo_activ=7 and a.id_activ=c.id_actividad group by c.id_unico;";



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

		echo "<br><h1>".$query."</h1>"; 
		$result=mysql_query($query, $conexion); 
		$cont = 0; 
		while($row = mysql_fetch_array($result,MYSQL_BOTH)){
			$array_datos[$cont++] = $row; 		
		}

		$atributos_tabla = array("width"=>"100%", "border"=>"1");
		$atributos_titulo = array("bgcolor"=>"#336699");
		$atributos_linea = array("bgcolor"=>"#COCOCO");

		tabla("", $array_datos, $atributos_tabla, $atributos_titulo, $atributos_linea);
//	}


include "cerrar_conexion.php"; 
?>
