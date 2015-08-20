<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiagnosticopatologiaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    private $patologias;

    /**
     * @param patologias $patologias
    */
    public function __construct($patologias=null)
    {
        $this->patologias = $patologias;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idpacientepatologia', new PacientepatologiaType($this->patologias), array(
                'label' => 'Agregar patología'))
            ;
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Diagnosticopatologia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_diagnosticopatologia';
    }
}
