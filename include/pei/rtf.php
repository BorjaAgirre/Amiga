<?php

$pai['exp'] = '133'; 
$pai['nombre'] = 'Borja'; 
$pai['apellidos'] = 'Aguirre Miñana';
$pai['dni'] = '23423423-F'; 
$pai['fecha'] = '14-8-12';
$pai['proyecto'] = 'Incorporación';
$pai['tutor'] = 'También borja'; 
$pai['fecha_ini'] = '14-8-12';
$pai['fecha_fin'] = '31-12-12';
$pai['inicio'] = 'X'; 
$pai['finalizado'] = ''; 
$pai['ciudad'] = 'Bilbao'; 
$pai['dia'] = '14'; 
$pai['mes'] = 'agosto'; 
$pai['ano'] = '2012'; 



$dim[0]['titulo'] = '1. VIVIENDA'; 
$dim[0]['objetivo'] = '1. Que encuentre vivienda, etc \par 2. Que siga en ese piso';
$dim[0]['metas'] = 'Que vaya todo bien'; 

$dim[0]['acciones'][0] = array('Acción número uno', 'tarea1', 'recurso1', 'ini1', 'fin1', 'responsable1', 'resultado1'); 
$dim[0]['acciones'][1] = array ('Acción número dos', 'tarea2', 'recurso2', 'ini2', 'fin2', 'responsable2', 'resultado2'); 

$dim[0]['acciones'] = $acciones; 
$dim[0]['observaciones'] = 'No hay nada interesante que observar'; 


$dim[1]['titulo'] = '2. ECONOMÍA'; 
$dim[1]['objetivo'] = '1. Que encuentre dinero, etc \par 2. Que siga bien';
$dim[1]['metas'] = 'Que vaya todo bien'; 

$dim[1]['acciones'][0] = array('Acción número uno', 'tarea1', 'recurso1', 'ini1', 'fin1', 'responsable1', 'resultado1'); 
$dim[1]['acciones'][1] = array ('Acción número dos', 'tarea2', 'recurso2', 'ini2', 'fin2', 'responsable2', 'resultado2'); 

$dim[1]['observaciones'] = 'No hay nada interesante que observar'; 


include_once "contenido_rtf.php"; 

// Comienzo y datos de la cabecera
$rtf_pei = $contenido_rtf['cabecera'];
$rtf_pei .= '\cell\pard\plain \s21\noline\intbl{\b\afs20\ab\rtlch \ltrch\loch\fs20
Nº EXPEDIENTE:  ';
$rtf_pei .= $pai['exp'];
$rtf_pei .= '                               DNI/ NIE/ PASAPORTE:    ';
$rtf_pei .= $pai['dni'];
$rtf_pei .= '}\par \pard\plain \s21\noline\intbl{\b\afs20\ab\rtlch \ltrch\loch\fs20 NOMBRE: ';
$rtf_pei .= $pai['nombre'];
$rtf_pei .= '} \par \pard\plain \s21\noline\intbl{\b\afs20\ab\rtlch \ltrch\loch\fs20 APELLIDOS:  ';
$rtf_pei .= $pai['apellidos'];
$rtf_pei .= '} \par \pard\plain \s21\noline\intbl{\b\afs20\ab\rtlch \ltrch\loch\fs20
FECHA:  ';
$rtf_pei .= $pai['fecha'];
$rtf_pei .= '                                                  PERSONA DE REFERENCIA: ';
$rtf_pei .= $pai['tutor'];
$rtf_pei .= '}
\par \pard\plain \s21\noline\intbl{\b\afs20\ab\rtlch \ltrch\loch\fs20
PROYECTO ZUBIETXE: ';
$rtf_pei .= $pai['proyecto'].'}\cell\pard\plain \s21\noline\intbl{\rtlch \ltrch\loch
}\cell\row\pard\pard\plain \s20\tqc\tx7284\tqr\tx14569\noline{\rtlch \ltrch\loch
}
\par \pard\plain \s20\tqc\tx7284\tqr\tx14569\noline{\rtlch \ltrch\loch
}
\par }\ftnbj\ftnstart1\ftnrstcont\ftnnar\aenddoc\aftnrstcont\aftnstart1\aftnnrlc
\pgndec\pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}\par ';



// Bucle de las diferentes dimensiones

$size = sizeof($dim); 
for ($i=0; $i<$size; $i++) {

// Sub-bucle de la tabla de las acciones
$tabla_acciones = ''; 
foreach ($dim[$i]['acciones'] as $acc) {
$tabla_acciones .= '\trowd\trql\ltrrow\trpaddft3\trpaddt0\trpaddfl3\trpaddl0\trpaddfb3\trpaddb0\trpaddfr3\trpaddr0\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx2079\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx5905\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx8418\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx9693\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx10930\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx12899\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\clbrdrr\brdrhair\brdrw1\brdrcf1\cellx14569\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[0].'}\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[1].'}\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[2].'}\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[3].'}\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[4].'}\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[5].'}\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$acc[6].'}\cell\row\pard ';
}

// Creación de la página o páginas correspondientes a esa dimensión
$pagina = '\trowd\trql\ltrrow\trpaddft3\trpaddt0\trpaddfl3\trpaddl0\trpaddfb3\trpaddb0\trpaddfr3\trpaddr0\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx2898\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\clbrdrr\brdrhair\brdrw1\brdrcf1\cellx14569\pard\plain \s21\noline\intbl{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl{\b\afs22\ab\rtlch \ltrch\fs22\loch\f3
 }{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
DIMENSION:}{\afs22\rtlch \ltrch\loch\fs22\loch\f3
 }\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\fs18\loch\f3
 }
