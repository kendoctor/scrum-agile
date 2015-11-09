<?php

namespace Kendoctor\Bundle\AppBundle\Form;

use Knd\Bundle\RadBundle\DependencyInjection\AutoInjectInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupType extends AbstractType implements AutoInjectInterface
{
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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'kendoctor.group.label.name'
            ))
            ->add('roles', 'choice', array(
                'choices' => $this->getRoles(),
                'multiple' => true,
                'expanded' => true,
                'label' => 'kendoctor.group.label.roles'
            ))
            ->add('users', 'entity', array(
                'class' => 'Kendoctor\Bundle\AppBundle\Entity\User',
                'multiple' => true,
                'expanded' => true,
                'label' => 'kendoctor.group.label.users',
                'by_reference' => false
            ))
        ;
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\AppBundle\Entity\Group'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kendoctor_app_group';
    }
}
