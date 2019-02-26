<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// Archivo de configuración                                              //
//                                                                       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
//                                                                       //
// Copyright (C) 2011 Borja Aguirre &  Asoc. Zubietxe                    //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

define('BASE_PATH',realpath('.'));
define('BASE_URL', dirname($_SERVER["SCRIPT_NAME"]));

unset($CFG);  // Ignore this line
$CFG = new stdClass();
$AUX = new stdClass(); 

include_once "clases/class.leer_mysqli.php"; 

//=========================================================================
// 1. DATABASE SETUP
//=========================================================================
// Base de datos del programa, en MySql		                         //
//                                                                       //

$CFG->dbtype    = 'mysqli';     // 'pgsql', 'mysqli', 'mssql' o 'oci'
$CFG->dbhost    = 'localhost';  // normalmente 'localhost' 
$CFG->dbname    = 'zubietxe';   // nombre de la base de datos
$CFG->dbuser    = 'root';   // nombre de usuario
$CFG->dbpass    = 'zubietxe20100';   // password de usuario
$CFG->prefix    = 'bd_';       // prefijo
$CFG->dboptions = array(
    'dbport'    => '',          // El número de puerto TCP a utilizar 
                                //  al conectarse a la base de datos. 
);




//=========================================================================
// 2. SERVICIOS
//=========================================================================
// Lista de servicios de la asociación.	                                  //
// Los datos de entrada y salida de cada persona dependen del servicio    //
//                                                                        //

$datos = new Leer_Mysqli(); 
$lista = $datos->lista_query("SELECT * FROM servicios"); 
foreach($lista as $serv) {
	$AUX->servicio[$serv['codigo']] = $serv['nombre']; 
}




//=========================================================================
// 3. TABLAS AUXILIARES
//=========================================================================
// Tablas auxiliares para las listas desplegables                         //
//                                                                        //

/*$AUX->aux['edad'] = array(
		array(1, "de 18 a 24 años", 18, 24),
		array(2, "de 25 a 30 años", 25, 30),
		array(3, "de 31 a 35 años", 31, 35),
		array(4, "de 36 a 40 años", 36, 40),
		array(5, "de 41 a 45 años", 41, 45),
		array(6, "de 46 en adelante", 46, 100)
	);
*/

$AUX->aux['edad'] = array(
		array(1, "de 18 a 24 años", 18, 24),
		array(2, "de 25 a 30 años", 25, 30),
		array(3, "de 31 a 35 años", 31, 35),
		array(4, "de 36 a 40 años", 36, 40),
		array(5, "de 41 a 45 años", 41, 45),
		array(6, "de 46 en adelante", 46, 100)
	);


$AUX->aux['area'] = array(
		array(1, "Europa"),
		array(2, "Magreb"),
		array(3, "Africa subsahariana"),
		array(4, "América latina"),
		array(5, "Resto del mundo"),
		array(6, "Resto del Estado")
	);




//=========================================================================
// 4. ITEMS LISTABLES EN 'RESULTADOS'
//=========================================================================
// Los items que aparecen aquí aparecerán en el apartado de Resultados.   //
//                                                                        //


$AUX->datos_items = array(
		"area" =>  "Nacionalidad",
		"edad"  =>   "Edad",  
		"estado_civil" =>  "Estado civil",
		"nucleo_conv"  => "Nucleo convivencia",
		"poblacion"  =>  "Poblacion vivienda actual",
		"poblacion_padron"  =>   "Poblacion padrón actual",
		"DatosFormativosItem"  =>  "Nivel estudios",
		"NivelCastellano"  =>  "Nivel de castellano",
		"Trabaja"  =>  "Trabajo",
		"AnosConsumo"  =>  "Años consumo",
		"ConsumoPrinc"  =>  "Consumo Principal",
		"EnfMentalTratamiento"  =>  "Centro de tratamiento",
		"TratamientoTipo"  =>  "Tipo de tratamiento",
		"procedencia_demanda_lista"  =>  "Procedencia de la demanda",
		"ingresos" => "Ingresos",
		"enferm" => "Enfermedades", 
		"penal" => "Penales",
		"tratam" => "Tratamientos", 
		"salida" => "Motivo de la salida"
	);






// Número máximo de nombres en el cuadro del Indice 
define ('MAXIMO_SUGGESTIONS', 10);



//=========================================================================
// 5. PERMISOS
//=========================================================================
// Acceso a las diferentes páginas según los niveles de permisos.   //
// Se activa en headers.php                                          //

$AUX->permisos = array(
			'seguimiento' => 0,
			'persona' => 0,
			'actividad' => 0,
			'indicadores' => 5,
			'admin' => 6,
			'form_pei' => 7,
			'perfil' => 0,
			'consulta' => 0,
			'persona_alta_baja' => 0
	);


//=========================================================================
// TERMINADO!  
//=========================================================================


$_SESSION['aux'] = $AUX; 
$_SESSION['cfg'] = $CFG; 

// Esto es por si se quiere poner un acceso aquí a setup.php
// Pero he preferido ponerlo provisionalmente después del login
// para 
// require_once(dirname(__FILE__) . '/lib/setup.php'); // Do not edit

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!

?>
