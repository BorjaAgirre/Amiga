<?php
session_start();
include("clases/class.login.php");
$login=new login();
$login->inicia();

include_once "include/imprime.php"; 
include_once "include/fechas.php";
include_once "headers.php";
header_principal("persona"); 
$pagina = "persona"; 
include_once "menu_lateral.php";
include_once "clases/class.leer_mysqli.php";

		//echo "<br><h2>HOLA soy Borja, estoy haciendo cambios en el programa, en unos minutos vuelven a aparecer los datos. </h2>";
		$db = new Leer_Mysqli(); 

		/*   Si al cargar la web se ha seleccionado un usuario, se carga con los datos    */

		$id_unico = ""; 

		if ((isset($_GET['load'])) || (isset($_SESSION['load'])) )
		{
			if (isset($_SESSION['load'])) $id_unico=$_SESSION['load'];
			if (isset($_GET['load'])) $id_unico=$_GET['load'];

			if ($id_unico != 0) {
				//include_once  "include/funciones_buscar.php";
				$maxid = $db->maxid($id_unico); 
				$result = $db->persona_idpers($maxid); 
				$row = $result->fetch_array(MYSQLI_BOTH); 
				$id_pers = $maxid;	
				$_SESSION['load']=$id_unico;
			}
		}
		
		
		if (isset($_GET['delete']))
		{
			$deleteid=$_GET["delete"];

			$datos = new Leer_Mysqli(); 
			$result = $datos->pregunta_query("DELETE FROM persona WHERE id_pers=".$deleteid); 
			$datos->cerrar_conexion(); 
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=persona.php'>";

//			Cambiado a Mysqli; dejo las anteriores líneas temporalmente por si hay errores
//			include "conexion.php";
//			$result=mysql_query("DELETE FROM persona WHERE id_pers=$deleteid", $conexion);
//			include "cerrar_conexion.php";
		}

		
		?>
		
	<script language="Javascript">
		function opcion()  {
 			ventana=confirm("Se va a proceder a borrar a esta persona de la bases de datos. Esta acción no se puede deshacer. ¿ESTÁS SEGURO?");
			if (ventana) {
				alert("El registro ha sido borrado");
			} else {
				alert("No se ha borrado el registro");             
			}                                   
		}
		function validar() {
		}
	</script>
		
<?php

////////////////////////////////////////////////////////////////////////////
//   COMPROBACIONES DE ERROR PREVIAS
////////////////////////////////////////////////////////////////////////////

//
// Comprueba que no hay personas sin al menos un registro con la variable historial = actual en la base de datos (tabla persona) 
//

// Personas
$personas = $db->lista_query("SELECT id_unico FROM persona GROUP BY id_unico ORDER BY id_unico", true); 
$tot_personas = sizeof($personas); 

// Actuales
$actuales = $db->lista_query("SELECT id_unico FROM persona WHERE historial = 'actual' ORDER BY id_unico", true); 
$tot_actuales = sizeof($actuales); 

// Avisa en caso de que existan personas sin el registro actual
if ($tot_personas != $tot_actuales) {
	$array_dif = array_diff($personas, $actuales); 
	echo "<div id='nota'>"; 
	echo "<br><strong>Error encontrado: </strong>hay algunos registros de personas que no tienen la variable 'actual'";
	foreach ($array_dif as $pers) {
		echo "<br>id_unico: <strong>".$pers."</strong>";
	}
	echo "<br>Por favor, avisa al responsable de la base de datos. ";
	echo "</div>";
}

?>


	<div id="main">

<!-- FORMULARIO INSERTAR PERSONA -->

	<form name="persona"  autocomplete='off' id="persona" enctype='multipart/form-data' action="insertar_persona.php" method="post">
		
		
<!-- ######################################################################################################## -->
<!-- ######################################################################################################## -->
<!-- ######################################################################################################## -->
<!-- ######################################################################################################## -->
			



<!-- ##################################################
     DATOS PERSONALES
     #################################################
-->	
	<div id="datos_personales" style="display:;">
	<script language="JavaScript" src='jq/js/scripts_historial.js'></script> 
