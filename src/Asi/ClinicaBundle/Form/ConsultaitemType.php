<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConsultaitemType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valor', 'number', array('attr' => array('class' => 'round default-width-input')))
            ->add('idconsulta', 'entity', array(
                'label' => 'Consulta',
                'class' => 'AsiClinicaBundle:Consulta',
                'property' => 'getFechaHora',
                'empty_value'=>'Seleccionar...'))
            ->add('iditemexamenfisico', 'entity', array(
                'label' => 'Item del examen fisico',
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
            'data_class' => 'Asi\ClinicaBundle\Entity\Consultaitem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_consultaitem';
    }
}