\par \pard\plain \s21\noline\intbl{\afs24\rtlch \ltrch\loch\fs24\loch\f3
';
$pagina .= $dim[$i]['titulo'].'}\cell\row\pard

\trowd\trql\ltrrow\trpaddft3\trpaddt0\trpaddfl3\trpaddl0\trpaddfb3\trpaddb0\trpaddfr3\trpaddr0\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx2898\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\clbrdrr\brdrhair\brdrw1\brdrcf1\cellx14569\pard\plain \s21\noline\intbl{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl{\b\afs22\ab\rtlch \ltrch\fs22\loch\f3
 }{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
OBJETIVOS:}{\afs22\rtlch \ltrch\loch\fs22\loch\f3
 }\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
}
\par \pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$dim[$i]['objetivo'].'}\cell\row\pard

\trowd\trql\ltrrow\trpaddft3\trpaddt0\trpaddfl3\trpaddl0\trpaddfb3\trpaddb0\trpaddfr3\trpaddr0\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx2898\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\clbrdrr\brdrhair\brdrw1\brdrcf1\cellx14569\pard\plain \s21\noline\intbl{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl{\b\afs22\ab\rtlch \ltrch\fs22\loch\f3
 }{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
METAS:}{\afs22\rtlch \ltrch\loch\fs22\loch\f3
 }\cell\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
}
\par \pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$dim[$i]['metas'].'}\cell\row\pard\pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par 

\trowd\trql\ltrrow\trpaddft3\trpaddt0\trpaddfl3\trpaddl0\trpaddfb3\trpaddb0\trpaddfr3\trpaddr0\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx2079\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx5905\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx8418\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx9693\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx10930\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\cellx12899\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\clbrdrr\brdrhair\brdrw1\brdrcf1\cellx14569\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
ACCIONES A DESARROLLAR}\cell\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
TAREA}\cell\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
RECURSOS}\cell\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
FECHA INICIO}\cell\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
FECHA FIN}\cell\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
RESPONSABLE}\cell\pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s21\noline\intbl\qc{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
RESULTADO}\cell\row\pard



'.$tabla_acciones.'


\pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
OBSERVACIONES:}{\rtlch \ltrch\loch
 }
\par 

\trowd\trql\ltrrow\trpaddft3\trpaddt0\trpaddfl3\trpaddl0\trpaddfb3\trpaddb0\trpaddfr3\trpaddr0\clbrdrt\brdrhair\brdrw1\brdrcf1\clbrdrl\brdrhair\brdrw1\brdrcf1\clbrdrb\brdrhair\brdrw1\brdrcf1\clbrdrr\brdrhair\brdrw1\brdrcf1\cellx14569\pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
}
\par \pard\plain \s21\noline\intbl{\afs18\rtlch \ltrch\loch\fs18\loch\f3
'.$dim[$i]['observaciones'].'}\cell\row\pard\pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082\pagebb{\rtlch \ltrch\loch
}
';


// Añade la página recién creada
$rtf_pei .= $pagina;
$rtf_pei .= ($i == ($size-1)) ? '' : '\par';
}


// Parte final, última página

$rtf_pei .= '\s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082\pagebb{\b\afs22\ab\rtlch \ltrch\loch\fs22\loch\f3
PERIODO DE VIGENCIA DEL PLAN:}{\rtlch \ltrch\loch
 }
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\afs22\rtlch \ltrch\loch\fs22\loch\f3
FECHA DE INICIO:   '.$pai['fecha_ini'].'}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\afs22\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\afs22\rtlch \ltrch\loch\fs22\loch\f3
FECHA FINAL:    '.$pai['fecha_fin'].'}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch\loch\f3
La persona usuaria y la persona tutora deciden que este Plan Individual de Atención se da por:}{\rtlch \ltrch\loch
 }
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\afs22\rtlch \ltrch\loch\fs22\loch\f3
INICIADO:\tab \tab '.$pai['inicio'].'\tab }
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\afs22\rtlch \ltrch\loch\fs22\loch\f3
FINALIZADO\tab :\tab '.$pai['finalizado'].' }
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082{\afs22\rtlch \ltrch\loch\fs22\loch\f3
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082\tqr\tx14213{\rtlch \ltrch\loch
\tab \tab }{\afs22\rtlch \ltrch\loch\fs22\loch\f3
En '.$pai['ciudad'].', a '.$pai['dia'].' de '.$pai['mes'].' de '.$pai['ano'].'}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082\tqr\tx14288{\rtlch \ltrch\loch
}
\par \pard\plain \s0\nowidctlpar{\*\hyphen2\hyphlead2\hyphtrail2\hyphmax0}\aspalpha\ltrpar\cf0\kerning1\hich\af4\langfe255\dbch\af5\afs24\lang255\loch\f0\fs24\lang3082\tqr\tx14288{\afs22\rtlch \ltrch\loch\fs22\loch\f3
Firma profesional de referencia\tab Firma persona interesada}
\par }'; 


file_put_contents('rtf_pei.rtf', $rtf_pei);


?>