<?php


		imprimeItem("nombre", "Nombre", 12, "fafd00", 1, 1, false);
		imprimeItem("apellido1", "Primer Apellido", 12, "fafd00", 1, 20, false);  
		imprimeItem("apellido2", "Segundo Apellido", 12, "fafd00", 1, 40, false);  
		imprimeItemFecha("fechanac", "Fecha Nacimiento", 12, "fafd00", 1, 60, false);     
		imprimeItem("lugarNac", "Ciudad Nacimiento", 12, "AAAAFF", 1, 80, false); 
			$sexo[0]=array ("titulo"=>"Mujer", "top"=>"12", "left"=>"01");
			$sexo[1]=array ("titulo"=>"Hombre", "top"=>"16", "left"=>"01");
		imprimeRadio($sexo, "sexo", "");

		imprimeItem("dni", "DNI/Pasaporte/NIE", 12, "BBBBBB", 12, 20, false); 		
//		imprimeHistorial("dni_pas", "DNI/Pasaporte/NIE", 12, "BBBBBB", 16, 34, false); 	
		imprimeListaDesplegable("nacionalidad", "Nacionalidad", "paises_mundo", "fafd00", "id_pais", 150, 12, 40, false);	
		imprimeItem("telefono", "Teléfono", 12, "BBBBBB", 12, 60, false);     
//		imprimeHistorial("telefono", "Teléfono", 12, "BBBBBB", 11, 68, false);     
		imprimeListaDesplegable("estadoCivil", "Estado civil", "estado_civil", "fafd00", "est_civil", 150, 12, 80, false);	

		imprimeListaDesplegable("nucleoConv", "Núcleo Convivencia", "despl_nucleoconv", "fafd00", "id_nucleo", 150, 24, 1, false);	
		imprimeItem("direccionActual", "Dirección vivienda actual", 30, "BBBBBB", 24, 23, false);     
//		imprimeHistorial("direccion", "Dirección vivienda actual", 30, "BBBBBB", 23, 44, false); 
		imprimeListaDesplegable("poblacion", "Población vivienda actual", "poblaciones", "fafd00", "id_poblacion", 250, 24,60, false);

		imprimeItemFecha("FechaEmpadronamiento", "Fecha padrón actual", 12, "BBBBBB", 36, 01, false);     
		imprimeItem("direccionPadronActual", "Domicilio padrón actual", 30, "BBBBBB", 36, 23, false);     
		imprimeListaDesplegable("poblacionPadron", "Población padrón actual", "poblaciones", "fafd00", "id_poblacion", 250, 36,60, false); 

		imprimeItem("numHijos", "Nº hijos/as", 1, "ffbf5a", 50, 15, false);     
		imprimeCheckbox("hijos", "¿Hijos/as?", "ffbf5a", 50, 1, "arriba", false);
		imprimeTexto("observacionesHijos", "Observaciones Familia", 4,30, "BBBBBB", 50, 30, false);    
		imprimeTexto("telefonosInteres", "Teléfonos de interés", 6,30, "BBBBBB", 50, 65, false);      
//		imprimeItem("id_antiguo", "Id. antiguo", 12, "fafd00", 50, 70, false);

		imprimeImagen("id_imagen", "test.bmp", 65, 5);

			
	echo "\n\t\t\t</div>\n";
//	Fin div datos_personales   
			

