<?php

/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午7:55
 */

namespace Kendoctor\Bundle\AppBundle\Form;
use Knd\Bundle\RadBundle\DependencyInjection\AutoInjectInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractUserType
 * @package Kendoctor\Bundle\AppBundle\Form
 */
abstract class AbstractUserType extends AbstractType implements AutoInjectInterface {

    private $kndRadVoterStack;

    public function __construct($kndRadVoterStack)
    {
        $this->kndRadVoterStack = $kndRadVoterStack;
    }

    public static function getConstructorParameters()
    {
        return array('@knd_rad.security.voter.stack');
    }

    protected function getRoles()
    {
        $roles = $this->kndRadVoterStack->getRoles();
        $uppercaseRoles = array_map(function($item) {
            return strtoupper($item);
        }, $roles);
        return array_combine($uppercaseRoles, $roles);
    }

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
            ->add('baseRoles', 'choice', array(
                'choices' => $this->getRoles(),
                'multiple' => true,
                'expanded' => true,
                'label' => 'kendoctor.user.label.roles'
            ))
            ->add('groups', 'entity', array(
                'class' => 'Kendoctor\Bundle\AppBundle\Entity\Group',
                'multiple' => true,
                'expanded' => true,
                'label' => 'kendoctor.user.label.groups'
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