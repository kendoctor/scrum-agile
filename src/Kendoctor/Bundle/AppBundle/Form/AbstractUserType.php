<?php

/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午7:55
 */

namespace Kendoctor\Bundle\AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractUserType
 * @package Kendoctor\Bundle\AppBundle\Form
 */
abstract class AbstractUserType extends AbstractType {


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    protected function buildProfileForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => 'kendoctor.user.label.username'
            ))
            ->add('email', 'email', array(
                'label' => 'kendoctor.user.label.email'
            ))
            ->add('enabled', null, array(
                'label' => 'kendoctor.user.label.enabled',
                'required' => false,
            ))
        ;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    protected function buildResetPasswordForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array('label' => 'kendoctor.user.label.new_password'),
                'second_options' => array('label' => 'kendoctor.user.label.new_password_confirmation'),
                'invalid_message' => 'kendoctor.validation.password.mismatch',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\AppBundle\Entity\User'
        ));
    }

}