<?php




function cabecera ($config_head) {
	foreach ($config_head['array_css'] as $css) {
		echo "\n<link href='".$css."' rel='stylesheet' type='text/css'>";
	}
	echo "\n<html>";
	foreach ($config_head['array_javascript'] as $javascr) {
		echo "\n<script type ='text/javascript' src='".$javascr."'></script>"; 
	}
	echo "\n<head><title>Zubietxe</title>";
	if ($config_head['charset'] == 'iso') echo "\n<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=ISO-8859-1'></head>";
	if ($config_head['charset'] == 'utf') echo "\n<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'></head>";
}


function actividadesInicial($pagina) {
	global $id_activ; 
	if ($pagina=="actividades") {
		if (isset($_GET['acude']))
		{
			$id_activ=$_GET["acude"];
			echo "<body bgcolor='#FFFFFF'  onload='asistencia();'>";
		} else if (isset($_GET['load'])) {
			echo "<body bgcolor='#FFFFFF' >";
		} else	{
			echo "<body bgcolor='#FFFFFF' >"; // posibilidad cambiar fondo si no hay usuario 
		}
	} else {
		echo "<body bgcolor='#FFFFFF'  onload='ningunrecuadro();datos_personales();'>";		
	}
}	

function menuSuperiorDerecho ($permisos, $dir) {
	// Menú superior derecho 
	global $perm_conf, $grupo;
	echo "<span id='headers'><b>MENU</b><br>";
	if ($permisos > $perm_conf['seguimiento'])		echo "<a href='".$dir."seguimiento.php'>Seguimiento</a><br>"; 
	if ($permisos > $perm_conf['persona'])			echo "<a href='".$dir."persona.php'>Persona</a><br>" ;
	if ($permisos > $perm_conf['actividad'])		echo "<a href='".$dir."actividad.php'>Actividades</a><br>" ;
	if ($permisos > $perm_conf['indicadores'])		echo "<a href='".$dir."indicadores.php'>Indicadores</a><br>" ;
	if ($permisos > $perm_conf['admin'])			echo "<a href='".$dir."admin.php'>Admin</a><br>"; 
	if ($permisos > $perm_conf['form_pei'])			echo "<a href='".$dir."include/pei/form_pei.php'>PEI</a><br>"; 
	if ($grupo == 9)					echo "<a href='".$dir."include/include/formularios
									/form_situacion:social.php'>Ficha Sit. Soc.</a><br>"; 
	if ($permisos > $perm_conf['consulta'])	 		echo "<a href='".$dir."consulta.php'>Consultas</a><br>" ;
	if ($permisos > $perm_conf['perfil'])	 		echo "<a href='".$dir."login_cambiar.php'>Perfil</a><br>" ;
	if ($permisos > $perm_conf['persona_alta_baja'])	echo "<a href='".$dir."persona_alta_baja.php'>Alta-Baja</a><br>"; 
	echo "<a href='".$dir."logout.php'>Salir</a><br></span>";
}
	// Aviso de logueo, superior izquierdo
/*	echo "<div id='superior_izda'>
			Logueado como <b><i>".ucwords($usuario)."</b>(Grupo: ".ucwords($grupo).")</i><br>";
	include "leer_lanbide.php"; 
	echo "</div>";
*/

function logoCentral() {
	// Logo central 
	echo "<div id='logotipo'><img src='graficos/logoweb.png'></div>";
}