//   ##################################################
//   DATOS FORMATIVO-LABORALES
//   #################################################


	echo "<div id='formativo' style='display:;'>";

			
	
		imprimeListaDesplegable("nivelFormativo", "Nivel formativo", "despl_estudios", "fafd00", "nivelFormativo", 240, 1,1, false);
		imprimeListaDesplegable("NivelCastellano", "Nivel de castellano", "despl_idioma", "fafd00", "idNivCast", 240, 18,1, false);
		imprimeListaDesplegable("Trabaja", "Situación laboral", "despl_trabaja", "fafd00", "id_trab", 180, 35,1, false);

		imprimeTexto("observacionesNivelFormativo", "Datos de formación y trabajo", 3,40, "AAFFAA", 1, 33, false);     
		imprimeTexto("observacionesIdioma", "Idiomas", 3,35, "ffbf5a", 18, 33, false);    
		imprimeTexto("cursos", "Cursos", 3,50, "ffbf5a", 55, 35, false);

		imprimeTitulo("TituloIngresos", "Ingresos", 50, 5, true);		

		imprimeItem("numSegSoc", "Nº S. Social", 15, "BBBBBB", 18, 70, false);     
		imprimeItem("EdadAbandonoEstudios", "Edad fin estudios", 2, "BBBBBB", 1, 80, false);   
		imprimeItem("TiempoTrabajado", "Tiempo Trabajado", 10, "BBBBBB", 35, 24, false);   
		
		imprimeCheckbox("IngresosPropios", "Propios", "DDDDDD" , 54, 5, "dcha", false);
		imprimeCheckbox("IngresosPnc", "Prestación no Contributiva", "DDDDDD" , 58, 5, "dcha", false);
		imprimeCheckbox("IngresosPrestContrib", "Prestación Contributiva", "DDDDDD" , 62, 5, "dcha", false);

		imprimeCheckbox("IngresosOtros", "Otros", "DDDDDD" , 74, 5, "dcha", false);
		imprimeCheckbox("IngresosNomina", "Nómina", "DDDDDD" , 66, 5, "dcha", false);
		imprimeCheckbox("IngresosRGI", "Renta Garantía de Ingresos", "DDDDDD" , 70, 5, "dcha", false);

		imprimeCheckbox("IngresosSeDesconoce", "Desconocidos", "DDDDDD" , 78, 5, "dcha", false);
		imprimeCheckbox("IngresosAyudaIndividual", "Ayuda Especial Inclusión Social", "DDDDDD" , 82, 5, "dcha", false);
		imprimeCheckbox("IngresosNo", "Sin Ingresos", "DDDDDD" , 86, 5, "dcha", false);
		
		
		imprimeCheckbox("RedApoyo", "Red de Apoyo", "DDDDDD" , 10, 5, "dcha", false);
		imprimeCheckbox("expLaboral", "Experiencia Laboral", "DDDDDD" , 43, 1, "dcha", false);
		imprimeCheckbox("lanbide", "Lanbide", "DDDDDD" , 40, 35, "izda", false);
		imprimeCheckbox("inem", "INEM", "DDDDDD" , 48, 37, "izda", false);
		
		
		imprimeItemFecha("fechaAltaLanbide", "Fecha alta", 12, "BBBBBB", 36, 48, false);     
		imprimeItemFecha("fechaRenovLanbide", "Fecha renovac.", 12, "BBBBBB", 36, 73, false);     
		imprimeItemFecha("fechaAltaInem", "Fecha alta", 12, "BBBBBB", 46, 48, false);     
		imprimeItemFecha("fechaRenovInem", "Fecha renovac.", 12, "BBBBBB", 46, 73, false);     

			

	echo "</div>";
	// Fin div formativo 

//   ##################################################
//   DATOS SALUD
//   #################################################
	
	echo "<div id='salud' style='display:;'>";


		imprimeCheckbox("EnfermedadMental", "Enfermedad mental", "fafd00", 1, 1, "dcha", true);
?>		

			<div id="EnfMentalDiagnostico">
			Diagnóstico<br><textarea name="EnfMentalDiagnostico" size="12;font-weight:bold" cols="50" rows="2" ><?php echo $row["EnfMentalDiagnostico"];?></textarea>
			</div>
