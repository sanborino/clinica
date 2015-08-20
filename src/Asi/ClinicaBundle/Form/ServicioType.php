<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Asi\ClinicaBundle\Entity\Tiposervicio;
use Doctrine\ORM\EntityRepository;

class ServicioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    private $tipo;

    /**
     * @param Tiposervicio $tipo
    */
    public function __construct(Tiposervicio $tipo=null)
    {
        $this->tipo = $tipo;
    }    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $array = array($this->tipo);
        $builder
            ->add('nombre','text', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 50)))
            ->add('precio','number', array('required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 10, 'pattern' => '[0-9.]*')))
            // ->add('idtiposervicio', 'entity', array(
            //     'label' => 'Tipo de servicio',
            //     'class' => 'AsiClinicaBundle:Tiposervicio',
            //     'property' => 'getNombre'
            //     ))
        ;
        if ($this->tipo===null) {
            // $builder
            //     ->get('idtiposervicio')->setAttribute('query_builder', function(EntityRepository $er){
            //         return $er->createQueryBuilder('ts')->where('ts.nombre not in (\'Medicamento\', \'Examen\', \'Vacuna\')');
            //     });
            // $builder
            //     ->get('idtiposervicio')
            //     ->setAttribute('empty_value', 'Seleccionar...')
            // ;
            $builder 
            ->add('idtiposervicio', 'entity', array(
                'label' => 'Tipo de servicio',
                'class' => 'AsiClinicaBundle:Tiposervicio',
                'property' => 'getNombre',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('ts')->where('ts.nombre not in (\'Medicamento\', \'Examen\', \'Vacuna\')');
                },
                'empty_value'=>'Seleccionar...'))
            ;
        } else {
            // $builder
            //     ->get('idtiposervicio')->setAttribute('choices', $array)
            // ;
            // $builder
            //     ->get('idtiposervicio')
            //     ->setAttribute('attr', array('style' => 'display:none'))

            // ;
            $builder
            ->add('idtiposervicio', 'entity', array(
                'label' => false,
                'class' => 'AsiClinicaBundle:Tiposervicio',
                'choices' => $array,
                'property' => 'getNombre',
                'attr' => array('style'=> 'display:none')
                ))
            ;
        }
        // var_dump($this->tipo);

        // if ($this->tipo === null) {
        //     $builder 
        //     ->add('idtiposervicio', 'entity', array(
        //         'label' => 'Tipo de servicio',
        //         'class' => 'AsiClinicaBundle:Tiposervicio',
        //         'property' => 'getNombre',
        //         'empty_value'=>'Seleccionar...'))
        //     ;
        // } else {
        //     $builder
        //     ->add('idtiposervicio', 'hidden', array(
        //         'data'=>$this->tipo))
        //     ;
        // }


    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Servicio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_servicio';
    }
}
