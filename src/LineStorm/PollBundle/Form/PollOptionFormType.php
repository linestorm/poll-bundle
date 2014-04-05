<?php

namespace LineStorm\PollBundle\Form;

use LineStorm\BlogBundle\Form\AbstractBlogFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PollOptionFormType extends AbstractBlogFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer', 'text', array(
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
            'data_class' => $this->modelManager->getEntityClass('poll_option')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linestorm_blog_form_post_poll_option';
    }
}