<?php 
		imprimeCheckbox("EnfMentalPadres", "Enf. mental padres", "", 5, 70, "dcha", false);
		imprimeCheckbox("EnfMentalHermanos", "Enf. mental hermanos", "", 9, 70, "dcha", false);
		imprimeCheckbox("EnfMentalPareja", "Enf. mental pareja", "", 13, 70, "dcha", false);
		imprimeCheckbox("EnfMentalHijos", "Enf. mental hijos", "", 17, 70, "dcha", false);

		imprimeCheckbox("Toxicomania", "Toxicomanía", "fafd00", 21, 1, "dcha", true);
		imprimeCheckbox("AntecConsumo", "Antecedentes de consumo", "fafd00", 26, 1, "dcha", true);
		imprimeListaDesplegable("ConsumoPrinc", "Consumo principal", "despl_consumoprinc", "fafd00", "id_cons", 180, 21, 23, true);	
		imprimeListaDesplegable("AnosConsumo", "Años consumo", "despl_anosconsumo", "fafd00", "id_anos", 130, 21, 65, true);	

		imprimeCheckbox("DisminucionPsiquica", "Minusvalía Psíquica", "fafd00", 32, 1, "dcha", true);
		imprimeCheckbox("DisminucionFisica", "Minusvalía Física", "fafd00", 38, 1, "dcha", true);
		imprimeItem("MinusvaliaPorcentaje", "Porcentaje de minusvalía", 4, "fafd00", 38, 25, true);
		imprimeTitulo("TituloIncapacit", "Incapacitación", 44, 25, "");
			$incap[1]=array ("titulo"=>"Si", "top"=>"44", "left"=>"40");
			$incap[2]=array ("titulo"=>"No", "top"=>"44", "left"=>"45");
		imprimeRadio($incap, "Incapacitacion", ""); 
		imprimeCheckbox("Autonomia", "Persona autónoma", "fafd00", 45, 1, "dcha", true);
		imprimeCheckbox("Tuberculosis", "Tuberculosis", "fafd00", 50, 5, "dcha", false);
		imprimeCheckbox("Hepatitis", "Hepatitis", "fafd00", 54, 5, "dcha", false);
		imprimeCheckbox("VIH", "VIH", "fafd00", 50, 25, "dcha", false);
		imprimeCheckbox("diabetes", "Diabetes", "fafd00", 54, 25, "dcha", false);
		imprimeCheckbox("Otras", "Otras", "bbbbbb", 50, 50, "dcha", false);

		imprimeCheckbox("DrogasPadres", "Drogas padres", "bbbbbb", 40, 70, "dcha", false);
		imprimeCheckbox("DrogasHermanos", "Drogas hermanos", "bbbbbb", 44, 70, "dcha", false);
		imprimeCheckbox("DrogasPareja", "Drogas pareja", "bbbbbb", 48, 70, "dcha", false);
		imprimeCheckbox("DrogasHijos", "Drogas hijos", "bbbbbb", 52, 70, "dcha", false);

		imprimeCheckbox("Tratamiento", "Tratamiento", "fafd00", 62, 1, "dcha", true);
		imprimeListaDesplegable("EnfMentalTratamiento", "Centro tratamiento", "despl_centrotrat", "fafd00", "id_centro", 130, 66, 5, true);

		imprimeItem("EnfMentalIngresos", "Ingresos psiq.", 10, "AAAAFF", 65, 75, false); 	
		imprimeListaDesplegable("TratamientoTipo", "Tipo tratam.", "despl_tipotrat", "fafd00", "id_tipotrat", 130, 66, 45, true);
		
		
		imprimeTexto("Medicacion", "Medicacion/Pauta", 3,40, "EEEEEE", 75, 5, false);		
		imprimeTexto("EnfermedadesComentarios", "Comentarios", 3,40, "EEEEEE", 75, 50, false);	




/// ##################################################
///  DATOS ADMINISTRATIVOS
/// #################################################

		echo "</div><div id='administrativo' style='display:;'>";

		imprimeCheckbox("Tis", "TIS", "ffbf5a", 5, 75, "dcha", false);
			$pasap[0]=array ("titulo"=>"Pasaporte", "top"=>"5", "left"=>"5");
			$pasap[1]=array ("titulo"=>"Cédula inscripción", "top"=>"9", "left"=>"5");
			$pasap[2]=array ("titulo"=>"Sin documento de país de origen", "top"=>"13", "left"=>"5");
		imprimeRadio($pasap, "DocumentoIdentif", "");   

//Hay que poner en insertar_persona.php lo que son fechas

		imprimeItem("npasap", "Nº", 8, "", 5, 60, true);  
		imprimeItemFecha("fpasap", "fecha caduc.:", 8, "", 5, 30, true);  
		imprimeItem("ncedula", "Nº", 8, "", 9, 60, true);  
		imprimeItemFecha("fcedula", "fecha caduc.:", 8, "", 9, 30, true);  

		imprimeTitulo("lblres", "Permiso de residencia:", 20, 5, true); 

//  Está por poner los nombres de base de datos correspondientes

			$res[0]=array ("titulo"=>"no solicitada", "top"=>"20", "left"=>"30");
			$res[1]=array ("titulo"=>"solicitada", "top"=>"24", "left"=>"30");
			$res[2]=array ("titulo"=>"concedida", "top"=>"28", "left"=>"30");
		imprimeRadio($res, "PermisoResid", "");



		imprimeItemFecha("fechaResidSolicit", "fecha:", 8, "", 24, 46, true);  
		imprimeItem("numResidConced", "Nº", 6, "", 28, 65, true);  
		imprimeItemFecha("fechaResidConced", "fecha:", 8, "", 28, 46, true);  
		imprimeTitulo("lblrestr", "Permiso de residencia:", 34, 5, true); 
		imprimeTitulo("lblrestr2", "y trabajo:", 38, 5, true); 

		$res[0]=array ("titulo"=>"no solicitada", "top"=>"34", "left"=>"30");
		$res[1]=array ("titulo"=>"solicitada", "top"=>"38", "left"=>"30");
		$res[2]=array ("titulo"=>"concedida", "top"=>"42", "left"=>"30");
		imprimeRadio($res, "PermisoResidTr", "");

		imprimeItemFecha("frestrsol", "fecha:", 8, "", 38, 46, true);  
		imprimeItem("numResidTrabConc", "Nº", 6, "", 42, 65, true);  
		imprimeItemFecha("fechaResidTrabConc", "fecha:", 8, "", 42, 46, true);  

		imprimeCheckbox("visado", "Visado de estancia", "ffffff", 50, 5, "dcha", false);
		imprimeCheckbox("asilo", "Asilo", "ffffff", 54, 5, "dcha", false);
		imprimeItem("otrosDoc", "Otros: ", 30, "", 58, 5, true);  
		imprimeItemFecha("fechaEntrada", "Fecha de entrada en España: ", 10, "", 54, 50, true);  
		imprimeItemFecha("fechaPrueba", "Fecha de primera prueba: ", 10, "", 58, 50, true);  

		imprimeTitulo("lblabogado", "Acompañamiento jurídico:", 69, 5, true); 
		imprimeItem("abogadootros", "Abogado y otros: ", 30, "", 81, 5, true);  





		
	echo "</div>"; //  Fin div administrativo 





