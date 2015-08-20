<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistropacienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    private $tipo;

    /**
     * @param string $tipo
    */
    public function __construct($tipo)
    {
        $this->tipo = $tipo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idpaciente', new PacienteType($this->tipo), array('label' => '* Informacion del Paciente *'))
            ->add('idencargado', new EncargadoType(), array('label' => '* Informacion del responsable del Paciente *'))
            ->add('parentesco', 'text', array('label' => 'Parentesco del responsable con el paciente','attr' => array('class' => 'round default-width-input')))
            //->add('idencargado', 'entity', array(
            //    'label' => 'Encargado',
            //    'class' => 'AsiClinicaBundle:Encargado',
            //    'property' => 'getNombres',
            //    'empty_value'=>'Seleccionar...'))
            //->add('idpaciente', 'entity', array(
            //    'label' => 'Paciente',
            //    'class' => 'AsiClinicaBundle:Paciente',
            //    'property' => 'getNombreApellido',
            //    'empty_value'=>'Seleccionar...'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Encargadopaciente',
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
