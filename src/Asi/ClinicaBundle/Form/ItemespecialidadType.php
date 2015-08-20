<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemespecialidadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idespecialidad', 'entity', array(
                'label' => 'Especialidad',
                'class' => 'AsiClinicaBundle:Especialidad',
                'property' => 'getNombre',
                'empty_value'=>'Seleccionar...'))
            ->add('iditemexamenfisico', 'entity', array(
                'label' => 'Item examen fisico',
                'class' => 'AsiClinicaBundle:Itemexamenfisico',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Itemespecialidad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_itemespecialidad';
    }
}
