<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();

// 
//  En esta página está pendiente darle un poco de forma a los div y a la página en general
//

include "headers.php";

header_principal("actividades"); 

include_once "include/fechas.php";
include_once "include/imprime.php"; 
include_once "clases/class.leer_mysqli.php";

function hito_activ($row) {   // Esto está sin terminar.
	$hitos=  $_SESSION['hitos'];
	echo  "<br>&nbsp;&nbsp;&nbsp;Hito \n<select name='hito'>";
	echo "<option value=''>---------</option>";
	foreach($hitos as $hit){
		echo "<option value='".$hit['hito']."'";
		if ($row['hito']==$hit['hito'])  {
			echo " selected";
		}
	} 
	echo ">".$hit['hito']."</option>";
	echo "</select>";
}

?>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">

	
		<script>
		
		function toggleDiv(id,flagit) {
		if (flagit=="1"){
		if (document.layers) document.layers[''+id+''].visibility = "show"
		else if (document.all) document.all[''+id+''].style.visibility = "visible"
		else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"
		}
		else
		if (flagit=="0"){
		if (document.layers) document.layers[''+id+''].visibility = "hide"
		else if (document.all) document.all[''+id+''].style.visibility = "hidden"
		else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"
		}
		}
		
		
		function asistencia() 
		{
		toggleDiv('titulos',1);
		toggleDiv('iframe',1);
		toggleDiv('nombre',0);
		toggleDiv('fecha',0);
		toggleDiv('responsable',0);
		toggleDiv('responsable2',0);
		toggleDiv('volunt',0);
		toggleDiv('descripcion',0);
		toggleDiv('send',0);
		toggleDiv('activ_pdf',0);
		toggleDiv('send2',1);		
		}
		
		function deletecheck(id) 
		{
			var x=window.confirm('¿De verdad quieres eliminar la actividad?')
			if (x)
			{
			window.alert('Actividad eliminada')
			location.href='actividad.php?delete='+id;
			}
			else
			{
			window.alert('No se ha eliminado la actividad')
			}
		}


		function deletecheckasistente(delete_asist) 
		{
			var x=window.confirm('¿De verdad quieres eliminar al asistente?')
			if (x)
			{
			window.alert('Asistente eliminado')
			location.href='actividad.php?delete_asist='+delete_asist;
			}
			else
			{
			window.alert('No se ha eliminado la actividad')
			}
		}

		</script>



		
		<!-- Listado de DIV's ##### ETIQUETAS -->
		
		<!-- DIVS DE LA ESTRUCTURA DEL FORMULARIO -->
		<style type="text/css">#main {width:60%; height:70%; margin:0; left:5%;padding:5px; margin-top: 20px;	margin-bottom: 20px; text-align:left; border:1px solid #2f5d69;	position:relative;}</style>
		<style type="text/css">#indice {width:25%; height:70%; right:5%;padding:5px; margin-top: 20px;	margin-bottom: 20px; text-align:left; border:1px solid #2f5d69;	position:absolute;}</style>
		
		
		
		
		<!-- Div formulario DATOS PERSONALES -->
		<style type="text/css">#nombre			{position:absolute; top: 3%;  left: 05%; font-size:18; font-family:'Verdana'; width:300; visibility:show}</style>
		<style type="text/css">#fecha 			{position:absolute; top: 3%;  left: 30%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#responsable		{position:absolute; top: 3%; left: 55%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#responsable2		{position:absolute; top: 3%; left: 80%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#volunt			{position:absolute; top: 12%; left: 55%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#descripcion		{position:absolute; top: 20%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#observaciones		{position:absolute; top: 45%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#send	 		{position:absolute; top: 70%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#activ_pdf 		{position:absolute; top: 85%; left: 05%; font-size:12; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#send2	 		{position:absolute; top: 91%; margin:0 auto; font-size:18; font-family:'Verdana'; width:200; position:relative; visibility:hidden}</style>
		<style type="text/css">#iframe	 		{height:80%; width:100%; background:#EEEEEE;margin:0 auto;overflow:auto; position:relative; top: 3%; font-size:18; font-family:'Verdana'; visibility:hidden}</style>
		<style type="text/css">#titulos	 		{position:absolute; top: 3%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:hidden}</style>		
		<style type="text/css">#cuadro_asistencia	{font-size:9px; font-family:'Arial'}</style>	
		

		
		<span id="indice">
		<center><font size="5">ÚLTIMAS ACTIVIDADES</font></center><br><br>
		<center>
		<div id="iframe2">
		<table width=300>
