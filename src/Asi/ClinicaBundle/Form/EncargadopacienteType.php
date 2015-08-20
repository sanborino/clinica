<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncargadopacienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentesco', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15)))
            ->add('idencargado', 'entity', array(
                'label' => 'Encargado',
                'class' => 'AsiClinicaBundle:Encargado',
                'property' => 'getIdNombreApellido',
                'empty_value'=>'Seleccionar...',
                'attr' => array('class' => 'chosen_select')
                ))
            ->add('idpaciente', 'entity', array(
                'label' => 'Paciente',
                'class' => 'AsiClinicaBundle:Paciente',
                'property' => 'getIdNombreApellido',
                'empty_value'=>'Seleccionar...',
                'attr' => array('class' => 'chosen_select')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Encargadopaciente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_encargadopaciente';
    }
}
