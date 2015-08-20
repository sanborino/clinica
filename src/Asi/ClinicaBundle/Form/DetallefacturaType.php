<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DetallefacturaType extends AbstractType
{

    private $servicios;

    /**
     * @param Arrayservicios $servicios
    */
    public function __construct($servicios = null)
    {
        $this->servicios = $servicios;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $emptyval = "Seleccionar...";
        $disabled = false;
        if (count($this->servicios)==0 && $this->servicios!== null){
            $emptyval = "No hay servicios disponibles.";
            $disabled = true;
        }

        $builder
            ->add('idfactura', 'entity', array(
                'label' => 'Factura',
                'class' => 'AsiClinicaBundle:Factura',
                'property' => 'getTitularDui',
                'empty_value'=>'Titular y dui'))
            ->add('idservicio', 'entity', array(
                'label' => 'Servicio',
                'class' => 'AsiClinicaBundle:Servicio',
                'property' => 'getNombre',
                'choices' => $this->servicios,
                'empty_value'=>$emptyval,
                'disabled' => $disabled,
                'attr' => array('class' => 'chosen_select')))
            ->add('precio', 'number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9.]*')))
            ->add('descuento', 'number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9]*')))
            ->add('cantidad', 'text', array('required' => true, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 11, 'pattern' => '[0-9]*')))
            ->add('comentario', 'textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 200)))
            ->add('facturado')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Detallefactura'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_detallefactura';
    }
}
