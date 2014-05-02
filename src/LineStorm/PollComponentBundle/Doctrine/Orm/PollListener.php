<?php

namespace LineStorm\PollComponentBundle\Doctrine\Orm;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use LineStorm\PollComponentBundle\Model\Poll;

/**
 * Doctrine ORM listener updating the canonical fields and the password.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class PollListener implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
        );
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist($args)
    {
        $object = $args->getEntity();
        if ($object instanceof Poll && $object->getCreatedOn() === null) {
            $object->setCreatedOn(new \DateTime());
        }
    }
}