//     ##################################################
//     DATOS JURIDICOS
//     #################################################


	echo "<div id='juridico' style='display:;'>";

	
		imprimeCheckbox("PenalAntecedentesPrision", "Antecedentes Prisión", "fafd00", 2, 5, "dcha", false);
		imprimeCheckbox("PenalOrdenAlejamiento", "Orden de alejamiento", "fafd00", 6, 5, "dcha", false);		
		imprimeCheckbox("PenalPrisionPreventiva", "Prisión preventiva", "fafd00", 10, 5, "dcha", false);
		imprimeCheckbox("PenalPrisionOtros", "Prisión (otros)", "fafd00", 14, 5, "dcha", false);
		imprimeCheckbox("PenalLibCondicional", "Libertad Condicional", "fafd00", 18, 5, "dcha", false);

		imprimeCheckbox("PenalTbc", "TBC", "", 2, 40, "dcha", true);
		imprimeCheckbox("PenalTercerGrado", "Tercer grado", "fafd00", 6, 40, "dcha", false);
		imprimeCheckbox("PenalCausasPendientes", "Causas pendientes", "fafd00", 10, 40, "dcha", false);
		imprimeCheckbox("PenalPermisoPenitenc", "Permiso penitenciario", "fafd00", 14, 40, "dcha", false);
		imprimeCheckbox("PenalMedidaSeguridad", "Medidas de seguridad", "fafd00", 18, 40, "dcha", false);

		imprimeItem("PermisoSolicitudLugar", "Lugar", 12, "BBBBBB", 36, 48, false);     
		imprimeItem("TiempoResidenciaEspanya", "Periodo España", 12, "BBBBBB", 36, 48, false);     
		imprimeItem("TiempoResidenciaBilbao", "Periodo Bilbao", 12, "BBBBBB", 36, 48, false);     

		

// 	SUBFORMULARIO

//	Dibuja subformulario

//	Definición de los campos de la tabla jurídica

	$campos_jurid = array(
		"organo_judicial" => "Organo judicial", 
		"situacion" => "Situación", 
		"citaciones" => "Citaciones ptes.",
		"condena" => "Condena", 
		"informes" => "Informes enviados", 
		"domicilio" => "Domic. notificaciones", 
		"informes2" => "Informes enviados"); 


//	Primera fila de cabeceras

	echo "<div id='iframetabla'>";
	echo "<table>";
	echo "<tr class='header'>";
	$texto_campos = ""; 
	foreach ($campos_jurid as $id => $campo) {
		$texto_campos .= "<td>".$campo."</td>";
	}
	echo $texto_campos; 
	echo "</tr>";
	echo "<tr>";
	

