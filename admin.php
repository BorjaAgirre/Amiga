<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();

include ("headers.php");
header_principal("admin"); 
?>

<html>
<body>
	<iframe name="phpmyadmin" width="80%" height="70%"></iframe>
</body>
</html>
