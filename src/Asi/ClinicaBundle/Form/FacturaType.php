<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacturaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titular', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('dui', 'number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 10, 'pattern' => '[0-9-]*')))
            ->add('nit', 'number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 15, 'pattern' => '[0-9-]*')))
            //->add('fechahoraemision', 'datetime', array('label' => 'Fecha y hora de emision'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Factura'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_factura';
    }
}
