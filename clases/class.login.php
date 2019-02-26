<?php

include_once "class.leer_mysqli.php"; 

class login {



// Inicia sesion
public function inicia($tiempo = 18000, $usuario = NULL, $clave = NULL) {	
	if ($usuario == NULL && $clave == NULL) {
			// Verifica sesion
			if ($_COOKIE['usuario']=="")
				header( "Location: index.php" );
			if (isset($_SESSION['idusuario'])) {
				//echo "Estas logeado";
			} else {
				// Verifica cookie
				if (isset($_COOKIE['idusuario'])) {
					// Restaura sesion
					$_SESSION['idusuario']=$_COOKIE['idusuario'];
				} else {
					// Si no hay sesion regresa al login
					header( "Location: index.php" );
				}
			}	
	} else {
		$clave_md5 = md5($clave); 
		$this->verifica_usuario($tiempo, $usuario, $clave_md5);
	}
}

	
//  Verifica login
private function verifica_usuario($tiempo, $usuario, $clave_md5) {

	$db = new Leer_Mysqli(); 
	$usuario=strtolower($usuario);
	$result = $db->pregunta_query("SELECT * FROM tutor WHERE nombre='".$usuario."'");
	$row = $result->fetch_array(MYSQLI_BOTH);
//	echo "<br>Password: ".$row['password']; 
	if ($row['pass'] == $clave_md5)  {

		// Si la clave es correcta
		$permisos=$row['nivel']; 
		$grupos=$row['grupo'];
		//$idusuario=$this->codificar_usuario($usuario); Modo HASH
		$idusuario=$row['id_tutor'];
		$nombre_tutor = $row['nombre']; 

		// Crea las cookies
		setcookie("id_usuario", $idusuario, time()+$tiempo);
		setcookie("usuario", $usuario, time()+$tiempo);
		setcookie("grp", $grupos, time()+$tiempo);
		setcookie("prm", $permisos, time()+$tiempo);
		setcookie("nom", $nombre_tutor, time()+$tiempo);
		
		$_SESSION['idusuario']=$idusuario;

		header( "Location: seguimiento.php" );
	} else {
		// Si la clave es incorrecta
		header( "Location: index.php?error=1" );
	}
	$db->cerrar_conexion(); 
}


// Codifica idusuario 
private function codificar_usuario($usuario) {
	return md5($usuario);
}
}



?>
