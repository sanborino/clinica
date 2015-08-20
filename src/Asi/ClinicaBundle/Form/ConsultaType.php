<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ConsultaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motivoconsulta','text', array('label' => 'Motivo de la consulta','attr' => array('class' => 'round default-width-input', 'maxlength' => 150)))
            ->add('diagnostico', 'text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 300)))
            ->add('sintomas', 'textarea', array('attr' => array('class' => 'round default-width-input')))
            ->add('comentario', 'textarea', array('required' => false, 'attr' => array('class' => 'round default-width-input')))
            ->add('fecha')
            ->add('hora')
            ->add('idcita', 'entity', array(
                'label' => 'Cita',
                'class' => 'AsiClinicaBundle:Cita',
                'property' => 'getNombreApellidoFechaHora',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')->where('c.estado =\'Pendiente\'');
                },
                'empty_value'=>'Seleccionar...')
            )
            ->add('idfactura', 'entity', array(
                'label' => 'Factura',
                'class' => 'AsiClinicaBundle:Factura',
                'property' => 'getTitularDui',
                'empty_value'=>'Titular y dui'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Consulta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_consulta';
    }
}
