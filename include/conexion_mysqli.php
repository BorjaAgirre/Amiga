<?php

$mysqli = new mysqli("localhost", "root", "zubietxe2010", "zubietxe");
if ($mysqli->connect_errno) {
    echo "<br>Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>
