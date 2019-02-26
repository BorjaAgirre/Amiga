<?php
session_start();
include("login.class.php");
$login=new login();
$login->inicia();

$pagina="actividades"; 
include ("headers.php");
include ("fechas.php");
?>


	
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
		toggleDiv('descripcion',0);
		toggleDiv('send',0);
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

		</script>



		
		<!-- Listado de DIV's ##### ETIQUETAS -->
		
		<!-- DIVS DE LA ESTRUCTURA DEL FORMULARIO -->
		<style type="text/css">#main {width:60%; height:70%; margin:0; left:5%;padding:5px; margin-top: 20px;	margin-bottom: 20px; text-align:left; border:1px solid #2f5d69;	position:relative;}</style>
		<style type="text/css">#indice {width:25%; height:70%; right:5%;padding:5px; margin-top: 20px;	margin-bottom: 20px; text-align:left; border:1px solid #2f5d69;	position:absolute;}</style>
		
		
		
		
		<!-- Div formulario DATOS PERSONALES -->
		<style type="text/css">#nombre			{position:absolute; top: 3%;  left: 05%; font-size:18; font-family:'Verdana'; width:300; visibility:show}</style>
		<style type="text/css">#fecha 			{position:absolute; top: 3%;  left: 30%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#responsable		{position:absolute; top: 3%; left: 55%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#descripcion		{position:absolute; top: 20%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#observaciones		{position:absolute; top: 45%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#send	 		{position:absolute; top: 70%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:show}</style>
		<style type="text/css">#send2	 		{position:absolute; top: 91%; margin:0 auto; font-size:18; font-family:'Verdana'; width:200; position:relative; visibility:hidden}</style>
		<style type="text/css">#iframe	 		{height:80%; width:100%; background:#EEEEEE;margin:0 auto;overflow:auto; position:relative; top: 3%; font-size:18; font-family:'Verdana'; visibility:hidden}</style>
		<style type="text/css">#titulos	 		{position:absolute; top: 3%; left: 05%; font-size:18; font-family:'Verdana'; width:200; visibility:hidden}</style>		
		
		
			
		

	
		
		<span id="indice">
		
		<center><font size="5">ÚLTIMAS ACTIVIDADES</font></center><br><br>
		<center>
		<div id="iframe2">
		<?
		include "conexion.php";
		$result=mysql_query("SELECT * FROM actividad ORDER BY id_activ DESC", $conexion);
		include "cerrar_conexion.php";
		echo"<table width=300>";
		  include "conexion.php";
		while($row=mysql_fetch_array($result,MYSQL_BOTH)){
			$result2=mysql_query("SELECT * FROM lista_actividades WHERE id_listaactividad=$row[1]", $conexion);
			$row2=mysql_fetch_array($result2,MYSQL_BOTH);
			$result3=mysql_query("SELECT COUNT(DISTINCT id_unico) FROM comentario WHERE id_actividad=$row[0]", $conexion);
			$row3=mysql_fetch_array($result3,MYSQL_BOTH);
			$row3=fecha_sql_txt($row3);
			$fecha=fecha_sql_txt($row[3]);	
			echo"<tr>
				<td>$row2[1] ($row3[0])</td><td>$fecha</td><td><a href='actividad.php?load=$row[0]'><img src='load.png' border=0></a> 
				<a href='javascript:deletecheck($row[0]);'><img src='del.png' border=0></a></td>	
				</tr>";
		}

		include "cerrar_conexion.php";
		echo"</table>";

		?>
		
		</div>
		
		</center>
		</span>
		
		
		
		

		
		
		<!-- Si se ha seleccionado un usuario, se carga la web con los datos -->
		<?
		if (isset($_GET['load']))
		{
			$loadid=$_GET["load"];
			echo "<form name='insertar_actividad' id='insertar_actividad' action='actualizar_actividad.php?load=".$loadid."' method='post'>";
		}
		elseif (isset($_GET['delete']))
		{
		$deleteid=$_GET["delete"];
		include "conexion.php";
		$result=mysql_query("DELETE FROM actividad WHERE id_activ=$deleteid", $conexion);
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=actividad.php'>";
		}
		else
		{
		echo "<form name='insertar_actividad' id='insertar_actividad' action='insertar_actividad.php' method='post'>";
		}
		?>
		
		<div id="main">
			
			<div id="nombre">
			Nombre Actividad<br>
			<?
			echo"<select name='tipo_activ' STYLE='font-size : 13pt'>";
			include "conexion.php";
			$result=mysql_query("SELECT * FROM lista_actividades ORDER BY nombre_actividad", $conexion); 
			include "cerrar_conexion.php";
			while($row5=mysql_fetch_array($result,MYSQL_BOTH)){
			echo '<option value="'.$row5[0].'" ';
			if ($rowload[1]==$row5[0])   {
				echo 'selected';
			}
			echo '>'.$row5[1].'</option>';
			}
			echo "</select>";
			echo "</div><div id='fecha'>";
			if (isset($_GET['load']))  {
				$fecha=fecha_txt_sql($rowload[3]);
			} else  {
 				$fecha=date("d/m/Y");
			}

			echo "Fecha<br><input type='text' name='fecha_actividad' size='10' value=".$fecha." STYLE='font-size : 13pt'></div>";	
			echo "<div id='responsable'>Responsable";
			echo "<select name='responsable' STYLE='font-size : 13pt'>";
			include "conexion.php";
			$result=mysql_query("SELECT * FROM tutor ORDER BY nombre", $conexion); 
			include "cerrar_conexion.php";
			while($row6=mysql_fetch_array($result,MYSQL_BOTH))  {
				echo '<option value="'.$row6[1].'" ';
				if ($rowload[2]==$row6[1])  {
					echo 'selected';
				}
				echo '>'.$row6[1].'</option>';
			}
			echo "</select>";

