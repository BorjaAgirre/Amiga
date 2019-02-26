<?php

$extra = array (
		'name_3_8' => 'cuadro_4',
		'name_12_3' => 'cuadro_13'
	);
	// Nota: si se a�aden items, hay que cambiar el javascript de form_situacion_social.php


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
		'Informaci�n adecuada',
		'Desinformaci�n sobre prestaciones de los SSSS',  
		'Desinformaci�n sobre otros recursos de protecci�n p�blicos',
		'Desinformaci�n sobre recursos de participaci�n social',
		'Dificultad de acceso a los recursos por inhibici�n multicausal'
			)
	),
	
	array(
	'id' => 2,
	'titulo' => 'HABILIDADES SOCIALES',
	'items' => array(
		'Habilidades sociales adecuadas',
		'Dificultad para iniciar/mantener una conversaci�n',
		'Dificultad para captar/ expresar sentimientos propios o de los dem�s ',
		'Dificultad para analizar con realismo su situaci�n',
		'Dificultades relacionadas con la resoluci�n de conflictos',
		'Dificultad para adaptarse a situaciones nuevas o inmodificables'
			)
	),

	array(
	'id' => 3,
	'titulo' => 'AUTONOMIA FISICA / PSIQUICA',
	'items' => array(
		'Autonom�a f�sica/ ps�quica adecuada',
		'Dificultad para la realizaci�n de tareas cotidianas',
		'Disminuci�n F�sica',
		'Disminuci�n ps�quica',
		'Dificultad de movilidad',	
		'Disminuci�n sensorial',
		'Enfermedad mental',
		'Enfermedad cr�nica aguda',
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
	'titulo' => 'RELACI�N CONVIVENCIAL',
	'items' => array(
		'Relaci�n convivencial adecuada',
		'Unidad Familiar temporalmente incompleta',
		'Orfandad',		
		'Soledad/aislamiento',
		'Familia monoparental',		
		'Separaci�n/ divorcio',
		'Deterioro de las relaciones familiares',
		'Abandono/ expulsi�n del hogar',		
		'Maltrato/ abuso sexual',
		'Atenci�n deficitaria a los miembros vulnerables de la familia'
			)
	),

	array(
	'id' => 6,
	'titulo' => 'ORGANIZACI�N DE LA UNIDAD CONVIVENCIAL',
	'items' => array(
		'Organizaci�n convivencial adecuada',
		'Administraci�n econ�mica inadecuada',
		'Abuso del poder en el manejo del presupuesto',
		'Reparto injusto de las tareas domesticas',
		'Alimentaci�n deficitaria',		
		'Higiene del h�bitat deficitario',
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
		'Alojamiento en pensi�n	',	
		'Alojamiento en infravivienda',
		'Sin vivienda'
			)
	),


	array(
	'id' => 8,
	'titulo' => 'RECURSOS ECONOMICOS',
	'items' => array(
		'Recursos econ�micos suficientes',		
		'Deudas, impagos,etc',
		'Situaci�n econ�mica deficitaria',
		'Situaci�n econ�mica muy deficitaria',
		'Situaci�n de necesidad provocada por emergencia social',
		'Carencia de ingresos econ�micos'
			)
	),


	array(
	'id' => 9,
	'titulo' => 'TRABAJO OCUPACI�N',
	'items' => array(
		'Actividad laboral adecuada',			
		'Explotaci�n laboral',
		'Trabajo sumergido',			
		'Ocupaci�n sumergida ilegal',
		'Paro de larga duraci�n',
		'Fuera del mercado laboral por jubilaci�n/incapacidad',
		'Capacitaci�n laboral inadecuada al mercado laboral',
		'Dificultades de incorporaci�n laboral por edad, sexo, raza,etc',
		'Dificultades de incorporaci�n laboral por obligaciones familiares'
			)
	),

	
	array(
	'id' => 10,
	'titulo' => 'ESCOLARIZACION DE MENORES',
	'items' => array(
		'Escolarizaci�n adecuada',		
		'Bajo rendimiento escolar',
		'Absentismo escolar',		
		'Desescolarizaci�n',
		'Escolarizaci�n conflictiva'
			)
	),

	
	array(
	'id' => 11,
	'titulo' => 'FORMACION DE ADULTOS',
	'items' => array(
		'Formaci�n adecuada al estandar de la zona',
		'Sin formaci�n academica',		
		'Analfabetismo funcional',
		'Formaci�n no homologada',		
		'Formaci�n escasa o desfasada'
			)
	),


	array(
	'id' => 12,
	'titulo' => 'INTEGRACI�N SOCIAL',
	'items' => array(
		'Participaci�n social adecuada',			
		'Aislamiento social',
		'Dificultades de inserci�n por circunstancias particulares',
		'Rechazo violento por circunstancias personales'
			)
	),
	
	array(
	'id' => 13,
	'titulo' => 'CIRCUNSTANCIAS PARTICULARES QUE DIFICULTAN LA INTEGRACI�N SOCIAL O PROVOCAN EL RECHAZO SOCIAL VIOLENTO',
	'items' => array(
		'Inmigraci�n ilegal',		                 
		'Antecedentes de conductas delictivas',
		'Inmigraci�n legal',			     
		'Antecedentes de consumo drogas/alcohol',
		'Minoria etnica	',			      
		'Ejercicio de la mendicidad',
		'Transeuntismo/ indomiciliaci�n	',      
		'Padecimiento enfermedad estigmatizada',
		'Ejercicio de la prostituci�n',		
		'Discriminaci�n por orientaci�n sexual, expresi�n generica o apariencia'
			)
	)

);
?>
