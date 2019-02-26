<html>
<? include("headers.php")?>	
<script type="text/javascript" src="menu_superior.js"></script>
<script type="text/javascript" src="jq/jquery.min.js"></script> 
<script type="text/javascript" src="jq/js/scripts.js"></script>




<style type="text/css">#iframe2	 		{height:80%; width:100%; background:#EEEEEE;overflow:auto; position:absolute; top:10%; left: 0%; font-size:18; font-family:'Verdana'; visibility:show}</style>
<style type="text/css">#indice2 {width:20%; height:70%; padding:5px; margin-top: 20px;	margin-bottom: 20px;  border:3px solid #2f5d69;	position:absolute;}</style>




	<span id="indice2">
		<center><font size="5">INDICE</font></center>
		<div id="iframe2">
		<form action="insertar_lista.php" method="post">
		<?
		
		include "conexion.php";
		
		$result=mysql_query("SELECT DISTINCT (dni_pas), nombre, apellido1, max(id_pers)
		FROM persona
		GROUP BY dni_pas ORDER BY max(id_pers)", $conexion);
		include "cerrar_conexion.php";
		echo"<table width=250>
		";
		while($row=mysql_fetch_row($result)){
		  echo"<tr>
			<td>$row[1] $row[2]</td><td><input type='checkbox' name='$row[3]' size='12;font-weight:bold' value='$row[3]'></td>
				
			</tr>";
		}
		echo"</table>";
		
		
		
		?>
		
		<input type="submit" value="Guardar" style="font-size:24;background-color: #77FF77; ">
		</form>
		</div>
		</center>
		
		
		</span>
		
		
		</html>