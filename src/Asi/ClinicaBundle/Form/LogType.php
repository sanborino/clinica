<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LogType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechahora', 'datetime', array('label' => 'Fecha y hora'))
            ->add('accion','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 30)))
            ->add('idpantalla', 'entity', array(
                'label' => 'Pantalla',
                'class' => 'AsiClinicaBundle:Pantalla',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
            ->add('idusuario', 'entity', array(
                'label' => 'Usuario',
                'class' => 'AsiClinicaBundle:Usuario',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Log'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_log';
    }
}
