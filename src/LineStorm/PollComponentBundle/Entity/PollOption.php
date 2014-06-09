<?php

namespace LineStorm\PollComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LineStorm\PollComponentBundle\Model\PollOption as BasePollOption;

/**
 * Class PollOption
 *
 * @package LineStorm\PollComponentBundle\Model
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
class PollOption extends BasePollOption
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var Poll
     *
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="options", cascade={"remove"})
     */
    protected $poll;

    /**
     * @var PollAnswer[]
     *
     * @ORM\OneToMany(targetEntity="PollAnswer", mappedBy="option", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $answers;
}
