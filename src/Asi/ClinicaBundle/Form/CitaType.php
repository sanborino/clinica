<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CitaType extends AbstractType
{

    private $disponibilidad;

    private $paciente;

    /**
     * @param string $disponibilidad
    */
    public function __construct($disponibilidad=null, $paciente=null)
    {
        $this->disponibilidad = $disponibilidad;
        $this->paciente = $paciente;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $disponibilidad = array($this->disponibilidad);

        $builder
            // ->add('fecharealizacion', 'date', array(
            //     'label' => 'Fecha de realizacion',
            //     'years' => range(2014, date('Y'))))
            ->add('comentario', 'textarea', array('label' => 'Motivo', 'required' => false, 'attr' => array('class' => 'round default-width-input', 'maxlength' => 100)))
            ->add('tipocita','choice', array(
                'label' => 'Tipo de cita',
                'required' => true,
                'choices' => array(
                    'Control' => 'Control',
                    'Urgencia' => 'Urgencia',
                    'Primera vez' => 'Primera vez',
                    ),
                'empty_value' => 'Seleccionar...'
                ))
            ->add('estado', 'hidden', array(
                'data'=>'Pendiente'))
            // ->add('idDisponibilidad', 'entity', array(
            //     'label'=>'Disponibilidad',
            //     'choices' => $disponibilidad,
            //     'class'=>'AsiClinicaBundle:Disponibilidad',
            //     'property'=>'getFechaHora',
            //     'empty_value'=>'Seleccionar...'))
            // ->add('idpaciente', 'entity', array(
            //     'label' => 'Paciente',
            //     'class' => 'AsiClinicaBundle:Paciente',
            //     'property' => 'nombres',
            //     'empty_value'=>'Seleccionar...'))
        ;


        if($this->disponibilidad===null)
        {
            $builder
            ->add('idDisponibilidad', 'entity', array(
                 'label'=>'Disponibilidad',
                 'class'=>'AsiClinicaBundle:Disponibilidad',
                 'property'=>'getFechaHoraConsultorio',
                 'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('d')
                    ->where('d.disponibilidad =\'1\' AND d.fecha >= :fecha AND d.hora > :hora')
                    ->setParameter('fecha', new \DateTime('today'))
                    ->setParameter('hora', new \DateTime('now'))
                    ;},
                 'empty_value'=>'Seleccionar...',
                 'attr' => array('class' => 'chosen_select')
                 ));

        } else {
            $builder
            ->add('idDisponibilidad', 'entity', array(
                'label'=>false,
                'choices' => $disponibilidad,
                'class'=>'AsiClinicaBundle:Disponibilidad',
                'property'=>'getFechaHora',
                'attr' => array('style' => 'display:none')
                ));
        }

        if($this->paciente===null)
        {
            $builder
            ->add('idpaciente', 'entity', array(
                'label' => 'Paciente',
                'class' => 'AsiClinicaBundle:Paciente',
                'property' => 'getIdNombreApellido',
                'empty_value'=>'Seleccionar...',
                'attr' => array('class' => 'chosen_select')

                ));
           
        } else {
            $builder
            ->add('idpaciente', 'entity', array(
                'label' => false,
                'choices' => $this->paciente,
                'class' => 'AsiClinicaBundle:Paciente',
                'property' => 'getIdNombreApellido',
                'attr' => array('style' => 'display:none')
                ));
            
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Cita'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_cita';
    }
}
