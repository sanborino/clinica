<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType;

class PersonalType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('apellidos','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('fechanacimiento', 'date', array(
                'label' => 'Fecha de nacimiento',
                'years' => range(1920, date('Y'))))
            ->add('telefono','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9-]*')))
            ->add('dui','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 10, 'pattern' => '[0-9-]*')))
            ->add('movil','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9-]*')))
            ->add('direccion','textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('genero', 'choice', array('choices' => array('M' => 'Masculino', 'F' => 'Femenino')))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>''))
            ->add('idmunicipio', 'entity', array(
                'label' => 'Municipio',
                'class' => 'AsiClinicaBundle:Municipio',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...',
                'attr' => array('class' => 'chosen_select')))
            ->add('idtipopersonal', 'entity', array(
                'label' => 'Tipo de personal',
                'class' => 'AsiClinicaBundle:Tipopersonal',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
            ->add('idusuario', new RegistrationFormType('Asi\ClinicaBundle\Entity\User'), array('label' => 'Datos de Usuario'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Personal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_personal';
    }
}
