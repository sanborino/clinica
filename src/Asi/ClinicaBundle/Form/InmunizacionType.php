<?php

namespace Asi\ClinicaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class InmunizacionType extends AbstractType
{

    private $vacunas;

    /**
     * @param vacunas $vacunas
    */
    public function __construct($vacunas=null)
    {
        $this->vacunas = $vacunas;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $emptyval = "Seleccionar...";
        $disabled = false;
        if (count($this->vacunas)===0 && $this->vacunas!== null){
            $emptyval = "No hay vacunas disponibles.";
            $disabled = true;

        }
        $builder
            ->add('idvacuna', 'entity', array(
                'label' => 'Vacuna',
                'class' => 'AsiClinicaBundle:Vacuna',
                'property' => 'getNombre',
                'choices' => $this->vacunas,
                'empty_value'=>$emptyval,
                'disabled' => $disabled,
                'attr' => array('class' => 'chosen_select')));

        $builder
            ->add('fechatomada','date', array(
                'label' => 'Fecha tomada',
                'years' => range(1900, date('Y'))))
            ->add('idconsulta', 'entity', array(
                'label' => 'Consulta',
                'required' => false, 
                'class' => 'AsiClinicaBundle:Cita',
                'property' => 'getNombreApellidoFechaHora',
                'empty_value'=>'Seleccionar...'))
            ->add('idpaciente', 'entity', array(
                'label' => 'Paciente',
                'class' => 'AsiClinicaBundle:Paciente',
                'property' => 'getNombreApellido',
                'empty_value'=>'Seleccionar...'))
        ;


    }
    

    //     'query_builder' => function(EntityRepository $er){
    //     return $er->createQueryBuilder('v')
    //     ->innerJoin('AsiClinicaBundle:Servicio', 's', 'WITH', 'v.idservicio = s.id')
    //     ->innerJoin('AsiClinicaBundle:Tiposervicio', 'ts', 'WITH', 's.idtiposervicio = ts.id')
    //     ->where('ts.nombre = \'Vacuna\'');
    // },
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asi\ClinicaBundle\Entity\Inmunizacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asi_clinicabundle_inmunizacion';
    }
}
