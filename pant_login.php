
<html>
<head>
<title>Zubietxe</title>
<link href='css/zubietxe.css' rel='stylesheet' type='text/css'>

</head>
<body bgcolor='#FFFFFF'>


<!--
<p class="csscheck">Este documento está escrito en XHTML y CSS2;
 y el navegador que estás utilizando es muy viejo, 
eso quiere decir que podrás leer el contenido aceptablemente, 
pero necesitarás un navegador más moderno para ver el documento correctamente.</p>
-->

<div id="maini">
	<link href="zubietxe.css" rel="stylesheet" type="text/css">
	<center><img src="graficos/logotipo.jpg" width=200>	</center>
	<span style="position:absolute; bottom:0px; right:0px; font-family:arial; font-size:14px"><i>Amiga 1.0 - 2019</i></span>

	<form name="login" class='div_login' id="login" action="login.php" method="post">
				
			<!-- Div formulario DATOS PERSONALES -->
			<div id="user" class='form_login'>
			Usuario<br><input type="text" name="user" size="12">
			</div>
					
			<div id="password"  class='form_login'>
			Contraseña<br><input type="password" name="pass" size="12">
			</div>
						
						
			<div id="sendlogin"  class='form_login'>
			<input type="submit" name="submit" value="Entrar" />
			</div>

					
			<div id="error">
			<?php
				if (isset($_GET['error'])) {
					echo '<center><img src="/graficos/error.png"><br><b>¡Usuario o clave incorrecta!</b></center>';
				}
			?>
			</div>
	</form>
</div>

<!-- 
<div id='noticias' style='color: #A80808'>
VERY IMPORTANT: he visto que confundís algunas personas porque tienen el mismo nombre. A ver si en breve ponemos fotos en la base de datos. Mientras tanto, acordaos de utilizar el botoncito 'Activos' para que solamente os aparezcan los que están dados de alta en el Centro de Día o el servicio que sea, así eliminaréis posibles confusiones.  
</div>
-->





</body>
</html>
