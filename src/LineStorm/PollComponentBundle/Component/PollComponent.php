<?php

namespace LineStorm\PollComponentBundle\Component;

use FOS\UserBundle\Model\UserInterface;
use LineStorm\Content\Component\AbstractBodyComponent;
use LineStorm\Content\Component\ComponentInterface;
use LineStorm\Content\Component\View\ComponentView;
use LineStorm\PollComponentBundle\Model\Poll;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class PollComponent
 * @package LineStorm\PollComponentBundle\Component
 */
class PollComponent extends AbstractBodyComponent implements ComponentInterface
{
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return 'polls';
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return  'Poll';
    }

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
    public function getAssets()
    {
        return array(
            '@LineStormPollComponentBundle/Resources/public/js/poll.js'
        );
    }

    public function getViewAssets()
    {
        return array(
            '@LineStormPollComponentBundle/Resources/public/js/poll_view.js'
        );
    }

    /**
     * @inheritdoc
     */
    public function getForm(FormView $view)
    {
        return $this->container->get('templating')->render('LineStormPollComponentBundle:Component:form.html.twig', array(
            'form'          => $view,
            'component'     => $this,
        ));
    }

    /**
     * @inheritdoc
     */
    public function getView($entity)
    {
        // check if the user has answered the poll
        $request = $this->container->get('request');
        $token   = $this->container->get('security.context')->getToken();
        $poll = $this->modelManager->get('poll')->findResults($entity->getId());

        $allowVoting = true;

        $qb = $this->modelManager->get('poll_answer')->createQueryBuilder('a')
            ->select('a', 'o')
            ->join('a.option', 'o')
            ->join('o.poll', 'p')
            ->where('p.id = ?1')
            ->setParameter(1, $poll['id']);

        if($poll['allowAnonymous'])
        {
            $qb->andWhere('a.ip = :ip')
               ->setParameter(':ip', $request->getClientIp());
            $answers = $qb->getQuery()->getArrayResult();
        }
        else
        {
            // if there is no token, dont allow voting
            if(!($token instanceof TokenInterface) || !($token->getUser() instanceof UserInterface))
            {
                $allowVoting = false;
                $answers = array();
            }
            else
            {
                $qb->andWhere('a.user = :user')
                    ->setParameter(':user', $token->getUser());
                $answers = $qb->getQuery()->getArrayResult();
            }
        }


        if($allowVoting && count($answers))
        {
            $allowVoting = false;
        }

        return new ComponentView('LineStormPollComponentBundle:Component:view.html.twig', array(
            'user_answers'  => $answers,
            'poll_results'  => $poll,
            'allow_voting'  => $allowVoting,
        ));
    }


    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('polls', 'collection', array(
                'type'      => 'linestorm_cms_form_post_poll',
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
    public function getFormFields()
    {
        // forms are loaded asyncronously, so just return nothing
        return array();
    }

    /**
     * @inheritdoc
     */
    public function getRoutes(Loader $loader)
    {
        return $loader->import('@LineStormPollComponentBundle/Resources/config/routing/api.yml', 'rest');
    }
} 
