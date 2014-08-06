<?php

namespace Zubietxe\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActividadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('responsable', 'entity', array(
                    'class' => 'ZubietxePrincipalBundle:Tutor',
                    'property' => 'nombre', ))            
            ->add('responsable2', 'text', array(
                    'label'  => 'Responsable Segundo',
              //      'label_attr' => array('placeholder' => '.col-xs-2')
                    )
                )
            ->add('volunt')
            ->add('fechaActividad', 'date', array(
                 'format' => 'dd /MM /yyyy'))
            ->add('comentarioActividad')
            ->add('observacionesActividad')
            ->add('tipoActiv', 'entity', array(
                    'class' => 'ZubietxePrincipalBundle:ListaActividades',
                    'property' => 'nombreActividad', ))
            ->add('guardar', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zubietxe\PrincipalBundle\Entity\Actividad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zubietxe_principalbundle_actividad';
    }
}
