<?php


function antihack($text)
{
	$text = strip_tags($text);	
	$text = str_replace ("*", "", $text);
	$text = str_replace ("%", "", $text);
	$text = str_replace ("'", "", $text);
	$text = str_replace ("#", "", $text);
	$text = str_replace ("\\", "", $text);
	$text = str_replace("mytext","",$text);
	$text = str_replace("mstext","",$text);
	$text = str_replace("query","",$text);
	$text = str_replace("insert","",$text);
	$text = str_replace("into","",$text);
	$text = str_replace("update","",$text);
	$text = str_replace("delete","",$text);
	$text = str_replace("select","",$text);
	$text = str_replace("Character","",$text);
	$text = str_replace("MEMB_INFO","",$text);
 	$text = str_replace("IN","",$text);
 	$text = str_replace("OR","",$text);
 	$text = str_replace (";", "", $text);
	$cadena = str_replace (",", "", $text);
 
	return $text;
}


if ($_POST['user']==NULL && $_POST['pass']==NULL) {
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php?error=2'>";
} else {

	session_start();

	// Se inicializan las variables

	include_once "clases/class.leer_mysqli.php"; 
	include "include/inicializa.php"; 	
	include "config.php";	  
	include "include/array_desplegable.php";  
// echo "<br>login.php ejecutándose"; 
	// Se ejecuta el login
	include("clases/class.login.php");
	$login=new login();
	$login->inicia(18000, antihack($_POST['user']), $_POST['pass']);
}
?>
