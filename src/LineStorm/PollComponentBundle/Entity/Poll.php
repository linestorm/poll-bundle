<?php

namespace LineStorm\PollComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LineStorm\PollComponentBundle\Model\Poll as BasePoll;

/**
 * Class Poll
 *
 * @package LineStorm\PollComponentBundle\Entity
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
class Poll extends BasePoll
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
     * @var PollOption
     *
     * @ORM\OneToMany(targetEntity="PollOption", mappedBy="poll", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $options;
}