<?php

		$db = new Leer_Mysqli(); 


		// 
		// Columna de la derecha
		//
		if (isset($_GET['activ_inicial'])) {	// A partir de qué actividad empezamos a contar, hasta un máximo de 25
			$inicial = ($_GET['activ_inicial']);
		} else {
			$inicial = 0;
		}

		
		$result_count=$db->pregunta_query("SELECT count(*) FROM actividad");
		$row_count = $result_count->fetch_array(MYSQLI_BOTH); 
		$count = $row_count[0];
	
		$result=$db->pregunta_query("SELECT * FROM actividad ORDER BY fecha_actividad DESC LIMIT ".$inicial.", 25");
		while($row=$result->fetch_array(MYSQLI_BOTH)){
			$result2=$db->pregunta_query("SELECT * FROM lista_actividades WHERE id_listaactividad=".$row['tipo_activ']);
			$row2=$result2->fetch_array(MYSQLI_BOTH);
			$result3=$db->pregunta_query("SELECT COUNT(DISTINCT id_unico) FROM comentario WHERE id_actividad=".$row['id_activ']);
			$row_cuenta=$result3->fetch_array(MYSQLI_BOTH);
			$fecha=fecha_sql_txt($row['fecha_actividad']);	
			echo "<tr><td><a href='actividad.php?load=$row[0]'>".$row2[1]."(".$row_cuenta[0].")</td></a><td>$fecha</td><td>
				</td></tr>";
		}

		$inicial_sig = $inicial + 25; 
		if ($inicial_sig > $count) {
			$inicial_sig = $count; 
		} else {
			$inicial_sig_sig = $inicial_sig + 25;   // $inicial_sig_sig se utiliza como segundo valor del paréntesis
			if ($inicial_sig_sig > $count) {
				$inicial_sig_sig = $count; 
			}
			echo "<tr><td><a href='actividad.php?activ_inicial=".$inicial_sig."'><strong>VER LOS 25 SIGUIENTES</strong></a></td>
				<td>(".($inicial_sig + 1)." - ".$inicial_sig_sig.")</td></tr>";
		}


		// include "cerrar_conexion.php";

		echo "</table>\n</div>\n</center>\n</span>";
		//
		//  Si se ha seleccionado un usuario, se carga la web con los datos
		//

		if ( (isset($_GET['acude'])) || (isset($_GET['load'])) )  {
			//  Comprueba si llega un 'acude'
			if (isset($_GET['acude'])) {
				$loadid=$_GET['acude'];
				echo "acude es: ".$loadid;
			}

			//  Comprueba si llega un 'load'
			if (isset($_GET['load']))  {
				$loadid=$_GET['load'];
				echo "<form name='insertar_actividad' autocomplete='off' id='insertar_actividad' 
					action='actualizar_actividad.php?load=".$loadid."' method='post'>";
			}  
			// Carga los datos de la base de datos
			$resultload = $db->pregunta_query("SELECT * FROM actividad WHERE id_activ=$loadid");
			$rowload = $resultload->fetch_array(MYSQLI_BOTH);
		}
		
		//  Comprueba si llega un 'delete':  se deriva a actividad.php
		elseif (isset($_GET['delete_asist']))  {
			$delete_asist=$_GET['delete_asist'];

			$result=$db->pregunta_query("DELETE FROM comentario WHERE id_coment=$delete_asist");
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php'>";
		} 

		//  Para ninguno de los casos anteriores
		else	{
			echo "<form name='insertar_actividad'  autocomplete='off' id='insertar_actividad' 
				action='insertar_actividad.php' method='post'>";
			$loadid= 10;
		}


		// 
		//  Imprime la cabecera de la actividad
		//
		echo "
		<div id='main'>
		<div id='nombre'>
		Nombre Actividad<br>";
		echo"<select name='tipo_activ' STYLE='font-size : 13pt'>";

		// Carga e imprime la lista desplegable de actividades

		$result = $db->pregunta_query("SELECT * FROM lista_actividades ORDER BY nombre_actividad"); 

		echo "<option value='0' >-----</option>";
		while($row5 = $result->fetch_array(MYSQLI_BOTH)){
			echo '<option value="'.$row5[0].'" ';
			if ((isset($rowload)) && ($rowload['tipo_activ']==$row5[0]))  {
				echo 'selected';
			}
			echo '>'.$row5[1].'</option>';
		}
		echo "</select>
		</div>";

		//  Imprime la fecha
		echo "
		<div id='fecha'>";
		if (isset($rowload))  {
			$fecha=fecha_sql_txt($rowload['fecha_actividad']);
		}
		else  {
			$fecha=date("d/m/Y");
		}
		echo "Fecha<br><input type='text' name='fecha_actividad' size='10' value='".$fecha."' STYLE='font-size : 13pt'>
			</div>";

		//  Carga e imprime la lista desplegable de los responsables (tutores) de actividad
		echo  "<div id='responsable'>Responsable<select name='responsable' STYLE='font-size : 13pt'>";
		$row_tutor= $_SESSION['tutores'];
		echo "<option value='0' >-----</option>";
		foreach($row_tutor as $tut){
			echo "<option value='".$tut['id']."' ";
			if ($rowload['responsable']==$tut['id'])  {
				echo 'selected';
			}		
			echo ">".$tut['nombre']."</option>";	
		}
		echo "</select>
		</div>";   // nombre

		echo  "<div id='responsable2'>Responsable 2<select name='responsable2' STYLE='font-size : 13pt'>";
		$row_tutor= $_SESSION['tutores'];
		echo "<option value='0' >-----</option>";
		foreach($row_tutor as $tut){
			echo "<option value='".$tut['id']."' ";
			if ($rowload['responsable2']==$tut['id'])  {
				echo 'selected';
			}		
			echo ">".$tut['nombre']."</option>";	
		}
		echo "</select>

		</div>";   // nombre


