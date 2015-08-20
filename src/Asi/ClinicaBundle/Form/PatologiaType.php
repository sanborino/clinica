<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatologiaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('descripcion','textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('idtipopatologia', 'entity', array(
                'label' => 'Tipo de patologia',
                'class' => 'AsiClinicaBundle:Tipopatologia',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Patologia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_patologia';
    }
}
