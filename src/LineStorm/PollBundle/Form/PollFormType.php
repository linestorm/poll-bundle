<?php

namespace LineStorm\PollBundle\Form;

use LineStorm\BlogBundle\Form\AbstractBlogFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PollFormType extends AbstractBlogFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control ckeditor-textarea',
                    'style' => 'height:200px;',
                ),
                'label' => false,
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
        return 'linestorm_blog_form_post_poll';
    }
}
