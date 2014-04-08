<?php

namespace LineStorm\PollBundle\Form;

use LineStorm\CmsBundle\Form\AbstractCmsFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PollFormType extends AbstractCmsFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('body', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control ckeditor-textarea',
                    'style' => 'height:200px;',
                ),
                'label' => false,
            ))
            ->add('options', 'collection', array(
                'type'      => 'linestorm_cms_form_post_poll_option',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'prototype_name' => '__option_name__',
            ))

            ->add('startDate', 'datetime', array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data'        => new \DateTime(),
                'required' => false,
            ))
            ->add('endDate', 'datetime', array(
                //'help'        => 'Leave blank to not set an end date',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data'        => null,
                'required' => false,
            ))
            ->add('allowAnonymous', 'checkbox', array(
                //'help'        => 'If checked, the anonymous users can vote',
                'required' => false,
            ))
            ->add('multiple', 'checkbox', array(
                //'help'        => 'If checked, the anonymous users can vote',
                'required' => false,
            ))
            ->add('order', 'hidden')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->modelManager->getEntityClass('poll')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linestorm_cms_form_post_poll';
    }
}