function pestanas($pagina) {
	// Pestañas 
	echo "<div id='Menu'>";
	echo "<ul>";

	// pestañas persona
	if ($pagina=="persona") {
		echo "<li><a href='persona.php?load=0' onclick='ningunrecuadro();datos_personales();'>
				<span>Nueva<img border=0px; src='graficos/nueva.png'></span></a></li>";
		echo "<li><a href='#' onclick='ningunrecuadro();datos_personales();'>
				<span>Datos Personales <img border=0px; src='graficos/datos_personales.png'></span></a></li>";
		echo "<li><a href='#' onclick='ningunrecuadro();formativo();'>
				<span>Formativo-Laborales <img border=0px; src='graficos/formativos.png'></span></a></li>";
		echo "<li><a href='#' onclick='ningunrecuadro();salud();'>
				<span>Sanitarios <img border=0px; src='graficos/salud.png'></span></a></li>";
		echo "<li><a href='#' onclick='ningunrecuadro();administrativo();'>
				<span>Administrativo <img border=0px; src='graficos/administrativo.png'></span></a></li>";
		echo "<li><a href='#' onclick='ningunrecuadro();juridico();'>
				<span>Juridico <img border=0px; src='graficos/legal.png'></span></a></li>";
		echo "<li><a href='#' onclick='ningunrecuadro();intervencion();'>
				<span>Intervención <img border=0px; src='graficos/intervencion.png'></span></a></li>";

	// pestañas seguimiento
	} if ($pagina=='seguimiento') {
		echo "<li><a href='#' onclick=''><span>Seguimiento <img src='graficos/seguimiento.png'></span></a></li>";

	// pestañas indicadores
	} if ($pagina=='indicadores') {
		echo "<li><a href='#' onclick=''><span>Indicadores <img src='graficos/seguimiento.png'></span></a></li>";

	// pestañas admin
	}  if ($pagina=='admin') {
//		echo "<li><a href='phpMyAdmin/sql.php?db=zubietxe&table=hito' target='phpmyadmin'><span>PhpMyAdmin2</span></a></li>";
		echo "<li><a href='phpMyAdmin/index.php?db=zubietxe&table=hito&server=1&target=sql.php&token=8ef624956d56e3a32fe2365df0449ab0' target='_blank'><span>PhpMyAdmin</span></a></li>"; 
//		echo "<li><a href='phpMyAdmin/sql.php?db=zubietxe&table=lista_actividades' target='phpmyadmin'><span>Actividades</span></a></li>";
//		echo "<li><a href='phpMyAdmin/sql.php?db=zubietxe&table=nucleo_conv' target='phpmyadmin'><span>N. de Convivencia</span></a></li>";
//		echo "<li><a href='phpMyAdmin/sql.php?db=zubietxe&table=tutor' target='phpmyadmin'><span>Tutores</span></a></li>";

	// pestañas resultados
	} if ($pagina=='resultados') {
		echo "<li><a href='resultados_2010.php' onclick=''><span>Resultados 
				<img src='graficos/nueva.png' border=0></span></a></li>";

	// pestañas actividades
	} if ($pagina=='actividades') {
		echo "<li><a href='actividad.php' onclick=''><span>Nueva 
				<img src='graficos/nueva.png' border=0></span></a></li>";


	// pestañas alta_baja
	} if ($pagina=='persona_alta_baja') {
		echo "<li><a href='persona_alta_baja.php' onclick=''><span>Altas y Bajas 
				<img src='graficos/nueva.png' border=0></span></a></li>";

	// perfil
	} if ($pagina=='perfil') {
		echo "<li><a href='login_cambiar.php' onclick=''><span>Cambiar contraseñas 
				<img src='graficos/nueva.png' border=0></span></a></li>";

	// listas_actividad
	} if ($pagina=='listas_actividad') {
		echo "<li><a href='listas_por_actividad.php' onclick=''><span>Listas por actividad
				<img src='graficos/nueva.png' border=0></span></a></li>";


	// ficha situacion social
	} if ($pagina=='ficha_situacion_social') {
		echo "<li><a href='ficha_situacion_social.php' onclick=''><span>Ficha Situación social
				<img src='graficos/nueva.png' border=0></span></a></li>";
	}
	echo "</ul>";
	echo "</div>";
}


function header_principal($pagina, $config_head = NULL) {
	global $usuario, $grupo, $permisos, $perm_conf; 

	include_once "config.php"; 	// Sin relación con la variable $config_head
	$perm_conf = $AUX->permisos; 	
	$usuario=$_COOKIE['usuario'];
	$grupo=$_COOKIE['grp'];
	$permisos=$_COOKIE['prm']; 
	
	if (isset($config_head)) {
		if (isset ($config_head['array_css'])) {
			if (!is_array($config_head['array_css'])) { $config_head['array_css'][] = $config_head['array_css']; } 
		}
	
		if (isset ($config_head['array_javascript'])) {
			if (!is_array($script)) { $config_head['array_javascript'][] = $config_head['array_javascript']; } 
		}
		$config_head['charset'] = 'utf'; 
	} else {
		$config_head['array_css'] = array ('css/zubietxe.css', 'jq/css/humanity/jquery-ui.css');
		$config_head['array_javascript'] = array ('jq/jquery.min.js', 'jq/jquery-ui.js', 'jq/js/scripts.js', 
				'jq/js/historial.js', 'menu_superior.js'); 
		$config_head['activ'] = true; 
		$config_head['menu'] = true; 
		$config_head['logo'] = true; 
		$config_head['pest'] = true; 
		$config_head['charset'] = 'utf'; 
	}

	// Se ejecutan las diferentes funciones que van dibujando la cabecera

	cabecera ($config_head);
	echo "\n\t<div class='wrap_header'>\n";
	if ($config_head['activ']) actividadesInicial($pagina);
	if ($config_head['menu']) menuSuperiorDerecho ($permisos, $dir);
	if ($config_head['logo']) logoCentral();
	if ($config_head['pest']) pestanas($pagina);
	echo "\n\t</div>\n";  //class wrap_header
}



?>




