<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemexamenfisicoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('tipodato','choice', array(
                'label' => 'Tipo de dato',
                'required' => false, 
                'choices' => array(
                    'text' => 'Texto',
                    'checkbox' => 'Si/No'
                    ),
                'empty_value' => 'Seleccionar...'
                ))
            ->add('universal', 'checkbox', array('required' => false))
            ->add('estadoactivacion', 'checkbox', array('label'=>'Activo', 'required'=>''))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Itemexamenfisico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_itemexamenfisico';
    }
}
