<?php

$extra = array (
		'name_3_8' => 'cuadro_4',
		'name_12_3' => 'cuadro_13'
	);
	// Nota: si se añaden items, hay que cambiar el javascript de form_situacion_social.php


$tratam = array (
		'name_4_0' => array('d', 'Tipo de tratamiento', 'tipo_trat', array('Agonista', 'Antagonista')),
		'name_4_1' => array('t', 'Centro de tratamiento', 'centro_trat')
	);


$desplegable = array (
		'desplegable_1' => array(
			'ago' =>'Agonista',
			'ant' => 'Antagonista'	
		)
	);


$form_ficha = array (	

	array(
	'id' => 1,
	'titulo' => 'INFORMACION',
	'items' => array(
		'Información adecuada',
		'Desinformación sobre prestaciones de los SSSS',  
		'Desinformación sobre otros recursos de protección públicos',
		'Desinformación sobre recursos de participación social',
		'Dificultad de acceso a los recursos por inhibición multicausal'
			)
	),
	
	array(
	'id' => 2,
	'titulo' => 'HABILIDADES SOCIALES',
	'items' => array(
		'Habilidades sociales adecuadas',
		'Dificultad para iniciar/mantener una conversación',
		'Dificultad para captar/ expresar sentimientos propios o de los demás ',
		'Dificultad para analizar con realismo su situación',
		'Dificultades relacionadas con la resolución de conflictos',
		'Dificultad para adaptarse a situaciones nuevas o inmodificables'
			)
	),

	array(
	'id' => 3,
	'titulo' => 'AUTONOMIA FISICA / PSIQUICA',
	'items' => array(
		'Autonomía física/ psíquica adecuada',
		'Dificultad para la realización de tareas cotidianas',
		'Disminución Física',
		'Disminución psíquica',
		'Dificultad de movilidad',	
		'Disminución sensorial',
		'Enfermedad mental',
		'Enfermedad crónica aguda',
		'Consumo abusivo de drogas alcohol'
			)
	),

	array(
	'id' => 4,
	'titulo' => 'TRATAMIENTO',
	'items' => array(
		'Tipo de tratamiento de drogodependencias',
		'Centro de Tratamiento'
			)
	),


	array(
	'id' => 5,
	'titulo' => 'RELACIÓN CONVIVENCIAL',
	'items' => array(
		'Relación convivencial adecuada',
		'Unidad Familiar temporalmente incompleta',
		'Orfandad',		
		'Soledad/aislamiento',
		'Familia monoparental',		
		'Separación/ divorcio',
		'Deterioro de las relaciones familiares',
		'Abandono/ expulsión del hogar',		
		'Maltrato/ abuso sexual',
		'Atención deficitaria a los miembros vulnerables de la familia'
			)
	),

	array(
	'id' => 6,
	'titulo' => 'ORGANIZACIÓN DE LA UNIDAD CONVIVENCIAL',
	'items' => array(
		'Organización convivencial adecuada',
		'Administración económica inadecuada',
		'Abuso del poder en el manejo del presupuesto',
		'Reparto injusto de las tareas domesticas',
		'Alimentación deficitaria',		
		'Higiene del hábitat deficitario',
		'Higiene personal deficitaria'
			)
	),


	array(
	'id' => 7,
	'titulo' => 'VIVIENDA',
	'items' => array(
		'Vivienda adecuada',			
		'Barreras arquitectonicas',
		'Hacinamiento',	
		'Equipamiento insuficiente',
		'Carencia de suministros o deficiencias en los mismos',
		'Condiciones de habitabilidad deficitarias',
		'Alojamiento temporal en otro domicilio o centro de acogida',
		'Alojamiento en pensión	',	
		'Alojamiento en infravivienda',
		'Sin vivienda'
			)
	),


	array(
	'id' => 8,
	'titulo' => 'RECURSOS ECONOMICOS',
	'items' => array(
		'Recursos económicos suficientes',		
		'Deudas, impagos,etc',
		'Situación económica deficitaria',
		'Situación económica muy deficitaria',
		'Situación de necesidad provocada por emergencia social',
		'Carencia de ingresos económicos'
			)
	),


	array(
	'id' => 9,
	'titulo' => 'TRABAJO OCUPACIÓN',
	'items' => array(
		'Actividad laboral adecuada',			
		'Explotación laboral',
		'Trabajo sumergido',			
		'Ocupación sumergida ilegal',
		'Paro de larga duración',
		'Fuera del mercado laboral por jubilación/incapacidad',
		'Capacitación laboral inadecuada al mercado laboral',
		'Dificultades de incorporación laboral por edad, sexo, raza,etc',
		'Dificultades de incorporación laboral por obligaciones familiares'
			)
	),

	
	array(
	'id' => 10,
	'titulo' => 'ESCOLARIZACION DE MENORES',
	'items' => array(
		'Escolarización adecuada',		
		'Bajo rendimiento escolar',
		'Absentismo escolar',		
		'Desescolarización',
		'Escolarización conflictiva'
			)
	),

	
	array(
	'id' => 11,
	'titulo' => 'FORMACION DE ADULTOS',
	'items' => array(
		'Formación adecuada al estandar de la zona',
		'Sin formación academica',		
		'Analfabetismo funcional',
		'Formación no homologada',		
		'Formación escasa o desfasada'
			)
	),


	array(
	'id' => 12,
	'titulo' => 'INTEGRACIÓN SOCIAL',
	'items' => array(
		'Participación social adecuada',			
		'Aislamiento social',
		'Dificultades de inserción por circunstancias particulares',
		'Rechazo violento por circunstancias personales'
			)
	),
	
	array(
	'id' => 13,
	'titulo' => 'CIRCUNSTANCIAS PARTICULARES QUE DIFICULTAN LA INTEGRACIÓN SOCIAL O PROVOCAN EL RECHAZO SOCIAL VIOLENTO',
	'items' => array(
		'Inmigración ilegal',		                 
		'Antecedentes de conductas delictivas',
		'Inmigración legal',			     
		'Antecedentes de consumo drogas/alcohol',
		'Minoria etnica	',			      
		'Ejercicio de la mendicidad',
		'Transeuntismo/ indomiciliación	',      
		'Padecimiento enfermedad estigmatizada',
		'Ejercicio de la prostitución',		
		'Discriminación por orientación sexual, expresión generica o apariencia'
			)
	)

);
?>
