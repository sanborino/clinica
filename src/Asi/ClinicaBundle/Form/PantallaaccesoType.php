<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PantallaaccesoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pantalla', 'entity', array(
                'label' => 'Pantalla',
                'class' => 'AsiClinicaBundle:Pantalla',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
            ->add('tipoUsuario', 'entity', array(
                'label' => 'Tipo de Usuario',
                'class' => 'AsiClinicaBundle:Tipousuario',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Pantallaacceso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_pantallaacceso';
    }
}
