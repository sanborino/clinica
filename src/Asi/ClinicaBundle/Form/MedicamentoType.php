<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Asi\ClinicaBundle\Entity\Tiposervicio;

class MedicamentoType extends AbstractType
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
            ->add('descripcion','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>''))
            ->add('idtipomedicamento', 'entity', array(
                'label' => 'Tipo de medicamento',
                'class' => 'AsiClinicaBundle:Tipomedicamento',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Medicamento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_medicamento';
    }
}
