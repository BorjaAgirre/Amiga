<?php

namespace Zubietxe\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AltaBajaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('servicio')
            ->add('altaBaja')
            ->add('fecha')
            ->add('fechaCorrel')
            ->add('motivoBaja')
            ->add('autorInserc')
            ->add('fechaInserc')
            ->add('idUnico')
            ->add('serv')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zubietxe\PrincipalBundle\Entity\AltaBaja'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zubietxe_principalbundle_altabaja';
    }
}
