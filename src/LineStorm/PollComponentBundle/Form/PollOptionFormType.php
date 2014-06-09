<?php

namespace LineStorm\PollComponentBundle\Form;

use LineStorm\CmsBundle\Form\AbstractCmsFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PollOptionFormType
 *
 * @package LineStorm\PollComponentBundle\Form
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
class PollOptionFormType extends AbstractCmsFormType
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
        return 'linestorm_cms_form_post_poll_option';
    }
}
