 <?php
session_start();
include_once("clases/class.login.php");
$login=new login();
$login->inicia();

$pagina = 'perfil'; 
include_once "clases/class.leer_mysqli.php"; 
include_once "include/imprime.php";
include_once "include/fechas.php";
include_once "headers.php";
header_principal("perfil");
include_once "menu_lateral.php";

if (isset($_SESSION['idusuario'])) 	{
	$id_usuario = $_SESSION['idusuario'];
}

	$db = new Leer_Mysqli(); 
	$tut = $db->tutor_idtutor($id_usuario); 
	$nombre_tutor = $tut['nombre'];
	$correcto = false;

  	if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario
	        // Procedemos a comprobar que los campos del formulario no estén vacíos
		if($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) { // comprobamos que las contraseñas ingresadas coincidan
	        	$texto = "Las contraseñas ingresadas no coinciden.";
	        } else {
			$usuario_clave = $db->pregunta_query_seguro("select", "tutor", "pass", "id_tutor", $id_usuario);
			$usuario_clave_nueva = md5($_POST ['usuario_clave']);  // encriptamos la contraseña ingresada con md5
	            	// comprobamos que no sea la misma contraseña
	            	if($usuario_clave_nueva == $usuario_clave) {
				$texto = "<br>Has puesto la misma contraseña que estaba. ";
	           	 } else {
	               		// ingresamos los datos a la BD
	              		$db->pregunta_query_seguro("update", "tutor", "pass", "id_tutor", $usuario_clave_nueva, $id_usuario); 
				$texto = "Se ha introducido correctamente la contraseña<br>";
				$correcto = true; 
	           	 }
      		}
		$db->cerrar_conexion(); 
    	} 
?>
	<div class='wrap_perfil'>
<?php if (isset($texto)) echo "<div id='texto_pass'>".$texto."<br></div><p>&nbsp;</p>";   
	if (!$correcto) {
		echo "<div id='cuadro_texto'> Tu nombre de usuario/a es: <b>".$nombre_tutor."</b>."; 
		echo "<br>(Tu nombre de usuario/a no va a cambiar)"; 
		echo "<br>Escribe dos veces la nueva contraseña para la base de datos"; 
		echo "<br>(Si aparecen caracteres escritos en el formulario, bórralos)"; 
		echo "<br>Recuérdala bien, la necesitarás la próxima vez que entres... "; 
		echo "<br></div>"; 
?>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
       		<label>Nueva contraseña:</label><br />
     	   		<input type="password" name="usuario_clave" maxlength="15" /><br />
     	   		<label>Confirmar Contraseña:</label><br />
     	   		<input type="password" name="usuario_clave_conf" maxlength="15" /><br />
      	  		<input type="submit" name="enviar" value="Registrar" />
      	  		<input type="reset" value="Borrar" />
		</form>
	</div>
<?php
	}
?> 
