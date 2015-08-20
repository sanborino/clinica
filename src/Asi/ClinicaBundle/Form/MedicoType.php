<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedicoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jvpm','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 20)))
            ->add('hospitalresidente', 'text', array('label' => 'Hospital residente','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('idpersonal', 'entity', array(
                'label' => 'Personal',
                'class' => 'AsiClinicaBundle:Personal',
                'property' => 'getNombres',
                'empty_value'=>'Seleccionar...'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Medico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_medico';
    }
}
