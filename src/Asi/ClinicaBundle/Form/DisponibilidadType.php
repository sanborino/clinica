<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DisponibilidadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha','date',array(
                'label' => 'Fecha',
                'years' => range(2014, date('Y'))))
            ->add('disponibilidad', 'checkbox', array('required' => false, 'label' => 'Disponible'))
            ->add('idclinica', 'entity', array(
                'label' => 'Clinica',
                'class' => 'AsiClinicaBundle:Clinica',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
            ->add('hora')
        ;


    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Disponibilidad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_disponibilidad';
    }
}
