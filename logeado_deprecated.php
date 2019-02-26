<?php
session_start();
include("login.class.php");
$login=new login();
$login->inicia();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Usuario</title>
</head>
<body>
<h1>Estas logeado</h1>
<?php echo $_SESSION['idusuario']; ?>
</body>
</html>
