<?php

include_once "clases/class.leer_mysqli.php";


$insert_id_usuario=$_COOKIE['id_usuario'];
$insert_fecha=date("Y/m/d");
$prueba = false; 




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
$F_alta_lanbide= ((!isset($_POST['fechaAltaLanbide'])) || ($_POST['fechaAltaLanbide'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaAltaLanbide'])."'" ;
$fechanac= ((!isset($_POST['fechanac'])) || ($_POST['fechanac'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechanac'])."'";
$fecha_ingreso= ((!isset($_POST['fechaIngreso'])) || ($_POST['fechaIngreso'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaIngreso'])."'";
$fecha_salida= ((!isset($_POST['fechaSalida'])) || ($_POST['fechaSalida'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaSalida'])."'";
$F_renov_lanbide= ((!isset($_POST['fechaRenovLanbide'])) || ($_POST['fechaRenovLanbide'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaRenovLanbide'])."'";
$F_alta_inem= ((!isset($_POST['fechaAltaInem'])) || ($_POST['fechaAltaInem'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaAltaInem'])."'";
$F_renov_inem= ((!isset($_POST['fechaRenovInem'])) || ($_POST['fechaRenovInem'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaRenovInem'])."'";
$FechaEmpadronamiento= ((!isset($_POST['FechaEmpadronamiento'])) || ($_POST['FechaEmpadronamiento'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['FechaEmpadronamiento'])."'";
$insert_fecha= ((!isset($_POST['fechaInsert'])) || ($_POST['fechaInsert'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaInsert'])."'";
$fpasap = ((!isset($_POST['fechaPasap'])) || ($_POST['fechaPasap'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaPasap'])."'";
$fcedula= ((!isset($_POST['fechaCaducCedula'])) || ($_POST['fechaCaducCedula'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaCaducCedula'])."'";
$fressol= ((!isset($_POST['fechaResidSolicit'])) || ($_POST['fechaResidSolicit'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaResidSolicit'])."'";
$fresconc= ((!isset($_POST['fechaResidConced'])) || ($_POST['fechaResidConced'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaResidConced'])."'";
$frestrsol= ((!isset($_POST['fechaResidTrabSolicit'])) || ($_POST['fechaResidTrabSolicit'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaResidTrabSolicit'])."'";
$frestrconc= ((!isset($_POST['fechaResidTrabConc'])) || ($_POST['fechaResidTrabConc'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaResidTrabConc'])."'";
$fentrada= ((!isset($_POST['fechaEntrada'])) || ($_POST['fechaEntrada'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaEntrada'])."'";
$fprueba= ((!isset($_POST['fechaPrueba'])) || ($_POST['fechaPrueba'] == '')) ? 'NULL' : "'".fecha_txt_sql($_POST['fechaPrueba'])."'";






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


	if ($_POST['id_unico']=="" || $_POST['id_unico']=="0" || $_POST['id_unico']== NULL )  // Si no existe el identificador personal, crea uno nuevo
	{		
		$result4 = $db->pregunta_query("SELECT MAX(id_unico) FROM persona");    
		$row_max = $result4->fetch_row();		
		$id_unico=$row_max[0] + 1; 
		echo "<h3>Se ha creado nueva persona usuaria: ".$id_unico."</h3>";		
	} else {

	}

	$nuc=$_POST['nucleoConv'];    // Cambia automáticamente los valores de dirección y población actual

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
if ($prueba) echo "query_ac: ".$query_ac;
$result_actual = $db->lista_query($query_ac);
if ($prueba) { echo "<pre>result actual: "; print_r($result_actual); echo "</pre>";}
if (empty($result_actual)) {
	$nuevo = true; 
	$ultimo_actual = 0; 
} else {
	$nuevo = false; 
	$ultimo_actual = $result_actual[0]['id_pers']; 
}
if ($prueba) echo "<br>ultimo_actual: ".$ultimo_actual; 





	$_POST['nombre'] = (!isset($_POST['nombre'])) ? 'NULL' : "'".$db->escape($_POST['nombre'])."'";			
	$_POST['apellido1'] = (!isset($_POST['apellido1'])) ? 'NULL' : "'".$db->escape($_POST['apellido1'])."'"; 		
	$_POST['apellido2'] = (!isset($_POST['apellido2'])) ? 'NULL' : "'".$db->escape($_POST['apellido2'])."'";		
	$_POST['lugarNac'] = (!isset($_POST['lugarNac'])) ? 'NULL' : "'".$db->escape($_POST['lugarNac'])."'";		
	$_POST['dni'] = (!isset($_POST['dni'])) ? 'NULL' : "'".$db->escape($_POST['dni'])."'"; 		
	$_POST['numSegSoc'] = (!isset($_POST['numSegSoc'])) ? 'NULL' : "'".$db->escape($_POST['numSegSoc'])."'"; 	
	$_POST['numExpediente'] = (!isset($_POST['numExpediente'])) ? 'NULL' : "'".$db->escape($_POST['numExpediente'])."'";		
	$_POST['nacionalidad'] = (!isset($_POST['nacionalidad'])) ? 'NULL' : "'".$db->escape($_POST['nacionalidad'])."'";	
	$_POST['telefono'] = (!isset($_POST['telefono'])) ? 'NULL' : "'".$db->escape($_POST['telefono'])."'"; 		
	$_POST['direccionActual'] = (!isset($_POST['direccionActual'])) ? 'NULL' : "'".$db->escape($_POST['direccionActual'])."'"; 		
	$_POST['poblacion'] = (!isset($_POST['poblacion'])) ? 'NULL' : "'".$db->escape($_POST['poblacion'])."'"; 		
	$_POST['nucleoConv'] = (!isset($_POST['nucleoConv'])) ? 'NULL' : "'".$db->escape($_POST['nucleoConv'])."'"; 	
	$_POST['estadoCivil'] = (!isset($_POST['estadoCivil'])) ? 'NULL' : "'".$db->escape($_POST['estadoCivil'])."'"; 		
	$_POST['hijos'] = (!isset($_POST['hijos'])) ? 'NULL' : "'".$db->escape($_POST['hijos'])."'"; 		
	$_POST['numHijos'] = (!isset($_POST['numHijos'])) ? 'NULL' : "'".$db->escape($_POST['numHijos'])."'"; 	
	$_POST['observacionesHijos'] = (!isset($_POST['observacionesHijos'])) ? 'NULL' : "'".$db->escape($_POST['observacionesHijos'])."'"; 	
	$_POST['telefonosInteres'] = (!isset($_POST['telefonosInteres'])) ? 'NULL' : "'".$db->escape($_POST['telefonosInteres'])."'";		
	$_POST['procedenciaDemanda'] = (!isset($_POST['procedenciaDemanda'])) ? 'NULL' : "'".$db->escape($_POST['procedenciaDemanda'])."'"; 
	$_POST['responsable'] = (!isset($_POST['responsable'])) ? 'NULL' : "'".$db->escape($_POST['responsable'])."'"; 				
	$_POST['comedorLun'] = (!isset($_POST['comedorLun'])) ? 'NULL' : "'".$db->escape($_POST['comedorLun'])."'"; 		
	$_POST['comedorMar'] = (!isset($_POST['comedorMar'])) ? 'NULL' : "'".$db->escape($_POST['comedorMar'])."'"; 		
	$_POST['comedorMie'] = (!isset($_POST['comedorMie'])) ? 'NULL' : "'".$db->escape($_POST['comedorMie'])."'"; 		
	$_POST['comedorJue'] = (!isset($_POST['comedorJue'])) ? 'NULL' : "'".$db->escape($_POST['comedorJue'])."'"; 		
	$_POST['comedorVie'] = (!isset($_POST['comedorVie'])) ? 'NULL' : "'".$db->escape($_POST['comedorVie'])."'"; 		
	$_POST['transporte'] = (!isset($_POST['transporte'])) ? 'NULL' : "'".$db->escape($_POST['transporte'])."'"; 		
	$_POST['listaEspera'] = (!isset($_POST['listaEspera'])) ? 'NULL' : "'".$db->escape($_POST['listaEspera'])."'";
	$_POST['observacionesNivelFormativo'] = (!isset($_POST['observacionesNivelFormativo'])) ? 'NULL' : "'".$db->escape($_POST['observacionesNivelFormativo'])."'";
	$_POST['nivelFormativo'] ?nivelFormativ: $db->escape($_POST['nivelFormat:'])."'";
	$_POST['observacionesIdioma'] = (!isset($_POST['observacionesIdioma'])) ? 'NULL' : "'".$db->escape($_POST['observacionesIdioma'])."'";
	$_POST['EdadAbandonoEstudios'] = (!isset($_POST['EdadAbandonoEstudios'])) ? 'NULL' : "'".$db->escape($_POST['EdadAbandonoEstudios'])."'";
	$_POST['LaboralOrigen'] = (!isset($_POST['LaboralOrigen'])) ? 'NULL' : "'".$db->escape($_POST['LaboralOrigen'])."'";
	$_POST['LaboralEspana'] = (!isset($_POST['LaboralEspana'])) ? 'NULL' : "'".$db->escape($_POST['LaboralEspana'])."'";
	$_POST['TiempoTrabajado'] = (!isset($_POST['TiempoTrabajado'])) ? 'NULL' : "'".$db->escape($_POST['TiempoTrabajado'])."'";
	$_POST['Trabaja'] = (!isset($_POST['Trabaja'])) ? 'NULL' : "'".$db->escape($_POST['Trabaja'])."'";
	$_POST['Autonomia'] = (!isset($_POST['Autonomia'])) ? 'NULL' : "'".$db->escape($_POST['Autonomia'])."'";
	$_POST['DisminucionFisica'] = (!isset($_POST['DisminucionFisica'])) ? 'NULL' : "'".$db->escape($_POST['DisminucionFisica'])."'";
	$_POST['MinusvaliaPorcentaje'] = (!isset($_POST['MinusvaliaPorcentaje'])) ? 'NULL' : "'".$db->escape($_POST['MinusvaliaPorcentaje'])."'";
	$_POST['Incapacitacion'] = (!isset($_POST['Incapacitacion'])) ? 'NULL' : "'".$db->escape($_POST['Incapacitacion'])."'";
	$_POST['Toxicomania'] = (!isset($_POST['Toxicomania'])) ? 'NULL' : "'".$db->escape($_POST['Toxicomania'])."'";
	$_POST['AntecConsumo'] = (!isset($_POST['AntecConsumo'])) ? 'NULL' : "'".$db->escape($_POST['AntecConsumo'])."'";
	$_POST['DisminucionPsiquica'] = (!isset($_POST['DisminucionPsiquica'])) ? 'NULL' : "'".$db->escape($_POST['DisminucionPsiquica'])."'";
	$_POST['EnfermedadMental'] = (!isset($_POST['EnfermedadMental'])) ? 'NULL' : "'".$db->escape($_POST['EnfermedadMental'])."'";
	$_POST['Tuberculosis'] = (!isset($_POST['Tuberculosis'])) ? 'NULL' : "'".$db->escape($_POST['Tuberculosis'])."'";
	$_POST['Hepatitis'] = (!isset($_POST['Hepatitis'])) ? 'NULL' : "'".$db->escape($_POST['Hepatitis'])."'";
	$_POST['VIH'] = (!isset($_POST['VIH'])) ? 'NULL' : "'".$db->escape($_POST['VIH'])."'";
	$_POST['Otras'] = (!isset($_POST['Otras'])) ? 'NULL' : "'".$db->escape($_POST['Otras'])."'";
	$_POST['EnfermedadesComentarios'] = (!isset($_POST['EnfermedadesComentarios'])) ? 'NULL' : "'".$db->escape($_POST['EnfermedadesComentarios'])."'";
	$_POST['Medicacion'] = (!isset($_POST['Medicacion'])) ? 'NULL' : "'".$db->escape($_POST['Medicacion'])."'";
	$_POST['EnfMentalDiagnostico'] = (!isset($_POST['EnfMentalDiagnostico'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalDiagnostico'])."'";
	$_POST['EnfMentalFechaDiagn'] = (!isset($_POST['EnfMentalFechaDiagn'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalFechaDiagn'])."'";
	$_POST['EnfMentalTratamiento'] = (!isset($_POST['EnfMentalTratamiento'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalTratamiento'])."'";
	$_POST['EnfMentalIngresos'] = (!isset($_POST['EnfMentalIngresos'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalIngresos'])."'";
	$_POST['EnfMentalPadres'] = (!isset($_POST['EnfMentalPadres'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalPadres'])."'";
	$_POST['EnfMentalHermanos'] = (!isset($_POST['EnfMentalHermanos'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalHermanos'])."'";
	$_POST['EnfMentalPareja'] = (!isset($_POST['EnfMentalPareja'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalPareja'])."'";
	$_POST['EnfMentalHijos'] = (!isset($_POST['EnfMentalHijos'])) ? 'NULL' : "'".$db->escape($_POST['EnfMentalHijos'])."'";
	$_POST['DrogasPadres'] = (!isset($_POST['DrogasPadres'])) ? 'NULL' : "'".$db->escape($_POST['DrogasPadres'])."'";
	$_POST['DrogasHermanos'] = (!isset($_POST['DrogasHermanos'])) ? 'NULL' : "'".$db->escape($_POST['DrogasHermanos'])."'";
	$_POST['DrogasPareja'] = (!isset($_POST['DrogasPareja'])) ? 'NULL' : "'".$db->escape($_POST['DrogasPareja'])."'";
	$_POST['DrogasHijos'] = (!isset($_POST['DrogasHijos'])) ? 'NULL' : "'".$db->escape($_POST['DrogasHijos'])."'";
	$_POST['PermisoResid'] = (!isset($_POST['PermisoResid'])) ? 'NULL' : "'".$db->escape($_POST['PermisoResid'])."'";
	$_POST['PermisoResidTr'] = (!isset($_POST['PermisoResidTr'])) ? 'NULL' : "'".$db->escape($_POST['PermisoResidTr'])."'";
	$_POST['numPasap'] = (!isset($_POST['numPasap'])) ? 'NULL' : "'".$db->escape($_POST['numPasap'])."'";
	$_POST['numCedula'] = (!isset($_POST['numCedula'])) ? 'NULL' : "'".$db->escape($_POST['numCedula'])."'";
	$_POST['numResidConced'] = (!isset($_POST['numResidConced'])) ? 'NULL' : "'".$db->escape($_POST['numResidConced'])."'";
	$_POST['numResidTrabConc'] = (!isset($_POST['numResidTrabConc'])) ? 'NULL' : "'".$db->escape($_POST['numResidTrabConc'])."'";
	$_POST['visado'] = (!isset($_POST['visado'])) ? 'NULL' : "'".$db->escape($_POST['visado'])."'";
	$_POST['asilo'] = (!isset($_POST['asilo'])) ? 'NULL' : "'".$db->escape($_POST['asilo'])."'";
	$_POST['otrosDoc'] = (!isset($_POST['otrosDoc'])) ? 'NULL' : "'".$db->escape($_POST['otrosDoc'])."'";
	$_POST['abogadootros'] = (!isset($_POST['abogadootros'])) ? 'NULL' : "'".$db->escape($_POST['abogadootros'])."'";
	$_POST['PermisoResidRazonesNo'] = (!isset($_POST['PermisoResidRazonesNo'])) ? 'NULL' : "'".$db->escape($_POST['PermisoResidRazonesNo'])."'";
	$_POST['PermisoSolicitudLugar'] = (!isset($_POST['PermisoSolicitudLugar'])) ? 'NULL' : "'".$db->escape($_POST['PermisoSolicitudLugar'])."'";
	$_POST['TiempoResidenciaEspanya'] = (!isset($_POST['TiempoResidenciaEspanya'])) ? 'NULL' : "'".$db->escape($_POST['TiempoResidenciaEspanya'])."'";
	$_POST['TiempoResidenciaBilbao'] = (!isset($_POST['TiempoResidenciaBilbao'])) ? 'NULL' : "'".$db->escape($_POST['TiempoResidenciaBilbao'])."'";
	$_POST['PermisoTrabajo'] = (!isset($_POST['PermisoTrabajo'])) ? 'NULL' : "'".$db->escape($_POST['PermisoTrabajo'])."'";
	$_POST['PermisoTrabajoRazonesNo'] = (!isset($_POST['PermisoTrabajoRazonesNo'])) ? 'NULL' : "'".$db->escape($_POST['PermisoTrabajoRazonesNo'])."'";
	$_POST['direccionPadronActual'] = (!isset($_POST['direccionPadronActual'])) ? 'NULL' : "'".$db->escape($_POST['direccionPadronActual'])."'";
	$_POST['Tis'] = (!isset($_POST['Tis'])) ? 'NULL' : "'".$db->escape($_POST['Tis'])."'";
	$_POST['RedApoyo'] = (!isset($_POST['RedApoyo'])) ? 'NULL' : "'".$db->escape($_POST['RedApoyo'])."'";
	$_POST['IngresosPropios'] = (!isset($_POST['IngresosPropios'])) ? 'NULL' : "'".$db->escape($_POST['IngresosPropios'])."'";
	$_POST['IngresosPnc'] = (!isset($_POST['IngresosPnc'])) ? 'NULL' : "'".$db->escape($_POST['IngresosPnc'])."'";
	$_POST['IngresosOtros'] = (!isset($_POST['IngresosOtros'])) ? 'NULL' : "'".$db->escape($_POST['IngresosOtros'])."'";
	$_POST['IngresosNomina'] = (!isset($_POST['IngresosNomina'])) ? 'NULL' : "'".$db->escape($_POST['IngresosNomina'])."'";
	$_POST['IngresosRGI'] = (!isset($_POST['IngresosRGI'])) ? 'NULL' : "'".$db->escape($_POST['IngresosRGI'])."'";
	$_POST['IngresosPrestContrib'] = (!isset($_POST['IngresosPrestContrib'])) ? 'NULL' : "'".$db->escape($_POST['IngresosPrestContrib'])."'";
	$_POST['IngresosSeDesconoce'] = (!isset($_POST['IngresosSeDesconoce'])) ? 'NULL' : "'".$db->escape($_POST['IngresosSeDesconoce'])."'";
	$_POST['IngresosAyudaIndividual'] = (!isset($_POST['IngresosAyudaIndividual'])) ? 'NULL' : "'".$db->escape($_POST['IngresosAyudaIndividual'])."'";
	$_POST['IngresosNo'] = (!isset($_POST['IngresosNo'])) ? 'NULL' : "'".$db->escape($_POST['IngresosNo'])."'";
	$_POST['PenalAntecedentesPrision'] = (!isset($_POST['PenalAntecedentesPrision'])) ? 'NULL' : "'".$db->escape($_POST['PenalAntecedentesPrision'])."'";
	$_POST['PenalOrdenAlejamiento'] = (!isset($_POST['PenalOrdenAlejamiento'])) ? 'NULL' : "'".$db->escape($_POST['PenalOrdenAlejamiento'])."'";
	$_POST['PenalPrisionPreventiva'] = (!isset($_POST['PenalPrisionPreventiva'])) ? 'NULL' : "'".$db->escape($_POST['PenalPrisionPreventiva'])."'";
	$_POST['PenalPrisionOtros'] = (!isset($_POST['PenalPrisionOtros'])) ? 'NULL' : "'".$db->escape($_POST['PenalPrisionOtros'])."'";
	$_POST['PenalLibCondicional'] = (!isset($_POST['PenalLibCondicional'])) ? 'NULL' : "'".$db->escape($_POST['PenalLibCondicional'])."'";
	$_POST['PenalMedidaSeguridad'] = (!isset($_POST['PenalMedidaSeguridad'])) ? 'NULL' : "'".$db->escape($_POST['PenalMedidaSeguridad'])."'";
	$_POST['PenalCausasPendientes'] = (!isset($_POST['PenalCausasPendientes'])) ? 'NULL' : "'".$db->escape($_POST['PenalCausasPendientes'])."'";
	$_POST['PenalPermisoPenitenc'] = (!isset($_POST['PenalPermisoPenitenc'])) ? 'NULL' : "'".$db->escape($_POST['PenalPermisoPenitenc'])."'";
	$_POST['PenalTercerGrado'] = (!isset($_POST['PenalTercerGrado'])) ? 'NULL' : "'".$db->escape($_POST['PenalTercerGrado'])."'";
	$_POST['PenalTbc'] = (!isset($_POST['PenalTbc'])) ? 'NULL' : "'".$db->escape($_POST['PenalTbc'])."'";
	$_POST['ducha'] = (!isset($_POST['ducha'])) ? 'NULL' : "'".$db->escape($_POST['ducha'])."'";	
	$_POST['ropero'] = (!isset($_POST['ropero'])) ? 'NULL' : "'".$db->escape($_POST['ropero'])."'";
	$_POST['lavanderia'] = (!isset($_POST['lavanderia'])) ? 'NULL' : "'".$db->escape($_POST['lavanderia'])."'";
	$_POST['tlSabado'] = (!isset($_POST['tlSabado'])) ? 'NULL' : "'".$db->escape($_POST['tlSabado'])."'";
	$_POST['tlDomingo'] = (!isset($_POST['tlDomingo'])) ? 'NULL' : "'".$db->escape($_POST['tlDomingo'])."'";
	$_POST['salidaVerano'] = (!isset($_POST['salidaVerano'])) ? 'NULL' : "'".$db->escape($_POST['salidaVerano'])."'";
	$_POST['salidaOtro'] = (!isset($_POST['salidaOtro'])) ? 'NULL' : "'".$db->escape($_POST['salidaOtro'])."'";
	$_POST['medicacionCentro'] = (!isset($_POST['medicacionCentro'])) ? 'NULL' : "'".$db->escape($_POST['medicacionCentro'])."'";
	$_POST['NivelCastellano'] = (!isset($_POST['NivelCastellano'])) ? 'NULL' : "'".$db->escape($_POST['NivelCastellano'])."'";		
	$_POST['expLaboral'] = (!isset($_POST['expLaboral'])) ? 'NULL' : "'".$db->escape($_POST['expLaboral'])."'";
	$_POST['lanbide'] = (!isset($_POST['lanbide'])) ? 'NULL' : "'".$db->escape($_POST['lanbide'])."'";
	$_POST['inem'] = (!isset($_POST['inem'])) ? 'NULL' : "'".$db->escape($_POST['inem'])."'";
	$_POST['cursos'] = (!isset($_POST['cursos'])) ? 'NULL' : "'".$db->escape($_POST['cursos'])."'";
	$_POST['sexo'] = (!isset($_POST['sexo'])) ? 'NULL' : "'".$db->escape($_POST['sexo'])."'";
//	$_POST['id_unico'] = (!isset($_POST['id_unico'])) ? 'NULL' : "'".$db->escape($_POST['id_unico'])."'"; 
	$_POST['id_unico'] = $id_unico;
	$_POST['poblacionPadron'] = (!isset($_POST['poblacionPadron'])) ? 'NULL' : "'".$db->escape($_POST['poblacionPadron'])."'";
	$_POST['diabetes'] = (!isset($_POST['diabetes'])) ? 'NULL' : "'".$db->escape($_POST['diabetes'])."'";
	$_POST['ConsumoPrinc'] = (!isset($_POST['ConsumoPrinc'])) ? 'NULL' : "'".$db->escape($_POST['ConsumoPrinc'])."'";
	$_POST['insertIdUsuario'] = (!isset($_POST['insertIdUsuario'])) ? 'NULL' : "'".$db->escape($_POST['insertIdUsuario'])."'";	
	$_POST['AnosConsumo'] = (!isset($_POST['AnosConsumo'])) ? 'NULL' : "'".$db->escape($_POST['AnosConsumo'])."'";
	$_POST['Tratamiento'] = (!isset($_POST['Tratamiento'])) ? 'NULL' : "'".$db->escape($_POST['Tratamiento'])."'";
	$_POST['TratamientoTipo'] = (!isset($_POST['TratamientoTipo'])) ? 'NULL' : "'".$db->escape($_POST['TratamientoTipo'])."'";
	$_POST['procedenciaDemandaLista'] = (!isset($_POST['procedenciaDemandaLista'])) ? 'NULL' : "'".$db->escape($_POST['procedenciaDemandaLista'])."'";
	$_POST['situacionAdministrativa'] = (!isset($_POST['situacionAdministrativa'])) ? 'NULL' : "'".$db->escape($_POST['situacionAdministrativa'])."'";
	$_POST['historial'] = (!isset($_POST['historial'])) ? 'NULL' : "'".$db->escape($_POST['historial'])."'";




	if (($nuc>6) && ( $nuc != 0 ))
	{
		$peticion="SELECT datotexto, dato1 FROM desplegables WHERE despl = 'nucleoconv' AND id_despl=".$nuc."";
		$result5 = $db->pregunta_query($peticion);    
		$row5 = $result5->fetch_array(MYSQLI_BOTH);
		$dir_nucleo_conv= "'" . $row5["datotexto"] . "'";
		$mun_nucleo_conv="'" . $row5["dato1"] . "'";
	} else {
		$dir_nucleo_conv=$_POST['direccionActual'];
		$mun_nucleo_conv=$_POST['poblacion'];
	}




if ($prueba) {
	print('<pre>');
	print_r($_POST);
	print('</pre>');
}


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
	".$_POST['nombre'].",
	".($_POST['apellido1']).",
	".($_POST['apellido2']).",
	".($fechanac).",
	".($_POST['lugarNac']).",
	".($_POST['dni']).",
	".($_POST['numSegSoc']).",
	".($_POST['numExpediente']).",
	{$_POST['nacionalidad']},
	".($_POST['telefono']).",
	".($dir_nucleo_conv).",
	".($mun_nucleo_conv).",
	{$_POST['nucleoConv']},
	{$_POST['estadoCivil']},
	".($_POST['hijos']).",
	".($_POST['numHijos']).",
	".($_POST['observacionesHijos']).",
	".($_POST['telefonosInteres']).",
	".($fecha_ingreso).",
	".($fecha_salida).",
	".($_POST['procedenciaDemanda']).",
	{$_POST['responsable']},
	{$_POST['comedorLun']},
	{$_POST['comedorMar']},
	{$_POST['comedorMie']},
	{$_POST['comedorJue']},
	{$_POST['comedorVie']},
	{$_POST['transporte']},
	{$_POST['listaEspera']},
	".($_POST['observacionesNivelFormativo']).",
	{$_POST['nivelFormativo']},
	".($_POST['observacionesIdioma']).",
	".($_POST['EdadAbandonoEstudios']).",
	{$_POST['LaboralOrigen']},
	{$_POST['LaboralEspana']},
	".($_POST['TiempoTrabajado']).",
	{$_POST['Trabaja']},
	{$_POST['Autonomia']},
	{$_POST['DisminucionFisica']},
	{$_POST['MinusvaliaPorcentaje']},
	{$_POST['Incapacitacion']},  
	{$_POST['Toxicomania']},
	{$_POST['AntecConsumo']},
	{$_POST['DisminucionPsiquica']},
	{$_POST['EnfermedadMental']},
	{$_POST['Tuberculosis']},
	{$_POST['Hepatitis']},
	{$_POST['VIH']},
	{$_POST['Otras']},
	".($_POST['EnfermedadesComentarios']).",
	".($_POST['Medicacion']).",
	{$_POST['EnfMentalDiagnostico']},
	{$_POST['EnfMentalFechaDiagn']},
	{$_POST['EnfMentalTratamiento']},
	{$_POST['EnfMentalIngresos']},
	{$_POST['EnfMentalPadres']},
	{$_POST['EnfMentalHermanos']},
	{$_POST['EnfMentalPareja']},
	{$_POST['EnfMentalHijos']},
	{$_POST['DrogasPadres']},
	{$_POST['DrogasHermanos']},
	{$_POST['DrogasPareja']},
	{$_POST['DrogasHijos']},
	{$_POST['PermisoResid']},


	{$_POST['PermisoResidTr']},
	".($_POST['numPasap']).",
	{$fpasap},
	".($_POST['numCedula']).",
	{$fcedula},
	{$fressol},
	".($_POST['numResidConced']).",
	{$fresconc},
	{$frestrsol},
	".($_POST['numResidTrabConc']).",
	{$frestrconc},
	{$_POST['visado']},
	{$_POST['asilo']},
	".($_POST['otrosDoc']).",
	{$fentrada},
	{$fprueba},
	".($_POST['abogadootros']).",
	".($_POST['PermisoResidRazonesNo']).",
	".($_POST['PermisoSolicitudLugar']).",
	".($_POST['TiempoResidenciaEspanya']).",
	".($_POST['TiempoResidenciaBilbao']).",
	{$_POST['PermisoTrabajo']},
	".($_POST['PermisoTrabajoRazonesNo']).",
	".($FechaEmpadronamiento).",
	".$_POST['direccionPadronActual'].",
	{$_POST['Tis']},
	{$_POST['RedApoyo']},
	{$_POST['IngresosPropios']},
	{$_POST['IngresosPnc']},
	{$_POST['IngresosOtros']},
	{$_POST['IngresosNomina']},
	{$_POST['IngresosRGI']},
	{$_POST['IngresosPrestContrib']},
	{$_POST['IngresosSeDesconoce']},
	{$_POST['IngresosAyudaIndividual']},
	{$_POST['IngresosNo']},
	{$_POST['PenalAntecedentesPrision']},
	{$_POST['PenalOrdenAlejamiento']},	
	{$_POST['PenalPrisionPreventiva']},
	{$_POST['PenalPrisionOtros']},
	{$_POST['PenalLibCondicional']},
	{$_POST['PenalMedidaSeguridad']},
	{$_POST['PenalCausasPendientes']},
	{$_POST['PenalPermisoPenitenc']},
	{$_POST['PenalTercerGrado']},
	{$_POST['PenalTbc']},
	{$_POST['ducha']},
	{$_POST['ropero']},
	{$_POST['lavanderia']},
	{$_POST['tlSabado']},
	{$_POST['tlDomingo']},
	{$_POST['salidaVerano']},
	{$_POST['salidaOtro']},
	{$_POST['medicacionCentro']},
	{$_POST['NivelCastellano']},
	".($_POST['expLaboral']).",
	{$_POST['lanbide']},
	".($F_alta_lanbide).",
	".($F_renov_lanbide).",
	{$_POST['inem']},
	".($F_alta_inem).",
	".($F_renov_inem).",
	".($_POST['cursos']).",
	{$_POST['sexo']},
	".$_POST['id_unico'].",
	".($_POST['poblacionPadron']).",
	{$_POST['diabetes']},
	".($_POST['ConsumoPrinc']).",
	{$insert_id_usuario},
	NOW(),
	{$_POST['AnosConsumo']},
	{$_POST['Tratamiento']},
	{$_POST['TratamientoTipo']},
	{$_POST['procedenciaDemandaLista']},
	{$_POST['situacionAdministrativa']},
	'actual'";


	$query .= ")";	
	if ($prueba) {echo "<br>Query: ".$query; die(); }



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
		if ($nuevo) {

		} else {
			// Cambia el historial a 'historial' en el último 'actual' 
			$db->pregunta_query("UPDATE persona SET historial = 'historial' WHERE id_pers = ".$ultimo_actual."");   
		}
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
