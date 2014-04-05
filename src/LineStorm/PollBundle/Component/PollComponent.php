<?php

namespace LineStorm\PollBundle\Component;

use LineStorm\BlogPostBundle\Module\Component\AbstractBodyComponent;
use LineStorm\BlogPostBundle\Module\Component\ComponentInterface;
use LineStorm\PollBundle\Model\Poll;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;

/**
 * Class PollComponent
 * @package LineStorm\PollBundle\Component
 */
class PollComponent extends AbstractBodyComponent implements ComponentInterface
{
    protected $name = 'Poll';
    protected $id = 'polls';

    /**
     * @inheritdoc
     */
    public function isSupported($entity)
    {
        return ($entity instanceof Poll);
    }

    /**
     * @inheritdoc
     */
    public function getForm(FormView $view)
    {
        return $this->container->get('templating')->render('LineStormPollBundle:Component:form.html.twig', array(
            'form'          => $view,
            'component'     => $this,
        ));
    }

    /**
     * @inheritdoc
     */
    public function getFormAssetTemplate()
    {
        return 'LineStormPollBundle:Component:form-assets.html.twig';
    }


    /**
     * @inheritdoc
     */
    public function getViewTemplate($entity)
    {
        return 'LineStormPollBundle:Component:view.html.twig';
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('polls', 'collection', array(
                'type'      => 'linestorm_blog_form_post_poll',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'     => false,
            ))
        ;
    }

    /**
     * @inheritdoc
     */
    public function getRoutes(LoaderInterface $loader)
    {
        return null;
    }
} 
