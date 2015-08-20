<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacientepatologiaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    private $patologias;

    /**
     * @param patologias $patologias
    */
    public function __construct($patologias=null)
    {
        $this->patologias = $patologias;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $emptyval = "Seleccionar...";
        $disabled = false;
        if (count($this->patologias)==0 && $this->patologias!== null){
            $emptyval = "No hay patologías disponibles.";
            $disabled = true;

        }
        $builder
            ->add('idpatologia', 'entity', array(
                'label' => 'Patologia',
                'class' => 'AsiClinicaBundle:Patologia',
                'property' => 'getNombre',
                'choices' => $this->patologias,
                'empty_value'=>$emptyval,
                'disabled' => $disabled,
                'attr' => array('class' => 'chosen_select')))
            ->add('fechadiagnostico', 'date', array(
                'label' => 'Fecha de diagnostico',
                'years' => range(1900, date('Y'))))
            ->add('importante', 'checkbox', array(
                'required' => false))
            ->add('comentario','textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('idpaciente', 'entity', array(
                'label' => 'Paciente',
                'class' => 'AsiClinicaBundle:Paciente',
                'property' => 'getNombreApellido',
                'empty_value' => 'Seleccionar...'))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Pacientepatologia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_pacientepatologia';
    }
}