//	Contenidos del subformulario, si hay un usuario 

	if ($id_unico != "")  {

//		include "conexion.php";
		$datos = new Leer_Mysqli(); 
		$sit = $datos->desplegable("despl_situacion", "situacion"); 
//		$resultsituacion = mysql_query("SELECT * FROM despl_situacion ORDER BY situacion desc", $conexion); 


		echo "<pre>"; print_r($sit); echo "</pre>"; //////////////////////////////
		echo "<tr>"; 
		$resultcausas = $datos->pregunta_query("SELECT * FROM causas WHERE id_unico = ".$id_unico); 

		while($rowj = $resultcausas->fetch_array(MYSQLI_BOTH))  {


			foreach ($campos_jurid as $id => $campo) {

				//  Campo especial: 'situacion'
				if ($id == 'situacion') {
					echo "<td><div id='situacion' ><select name='causas_".$rowj["id_causa"].
						"_situacion' style='background-color:#BBBBBB;font-weight:bold'>\n";	

					echo '<option value="1"></option>\n';				
					foreach($sit as $rowsit)  {
						echo "sit: ".$rowj['situacion']." - id: ".$rowsit['id_situacion'];/////////////////////////
						echo '<option value="'.$rowsit['situacion'].'"';
						if ($rowj['situacion'] == $rowsit['id_situacion'])  {
							echo " selected";
						}
						echo ">".$rowsit['situacion']."</option>\n";
					}
					echo "</select></div></td>\n";
				} else {

				//   Resto de los campos
					echo "<td><input type='text' name='causas_".$rowj['id_causa'].
							"_organo_judicial' value='".$rowj[$id]."'/></td>\n";
	 			}
			}
		}
		echo "</tr>";
		$datos->cerrar_conexion(); 
//		include "cerrar_conexion.php";
	}

	//  Ultima fila vacía 

	echo "<tr>";
	foreach ($campos_jurid as $id => $campo) {
		if ($id == 'situacion') {
			echo '<td>
			<select name="causas_new_situacion" style="background-color:#BBBBBB;font-weight:bold">;
				<option value="1"></option>
				<option value="Cumplida">Cumplida</option>
				<option value="Cumpliendo STC">Cumpliendo STC</option>
				<option value="Suspendida Art. 80">Suspendida Art. 80</option>
				<option value="Suspendida Art. 87">Suspendida Art. 87</option>
				<option value="Pendiente">Pendiente</option>
				<option value="Suspensión revocada">Suspensión revocada</option>
				<option value="Otros">Otros</option>
			</select>
			</td>';
		} else {
			echo "<td><input type='text' name='causas_new_".$id."' /></td>";
		}
	}
	echo "</tr>";
   ?>
</table>
</div>	
			
			
	</div>   <!-- Fin div juridico -->



<!-- ##################################################
     DATOS INTERVENCIÓN EN ZUBIETXE 
     #################################################
-->			
			
	<div id="intervencion" style="display:;">	
			
			
<?php
		if (isset($_GET['load']))
		{
			$fecha_ingreso=$row["fechaIngreso"];
		}
		else
		{
			$hoy = getdate();
			$dia = $hoy[mday];
			$mes = $hoy[mon];
			$anyo = $hoy[year];
			$fecha_ingreso="$dia/$mes/$anyo";
		}
		imprimeListaDesplegable("responsable", "Tutor", "tutor", "fafd00", "nombre", 120, 5, 1, true);
/*		imprimeItemFecha("fecha_ingreso", "Fecha ingreso", 12, "AAFFAA", 5, 25, true);
			$fsalida=$row["fecha_salida"];
			if (calcularactivo($fsalida) || $fsalida=="0000-00-00")
			$color="00FF00";
			else 
			$color="FF0000";
		imprimeItemFecha("fecha_salida", "Fecha salida", 12, $color, 5, 60, true);
*/

		imprimeCheckbox("listaEspera", "Lista espera piso", "", 5, 40, "dcha", true);

		imprimeListaDesplegable("procedenciaDemandaLista", "Demanda", "despl_demanda", "fafd00", "id_deman", 240, 10, 1, true);
		imprimeItem("procedenciaDemanda", "Concreción", 25, "AAFFAA", 10, 40, true);
		echo "Identificador base datos: ".$id_unico;
		echo "<p>&nbsp;</p>";
		echo "<p>&nbsp;</p>";
		echo "<div style='margin-right:25%; margin-top: 130px;'><h1>NOTA IMPORTANTE: A partir de ahora, para dar de alta y de baja a la gente, hay otro formulario llamado 'Alta-Baja'. Lo podéis ver arriba a la derecha, debajo de Consultas. Para cualquier cosa me decís. <br>Darle a GUARDAR antes de ir a la otra pestaña.<br>Firmado: Borja</div>"; 

		imprimeItem("numExpediente", "Número de expediente", 8, "", 15, 1, true);     


