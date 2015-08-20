<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
    */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Email', 'attr' => array('class' => 'round default-width-input')))
            ->add('username', null, array('label' => 'Nombre de usuario', 'attr' => array('class' => 'round default-width-input')))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                // 'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Contraseña', 'attr' => array('class' => 'round default-width-input')),
                'second_options' => array('label' => 'Confirmar contraseña', 'attr' => array('class' => 'round default-width-input')),
                'invalid_message' => 'Las contraseñas no coinciden'))
            ->add('estadoActivacion', 'checkbox', array('required'=>false))
            ->add('idTipoUsuario', 'entity', array(
                 'label' => 'Tipo de usuario',
                 'class' => 'AsiClinicaBundle:Tipousuario',
                 'property' => 'getNombre'))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'fos_user_registration';
    }
}