/*
- Al usar el nuevo botón de borrado de asistente, no 'vuelve' a la página en la que estaba.
*/


		echo "<div id='volunt'>Voluntarios/as:
			<input type='text' value='".$rowload['volunt']."' ></div>";
?>

		<div id="volunt">Voluntarios/as:<br>
		<input name='volunt' STYLE='font-size : 13pt' value='<?php echo $rowload['volunt']; ?>' >
		</div>	
	
		<div id="descripcion">Descripción:<br>
		<textarea name='comentario_actividad' STYLE='font-size : 13pt' ROWS='4' COLS='50'><?php echo $rowload['comentario_actividad']; ?></textarea>
		</div>
		
		<div id="observaciones">Observaciones:<br>
		<textarea name='observaciones_actividad' STYLE='font-size : 13pt' ROWS='4' COLS='50'><?php echo $rowload['observaciones_actividad']; ?></textarea>
		</div>
		
		<div id="send">
		<img src="graficos/asistencias.png"><br><input type="submit" value="Guardar y/o Asistencias" style="font-size:18; ">
		</div>
		
		
		<div id="activ_pdf">
		<input type="button" value="Pdf para imprimir" onclick="window.location='actividad_pdf.php?load=<?php echo $rowload['id_activ']; ?>'">
		</div>

		<div id="send2">
		<input type="button" value="<< Volver" onclick="window.location='actividad.php?load=<?php echo $rowload['id_activ'];?>'" 
				style="font-size:24;background-color: #77FF77; ">
		</div>

			<div id="titulos">
		<table><tr>Actividad: <?php echo $rowload['tipo_activ'] ?></tr><tr>&nbsp; &nbsp; Fecha: <?php echo $row[0] ?></tr></table>
		</div>
			</form>

		<div id="iframe">			
		<table width=100%>		
		<form name="comentario_actividad"  autocomplete='off' id="comentario_actividad" action="insertar_comentario_actividad.php" method="post">
			<tr width=30%>
			<td width=30%>
			<div id="container">

				<div><?php echo "<input type='text'  id='inputString' name=idu onkeyup='lookup3(this.value);' onblur='fill();' />";?>
				</div>
					<div class="suggestionsBox" id="suggestions" style="display: none;z-index:4;">
						<img src="graficos/upArrow.png" style="position: relative; top: -18px; left: 30px;" alt="upArrow" />
						<div class="suggestionList" id="autoSuggestionsList">
						</div>
					</div>
			</div>
		</td>
						
			
			
		<td>
			<textarea name='comentario' ROWS=4 COLS=50></textarea>
		</td>
			
						

			<?php
			//  Guarda el valor $responsable según una determinada $id_activ

			$result=$db->pregunta_query("SELECT responsable FROM actividad WHERE id_activ=$id_activ"); // OPTIMIZAR

			$row=$result->fetch_array(MYSQLI_BOTH);
			$responsable=$row["responsable"];
						
			//  Envía los datos del formulario (fecha, id_unico, tutor responsable) e imprime el botón 

			echo "<td>";
			echo "<input type='hidden' name='fecha_actividad' value='".fecha_txt_sql($fecha)."' />";  
			echo "<input type='hidden' name='idunico' id='idunico' value='' />";
			echo "<input type='hidden' name='tutor' id='tutor' value='".$responsable."' />";
			echo "<input type='hidden' name='id_activ' id='id_activ' value='".$id_activ."' />";  
			echo "<input type='image' src='graficos/guarda.png' name='submit' title='Insertar comentario'>";
			echo "</td>";
			echo "</tr>";
			echo "</form>";
			echo "</table>";
			


			$result=$db->pregunta_query("SELECT * FROM comentario WHERE id_actividad=$id_activ ORDER BY id_coment DESC;");
			echo "
			<table>
			<tr>
			</table>
			";
			
			
			
			while($row = $result->fetch_array(MYSQLI_BOTH))  // $row: todos los comentarios de una actividad definida por $id_activ
			{
				$query="SELECT * FROM persona WHERE id_unico=".$row['id_unico'];
				$result2 = $db->pregunta_query($query);  
				while($row2 = $result2->fetch_array(MYSQLI_BOTH)) {  // $row2: para buscar nombre y apellido de $row['id_unico']
					$nombre=$row2['nombre'];
					$apellido=$row2['apellido1'];
					$apellido2=$row2['apellido2'];
				}
				
				echo
				"	
				<table width=100%>
				
				<form name='comentario_actividad'  autocomplete='off' id='comentario_actividad' action='actualizar_comentario_actividad.php' method='post'>
				<tr width=30%>
				<td width=30%>
				<b>".$nombre." ".$apellido." ".$apellido2."</b>
				</td>";
				
				echo "
				<td>
				<div id='cuadro_asistencia'>
				<textarea name='comentario' ROWS=4 COLS=50>$row[3]</textarea>
				</div>
				</td>
				<td>
				<input type='hidden' name='id_coment' id='id_coment' value='".$row[0].">' /> 
				<input type='hidden' name='tutor' id='tutor' value='".$responsable.">' /> 
				<input type='hidden' name='id_activ' id='id_activ' value='".$id_activ."' />  
				<input type='image' src='graficos/guarda.png' name='submit' title='Actualizar comentario'>
				<a href='javascript:deletecheckasistente(".$row['id_coment'].");'><img src='graficos/del.png' border=0></a>
				</td>
				</tr>
				</form>
				</table>";
				
			}
			$db->cerrar_conexion();
			?>
			
			</div>
		</div>
	</body>
</html>