?>

			</div>
		
			<div id="descripcion">Descripción:<br>
			<textarea name='comentario_actividad' STYLE='font-size : 13pt' ROWS='4' COLS='50'><?echo $rowload[4]; ?></textarea>
			</div>
			
			<div id="observaciones">Observaciones:<br>
			<textarea name='observaciones_actividad' STYLE='font-size : 13pt' ROWS='4' COLS='50'><?echo $rowload[5]; ?></textarea>
			</div>
			
			<div id="send">
			<img src="asistencias.png"><br><input type="submit" value="Asistencias >>" style="font-size:18; ">
			</div>
			
			
			<div id="send2">
			<input type="button" value="<< Volver" onclick="window.location='actividad.php'" style="font-size:24;background-color: #77FF77; ">
			</div>
	

			<div id="titulos">
			<table><tr>Actividad: <?echo $rowload[1] ?></tr><tr>&nbsp; &nbsp; Fecha: <? echo $row[0] ?></tr></table>
			</div>

			</form>

			<div id="iframe">			
			<table width=100%>		
				<form name="comentario_actividad" id="comentario_actividad" action="insertar_comentario_actividad.php" method="post">
					<tr width=30%>
					<td width=30%>
					<div id="container">
					
						<div>
						<?php 	
							echo "<input type='text'  id='inputString' name=idu onkeyup='lookup3(this.value);' onblur='fill();' />";
								
							?>
							</div>
							<div class="suggestionsBox" id="suggestions" style="display: none;z-index:4;">
								<img src="upArrow.png" style="position: relative; top: -18px; left: 30px;" alt="upArrow" />
								<div class="suggestionList" id="autoSuggestionsList">
								</div>
							</div>
					</div>
				</td>
							
				
				
				<td>
				<textarea name='comentario' ROWS=2 COLS=50></textarea>
				</td>
				
							
				<td>
				<?
				include "conexion.php";
				$result=mysql_query("SELECT responsable FROM actividad WHERE id_activ=$id_activ", $conexion); // OPTIMIZAR
				include "cerrar_conexion.php";
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$responsable=$row[0];
				?>		
					
								
				
				<td>
				<input type="hidden" name="idunico" id="idunico" value="" /> 
				<input type="hidden" name="tutor" id="tutor" value="<?php echo $responsable;?>" /> 
				<input type="hidden" name="id_activ" id="id_activ" value="<?php echo $id_activ;?>" />  
				<input type="image" src="guarda.png" name="submit" title="Insertar comentario">
				</td>	
				</tr>			
				</form>
			</table>
			
			
			
			<?
			include "conexion.php";
			$result=mysql_query("SELECT * FROM comentario WHERE id_actividad=$id_activ ORDER BY id_coment DESC;", $conexion);
			echo "
			<table>
			<tr>
			</table>
			";
			
			
			
			while($row=mysql_fetch_array($result,MYSQL_BOTH))
			{
				
				$result2=mysql_query("SELECT * FROM persona WHERE id_unico=$row[1]", $conexion);
				while($row2=mysql_fetch_array($result2,MYSQL_BOTH))
				{
				$nombre=$row2[1];
				$apellido=$row2[2];
				}
				
				echo
				"	
				<table width=100%>
				
				<form name='comentario_actividad' id='comentario_actividad' action='actualizar_comentario_actividad.php' method='post'>
				<tr width=30%>
				<td width=30%>
				<b>".$nombre." ".$apellido."</b>
				</td>";
				
				echo "
					
				
				<td>
				<textarea name='comentario' ROWS=2 COLS=50>$row[3]</textarea>
				</td>
				
				<td>
				<input type='hidden' name='id_coment' id='id_coment' value='$row[0]>' /> 
				<input type='hidden' name='tutor' id='tutor' value='<?php echo $responsable;?>' /> 
				<input type='hidden' name='id_activ' id='id_activ' value='<?php echo $id_activ;?>' />  
				<input type='image' src='guarda.png' name='submit' title='Actualizar comentario'>
				</td>
				</tr>
				</form>
				</table>";
				
			}

			?>
			
			</div>
		
		</div>
		
		
		
		
	
	</body>
</html>
