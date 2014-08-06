<?php

namespace Zubietxe\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zubietxe\PrincipalBundle\Entity\Desplegables;
use Zubietxe\PrincipalBundle\Entity\DesplegablesRepository;

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
            ->add('idUnico')
            ->add('historial')
            ->add('sexo')
            ->add('nombre')
            ->add('apellido1')
            ->add('apellido2')
            ->add('fechanac', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('lugarNac')
            ->add('dniPas')
            ->add('numSs')
            ->add('numExpediente')
            ->add('nacionalidad')
            ->add('telefono')
            ->add('direccion', 'text', array('label' => 'Dirección'))
            ->add('poblacion', 'entity', array(
                    'class' => 'ZubietxePrincipalBundle:Desplegables',
                    'property' => 'nombre',
                    'choices' => $this->grupo->findByDespl('poblaciones')
                ))
            ->add('nucleoConv', 'entity', array(
                    'class' => 'ZubietxePrincipalBundle:Desplegables',
                    'property' => 'nombre',
                    'choices' => $this->grupo->findByDespl('poblaciones')
                ))
            ->add('estadoCivil')
            ->add('hijos')
            ->add('nHijos')
            ->add('observacionesHijos')
            ->add('telefonosInteres')
            ->add('fechaIngreso', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fechaSalida', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('procedenciaDemanda')
            ->add('tutor')
            ->add('comeLu')
            ->add('comeMa')
            ->add('comeMi')
            ->add('comeJu')
            ->add('comeVi')
            ->add('comeSa')
            ->add('comeDo')
            ->add('comeSaNotas')
            ->add('comeDoNotas')
            ->add('creditrans')
            ->add('listaEsperaPiso')
            ->add('datosformativosobs')
            ->add('datosformativositem')
            ->add('idioma')
            ->add('edadabandonoestudios')
            ->add('laboralorigen')
            ->add('laboralespana')
            ->add('tiempotrabajado')
            ->add('trabaja')
            ->add('autonomia')
            ->add('disminucionfisica')
            ->add('minusvaliaporcentaje')
            ->add('incapacitacion')
            ->add('toxicomania')
            ->add('antecconsumo')
            ->add('disminucionpsiquica')
            ->add('enfermedadmental')
            ->add('tuberculosis')
            ->add('hepatitis')
            ->add('vih')
            ->add('diabetes')
            ->add('otras')
            ->add('enfermedadescomentarios')
            ->add('medicacion')
            ->add('enfmentaldiagnostico')
            ->add('enfmentalfechadiagn', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('enfmentaltratamiento')
            ->add('enfmentalingresos')
            ->add('enfmentalpadres')
            ->add('enfmentalhermanos')
            ->add('enfmentalpareja')
            ->add('enfmentalhijos')
            ->add('drogaspadres')
            ->add('drogashermanos')
            ->add('drogaspareja')
            ->add('drogashijos')
            ->add('permisoresid')
            ->add('permisoresidtr')
            ->add('npasap')
            ->add('fpasap', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('ncedula')
            ->add('fcedula', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fressol', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('nresconc')
            ->add('fresconc', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('frestrsol', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('nrestrconc')
            ->add('frestrconc', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('visado')
            ->add('asilo')
            ->add('otrosdoc')
            ->add('fentrada', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fprueba', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('abogadootros')
            ->add('permisoresidrazonesno')
            ->add('permisosolicitudfecha', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('permisosolicitudlugar')
            ->add('tiemporesidenciaespanya')
            ->add('tiemporesidenciabilbao')
            ->add('permisotrabajo')
            ->add('permisotrabajorazonesno')
            ->add('fechaempadronamiento', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('empadronamiento')
            ->add('tis')
            ->add('redapoyo')
            ->add('ingresospropios')
            ->add('ingresospnc')
            ->add('ingresosotros')
            ->add('ingresosnomina')
            ->add('ingresosrentabas')
            ->add('ingresosprestcontrib')
            ->add('ingresossedesconoce')
            ->add('ingresosayudaindividual')
            ->add('ingresosno')
            ->add('penalantecedentesprision')
            ->add('penalordenalejamiento')
            ->add('penalprisionpreventiva')
            ->add('penalprisionotros')
            ->add('penallibcondicional')
            ->add('penalmedidaseguridad')
            ->add('penalcausaspendientes')
            ->add('penalpermisopenitenc')
            ->add('penaltercergrado')
            ->add('penaltbc')
            ->add('ducha')
            ->add('ropero')
            ->add('lavanderia')
            ->add('tlSabado')
            ->add('tlDomingo')
            ->add('salidaVerano')
            ->add('salidaOtro')
            ->add('medicacionCentro')
            ->add('nivelcastellano')
            ->add('expLaboral')
            ->add('lanbide')
            ->add('fAltaLanbide', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fRenovLanbide', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('inem')
            ->add('fAltaInem', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fRenovInem', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('cursos')
            ->add('poblacionPadron')
            ->add('consumoprinc')
            ->add('insertIdUsuario')
            ->add('insertFecha', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('anosconsumo')
            ->add('tratamiento')
            ->add('tratamientotipo')
            ->add('procedenciaDemandaLista')
            ->add('documentoidentif')
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
