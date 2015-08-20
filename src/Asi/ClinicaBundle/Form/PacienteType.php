<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType;


class PacienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    private $tipo;

    /**
     * @param string $tipo
    */
    public function __construct($tipo=null)
    {
        $this->tipo = $tipo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dui','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 10, 'pattern' => '[0-9-]*')))
            ->add('nombres','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('apellidos','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('genero','choice', array('choices' => array('M' => 'Masculino', 'F' => 'Femenino')))
            ->add('fechanacimiento', 'date', array(
                'label' => 'Fecha de nacimiento',
                'years' => range(1900, date('Y'))))
            ->add('telefono','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9]*')))
            ->add('movil','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9]*')))
            ->add('referidopor', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('lugarnacimiento', 'text', array('label' => 'Lugar de nacimiento','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            // ->add('fechacreacion', 'date', array(
            //     'label' => 'Fecha de creacion',
            //     'required' => false))
            ->add('direccion','textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('idmunicipio', 'entity', array(
                'label' => 'Municipio',
                'class' => 'AsiClinicaBundle:Municipio',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...',
                'attr' => array('class' => 'chosen_select'))) 
        ;

        if ($this->tipo!=='Paciente') {
            $builder->add('idusuario', new RegistrationFormType('Asi\ClinicaBundle\Entity\User'), array('label' => 'Datos de Usuario'));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Paciente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_paciente';
    }
}