//		imprimeCheckbox("centrodia", "Centro de día", "fafd00", 74, 2, "dcha", false);
/*
		imprimeTitulo("tit_alta", "Alta", 26, 25, true); 
		imprimeTitulo("tit_baja", "Baja", 26, 40, true); 
		imprimeTitulo("tit_motivo_salida", "Motivo baja", 26, 55, true); 
		imprimeTitulo("centroDia", "Centro día", 31, 1, false); 
		imprimeItemFecha("ff_centroDia", "", 8, "", 30, 35, true);  
		imprimeListaDesplegable("ms_centroDia", "", "despl_salida", "FFFFFF", "id_salida", 240, 30, 50, true);
		imprimeTitulo("berrisar", "Piso Berrisar", 36, 1, false);  
		imprimeItemFecha("fi_berrisar", "", 8, "", 35, 20, true);     
		imprimeItemFecha("ff_berrisar", "", 8, "", 35, 35, true);
		imprimeListaDesplegable("ms_berrisar", "", "despl_salida", "FFFFFF", "id_salida", 240, 35, 50, true);
		imprimeTitulo("protegido", "Piso protegido", 41, 1, false); 
		imprimeItemFecha("fi_protegido", "", 8, "", 40, 20, true);     
		imprimeItemFecha("ff_protegido", "", 8, "", 40, 35, true);
		imprimeListaDesplegable("ms_protegido", "", "despl_salida", "FFFFFF", "id_salida", 240, 40, 50, true);
		imprimeTitulo("pisoSantutxu", "Piso Santutxu", 46, 1, false); 
		imprimeItemFecha("fi_santutxu", "", 8, "", 45, 20, true);     
		imprimeItemFecha("ff_santutxu", "", 8, "", 45, 35, true);
		imprimeListaDesplegable("ms_santutxu", "", "despl_salida", "FFFFFF", "id_salida", 240, 45, 50, true);
		imprimeTitulo("pisoHiritar", "Piso Hiritar", 51, 1, false); 
		imprimeItemFecha("fi_hiritar", "", 8, "", 50, 20, true);     
		imprimeItemFecha("ff_hiritar", "", 8, "", 50, 35, true);
		imprimeListaDesplegable("ms_hiritar", "", "despl_salida", "FFFFFF", "id_salida", 240, 50, 50, true);
		imprimeTitulo("valoresPrision", "Valores prisión", 56, 1, false); 
		imprimeItemFecha("fi_prisionValores", "", 8, "", 55, 20, true);     
		imprimeItemFecha("ff_prisionValores", "", 8, "", 55, 35, true);
		imprimeListaDesplegable("ms_prisionValores", "", "despl_salida", "FFFFFF", "id_salida", 240, 55, 50, true);
		imprimeTitulo("entrevPrision", "Entrevistas prisión", 61, 1, false); 
		imprimeItemFecha("fi_prisionEntrev", "", 8, "", 60, 20, true);     
		imprimeItemFecha("ff_prisionEntrev", "", 8, "", 60, 35, true);
		imprimeListaDesplegable("ms_prisionEntrev", "", "despl_salida", "FFFFFF", "id_salida", 240, 60, 50, true);
		imprimeTitulo("parteHartzen", "Parte Hartzen", 66, 1, false); 
		imprimeItemFecha("fi_parteHartzen", "", 8, "", 65, 20, true);     
		imprimeItemFecha("ff_parteHartzen", "", 8, "", 65, 35, true);
		imprimeListaDesplegable("ms_parteHartzen", "", "despl_salida", "FFFFFF", "id_salida", 240, 65, 50, true);
		imprimeTitulo("documentacion", "Documentación", 71, 1, false); 
		imprimeItemFecha("fi_document", "", 8, "", 70, 20, true);     
		imprimeItemFecha("ff_document", "", 8, "", 70, 35, true);
		imprimeListaDesplegable("ms_document", "", "despl_salida", "FFFFFF", "id_salida", 240, 70, 50, true);
		imprimeTitulo("acompSocial", "Acompañamiento Social", 76, 1, false); 
		imprimeItemFecha("fi_acompSocial", "", 8, "", 75, 20, true);     
		imprimeItemFecha("ff_acompSocial", "", 8, "", 75, 35, true);
		imprimeListaDesplegable("ms_acompSocial", "", "despl_salida", "FFFFFF", "id_salida", 240, 75, 50, true);
		imprimeTitulo("fol", "Fol", 81, 1, false); 
		imprimeItemFecha("fi_fol", "", 8, "", 80, 20, true);     
		imprimeItemFecha("ff_fol", "", 8, "", 80, 35, true);
		imprimeListaDesplegable("ms_fol", "", "despl_salida", "FFFFFF", "id_salida", 240, 80, 50, true);
  		imprimeTitulo("seguimien", "Seguimiento", 86, 1, false); 
		imprimeItemFecha("fi_seguimiento", "", 8, "", 85, 20, true);     
		imprimeItemFecha("ff_seguimiento", "", 8, "", 85, 35, true);
		imprimeListaDesplegable("ms_seguimiento", "", "despl_salida", "FFFFFF", "id_salida", 240, 85, 50, true);
  		imprimeTitulo("trabsoc", "Trab. Social", 91, 1, false); 
		imprimeItemFecha("fi_trabsoc", "", 8, "", 90, 20, true);     
		imprimeItemFecha("ff_trabsoc", "", 8, "", 90, 35, true);
		imprimeListaDesplegable("ms_trabsoc", "", "despl_salida", "FFFFFF", "id_salida", 240, 90, 50, true);
*/

