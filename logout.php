<?php
unset($_SESSION['idusuario']);
setcookie("usuario", $usuario, time()-29999);
setcookie("grp", $usuario, time()-29999);
setcookie("prm", $usuario, time()-29999);
setcookie("idusuario", $usuario, time()-29999);
setcookie("idusuario", "");
session_destroy();
echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";	
?>
