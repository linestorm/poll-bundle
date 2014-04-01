<?php

namespace LineStorm\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class Poll
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var PollOption[]
     */
    protected $options;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var UserInterface
     */
    protected $createdBy;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @var boolean
     */
    protected $multiple;

}
