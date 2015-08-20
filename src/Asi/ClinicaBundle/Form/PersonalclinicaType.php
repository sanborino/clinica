<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonalclinicaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idclinica', 'entity', array(
                'label' => 'Clinica',
                'class' => 'AsiClinicaBundle:Clinica',
                'property' => 'getNombre'))
            ->add('idpersonal', 'entity', array(
                'label' => 'Personal',
                'class' => 'AsiClinicaBundle:Personal',
                'property' => 'getNombreApellido'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Personalclinica'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_personalclinica';
    }
}
