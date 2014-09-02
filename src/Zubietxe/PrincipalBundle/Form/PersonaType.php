<?php

namespace Zubietxe\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zubietxe\PrincipalBundle\Entity\Desplegables;
use Zubietxe\PrincipalBundle\Entity\DesplegablesRepository;
use Zubietxe\PrincipalBundle\Entity\Tutor;

use Doctrine\ORM\EntityRepository;

class PersonaType extends AbstractType
{
    protected $grupo;

    public function __construct (EntityRepository $grupo)
    {
        $this->grupo = $grupo;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
   //     $despl = new Desplegables; 
    //    $er = new EntityRepository('ZubietxePrincipalBundle:Desplegables');
   //     $despl = $er->getRepository;
        $builder
//            ->add('idUnico')
//            ->add('historial')
/*            ->add('sexo', 'entity', array(
                'label' => 'Sexo',
                'class' => 'ZubietxePrincipalBundle:Desplegables',
                'property' => 'nombre',
                'choices' => $this->grupo->findByDespl('sexo')
                ))
            ->add('fechaIngreso', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fechaSalida', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('listaEsperaPiso', 'text', array('label' => ''))
            ->add('insertIdUsuario', 'text', array('label' => ''))
            ->add('insertFecha', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
           ->add('permisotrabajo')  
            ->add('permisotrabajorazonesno')  
            ->add('edadabandonoestudios', 'text', array('label' => ''))
            ->add('laboralorigen', 'text', array('label' => ''))
            ->add('laboralespana', 'text', array('label' => ''))            
            ->add('permisosolicitudlugar', 'text', array('label' => 'Lugar solicitud permiso'))
            ->add('comeSaNotas', 'text', array('label' => 'Notas comedor sábado'))
            ->add('comeDoNotas', 'text', array('label' => 'Notas comedor domingo'))
*/

//
//  identificacion
//
            ->add('sexo', 'choice', array(
                'label' => 'Sexo',
                'choices' => $this->grupo->findDesplegable('sexo')
                ))
            ->add('nombre', 'text', array('label' => 'Nombre'))
            ->add('apellido1', 'text', array('label' => 'Primer Apellido'))
            ->add('apellido2', 'text', array('label' => 'Segundo Apellido'))
            ->add('nacionalidad', 'choice', array(
                'label' => 'Nacionalidad',
                'choices' => $this->grupo->findDesplegable('paises_mundo')
                ))           
            ->add('lugarNac', 'text', array('label' => 'Ciudad de nacimiento'))
            ->add('fechanac', 'date', array('label' => 'Fecha nacimiento', 'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('dniPas', 'text', array('label' => 'Dni / Pasaporte / NIE'))
            ->add('nucleoConv', 'choice', array(
                    'label' => 'Núcleo convivencia',
                    'choices' => $this->grupo->findDesplegable('nucleoconv')
                ))

            ->add('telefono', 'text', array('label' => 'Teléfono'))
            ->add('direccion', 'text', array('label' => 'Dirección actual'))
            ->add('poblacion', 'choice', array(
                'label' => 'Población actual',
                'choices' => $this->grupo->findDesplegable('poblaciones')
                ))
            ->add('poblacionPadron', 'choice', array(
                'label' => 'Población Padrón',
                'choices' => $this->grupo->findDesplegable('poblaciones')
                ))

            ->add('empadronamiento', 'text', array('label' => 'Dirección padrón actual'))
            ->add('fechaempadronamiento', 'date', array(
                'label' => 'Fecha empadronamiento', 
                'widget' => 'single_text', 
                'format' => 'dd-M-yyyy'
                ))
            ->add('estadoCivil', 'choice', array(
                    'label' => 'Estado civil',
                    'choices' => $this->grupo->findDesplegable('estado_civil')
                ))
            ->add('hijos', 'choice', array(
                'label' => '¿Hijos?',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('nHijos', 'integer', array('label' => 'Núm. hijos'))
            ->add('observacionesHijos', 'textarea', array('label' => 'Observaciones Hijos', 'max_length' => 255))
            ->add('telefonosInteres', 'text', array('label' => 'Teléfonos interés'))


//
//  juridico
//
            ->add('tis', 'number', array('label' => 'Número TIS'))            
            ->add('fecha_caduc_tis', 'date', array(
                'label' => 'Fecha caduc. TIS',
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('incapacitacion', 'choice', array(
                'label' => 'Incapacitación ',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('numSs', 'text', array('label' => 'Número Seg. Social'))
            ->add('numExpediente', 'text', array('label' => 'Núm. Expediente'))
            ->add('documentoidentif', 'choice', array('label' => 'Documentación', 
                'choices' => array( 
                    '0' =>"Pasaporte",
                    '1' =>"Cédula inscripción",
                    '2' =>"Sin documento de país de origen" ),
                'multiple' => false,
                'expanded' => true
                ))

           ->add('permisoresid', 'choice', array(
                'label' => 'Permiso residencia',
                'choices' => array('1' => 'No solicitada', '2' => 'Solicitada', '3' => 'Concedida'),
                'multiple' => false,
                'expanded' => true
                ))   
            ->add('permisoresidtr', 'choice', array(
                'label' => 'Permiso residencia y trabajo',
                'choices' => array('1' => 'No solicitada', '2' => 'Solicitada', '3' => 'Concedida'),
                'multiple' => false,
                'expanded' => true
                ))   
            ->add('npasap', 'text', array('label' => 'Núm. Pasaporte'))
            ->add('fpasap', 'date', array(
                'label' => 'Fecha caduc. pasaporte', 
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('ncedula', 'text', array('label' => 'Número Cédula'))
            ->add('fcedula', 'date', array(
                'label' => 'Fecha caduc. cédula', 
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fressol', 'date', array(
                'label' => 'Fecha solicitud permiso residencia', 
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('nresconc', 'text', array('label' => 'Núm. Permiso Residencia'))
            ->add('fresconc', 'date', array(
                'label' => 'Fecha resolución permiso residencia', 
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('frestrsol', 'date', array(
                'label' => 'Fecha solicitud permiso residencia y trabajo', 
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('nrestrconc', 'text', array('label' => 'Núm. Permiso Residencia y trabajo'))
            ->add('frestrconc', 'date', array(
                'label' => 'Fecha resolución permiso residencia y trabajo',
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('visado', 'choice', array(
                'label' => 'Visado',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('asilo', 'choice', array(
                'label' => 'Asilo',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('otrosdoc', 'text', array('label' => 'Otra documentación'))
            ->add('fentrada', 'date', array(
                'label' => 'Fecha de entrada en España',
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fprueba', 'date', array(
                'label' => 'Fecha de primera prueba',
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('abogadootros', 'text', array('label' => 'Abogado'))
            ->add('permisoresidrazonesno', 'text', array('label' => 'Razones rechazo permiso resid.'))
            ->add('permisosolicitudfecha', 'date', array(
                'label' => 'Fecha solicitud xx',
                'widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('tiemporesidenciaespanya', 'text', array('label' => 'Tiempo residencia en España'))
            ->add('tiemporesidenciabilbao', 'text', array('label' => 'Tiempo residencia CAPV'))

            ->add('orden_expulsion', 'choice', array(
                'label' => 'Orden expulsión ',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalantecedentesprision', 'choice', array(
                'label' => 'Antecedentes prisión',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalordenalejamiento', 'choice', array(
                'label' => 'Orden alejamiento',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalprisionpreventiva', 'choice', array(
                'label' => 'Prisión preventiva',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalprisionotros', 'choice', array(
                'label' => 'Prisión (otros)',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penallibcondicional', 'choice', array(
                'label' => 'Libertad condicional ',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalmedidaseguridad', 'choice', array(
                'label' => 'Medidas seguridad',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalcausaspendientes', 'choice', array(
                'label' => 'Causas pendientes',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penalpermisopenitenc', 'choice', array(
                'label' => 'Permiso penitenciario',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penaltercergrado', 'choice', array(
                'label' => 'Tercer grado',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 
            ->add('penaltbc', 'choice', array(
                'label' => 'TBC',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                )) 

//
//  economico
//
            ->add('ingresospropios', 'choice', array(
                'label' => 'Ingresos Propios',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresospnc', 'choice', array(
                'label' => 'Ingresos PNC',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresosotros', 'choice', array(
                'label' => 'Ingresos Otros',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresosnomina', 'choice', array(
                'label' => 'Ingresos Nómina',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresosrentabas', 'choice', array(
                'label' => 'Ingresos Renta Básica',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresosprestcontrib', 'choice', array(
                'label' => 'Ingresos PC',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresossedesconoce', 'choice', array(
                'label' => 'Ingresos desconocidos',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresosayudaindividual', 'choice', array(
                'label' => 'Ingresos Ayuda Individual',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('ingresosno', 'choice', array(
                'label' => 'Sin ingresos',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('cantidad_ingresospropios', 'text', array('label' => 'Cantidad ingresos propios'))
            ->add('cantidad_ingresospnc', 'text', array('label' => 'Cantidad ingresos PNC'))
            ->add('cantidad_ingresosotros', 'text', array('label' => 'Cantidad ingresos Otros'))
            ->add('cantidad_ingresosnomina', 'text', array('label' => 'Cantidad ingresos Nómina'))
            ->add('cantidad_ingresosrentabas', 'text', array('label' => 'Cantidad ingresos Renta Básica'))
            ->add('cantidad_ingresosprestcontrib', 'text', array('label' => 'Cantidad ingresos PC'))
            ->add('cantidad_ingresossedesconoce', 'text', array('label' => 'Cantidad ingresos desconocidos'))
            ->add('cantidad_ingresosayudaindividual', 'text', array('label' => 'Cantidad ingresos ayuda individual'))
            ->add('autonomia_economica', 'choice', array(
                'label' => 'Autonomía económica',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('observaciones_economia', 'textarea', array('label' => 'Observaciones economía'))



//
//  formativo
//
            ->add('datosformativositem', 'choice', array(
                    'label' => 'Estudios',
                    'choices' => $this->grupo->findDesplegable('estudios')
                ))
            ->add('datosformativosobs', 'textarea', array('label' => 'Notas estudios'))
            ->add('NivelCastellano', 'choice', array(
                    'label' => 'Nivel Castellano',
                    'choices' => $this->grupo->findDesplegable('idioma')
                ))
            ->add('Idioma', 'text', array('label' => 'Idioma/s'))
            ->add('cursos', 'textarea', array('label' => 'Cursos realizados'))
            ->add('curso_actual', 'text', array('label' => 'Curso actual'))

//
//  ocupacional-laboral
//
            ->add('tiempotrabajado', 'text', array('label' => 'Tiempo trabajado'))
            ->add('expLaboral', 'choice', array(
                'label' => 'Experiencia laboral',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('trabaja', 'choice', array(
                    'label' => 'Trabaja',
                    'choices' => $this->grupo->findDesplegable('trabaja')
                ))
            ->add('lanbide', 'choice', array(
                'label' => 'Lanbide',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('fAltaLanbide', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy', 
                    'label' => 'Fecha alta Lanbide'))
            ->add('fRenovLanbide', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy', 
                    'label' => 'Fecha renovación Lanbide'))
            ->add('inem', 'choice', array(
                'label' => 'Inem',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('fAltaInem', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy', 
                    'label' => 'Fecha alta Inem'))
            ->add('fRenovInem', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy', 
                    'label' => 'Fecha renovación Inem'))

//
//  vivienda
//


//
//  social
//
            ->add('redapoyo', 'choice', array(
                'label' => 'Red de apoyo',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

//
//  convivencia
//


//
//  salud
//
            ->add('autonomia', 'choice', array(
                'label' => 'Autonomía',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('disminucionfisica', 'choice', array(
                'label' => 'Disminución física',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('minusvaliaporcentaje', 'text', array('label' => 'Porcentaje minusvalía'))
            ->add('toxicomania', 'choice', array(
                'label' => 'Toxicomanía',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('antecconsumo', 'choice', array(
                'label' => 'Antecedentes consumo',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('ConsumoPrinc', 'choice', array(
                'label' => 'Consumo principal',
                'choices' => $this->grupo->findDesplegable('consumoprinc')))
            ->add('anosconsumo', 'choice', array(
                    'label' => 'Años Consumo',
                    'choices' => $this->grupo->findDesplegable('anosconsumo')))
            ->add('tratamiento', 'choice', array(
                'label' => 'Tratamiento',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('tratamientotipo', 'choice', array(
                    'label' => 'Tipo tratamiento',
                    'choices' => $this->grupo->findDesplegable('tipotrat')))
            ->add('disminucionpsiquica', 'choice', array(
                'label' => 'Disminución psíquica',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('enfermedadmental', 'choice', array(
                'label' => 'Enfermedad mental',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('tuberculosis', 'choice', array(
                'label' => 'Tuberculosis',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('hepatitis', 'choice', array(
                'label' => 'Hepatitis',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('vih', 'choice', array(
                'label' => 'VIH',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('diabetes', 'choice', array(
                'label' => 'Diabetes',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('otras', 'choice', array(
                'label' => 'Otras',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('enfermedadescomentarios', 'textarea', array('label' => 'Comentarios enfermedades'))
            ->add('medicacion', 'textarea', array('label' => 'Medicación'))
            ->add('enfmentaldiagnostico', 'textarea', array('label' => 'Diagnóstico'))
            ->add('enfmentalfechadiagn', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy',
                    'label' => 'Fecha diagnóstico'))
            ->add('enfmentaltratamiento', 'choice', array(
                    'label' => 'Centro Tratamiento',
                    'choices' => $this->grupo->findDesplegable('centrotrat')))
            ->add('enfmentalingresos', 'textarea', array('label' => 'Ingresos'))
            ->add('enfmentalpadres', 'choice', array(
                'label' => 'Enf. mental padres',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('enfmentalhermanos', 'choice', array(
                'label' => 'Enf. mental hermanos',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('enfmentalpareja', 'choice', array(
                'label' => 'Enf. mental pareja',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('enfmentalhijos', 'choice', array(
                'label' => 'Enf. mental hijos',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('drogaspadres', 'choice', array(
                'label' => 'Drogas padres',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('drogashermanos', 'choice', array(
                'label' => 'Drogas hermanos/as',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('drogaspareja', 'choice', array(
                'label' => 'Drogas pareja',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('drogashijos', 'choice', array(
                'label' => 'Drogas hijos/as',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))


//
//  competencias
//


//
//  aceptacion
//


//
//  participacion
//


//
//  intervencion
//
            ->add('tutor', 'entity', array(
                    'label' => 'Persona responsable',
                    'class' => 'ZubietxePrincipalBundle:Tutor',
                    'property' => 'nombre'
                    ))
            ->add('procedenciaDemandaLista', 'choice', array(
                    'label' => 'Demanda',
                    'choices' => $this->grupo->findDesplegable('demanda')))
            ->add('procedenciaDemanda', 'text', array('label' => 'Concreción demanda'))

            ->add('creditrans', 'choice', array(
                'label' => 'Creditrans',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))            
            ->add('ducha', 'choice', array(
                'label' => 'Ducha',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('ropero', 'choice', array(
                'label' => 'Ropero',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('lavanderia', 'choice', array(
                'label' => 'Lavandería',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('tlSabado', 'choice', array(
                'label' => 'Tiempo libre sábado',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('tlDomingo', 'choice', array(
                'label' => 'Tiempo libre domingo',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('salidaVerano', 'choice', array(
                'label' => 'Salida verano',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('salidaOtro', 'choice', array(
                'label' => 'Otra salida',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('medicacionCentro', 'choice', array(
                'label' => 'Medicación en centro',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))

            ->add('comeLu', 'choice', array(
                'label' => 'Comedor Lunes',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('comeMa', 'choice', array(
                'label' => 'Comedor Martes',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('comeMi', 'choice', array(
                'label' => 'Comedor Miércoles',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('comeJu', 'choice', array(
                'label' => 'Comedor Jueves',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('comeVi', 'choice', array(
                'label' => 'Comedor Viernes',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('comeSa', 'choice', array(
                'label' => 'Comedor Sábado',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))
            ->add('comeDo', 'choice', array(
                'label' => 'Comedor Domingo',
                'choices' => array('0' => 'No', '1' => 'Si'),
                'multiple' => false,
                'expanded' => true
                ))



//
//  botones
//
            ->add('guardar', 'submit')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zubietxe\PrincipalBundle\Entity\Persona'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zubietxe_principalbundle_persona';
    }
}
