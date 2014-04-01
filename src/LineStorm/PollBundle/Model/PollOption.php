<?php

namespace LineStorm\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

abstract class PollOption
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
     * @var Poll
     */
    protected $poll;

    /**
     * @var boolean
     */
    protected $isCorrect;
}
