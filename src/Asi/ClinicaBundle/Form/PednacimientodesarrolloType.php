<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PednacimientodesarrolloType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('edadgestacional','text', array('label' => 'Edad gestacional','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 10)))
            ->add('condicionnacimiento', 'text', array('label' => 'Condicion al nacer','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('cianosis','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('convulsiones','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('ictericia','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('partocomentario','text', array('label' => 'Comentario del parto','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('pesonacimiento','text', array('label' => 'Peso al nacer','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('alimentacion','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('sesento','text', array('label' => 'Se sento','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('camino','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('separo','text', array('label' => 'Se paro', 'required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('primeraspalabras','text', array('label' => 'Primeras palabras','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('primerdiente','text', array('label' => 'Primer diente','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('frasescortas','text', array('label' => 'Frases cortas','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('controlintestinal','text', array('label' => 'Control intestinal','required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('obstetra','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 45)))
            ->add('idpaciente', 'entity', array(
                'label' => 'Paciente',
                'class' => 'AsiClinicaBundle:Paciente',
                'property' => 'getNombreApellido',
                'empty_value'=>'Seleccionar...',
                'attr' => array(
                    'required'=>'required')
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Pednacimientodesarrollo',
            'required' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_pednacimientodesarrollo';
    }
}
