<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Asi\ClinicaBundle\Entity\Tiposervicio;

class VacunaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    private $tipo;

    /**
     * @param Tiposervicio $tipo
    */
    public function __construct(Tiposervicio $tipo = null)
    {
        $this->tipo = $tipo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idservicio', new ServicioType($this->tipo), array('label'=>false))
            ->add('cantidaddosis', 'text', array('label' => 'Cantidad dosis','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 11)))
            ->add('descripcion','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>''))
            ->add('idtipovacuna', 'entity', array(
                'label' => 'Tipo de vacuna',
                'class' => 'AsiClinicaBundle:Tipovacuna',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Vacuna'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_vacuna';
    }
}
