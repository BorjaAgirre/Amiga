<?php
echo "test";
$texto = "Hola<img423|left>Borja<img34|right>Quetal";
$texto2 = ""; 
$imagenes = array();
preg_match_all( '/^.*\<img([0-9]+)\|(right|left)>.*$/i', $texto, $imagenes); 
echo "<pre>";print_r($imagenes);echo "</pre>"; 

?>
