
<?php 
$httpfile  = file_get_contents("http://www.lanbide.net/plsql/fr_resultado_busqueda_cursos?idioma=C&cabeceraypie=S&menu=003001%40&tipoorigen=90&area=ALL&provincia=48&inicioimpart=&colectivo=XX&imparticion=TODOS&acreditados=TODOS&textolibre=&codigo=");
// echo $httpfile; 

$pos = strpos($httpfile, "http://www.lanbide.net/plsql/fr_curso_detallado?codigo="); 
$codigo= substr($httpfile, ($pos+55), 5); 

$pruebas = false; 

// LEER $codigo_anterior DE LA BASE DE DATOS
include "conexion.php";
$result_l = mysql_query("SELECT valor, valor2 FROM varios WHERE variable = 'lanbide'");
$row_l = mysql_fetch_row($result_l);
$codigo_anterior = trim($row_l[0]);
$codigo_almacenado = trim($row_l[1]); 
if ($pruebas) echo "código es '".$codigo."' y el código anterior es '".$codigo_anterior."'";

$result_d = mysql_query("select date(fecha_cambio) from varios where variable = 'lanbide'");
$row_d = mysql_fetch_row($result_d);
$fecha_cambio = $row_d[0];
if ($pruebas) echo "<br>fecha cambio:".$fecha_cambio.", date: ".date('Y-m-d')."<br>";

  if (($codigo != $codigo_anterior) || ($fecha_cambio == date('Y-m-d'))) {	// Avisa si hay codigo nuevo o si se ha cambiado hoy mismo
/*		$url_curso = "http://www.lanbide.net/plsql/fr_curso_detallado?codigo=".$codigo."&idioma=C";  */
		$url_curso = "http://www.lanbide.net/plsql/fr_resultado_busqueda_cursos?idioma=C&cabeceraypie=S&menu=003001%40&tipoorigen=90&area=ALL&provincia=48&inicioimpart=&colectivo=XX&imparticion=TODOS&acreditados=TODOS&textolibre=&codigo=";
		echo "<a href='".$url_curso."'><b style='font-size: 150%; background: red;'>NUEVO(S) CURSO(S) DE LANBIDE</b></a>"; 
		echo "<br>Ultimo curso registrado: código ".$codigo_almacenado;
		echo "<br>Nota: puede salir positivo si se han retirado cursos de la lista de Lanbide;"; 
		echo "<br>si el curso ".$codigo_almacenado." no existe, esto es lo que ha ocurrido"; 

		if ($codigo != $codigo_anterior) {	// Cambia el código actual, solamente cuando hay código nuevo (la primera vez)
			mysql_query("UPDATE varios SET valor2 = '".$codigo_anterior."' WHERE variable = 'lanbide'");
			mysql_query("UPDATE varios SET valor = '".$codigo."' WHERE variable = 'lanbide'");
		}
  } else {
 	echo "· No hay nuevos cursos de Lanbide"; 
  }	

		
		

// fclose($guardado);
include "cerrar_conexion.php";


/*

echo "<br>".$url_curso; 
$httpfile2  = file_get_contents($url_curso);
echo $httpfile2; 
echo chr(7); 

echo "<script language='JavaScript'>
                alert('Curso encontrado');
                </script>";


$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
if (mail('incorporacion@zubietxe.org', 'Prueba', 'Este es un mensaje automático enviado por un programa hecho por Borja...', $headers)) echo "Enviado";
*/
?>
