<?php

include_once "clases/class.leer_mysqli.php";


$insert_id_usuario=$_COOKIE['id_usuario'];
$insert_fecha=date("Y/m/d");
$prueba = false; 

if ($prueba) {
	print('<pre>');
	print_r($_POST);
	print('</pre>');
}

$id=-1;

function haz_mktime($fecha) {
	list($ano , $mes , $dia)=explode('/',$fecha);
	if ( $ano == '2000' && $mes == '0'  &&  $dia == '0' ) 
 		$fecha_ret = -1; 
	else 
		$fecha_ret = mktime( 0 , 0 , 0 , $mes , $dia , $ano);
	return $fecha_ret;	
}


include "include/fechas.php"; 


//
// Aquí se realiza el tratamiento de todas las fechas introducidas
//
$fechanac=fecha_txt_sql($_POST['fechanac']);
$fecha_ingreso=fecha_txt_sql($_POST['fechaIngreso']);
$fecha_salida=fecha_txt_sql($_POST['fechaSalida']);
$F_alta_lanbide=fecha_txt_sql($_POST['fechaAltaLanbide']);
$F_renov_lanbide=fecha_txt_sql($_POST['fechaRenovLanbide']);
$F_alta_inem=fecha_txt_sql($_POST['fechaAltaInem']);
$F_renov_inem=fecha_txt_sql($_POST['fechaRenovInem']);
$FechaEmpadronamiento=fecha_txt_sql($_POST['FechaEmpadronamiento']);
$insert_fecha=fecha_txt_sql($_POST['fechaInsert']);
$fpasap =fecha_txt_sql($_POST['fechaPasap']);
$fcedula=fecha_txt_sql($_POST['fechaCaducCedula']);
$fressol=fecha_txt_sql($_POST['fechaResidSolicit']);
$fresconc=fecha_txt_sql($_POST['fechaResidConced']);
$frestrsol=fecha_txt_sql($_POST['fechaResidTrabSolicit']);
$frestrconc=fecha_txt_sql($_POST['fechaResidTrabConc']);
$fentrada=fecha_txt_sql($_POST['fechaEntrada']);
$fprueba=fecha_txt_sql($_POST['fechaPrueba']);



//  
include "include/auxiliar.php";	// Aquí se define la variable $servicio

//
// Crea los valores que se insertarán como fecha inicio y fecha fin de cada servicio
// Calcula el valor activo o no para cada uno de los campos, en la variable $activo[$serv]
//
	foreach($servicio as $serv) {

		// realiza el fecha_txt_sql necesario para todas las fechas
		$fi[$serv] = fecha_txt_sql($_POST['fi_'.$serv]);
		$ff[$serv] = fecha_txt_sql($_POST['ff_'.$serv]);

		// lo mismo para insert_fecha, que además se utilizará para comparar con fecha inicio y fecha final para saber si está activo
		$fecha = fecha_txt_sql($_POST['insert_fecha']);
 		$fecha = haz_mktime($fecha); 

		// valores hay_fi y hay_ff si existen fecha de inicio y fecha fin, respectivamente, en cada servicio
		$hay_fi = ($fi[$serv] <> "") ? 1 : 0; 
		$hay_ff = ($ff[$serv] <> "") ? 1 : 0; 
	
		// prepara las fechas para ser comparadas
 		$f_ini = ($hay_fi) ? haz_mktime($fi[$serv]) : 0;
 		$f_fin = ($hay_ff) ? haz_mktime($ff[$serv]) : 0;
	
		// da el valor de 1 a activo si la persona está activa en ese servicio, según las fechas inicio y fin
		if ( $hay_fi || $hay_ff ) { 
			$activo[$serv] =  (($fecha >= $f_ini && $hay_fi) && ($fecha < $f_fin || !$hay_ff || $f_fin == -1)) ? 1 : 0;
		} else {
			$activo[$serv] = 0; 
		}
	}


$dni_pas=$_POST['dni'];
$id_unico=$_POST['id_unico'];



