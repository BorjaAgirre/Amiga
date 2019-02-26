<?php

class Registra {

public $array_error; 

private $inserta;

private $query; 

private $campo_actual; 



/* 
*  Constructor de la clase Registra. 
*/
function Registra() {
		//	echo "<br>Interior de la función Registra"; 
}





/*
*  Función que contiene el array de los posibles errores. 
*  Guarda en $array_error los valores: 'error'=>número del error, 'valor'=>texto correspondiente al error
*/
function gestionaError($error) {
	$valor_error = array (
		1 => 'Fecha incorrecta; número de argumentos incorrecto',
		2 => 'Fecha incorrecta'
	);
	$this->array_error[$this->campo_actual] = $error; 
	return array('error'=>$error, 'valor'=> $valor_error[$error]); 
}



/*
*  Función que valida las fechas: se asegura de que es correcta
*  Admite: poner día, mes y año, o sólo día y mes; poner dos o cuatro cifras en el año; usar / o - como separador.
*  El orden debe ser día-mes o día-mes-año.
*  Da dos posibles errores, 1 y 2. 
*/
function validaFecha($campo, $fecha){ 
	$this->campo_actual = $campo; 
//	echo "<br>Campo: ".$campo; 
	if (strpos($fecha, "/")) $separador = "/";
	if (strpos($fecha, "-")) $separador = "-";
	$fechasal = explode($separador,$fecha); 
	$args = count($fechasal); 
	if (($args > 3) || ($args < 2)) {
		return $this->gestionaError(1); 
	} else {
		if ($args == 2) $fechasal[2] = date ('Y');  	// si no viene año, lo añade 
		if ($fechasal[2]<100)	{			// si el año tiene sólo dos cifras, lo completa
			if ($fechasal[2]<20) {
				$fechasal[2]=$fechasal[2]+2000;
			} else {
				$fechasal[2]=1900+$fechasal[2];
			}
		}
		if (!checkdate($fechasal[1], $fechasal[0], $fechasal[2]))  {
			return $this->gestionaError(2); 
		} 
		$ret= $fechasal[2]."-".$fechasal[1]."-".$fechasal[0]; 
	}
	return array('error'=>0, 'valor'=>$ret); 
} 


/*
*  Función que valida los números
*/
function validaNumerico($valor)   {
     if(empty($valor))  {
           return false; //campo vacio no validar
     } else {
          if(ctype_digit($valor))  {
               return false; // Si es un número
          } else {
                return true; // Error no es un número
          }
     } 
}



/*
*  Función que valida las cadenas de texto sencillas
*/
function alfabetico($valor)  {
      $permitidos = '/^[A-Z üÜáéíóúÁÉÍÓÚñÑ]{1,50}$/i';
      if(empty($valor)) {
           return false; // Campo vacio no validar
      } else {
           if (preg_match($permitidos,$valor)) {
                return false; // Campo permitido 
          } else  { 
                return true; // Error uno de los caracteres no hace parte de la expresión regular 
          } 
     } 
} 




/*
*  Función que inserta un dato, con su clave, en el array $inserta, para su uso posterior en escribeQuery
*/
function insertaDato($campo, $dato) {
	$this->inserta[$campo] = $dato;
}


/*
*  Función que escribe el query final, correspondiente al array $inserta, para insertar un dato en MySql
*/
function escribeQuery($tabla) {
	$query_suj = "";
	$query_pred = "";
	$coma = ""; 
	foreach ($this->inserta as $key => $ins) {
		$query_suj .= $coma.$key;
		$query_pred .= $coma."'".$ins."'"; 
		$coma = ", ";
	}
	$query = "INSERT INTO ".$tabla." (".$query_suj.") VALUES (".$query_pred."); "; 
	return $query; 
}

}

?>
