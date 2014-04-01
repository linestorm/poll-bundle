<?php

namespace LineStorm\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class PollAnswer
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var PollOption
     */
    protected $option;

    /**
     * @var \DateTime
     */
    protected $answeredOn;
}