$db = new Leer_Mysqli(); 


	if ($_POST['id_unico']=="" || $_POST['id_unico']=="0")  // Si no existe el identificador personal, crea uno nuevo
	{
		$result4 = $db->pregunta_query("SELECT MAX(id_unico) FROM persona");    
		$row_max = $result4->fetch_row();		
		$id_unico=$row_max[0] + 1; 
	}


	$nuc=$_POST['nucleoConv'];    // Cambia automáticamente los valores de dirección y población actual


	if ($nuc>6)
	{
		$peticion="SELECT datotexto, dato1 FROM desplegables WHERE despl = 'nucleoconv' AND id_despl=".$nuc."";
		$result5 = $db->pregunta_query($peticion);    
		$row5 = $result5->fetch_array(MYSQLI_BOTH);
		$dir_nucleo_conv=$row5["datotexto"];
		$mun_nucleo_conv=$row5["dato1"];
	} else {
		$dir_nucleo_conv=$_POST['direccionActual'];
		$mun_nucleo_conv=$_POST['poblacion'];
	}



	$result3 = $db->pregunta_query("SELECT COUNT(DISTINCT id_pers) FROM persona WHERE dni='$dni_pas'");    
	$row3  = $result3->fetch_row();
	$countDNI=(int)$row3[0];


	
//
//  Si se ha puesto alguna imagen, la graba aquí
//

	if (isset($_POST['action'])) {
		if ($prueba) { echo "encontrada imagen en insertar_persona"; }
//		include "include/upload.php";

		if ($prueba) {
			if ($_FILES["imagen"]["error"] > 0)	 {
 				echo "<BR>Error al leer imagen en insertar_persona: " . $_FILES["imagen"]["error"] . "<br />";
 			}  else  {
				echo "<br />Upload: " . $_FILES["imagen"]["name"] . "<br />";
				echo "Type: " . $_FILES["imagen"]["type"] . "<br />";
				echo "Size: " . ($_FILES["imagen"]["size"] / 1024) . " Kb<br />";
 				echo "Stored in: " . $_FILES["imagen"]["tmp_name"];
 			}
		}

		include "class.upload/class.upload.php";

		$handle = new upload($_FILES['imagen']);   
		if ($handle->uploaded) {
   			$handle->file_new_name_body   = $id_unico;
			$handle->image_convert        = 'jpg';
			$handle->file_overwrite	      = true; 
    			$handle->image_resize         = true;
   			$handle->image_x              = 100;
   			$handle->image_y              = 135;
  			$handle->image_ratio_fill    = true;  
			$handle->file_new_name_ext    = 'jpg';
  			$handle->process('upload_imagenes/');
 			if ($handle->processed) {
      				if ($prueba) { echo 'image resized'; }
        			$handle->clean();
    			} else {
			        if ($prueba) { echo 'error : ' . $handle->error; }
     			}    
		} 
	} else {
		if ($prueba) { echo "no encontrada imagen en insertar_persona"; }
	}



// 
// Revisa cual es el último historial= actual de este id_unico, para cambiarlo posteriormente. 

$query_ac = "SELECT id_pers FROM persona WHERE id_unico = ".$id_unico." AND historial = 'actual';";
if (!$prueba) echo "query_ac: ".$query_ac;
$result_actual = $db->lista_query($query_ac);
$ultimo_actual = $result_actual[0]['id_pers']; 
if (!$prueba) echo "<br>ultimo_actual: ".$ultimo_actual; 




