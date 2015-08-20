<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClinicaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('direccion','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('telefono','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9]*')))
            ->add('citahorapromedio', 'time', array('label' => 'Cita hora promedio'))
            ->add('horaaperturasemana', 'time', array('label' => 'Hora de apertura entre semana'))
            ->add('horacierresemana', 'time', array('label' => 'Hora de cierre entre semana'))
            ->add('horaaperturasabado', 'time', array('label' => 'Hora de apertura el sabado'))
            ->add('horacierresabado', 'time', array('label' => 'Hora de cierre el sabado'))
            ->add('horaaperturadomingo', 'time', array('label' => 'Hora de apertura el domingo'))
            ->add('horacierredomingo', 'time', array('label' => 'Hora de cierre el domingo'))
            ->add('mesesagendar', 'integer', array('label' => 'Meses agendar','attr' => array('class' => 'round default-width-input')))
            ->add('fechainicioagenda','date',array(
                'label' => 'Fecha de inicio de agenda',
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'years' => range(2014, date('Y'))))
            ->add('fechafinalagenda','date',array(
                'label' => 'Fecha final de agenda',
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'years' => range(2014, date('Y'))))
            // ->add('fechainicioagenda', 'date', array(
            //     'label' => 'Fecha de inicio de agenda',
            //     'years' => range(2014, date('Y'))))
            // ->add('fechafinalagenda', 'date', array(
            //     'label' => 'Fecha final de agenda'))
            ->add('mesesdisponiblesagenda','integer', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 11, 'pattern' => '[0-9]*')))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>true))
            ->add('idmunicipio', 'entity', array(
                'label' => 'Municipio',
                'class' => 'AsiClinicaBundle:Municipio',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
            ->add('idespecialidad', 'entity', array(
                'label' => 'Especialidad',
                'class' => 'AsiClinicaBundle:Especialidad',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Clinica'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_clinica';
    }
}
