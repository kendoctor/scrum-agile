<?php

namespace Kendoctor\Bundle\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'kendoctor.project.label.title'
            ))
            ->add('description', 'textarea', array(
                'label' => 'kendoctor.project.label.description'
            ))
            ->add('supportEmail', 'email', array(
                'label' => 'kendoctor.project.label.support_email'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\AppBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kendoctor_app_project';
    }
}