//
//  Se insertan los valores. Utilizamos $db->escape en los casos en que sean items de texto
//
	
	$query="INSERT INTO persona 
	(
	nombre,			
	apellido1, 		
	apellido2,		
	fechanac, 		
	lugarNac,		
	dni, 		
	numSegSoc, 	
	numExpediente,		
	nacionalidad,	
	telefono, 		
	direccionActual, 		
	poblacion, 		
	nucleoConv, 	
	estadoCivil, 		
	hijos, 		
	numHijos, 	
	observacionesHijos, 	
	telefonosInteres,
	fechaIngreso, 		
	fechaSalida, 		
	procedenciaDemanda, 
	responsable, 				
	comedorLun, 		
	comedorMar, 		
	comedorMie, 		
	comedorJue, 		
	comedorVie, 		
	transporte, 		
	listaEspera,
	observacionesNivelFormativo,
	nivelFormativo,
	observacionesIdioma,
	EdadAbandonoEstudios,
	LaboralOrigen,
	LaboralEspana,
	TiempoTrabajado,
	Trabaja,
	Autonomia,
	DisminucionFisica,
	MinusvaliaPorcentaje,
	Incapacitacion,
	Toxicomania,
	AntecConsumo,
	DisminucionPsiquica,
	EnfermedadMental,
	Tuberculosis,
	Hepatitis,
	VIH,
	Otras,
	EnfermedadesComentarios,
	Medicacion,
	EnfMentalDiagnostico,
	EnfMentalFechaDiagn,
	EnfMentalTratamiento,
	EnfMentalIngresos,
	EnfMentalPadres,
	EnfMentalHermanos,
	EnfMentalPareja,
	EnfMentalHijos,
	DrogasPadres,
	DrogasHermanos,
	DrogasPareja,
	DrogasHijos,
	PermisoResid,
	PermisoResidTr,
	numPasap,
	fechaPasap,
	numCedula,
	fechaCaducCedula,
	fechaResidSolicit,
	numResidConced,
	fechaResidConced,
	fechaResidTrabSolicit,
	numResidTrabConc,
	fechaResidTrabConc,
	visado,
	asilo,
	otrosDoc,
	fechaEntrada,
	fechaPrueba,
	abogadootros,
	PermisoResidRazonesNo,
	PermisoSolicitudLugar,
	TiempoResidenciaEspanya,
	TiempoResidenciaBilbao,
	PermisoTrabajo,
	PermisoTrabajoRazonesNo,
	FechaEmpadronamiento,
	direccionPadronActual,
	Tis,
	RedApoyo,
	IngresosPropios,
	IngresosPnc,
	IngresosOtros,
	IngresosNomina,
	IngresosRGI,
	IngresosPrestContrib,
	IngresosSeDesconoce,
	IngresosAyudaIndividual,
	IngresosNo,
	PenalAntecedentesPrision,
	PenalOrdenAlejamiento,
	PenalPrisionPreventiva,
	PenalPrisionOtros,
	PenalLibCondicional,
	PenalMedidaSeguridad,
	PenalCausasPendientes,
	PenalPermisoPenitenc,
	PenalTercerGrado,
	PenalTbc,
	ducha,	
	ropero,
	lavanderia,
	tlSabado,
	tlDomingo,
	salidaVerano,
	salidaOtro,
	medicacionCentro,
	NivelCastellano,		
	expLaboral,
	lanbide,
	fechaAltaLanbide,
	fechaRenovLanbide,
	inem,
	fechaAltaInem,
	fechaRenovInem,
	cursos,
	sexo,
	id_unico, 
	poblacionPadron,
	diabetes,
	ConsumoPrinc,
	insertIdUsuario,	
	fechaInsert,
	AnosConsumo,
	Tratamiento,
	TratamientoTipo,
	procedenciaDemandaLista,
	situacionAdministrativa,
	historial";
/*
	// Para cargar los valores de cada servicio: fi, ff, activo
	foreach ($servicio as $serv) {
		$query .= "
			, fi_".$serv."
			, ff_".$serv."
			, ms_".$serv."
			, activo_".$serv;
	}
*/	
	$query .= ")
	VALUES 
	(
	'".$db->escape($_POST['nombre'])."',
	'".$db->escape($_POST['apellido1'])."',
	'".$db->escape($_POST['apellido2'])."',
	'".$db->escape($fechanac)."',
	'".$db->escape($_POST['lugarNac'])."',
	'".$db->escape($_POST['dni'])."',
	'".$db->escape($_POST['numSegSoc'])."',
	'".$db->escape($_POST['numExpediente'])."',
	'{$_POST['nacionalidad']}',
	'".$db->escape($_POST['telefono'])."',
	'".$db->escape($dir_nucleo_conv)."',
	'".$db->escape($mun_nucleo_conv)."',
	'{$_POST['nucleoConv']}',
	'{$_POST['estadoCivil']}',
	'".$db->escape($_POST['hijos'])."',
	'".$db->escape($_POST['numHijos'])."',
	'".$db->escape($_POST['observacionesHijos'])."',
	'".$db->escape($_POST['telefonosInteres'])."',
	'".$db->escape($fecha_ingreso)."',
	'".$db->escape($fecha_salida)."',
	'".$db->escape($_POST['procedenciaDemanda'])."',
	'{$_POST['responsable']}',
	'{$_POST['comedorLun']}',
	'{$_POST['comedorMar']}',
	'{$_POST['comedorMie']}',
	'{$_POST['comedorJue']}',
	'{$_POST['comedorVie']}',
	'{$_POST['transporte']}',
	'{$_POST['listaEspera']}',
	'".$db->escape($_POST['observacionesNivelFormativo'])."',
	'{$_POST['nivelFormativo']}',
	'".$db->escape($_POST['observacionesIdioma'])."',
	'".$db->escape($_POST['EdadAbandonoEstudios'])."',
	'{$_POST['LaboralOrigen']}',
	'{$_POST['LaboralEspana']}',
	'".$db->escape($_POST['TiempoTrabajado'])."',
	'{$_POST['Trabaja']}',
	'{$_POST['Autonomia']}',
	'{$_POST['DisminucionFisica']}',
	'{$_POST['MinusvaliaPorcentaje']}',
	'{$_POST['Incapacitacion']}',  
	'{$_POST['Toxicomania']}',
	'{$_POST['AntecConsumo']}',
	'{$_POST['DisminucionPsiquica']}',
	'{$_POST['EnfermedadMental']}',
	'{$_POST['Tuberculosis']}',
	'{$_POST['Hepatitis']}',
	'{$_POST['VIH']}',
	'{$_POST['Otras']}',
	'".$db->escape($_POST['EnfermedadesComentarios'])."',
	'".$db->escape($_POST['Medicacion'])."',
	'{$_POST['EnfMentalDiagnostico']}',
	'{$_POST['EnfMentalFechaDiagn']}',
	'{$_POST['EnfMentalTratamiento']}',
	'{$_POST['EnfMentalIngresos']}',
	'{$_POST['EnfMentalPadres']}',
	'{$_POST['EnfMentalHermanos']}',
	'{$_POST['EnfMentalPareja']}',
	'{$_POST['EnfMentalHijos']}',
	'{$_POST['DrogasPadres']}',
	'{$_POST['DrogasHermanos']}',
	'{$_POST['DrogasPareja']}',
	'{$_POST['DrogasHijos']}',
	'{$_POST['PermisoResid']}',


	'{$_POST['PermisoResidTr']}',
	'".$db->escape($_POST['numPasap'])."',
	'{$fpasap}',
	'".$db->escape($_POST['numCedula'])."',
	'{$fcedula}',
	'{$fressol}',
	'".$db->escape($_POST['numResidConced'])."',
	'{$fresconc}',
	'{$frestrsol}',
	'".$db->escape($_POST['numResidTrabConc'])."',
	'{$frestrconc}',
	'{$_POST['visado']}',
	'{$_POST['asilo']}',
	'".$db->escape($_POST['otrosDoc'])."',
	'{$fentrada}',
	'{$fprueba}',
	'".$db->escape($_POST['abogadootros'])."',
	'".$db->escape($_POST['PermisoResidRazonesNo'])."',
	'".$db->escape($_POST['PermisoSolicitudLugar'])."',
	'".$db->escape($_POST['TiempoResidenciaEspanya'])."',
	'".$db->escape($_POST['TiempoResidenciaBilbao'])."',
	'{$_POST['PermisoTrabajo']}',
	'".$db->escape($_POST['PermisoTrabajoRazonesNo'])."',
	'".$db->escape($FechaEmpadronamiento)."',
	'".$_POST['direccionPadronActual']."',
	'{$_POST['Tis']}',
	'{$_POST['RedApoyo']}',
	'{$_POST['IngresosPropios']}',
	'{$_POST['IngresosPnc']}',
	'{$_POST['IngresosOtros']}',
	'{$_POST['IngresosNomina']}',
	'{$_POST['IngresosRGI']}',
	'{$_POST['IngresosPrestContrib']}',
	'{$_POST['IngresosSeDesconoce']}',
	'{$_POST['IngresosAyudaIndividual']}',
	'{$_POST['IngresosNo']}',
	'{$_POST['PenalAntecedentesPrision']}',
	'{$_POST['PenalOrdenAlejamiento']}',	
	'{$_POST['PenalPrisionPreventiva']}',
	'{$_POST['PenalPrisionOtros']}',
	'{$_POST['PenalLibCondicional']}',
	'{$_POST['PenalMedidaSeguridad']}',
	'{$_POST['PenalCausasPendientes']}',
	'{$_POST['PenalPermisoPenitenc']}',
	'{$_POST['PenalTercerGrado']}',
	'{$_POST['PenalTbc']}',
	'{$_POST['ducha']}',
	'{$_POST['ropero']}',
	'{$_POST['lavanderia']}',
	'{$_POST['tlSabado']}',
	'{$_POST['tlDomingo']}',
	'{$_POST['salidaVerano']}',
	'{$_POST['salidaOtro']}',
	'{$_POST['medicacionCentro']}',
	'{$_POST['NivelCastellano']}',
	'".$db->escape($_POST['expLaboral'])."',
	'{$_POST['lanbide']}',
	'".$db->escape($F_alta_lanbide)."',
	'".$db->escape($F_renov_lanbide)."',
	'{$_POST['inem']}',
	'".$db->escape($F_alta_inem)."',
	'".$db->escape($F_renov_inem)."',
	'".$db->escape($_POST['cursos'])."',
	'{$_POST['sexo']}',
	'".$id_unico."',
	'".$db->escape($_POST['poblacionPadron'])."',
	'{$_POST['diabetes']}',
	'".$db->escape($_POST['ConsumoPrinc'])."',
	'{$insert_id_usuario}',
	'{$insert_fecha}',
	'{$_POST['AnosConsumo']}',
	'{$_POST['Tratamiento']}',
	'{$_POST['TratamientoTipo']}',
	'{$_POST['procedenciaDemandaLista']}',
	'{$_POST['situacionAdministrativa']}',
	'actual'";


	$query .= ")";	
	if ($prueba) {echo "<br>Query: ".$query; }



/*
// Graba un log con el query enviado
//  Lo he quitado porque el log era creciente... Hay que seguir probando. 
	$fp = fopen("LOG_QUERY.txt", "a"); 
	fwrite($fp, $query); 
	fclose($fp); 
*/


// Caso especial: nueva causa judicial
	if ($_POST['causas_new_organo_judicial']!="")  {
		$query2="INSERT INTO causas 
		(
		id_unico,
		organo_judicial,
		situacion,
		citaciones,	
		condena,    
		informes,	
		domicilio,	
		informes2
		)
		VALUES 
		(
		'".$id_unico."',
		'{$_POST['causas_new_organo_judicial']}',
		'{$_POST['causas_new_situacion']}',
		'{$_POST['causas_new_citaciones']}',
		'{$_POST['causas_new_condena']}',
		'{$_POST['causas_new_informes']}',
		'{$_POST['causas_new_domicilio']}',
		'{$_POST['causas_new_informes2']}'
		)
		";
		$db->pregunta_query($query2);
	}

	// fin nueva causa judicial
	if ($prueba) {echo "<br>Query2: ".$query2; }
	

// Ejecuta los querys
	$db->pregunta_query($query);
	$id = (string)$db->insert_id; 
	//$my_error = mysql_error($conexion);
	$my_error = "";

	
// Caso de error
	if(!empty($my_error)) {
		echo "<br>Ha habido un error al insertar los valores: <strong>".$my_error."</strong>"; 
	} else {
		// Cambia el historial a 'historial' en el último 'actual' 
		$db->pregunta_query("UPDATE persona SET historial = 'historial' WHERE id_pers = ".$ultimo_actual."");   
	}

	if ($id==-1)  {
		$id = (string)$db->insert_id; 
	} else  {

	}
	if (!$prueba) echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=persona.php'>";	


// Cambia la tabla 'auxiliar'
	//if (!$prueba) destruye_copia("auxiliar");
	//if (!$prueba) fotografia_auxiliar("auxiliar", "hoy", "");


$db->cerrar_conexion();


?>
