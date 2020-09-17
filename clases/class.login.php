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
					$_SESSION['usuario']=$_COOKIE['usuario'];
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
	$ip_login = $this->get_client_ip(); 
	$this->repeticionLogins($db, $usuario);
//	echo "<br>Password: ".$row['password']; 
	if ($row['pass'] == $clave_md5)  {
		$query1 = "INSERT INTO logins (nombre, momento, otros, ip) VALUES ('".$usuario."' , NOW() , '-OK-' , '".$ip_login."');";
		$guardalogin = $db->pregunta_query($query1);
 
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
		$_SESSION['nombreusuario']=$nombre_tutor;
		$_SESSION['grupousuario']=$grupos;
		$_SESSION['permisousuario']=$permisos;

		header( "Location: alertasprevias.php" );
	} else {
		// Si la clave es incorrecta
		$query2 = "INSERT INTO logins (nombre, momento, otros, ip) VALUES ('".$usuario."' , NOW() , 'err'  , '".$ip_login."');";
		$guardalogin = $db->pregunta_query($query2);		
		header( "Location: index.php?error=1" );
	}
	$db->cerrar_conexion(); 
}

	function repeticionLogins($db, $usuario) {
		$query3 = "SELECT momento, DATE(momento) as fecha, TIME(momento) as hora, nombre, otros FROM logins
			WHERE nombre = '".$usuario."' ORDER BY id_login DESC LIMIT 5;";
		$guardalogin = $db->lista_query($query3);	
/*		echo date('h:i:s', strtotime("-5 minutes")); 
		echo "<br>".date('h:i:s', strtotime($guardalogin[4]['momento'])); 
		echo "<br>".strtotime("-5 minutes"); 
		echo "<br>".strtotime($guardalogin[4]['momento']); 	     */
		if ( strtotime($guardalogin[3]['momento']) > strtotime("-2 minutes") ) {
			echo "<h3>Cuatro intentos fallidos en los últimos dos minutos</h3>";
			echo "Tendrás que esperar un par de minutos para volver a introducir la contraseña";
			die(); 
		}
		foreach ($guardalogin as $login) {

//			echo "<pre>"; print_r($login); echo "</pre>";
		}	

	}


	// Codifica idusuario 
	private function codificar_usuario($usuario) {
		return md5($usuario);
	}

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



}



?>
