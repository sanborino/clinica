<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PantallaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('descripcion','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('dirpantalla', 'text', array('label' => 'Direccion en pantalla','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>''))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Pantalla'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_pantalla';
    }
}