//		imprimeCheckbox("orient_laboral", "Orientación laboral", "", 80, 60, "dcha", false);

		imprimeTitulo("comedor","Comedor", 5, 85, true);
		imprimeCheckbox("comedorLun", "lunes", "", 9, 85, "dcha", false);
		imprimeCheckbox("comedorMar", "martes", "", 13, 85, "dcha", false);
		imprimeCheckbox("comedorMie", "miércoles", "", 17, 85, "dcha", false);
		imprimeCheckbox("comedorJue", "jueves", "", 21, 85, "dcha", false);
		imprimeCheckbox("comedorVie", "viernes", "", 25, 85, "dcha", false);

		imprimeTitulo("tiempo_libre", "Tiempo libre", 30, 85, true);
		imprimeCheckbox("tlSabado", "Sábado", "", 34, 85, "dcha", false);
		imprimeCheckbox("tlDomingo", "Domingo", "", 38, 85, "dcha", false);

		imprimeTitulo("otros_","Otros", 45, 85, true);
		imprimeCheckbox("creditrans", "Creditrans", "", 49, 85, "dcha", false);
		imprimeCheckbox("ducha", "Ducha", "", 53, 85, "dcha", false);
		imprimeCheckbox("ropero", "Ropero", "", 57, 85, "dcha", false);
		imprimeCheckbox("lavanderia", "Lavandería", "", 61, 85, "dcha", false);
		imprimeCheckbox("medicacionCentro", "Medicación en centro", "", 65, 85, "dcha", false);

		imprimeTitulo("salidas", "Salidas", 74, 85, true);
		imprimeCheckbox("salidaVerano", "Verano", "", 78, 85, "dcha", false);
		imprimeCheckbox("salidaOtro", "Otra salida (Arantzazu...)", "", 82, 85, "dcha", false);


			
		echo "</div>";  // Fin div intervencion 

//
//  Envía el dato del identificador de la persona  
//


    include "conexion.php";
    $resultidunico=mysql_query("SELECT id_unico FROM persona WHERE id_pers =".$loadid,$conexion); 
	if ($resultidunico!="")
	{
		$rowidunico=mysql_fetch_row($resultidunico);
		$id_unico=$rowidunico[0];
	}
	?>
		<input type="hidden" name="id_unico" value="<?php echo $id_unico; ?>" >

			
			
			<!-- FIN FORMULARIO DATOS PERSONALES -->
			
			<!-- ######################################################################################################## -->
			<!-- ######################################################################################################## -->
			<!-- ######################################################################################################## -->
			<!-- ######################################################################################################## -->
			
			
			<!-- Botón de envío (común a todas las pestañas) -->
			
			
			<div id="insert_fecha">
			<input type="text" size="10" value="<?echo date("d/m/Y");?>" name="insert_fecha" style="font-size:12;background-color: #AA55AA; "/></td>
			<br>
			<?
			if (isset ($loadid))
			{
			echo "Última modificación el <b>".fecha_sql_txt($row[120]). "</b> por <b>".$row[119]."</b>";
			}?>
			</div>

			
			<div id="send">
			<input type="submit" value="Guardar" onclick="validar();"style="font-size:24;background-color: #77FF77; ">
			</div>
			
			<!-- FIN Botón de envío-->
			
			<!-- Botón de borrado (común a todas las pestañas) -->
			
			<!-- FIN Botón de envío-->
			
		</form>
		<!-- FIN FORMULARIO INSERTAR PERSONA -->
		
		</div>
		<!-- Fin div main  -->

		<center><a href="pruebapdf.php">Generar listado de nombres y apellidos en PDF</a><a href='resultados.php'><b>&nbsp; &nbsp; Ver resultados</b></a></center>
		
		
		
		
		<!-- FIN FORMULARIO DATOS PERSONALES -->
	
	</body>
</html>
<?php 
//$db->cerrar_conexion(); 
?>
<!-- Cambiar formulario de intervención-->
