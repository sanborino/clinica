<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncargadoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('apellidos', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('telefono', 'number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9-]*')))
            ->add('movil', 'number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9-]*')))
            ->add('fechanacimiento', 'date', array(
                'label' => 'Fecha de nacimiento',
                'years' => range(1920, date('Y'))))
            ->add('direccion', 'textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>''))
            ->add('idmunicipio', 'entity', array(
                'label' => 'Municipio',
                'class' => 'AsiClinicaBundle:Municipio',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...',
                'attr' => array('class' => 'chosen_select')))
            // ->add('encargadopaciente', 'entity', array(
            //     'class' => 'AsiClinicaBundle:Encargadopaciente',
            //     'property' => 'idpaciente.nombres'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Encargado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_encargado';
    }
}
